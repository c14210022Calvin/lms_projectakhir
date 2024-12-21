<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
        // Debug: Periksa status autentikasi
        \Log::info('User is authenticated: ', ['authenticated' => auth()->check()]);
        dump(auth()->check()); // false jika pengguna tidak terautentikasi

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        // Lakukan autentikasi dengan actingAs sebelum log status
        $this->actingAs($user);

        // Log status sebelum logout
        \Log::info('Before logout', [
            'authenticated' => auth()->check(),
            'user' => auth()->user(),
        ]);

        // $response = $this->actingAs($user)->post('/logout');
        $response = $this->post('/logout');

        // Log status setelah logout
        \Log::info('After logout', [
            'authenticated' => auth()->check(),  // Harus false setelah logout
            'user' => auth()->user(),           // Harus null setelah logout
        ]);

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
