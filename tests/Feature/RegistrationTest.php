<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\RoleSeeder;
use App\Rules\PhoneNumber;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_user_can_register()
    {
        (new RoleSeeder())->run();

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '639392698072',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_new_user_cannot_register_with_invalid_phone()
    {
        (new RoleSeeder())->run();

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '01392698072',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertEquals(false, $this->isAuthenticated());
        $response->withViewErrors(['phone' => PhoneNumber::error_message()]);
    }
}
