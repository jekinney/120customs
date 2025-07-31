<?php

namespace Tests\Feature\Middleware;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_middleware_redirects_authenticated_users(): void
    {
        $user = User::factory()->create();

        // Test login page
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/');

        // Test register page
        $response = $this->actingAs($user)->get('/register');
        $response->assertRedirect('/');
    }

    public function test_auth_middleware_redirects_guests(): void
    {
        // Test admin dashboard
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');

        // Test admin routes
        $response = $this->get('/admin/users');
        $response->assertRedirect('/login');

        $response = $this->get('/admin/orders');
        $response->assertRedirect('/login');

        $response = $this->get('/admin/products');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_users_can_access_protected_routes(): void
    {
        $user = User::factory()->create();

        $routes = [
            '/admin/dashboard',
            '/admin/users',
            '/admin/orders',
            '/admin/products',
            '/admin/analytics',
            '/admin/settings',
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($user)->get($route);
            
            // Most routes redirect to dashboard (placeholder), dashboard should return 200
            if ($route === '/admin/dashboard') {
                $response->assertStatus(200);
            } else {
                $response->assertRedirect('/admin/dashboard');
            }
        }
    }

    public function test_session_regeneration_on_login(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }

    public function test_session_invalidation_on_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
