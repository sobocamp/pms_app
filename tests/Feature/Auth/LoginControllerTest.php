<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_login_successfully_and_redirect_to_dashboard()
    {
        // Arrange: membuat user
        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        // Act: melakukan request login
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        // Assert user berhasil login
        $this->assertAuthenticatedAs($user);

        // Assert redirect ke dashboard
        $response->assertRedirect(route('dashboard'));

        // Assert session regenerated
        $this->assertNotNull(session()->getId());
    }

    /** @test */
    public function login_fails_with_invalid_credentials()
    {
        // Arrange
        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        // Act: login salah
        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        // Assert: user tidak login
        $this->assertGuest();

        // Assert redirect ke login
        $response->assertRedirect('/login');

        // Assert error ditampilkan
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function login_uses_intended_redirect_if_available()
    {
        // Arrange
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        // Simulasikan user ditendang ke login
        $this->get('/dashboard')->assertRedirect('/login');

        // Act: login
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        // Assert: diarahkan kembali ke dashboard (intended)
        $response->assertRedirect(route('dashboard'));
    }
}
