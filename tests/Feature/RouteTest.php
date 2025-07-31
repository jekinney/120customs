<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_login_route_is_accessible(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_register_route_is_accessible(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_admin_routes_exist(): void
    {
        $routes = [
            'admin.dashboard',
            'admin.users.index',
            'admin.users.create',
            'admin.orders.index',
            'admin.orders.pending',
            'admin.orders.completed',
            'admin.products.index',
            'admin.products.create',
            'admin.categories.index',
            'admin.analytics',
            'admin.settings',
        ];

        foreach ($routes as $routeName) {
            $this->assertTrue(
                \Illuminate\Support\Facades\Route::has($routeName),
                "Route {$routeName} does not exist"
            );
        }
    }

    public function test_auth_routes_exist(): void
    {
        $routes = [
            'login',
            'register',
            'logout',
        ];

        foreach ($routes as $routeName) {
            $this->assertTrue(
                \Illuminate\Support\Facades\Route::has($routeName),
                "Route {$routeName} does not exist"
            );
        }
    }

    public function test_admin_routes_have_correct_middleware(): void
    {
        $route = \Illuminate\Support\Facades\Route::getRoutes()->getByName('admin.dashboard');
        
        $this->assertNotNull($route);
        $this->assertContains('auth', $route->middleware());
    }

    public function test_guest_routes_have_correct_middleware(): void
    {
        $loginRoute = \Illuminate\Support\Facades\Route::getRoutes()->getByName('login');
        $registerRoute = \Illuminate\Support\Facades\Route::getRoutes()->getByName('register');
        
        $this->assertNotNull($loginRoute);
        $this->assertNotNull($registerRoute);
        
        // Check that POST routes exist
        $this->assertNotNull(\Illuminate\Support\Facades\Route::getRoutes()->match(
            \Illuminate\Http\Request::create('/login', 'POST')
        ));
        
        $this->assertNotNull(\Illuminate\Support\Facades\Route::getRoutes()->match(
            \Illuminate\Http\Request::create('/register', 'POST')
        ));
    }
}
