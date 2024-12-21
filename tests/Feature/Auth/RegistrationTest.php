<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        // Log sebelum permintaan untuk memastikan status awal
        \Log::info('Before registration screen', [
            'authenticated' => auth()->check(),  // Memeriksa apakah pengguna sudah login
            'user' => auth()->user(),           // Memeriksa informasi pengguna yang sedang login (jika ada)
        ]);

        $response = $this->get('/register');

        // Log respons untuk memverifikasi bahwa halaman berhasil dirender
        \Log::info('Registration screen response', [
            'status' => $response->status(),  // Memeriksa status respons (200)
            
        ]);

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        // Log sebelum melakukan pendaftaran untuk memverifikasi status autentikasi awal
        \Log::info('Before new user registration', [
            'authenticated' => auth()->check(),  // Memeriksa apakah pengguna sudah login
            'user' => auth()->user(),           // Memeriksa informasi pengguna yang sedang login (harus null karena pengguna belum login)
        ]);

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Log respons setelah pendaftaran untuk memverifikasi proses pendaftaran
        \Log::info('New user registration response', [
            'status' => $response->status(),  // Memeriksa status respons (200 atau 302 jika berhasil)
            'redirect_url' => $response->headers->get('Location'),  // URL tujuan setelah pengalihan
        ]);

        // Memastikan pengguna terautentikasi setelah pendaftaran
        \Log::info('After new user registration', [
            'authenticated' => auth()->check(),  // Harus true karena pengguna sudah berhasil login
            'user' => auth()->user(),           // Harus berisi data pengguna yang baru saja terdaftar
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
