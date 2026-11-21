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

        // Settings from official PHEM INDUSTRIE S.A.R.L letterhead
        Setting::updateOrCreate(['key' => 'site_name'], ['value' => 'PHEM INDUSTRIE S.A.R.L']);
        Setting::updateOrCreate(['key' => 'phone'], ['value' => '0661533025']);
        Setting::updateOrCreate(['key' => 'fax'], ['value' => '05 22 76 71 17']);
        Setting::updateOrCreate(['key' => 'whatsapp'], ['value' => '+212661533025']);
        Setting::updateOrCreate(['key' => 'email'], ['value' => 'phemindustrie20@gmail.com']);
        Setting::updateOrCreate(['key' => 'address'], ['value' => '75 BD 11 Janvier ETG 1 APT 169 Casablanca']);
        Setting::updateOrCreate(['key' => 'about_text'], ['value' => 'Achat, vente et commercialisation des fournitures et équipements industrie hydraulique, pneumatiques, mécanique, tournage fraisage.']);
        Setting::updateOrCreate(['key' => 'about_text_ar'], ['value' => 'شراء وبيع وتسويق المعدات واللوازم الصناعية الهيدروليكية والهوائية والميكانيكية والخراطة والتفريز.']);
        Setting::updateOrCreate(['key' => 'capital'], ['value' => '100.000 DH']);
        Setting::updateOrCreate(['key' => 'rc'], ['value' => '379533']);
        Setting::updateOrCreate(['key' => 'if'], ['value' => '20794461']);
        Setting::updateOrCreate(['key' => 'patente'], ['value' => '33391116']);
        Setting::updateOrCreate(['key' => 'ice'], ['value' => '001951579000095']);
        Setting::updateOrCreate(['key' => 'cnss'], ['value' => '5546281']);

        // Restore user products from persistent NoSQL store
        NoSqlStore::syncToDatabase();
    }
}
