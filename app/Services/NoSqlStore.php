<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\File;

class NoSqlStore
{
    protected static string $storePath = 'database/nosql_data';

    /**
     * Get path to the JSON document collection.
     */
    protected static function getCollectionFile(string $collection): string
    {
        $dir = base_path(static::$storePath);
        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }
        return $dir . '/' . $collection . '.json';
    }

    /**
     * Get all documents from collection.
     */
    public static function all(string $collection = 'products'): array
    {
        $file = static::getCollectionFile($collection);
        if (!File::exists($file)) {
            return [];
        }
        $content = File::get($file);
        return json_decode($content, true) ?: [];
    }

    /**
     * Save a document to the NoSQL collection and back up its media file.
     */
    public static function save(string $collection, array $data): array
    {
        $items = static::all($collection);
        $id = $data['id'] ?? (count($items) > 0 ? max(array_column($items, 'id')) + 1 : 1);
        $data['id'] = $id;
        $data['updated_at'] = now()->toIso8601String();
        $data['created_at'] = $data['created_at'] ?? now()->toIso8601String();

        // Back up image if present
        if (!empty($data['image'])) {
            static::backupMedia($data['image']);
        }

        // Replace or append
        $found = false;
        foreach ($items as $k => $item) {
            if ($item['id'] == $id) {
                $items[$k] = array_merge($item, $data);
                $found = true;
                break;
            }
        }
        if (!$found) {
            $items[] = $data;
        }

        File::put(static::getCollectionFile($collection), json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return $data;
    }

    /**
     * Delete document from collection.
     */
    public static function delete(string $collection, $id): bool
    {
        $items = static::all($collection);
        $newItems = [];
        $deleted = false;

        foreach ($items as $item) {
            if ($item['id'] == $id) {
                $deleted = true;
                if (!empty($item['image'])) {
                    static::removeBackupMedia($item['image']);
                }
            } else {
                $newItems[] = $item;
            }
        }

        if ($deleted) {
            File::put(static::getCollectionFile($collection), json_encode(array_values($newItems), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        return $deleted;
    }

    /**
     * Permanently copy media to persistent NoSQL store.
     */
    public static function backupMedia(string $imagePath): void
    {
        $source = storage_path('app/public/' . $imagePath);
        if (File::exists($source)) {
            $dest = base_path(static::$storePath . '/media/' . basename($imagePath));
            File::copy($source, $dest);
        }
    }

    /**
     * Remove backup media.
     */
    public static function removeBackupMedia(string $imagePath): void
    {
        $dest = base_path(static::$storePath . '/media/' . basename($imagePath));
        if (File::exists($dest)) {
            File::delete($dest);
        }
    }

    /**
     * Restore missing media and sync NoSQL database into relational tables.
     * Ensures zero data loss across server restarts.
     */
    public static function syncToDatabase(): void
    {
        // Guard against running before migrations have executed (e.g. testing)
        try {
            if (!\Illuminate\Support\Facades\Schema::hasTable('products')) {
                return;
            }
        } catch (\Throwable $e) {
            return;
        }

        // 1. Ensure storage directory junction/structure
        $storagePublic = storage_path('app/public/products');
        if (!File::isDirectory($storagePublic)) {
            File::makeDirectory($storagePublic, 0755, true);
        }

        // 2. Restore images from NoSQL media backup to storage if missing
        $backupMediaDir = base_path(static::$storePath . '/media');
        if (File::isDirectory($backupMediaDir)) {
            foreach (File::files($backupMediaDir) as $file) {
                $target = $storagePublic . '/' . $file->getFilename();
                if (!File::exists($target)) {
                    File::copy($file->getPathname(), $target);
                }
            }
        }

        // 3. Sync NoSQL products into SQLite if table is empty
        $nosqlProducts = static::all('products');
        if (!empty($nosqlProducts)) {
            foreach ($nosqlProducts as $item) {
                Product::updateOrCreate(
                    ['id' => $item['id']],
                    [
                        'name' => $item['name'],
                        'name_ar' => $item['name_ar'] ?? null,
                        'description' => $item['description'] ?? '',
                        'description_ar' => $item['description_ar'] ?? null,
                        'image' => $item['image'] ?? 'default.jpg',
                        'price' => $item['price'] ?? null,
                        'category' => $item['category'] ?? 'Équipement',
                        'is_active' => $item['is_active'] ?? true,
                        'order' => $item['order'] ?? 1,
                    ]
                );
            }
        }
    }
}

