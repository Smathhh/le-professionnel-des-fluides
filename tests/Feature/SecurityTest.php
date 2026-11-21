<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SecurityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Test unauthenticated access to mobile store is blocked with 403 Forbidden.
     */
    public function test_unauthorized_user_cannot_upload_piece(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->create('test.jpg', 100, 'image/jpeg');

        $response = $this->post(route('admin.mobile.store'), [
            'name' => 'Hacked Item',
            'category' => 'electricite',
            'image' => $file,
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test unauthenticated access to mobile delete is blocked with 403 Forbidden.
     */
    public function test_unauthorized_user_cannot_delete_piece(): void
    {
        $product = Product::first();
        if ($product) {
            $response = $this->delete(route('admin.mobile.destroy', $product->id));
            $response->assertStatus(403);
            $this->assertDatabaseHas('products', ['id' => $product->id]);
        }
    }

    /**
     * Test rate limiting on PIN verification (max 5 attempts per minute).
     */
    public function test_mobile_pin_has_rate_limiting(): void
    {
        // 5 wrong attempts
        for ($i = 0; $i < 5; $i++) {
            $this->post(route('admin.mobile.pin'), ['pin' => '9999']);
        }

        // 6th attempt must be throttled with HTTP 429 Too Many Requests
        $response = $this->post(route('admin.mobile.pin'), ['pin' => '9999']);
        $response->assertStatus(429);
    }

    /**
     * Test rate limiting on Admin Login (max 5 attempts per minute).
     */
    public function test_login_has_rate_limiting(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post(route('login.post'), ['email' => 'bad@admin.com', 'password' => 'wrong']);
        }

        $response = $this->post(route('login.post'), ['email' => 'bad@admin.com', 'password' => 'wrong']);
        $response->assertStatus(429);
    }
}
