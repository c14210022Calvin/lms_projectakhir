<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */

    public function test_login_with_minimal_boundary_data()
    {
        // Create a minimal user in the database
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        // Attempt login
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // Assert the response is successful
        $response->assertRedirect(route('dashboard', absolute: false));
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_with_non_latin_characters()
    {
        // Create a user with non-Latin email and password
        $email = '测试@例子.公司'; // Chinese characters
        $password = 'пароль123'; // Cyrillic and numbers

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        // Attempt login
        $response = $this->post('/login', [
            'email' => $email,
            'password' => $password,
        ]);

        // Assert the response is successful
        $response->assertRedirect(route('dashboard', absolute: false));
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_fails_with_invalid_credentials()
    {
        $response = $this->post('/login', [
            'email' => 'invalid@example.com',
            'password' => 'wrongpassword',
        ]);
        
        \Log::info('Session Data:', session()->all());

        // Assert the response status
        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }
}
