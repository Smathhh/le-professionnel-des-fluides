<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Setting;
use App\Services\NoSqlStore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@phemindustrie.ma'],
            [
                'name' => 'Admin Phem',
                'password' => bcrypt('admin123')
            ]
        );

        // Core Hydraulic & Pneumatic Maintenance Services
        $services = [
            [
                'name' => 'Maintenance Hydraulique Industrielle',
                'name_ar' => 'الصيانة الهيدروليكية الصناعية',
                'description' => 'Diagnostic, réparation et entretien de centrales hydrauliques, pompes, vérins, distributeurs et flexibles haute pression.',
                'description_ar' => 'تشخيص وإصلاح وصيانة المحطات الهيدروليكية والمضخات والأسطوانات والموزعات.',
                'icon' => 'hydraulic',
                'order' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Maintenance Pneumatique & Air Comprimé',
                'name_ar' => 'الصيانة الهوائية والهواء المضغوط',
                'description' => 'Entretien et dépannage de compresseurs, vérins pneumatiques, électrovannes, filtres régulateurs et réseaux d\'air comprimé.',
                'description_ar' => 'صيانة وإصلاح الضواغط والأسطوانات الهوائية والصمامات وشبكات الهواء المضغوط.',
                'icon' => 'pneumatic',
                'order' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Révision de Machines Hydrauliques & Pneumatiques',
                'name_ar' => 'إصلاح وتجديد الآلات الهيدروليكية والهوائية',
                'description' => 'Remise en état complète de presses, engins, machines de production et équipements industriels pneumatiques et hydrauliques.',
                'description_ar' => 'إصلاح شامل للمكابس والمعدات الصناعية الهيدروليكية والهوائية.',
                'icon' => 'machinery',
                'order' => 3,
                'is_active' => true
            ],
            [
                'name' => 'Contrats de Maintenance Préventive',
                'name_ar' => 'عقود الصيانة الوقائية',
                'description' => 'Suivi périodique, contrôle de pression, analyse d\'huile hydraulique et prévention des pannes sur toutes vos machines.',
                'description_ar' => 'متابعة دورية وفحص الضغط والزيوت للوقاية من الأعطال.',
                'icon' => 'preventive',
                'order' => 4,
                'is_active' => true
            ]
        ];

        $allowedNames = array_column($services, 'name');
        Service::whereNotIn('name', $allowedNames)->delete();

        foreach ($services as $srv) {
            Service::updateOrCreate(['name' => $srv['name']], $srv);
        }

        // Settings with WhatsApp number
        Setting::updateOrCreate(['key' => 'site_name'], ['value' => 'LE PROFESSIONNEL DES FLUIDES']);
        Setting::updateOrCreate(['key' => 'phone'], ['value' => '+212 666-569562']);
        Setting::updateOrCreate(['key' => 'whatsapp'], ['value' => '+212666569562']);
        Setting::updateOrCreate(['key' => 'email'], ['value' => 'contact@phemindustrie.ma']);
        Setting::updateOrCreate(['key' => 'address'], ['value' => 'Casablanca, Maroc']);
        Setting::updateOrCreate(['key' => 'about_text'], ['value' => 'Spécialiste au Maroc de la maintenance, réparation et révision de toutes les machines hydrauliques et pneumatiques industrielles.']);
        Setting::updateOrCreate(['key' => 'about_text_ar'], ['value' => 'شركة متخصصة في صيانة وإصلاح جميع الآلات الهيدروليكية والهوائية الصناعية في المغرب.']);

        // Restore user products from persistent NoSQL store
        NoSqlStore::syncToDatabase();
    }
}
