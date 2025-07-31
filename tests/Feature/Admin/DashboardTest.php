<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_requires_authentication(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_access_admin_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
        $response->assertSee('120 Customs');
    }

    public function test_admin_dashboard_displays_stats_cards(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Total Users');
        $response->assertSee('Total Orders');
        $response->assertSee('Revenue');
        $response->assertSee('Pending Orders');
    }

    public function test_admin_dashboard_displays_recent_orders(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Recent Orders');
        $response->assertSee('Custom Exhaust System');
        $response->assertSee('John Doe');
        $response->assertSee('Performance Tune');
        $response->assertSee('Jane Smith');
    }

    public function test_admin_dashboard_displays_quick_actions(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Quick Actions');
        $response->assertSee('Add User');
        $response->assertSee('Add Product');
        $response->assertSee('View Orders');
        $response->assertSee('Analytics');
    }

    public function test_admin_dashboard_displays_user_info(): void
    {
        $user = User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
        ]);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Test Admin');
    }

    public function test_admin_dashboard_has_sidebar_navigation(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Users');
        $response->assertSee('Orders');
        $response->assertSee('Products');
        $response->assertSee('Analytics');
        $response->assertSee('Settings');
    }

    public function test_admin_dashboard_shows_correct_page_title(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('<title>Admin Dashboard - Laravel</title>', false);
    }

    public function test_admin_dashboard_includes_logout_functionality(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Sign out');
    }
}
