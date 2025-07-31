<?php

namespace Tests\Browser\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_user_can_register(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Create your account')
                    ->type('name', 'John Doe')
                    ->type('email', 'john@example.com')
                    ->type('password', 'password')
                    ->type('password_confirmation', 'password')
                    ->press('Create Account')
                    ->assertPathIs('/');
        });

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'is_admin' => false,
        ]);
    }

    public function test_registration_form_validation(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->press('Create Account')
                    ->assertSee('The name field is required.')
                    ->assertSee('The email field is required.')
                    ->assertSee('The password field is required.');
        });
    }

    public function test_registration_with_invalid_email(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'John Doe')
                    ->type('email', 'invalid-email')
                    ->type('password', 'password')
                    ->type('password_confirmation', 'password')
                    ->press('Create Account')
                    ->assertSee('The email field must be a valid email address.');
        });
    }

    public function test_registration_with_existing_email(): void
    {
        User::factory()->create(['email' => 'existing@example.com']);

        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'John Doe')
                    ->type('email', 'existing@example.com')
                    ->type('password', 'password')
                    ->type('password_confirmation', 'password')
                    ->press('Create Account')
                    ->assertSee('The email has already been taken.');
        });
    }

    public function test_registration_with_mismatched_passwords(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'John Doe')
                    ->type('email', 'john@example.com')
                    ->type('password', 'password')
                    ->type('password_confirmation', 'different-password')
                    ->press('Create Account')
                    ->assertSee('The password field confirmation does not match.');
        });
    }

    public function test_registration_with_weak_password(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'John Doe')
                    ->type('email', 'john@example.com')
                    ->type('password', '123')
                    ->type('password_confirmation', '123')
                    ->press('Create Account')
                    ->assertSee('The password field must be at least');
        });
    }

    public function test_navigation_to_login_page(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->clickLink('sign in to your existing account')
                    ->assertPathIs('/login')
                    ->assertSee('Sign in to your account');
        });
    }

    public function test_user_is_automatically_logged_in_after_registration(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'John Doe')
                    ->type('email', 'john@example.com')
                    ->type('password', 'password')
                    ->type('password_confirmation', 'password')
                    ->press('Create Account')
                    ->assertPathIs('/');

            // Verify user is logged in by trying to access admin dashboard
            $browser->visit('/admin/dashboard')
                    ->assertSee('Dashboard'); // Should be accessible since user is logged in
        });
    }

    public function test_form_fields_retain_values_on_validation_error(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'John Doe')
                    ->type('email', 'invalid-email')
                    ->press('Create Account')
                    ->assertInputValue('name', 'John Doe')
                    ->assertInputValue('email', 'invalid-email');
        });
    }
}
