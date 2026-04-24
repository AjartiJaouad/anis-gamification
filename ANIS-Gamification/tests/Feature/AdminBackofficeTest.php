<?php

namespace Tests\Feature;

use App\Models\Module;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminBackofficeTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_a_module(): void
    {
        $admin = User::factory()->admin()->create();

        $module = Module::create([
            'title' => 'Module initial',
            'content' => 'Version 1',
            'order' => 1,
        ]);

        $response = $this->actingAs($admin)->put(route('admin.modules.update', $module), [
            'title' => 'Module mis a jour',
            'content' => 'Version 2',
            'order' => 2,
        ]);

        $response->assertRedirect(route('admin.modules.index'));
        $this->assertDatabaseHas('modules', [
            'id' => $module->id,
            'title' => 'Module mis a jour',
            'order' => 2,
        ]);
    }

    public function test_admin_can_update_a_user_role(): void
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create([
            'pseudo' => 'test_user_01',
            'role' => 'user',
        ]);

        $response = $this->actingAs($admin)->put(route('admin.users.update', $user), [
            'pseudo' => $user->pseudo,
            'email' => $user->email,
            'role' => 'admin',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'role' => 'admin',
        ]);
    }
}
