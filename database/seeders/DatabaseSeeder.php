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

        // Official 9 PHEM INDUSTRIE S.A.R.L Services
        $services = [
            [
                'name' => 'Installation des Circuits Hydrauliques et Pneumatiques',
                'name_ar' => 'تركيب الدوائر الهيدروليكية والهوائية',
                'description' => 'Étude, pose et mise en service de réseaux et circuits hydrauliques et pneumatiques haute et basse pression pour l\'industrie.',
                'description_ar' => 'دراسة وتركيب وتشغيل الشبكات والدوائر الهيدروليكية والهوائية الصناعية.',
                'icon' => 'circuit',
                'order' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Diagnostic des Pannes Hydrauliques',
                'name_ar' => 'تشخيص الأعطال الهيدروليكية',
                'description' => 'Contrôle de pression, débitmétrie, détection de fuites internes et identification rapide des pannes sur machines hydrauliques.',
                'description_ar' => 'فحص الضغط والتدفق وكشف التسربات وتحديد الأعطال بسرعة ودقة.',
                'icon' => 'diagnostic',
                'order' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Réparation des Électro-Pompes Hydrauliques',
                'name_ar' => 'إصلاح المضخات الكهربائية الهيدروليكية',
                'description' => 'Révision, remise en état et test sur banc de toutes électro-pompes hydrauliques (à pistons, à palettes et à engrenages).',
                'description_ar' => 'إصلاح وتجديد واختبار جميع المضخات الهيدروليكية.',
                'icon' => 'electropompe',
                'order' => 3,
                'is_active' => true
            ],
            [
                'name' => 'Confection des Centrales et Vérins Hydrauliques',
                'name_ar' => 'تصنيع المحطات والأسطوانات الهيدروليكية',
                'description' => 'Conception et fabrication sur mesure de centrales hydrauliques industrielles et vérins adaptés à vos cahiers des charges.',
                'description_ar' => 'تصميم وتصنيع المحطات والأسطوانات الهيدروليكية حسب الطلب.',
                'icon' => 'centrale',
                'order' => 4,
                'is_active' => true
            ],
            [
                'name' => 'Réparation des Vérins Hydrauliques et Pneumatiques',
                'name_ar' => 'إصلاح الأسطوانات الهيدروليكية والهوائية',
                'description' => 'Remplacement de joints haute pression, chromage ou fabrication de tiges, honage de fûts et essais d\'étanchéité.',
                'description_ar' => 'تبديل موانع التسرب وإصلاح وتجديد الأسطوانات الهيدروليكية والهوائية.',
                'icon' => 'verin',
                'order' => 5,
                'is_active' => true
            ],
            [
                'name' => 'Gonflage et Réparation des Accumulateurs',
                'name_ar' => 'شحن وإصلاح المراكم الهيدروليكية',
                'description' => 'Contrôle de pression, gonflage à l\'azote (N2) et remplacement des vessies et membranes d\'accumulateurs hydrauliques.',
                'description_ar' => 'فحص وشحن المراكم بغاز النيتروجين وتبديل الأغشية.',
                'icon' => 'accumulateur',
                'order' => 6,
                'is_active' => true
            ],
            [
                'name' => 'Entretien et Réparation Mécanique',
                'name_ar' => 'الصيانة والإصلاح الميكانيكي',
                'description' => 'Maintenance préventive et corrective des ensembles mécaniques, réducteurs, transmissions et machines de production.',
                'description_ar' => 'الصيانة الوقائية والتصحيحية للمعدات والآلات الميكانيكية.',
                'icon' => 'mecanique',
                'order' => 7,
                'is_active' => true
            ],
            [
                'name' => 'Fournitures des Composants Hydrauliques et Pneumatiques',
                'name_ar' => 'توريد المكونات الهيدروليكية والهوائية',
                'description' => 'Vente de pompes, distributeurs, électrovannes, manomètres, flexibles, raccords et composants certifiés disponibles en stock.',
                'description_ar' => 'توفير المضخات والموزعات والصمامات والخراطيم والمكونات الصناعية.',
                'icon' => 'composants',
                'order' => 8,
                'is_active' => true
            ],
            [
                'name' => 'Usinage et Fabrication Mécanique',
                'name_ar' => 'الخراطة والتفريز والتصنيع الميكانيكي',
                'description' => 'Tournage, fraisage et fabrication de pièces mécaniques de précision sur plan ou sur modèle pour l\'industrie.',
                'description_ar' => 'الخراطة والتفريز وتصنيع القطع الميكانيكية الدقيقة حسب الطلب.',
                'icon' => 'usinage',
                'order' => 9,
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
