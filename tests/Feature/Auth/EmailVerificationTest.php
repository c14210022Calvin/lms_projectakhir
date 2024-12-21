<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_verification_screen_can_be_rendered(): void
    {
        $user = User::factory()->unverified()->create();
        // Log sebelum permintaan untuk memastikan status pengguna
        \Log::info('Before email verification screen', [
            'authenticated' => auth()->check(),
            'user' => auth()->user(),
        ]);

        $response = $this->actingAs($user)->get('/verify-email');

        // Log respons untuk memverifikasi status respons
        \Log::info('Email verification screen response', [
            'status' => $response->status(),
            'authenticated' => auth()->check(),
            'user' => auth()->user(),
        ]);
        $response->assertStatus(200);
    }

    public function test_email_can_be_verified(): void
    {
        $user = User::factory()->unverified()->create();

        Event::fake();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        // Log informasi sebelum mengunjungi URL verifikasi
        \Log::info('Before email verification', [
            'verification_url' => $verificationUrl,
            'user_email' => $user->email,
            'user_verified' => $user->hasVerifiedEmail(),
        ]);

        $response = $this->actingAs($user)->get($verificationUrl);

        // Log setelah verifikasi
        \Log::info('After email verification', [
            'status' => $response->status(),
            'user_verified' => $user->fresh()->hasVerifiedEmail(),
        ]);

        Event::assertDispatched(Verified::class);
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $response->assertRedirect(route('dashboard', absolute: false) . '?verified=1');
    }

    public function test_email_is_not_verified_with_invalid_hash(): void
    {
        $user = User::factory()->unverified()->create();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1('wrong-email')]
        );

        // Log sebelum mencoba verifikasi dengan hash yang salah
        \Log::info('Attempting email verification with invalid hash', [
            'verification_url' => $verificationUrl,
            'user_email' => $user->email,
            'user_verified' => $user->hasVerifiedEmail(),
        ]);

        $this->actingAs($user)->get($verificationUrl);

        // Log setelah mencoba verifikasi dengan hash yang salah
        \Log::info('After failed email verification', [
            'user_verified' => $user->fresh()->hasVerifiedEmail(),
        ]);

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }
}
