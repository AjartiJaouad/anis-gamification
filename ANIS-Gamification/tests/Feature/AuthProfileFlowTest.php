<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthProfileFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_anonymously(): void
    {
        User::factory()->create();

        $response = $this->post(route('register'), [
            'pseudo' => 'anis_user',
            'email' => '',
            'password' => 'StrongPass1',
            'password_confirmation' => 'StrongPass1',
            'stay_anonymous' => '1',
            'cgu' => '1',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'pseudo' => 'anis_user',
            'is_anonymous' => true,
            'role' => 'user',
        ]);
    }

    public function test_user_can_update_profile_and_stay_anonymous(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('StrongPass1'),
            'is_anonymous' => false,
            'email' => 'old@example.com',
        ]);

        $response = $this->actingAs($user)->put(route('profile.update'), [
            'current_password' => 'StrongPass1',
            'pseudo' => 'updated_user',
            'email' => 'new@example.com',
            'stay_anonymous' => '1',
        ]);

        $response->assertRedirect(route('profile.edit'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'pseudo' => 'updated_user',
            'email' => null,
            'is_anonymous' => true,
        ]);
    }
}
