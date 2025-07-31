<?php

namespace Tests\Browser\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_user_can_login(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Sign in to your account')
                    ->type('email', 'test@example.com')
                    ->type('password', 'password')
                    ->press('Sign in')
                    ->assertPathIs('/');
        });
    }

    public function test_admin_user_redirected_to_dashboard(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'admin@example.com')
                    ->type('password', 'password')
                    ->press('Sign in')
                    ->assertPathIs('/admin/dashboard')
                    ->assertSee('Dashboard')
                    ->assertSee('120 Customs');
        });
    }

    public function test_login_with_invalid_credentials(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'invalid@example.com')
                    ->type('password', 'wrongpassword')
                    ->press('Sign in')
                    ->assertPathIs('/login')
                    ->assertSee('The provided credentials do not match our records.');
        });
    }

    public function test_login_form_validation(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->press('Sign in')
                    ->assertSee('The email field is required.')
                    ->assertSee('The password field is required.');
        });
    }

    public function test_remember_me_checkbox(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'test@example.com')
                    ->type('password', 'password')
                    ->check('remember')
                    ->press('Sign in')
                    ->assertPathIs('/');
        });
    }

    public function test_navigation_to_register_page(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->clickLink('create a new account')
                    ->assertPathIs('/register')
                    ->assertSee('Create your account');
        });
    }

    public function test_logout_functionality(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->browse(function (Browser $browser) {
            $browser->loginAs($user)
                    ->visit('/admin/dashboard')
                    ->click('#user-menu-button')
                    ->waitFor('#user-dropdown')
                    ->press('Sign out')
                    ->assertPathIs('/');
        });
    }
}
