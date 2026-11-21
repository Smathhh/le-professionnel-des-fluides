<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsitePagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_all_public_pages_load_successfully(): void
    {
        $routes = ['/', '/services', '/products', '/gallery', '/about', '/contact'];

        foreach ($routes as $uri) {
            $response = $this->get($uri);
            $response->assertStatus(200);
        }
    }

    public function test_admin_bar_is_hidden_for_all_public_pages_even_when_logged_in(): void
    {
        // Guest visitor should NOT see admin shortcuts
        $guestResponse = $this->get('/');
        $guestResponse->assertStatus(200);
        $guestResponse->assertDontSee('App Mobile Admin');
        $guestResponse->assertDontSee('Espace Admin');

        // Authenticated admin should also not see the deleted top bar on public pages
        $admin = User::where('email', 'admin@phemindustrie.ma')->first();
        $this->assertNotNull($admin);

        $adminResponse = $this->actingAs($admin)->get('/');
        $adminResponse->assertStatus(200);
        $adminResponse->assertDontSee('App Mobile Admin');
        $adminResponse->assertDontSee('Espace Admin');
    }

    public function test_contact_form_submits_successfully(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Karim Test',
            'email' => 'karim@example.ma',
            'phone' => '0666000000',
            'service_type' => 'hydraulique',
            'message' => 'Besoin d un devis pour installation pompe.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'karim@example.ma',
        ]);
    }

    public function test_admin_dashboard_requires_authentication(): void
    {
        $this->get('/admin')->assertRedirect('/login');

        $admin = User::where('email', 'admin@phemindustrie.ma')->first();
        $this->actingAs($admin)->get('/admin')->assertStatus(200);
    }

    public function test_mobile_api_products_endpoint_requires_pin_and_returns_json(): void
    {
        $this->getJson('/api/mobile/products')->assertStatus(403);

        $pin = env('ADMIN_MOBILE_PIN', '1234');
        $response = $this->withHeaders(['X-Admin-PIN' => $pin])->getJson('/api/mobile/products');
        $response->assertStatus(200);
        $response->assertJsonStructure(['products']);
    }
}
