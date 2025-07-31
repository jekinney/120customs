<?php

namespace Tests\Browser\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DashboardTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_unauthenticated_users_redirected_to_login(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/dashboard')
                    ->assertPathIs('/login')
                    ->assertSee('Sign in to your account');
        });
    }

    public function test_admin_dashboard_displays_correctly(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                    ->visit('/admin/dashboard')
                    ->assertSee('Dashboard')
                    ->assertSee('120 Customs')
                    ->assertSee('Total Users')
                    ->assertSee('Total Orders')
                    ->assertSee('Revenue')
                    ->assertSee('Pending Orders')
                    ->assertSee('Recent Orders')
                    ->assertSee('Quick Actions');
        });
    }

    public function test_sidebar_navigation_is_present(): void
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/admin/dashboard')
                    ->assertSee('Dashboard')
                    ->assertSee('Users')
                    ->assertSee('Orders')
                    ->assertSee('Products')
                    ->assertSee('Analytics')
                    ->assertSee('Settings');
        });
    }

    public function test_user_dropdown_functionality(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/admin/dashboard')
                    ->assertSee('Test User')
                    ->click('#user-menu-button')
                    ->waitFor('#user-dropdown')
                    ->assertSee('Profile')
                    ->assertSee('Settings')
                    ->assertSee('Sign out');
        });
    }

    public function test_stats_cards_display_data(): void
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/admin/dashboard')
                    ->assertSee('1,234') // Total users
                    ->assertSee('567') // Total orders
                    ->assertSee('$89,432') // Revenue
                    ->assertSee('23'); // Pending orders
        });
    }

    public function test_recent_orders_section(): void
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/admin/dashboard')
                    ->assertSee('Recent Orders')
                    ->assertSee('Custom Exhaust System')
                    ->assertSee('John Doe')
                    ->assertSee('$1,250')
                    ->assertSee('Completed')
                    ->assertSee('Performance Tune')
                    ->assertSee('Jane Smith')
                    ->assertSee('In Progress')
                    ->assertSee('Turbo Installation')
                    ->assertSee('Mike Johnson')
                    ->assertSee('Pending');
        });
    }

    public function test_quick_actions_section(): void
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/admin/dashboard')
                    ->assertSee('Quick Actions')
                    ->assertSee('Add User')
                    ->assertSee('Create a new user account')
                    ->assertSee('Add Product')
                    ->assertSee('Add a new product or service')
                    ->assertSee('View Orders')
                    ->assertSee('Manage pending orders')
                    ->assertSee('Analytics')
                    ->assertSee('View reports and analytics');
        });
    }

    public function test_mobile_sidebar_toggle(): void
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/admin/dashboard')
                    ->resize(768, 1024) // Mobile viewport
                    ->assertPresent('#sidebar-toggle')
                    ->click('#sidebar-toggle')
                    ->pause(500) // Wait for animation
                    ->assertVisible('#sidebar-overlay');
        });
    }

    public function test_sidebar_submenu_functionality(): void
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/admin/dashboard')
                    ->assertDontSee('All Users') // Submenu should be hidden initially
                    ->script('toggleSubmenu("users-submenu")') // Trigger JavaScript function
                    ->pause(200)
                    ->assertSee('All Users')
                    ->assertSee('Add User');
        });
    }

    public function test_revenue_chart_placeholder(): void
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/admin/dashboard')
                    ->assertSee('Revenue Overview')
                    ->assertSee('Chart Placeholder')
                    ->assertSee('Revenue chart will be displayed here');
        });
    }

    public function test_responsive_design(): void
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/admin/dashboard');

            // Test desktop view
            $browser->resize(1200, 800)
                    ->assertVisible('#sidebar')
                    ->assertDontSee('#sidebar-toggle');

            // Test mobile view
            $browser->resize(640, 800)
                    ->assertPresent('#sidebar-toggle');
        });
    }
}
