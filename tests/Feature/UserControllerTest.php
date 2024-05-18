<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_users_can_be_retreived_at_controller_index_method(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/users');

        $this->assertNotEmpty($response);
    }

    public function test_trashed_users_can_be_retreived_at_controller_trashed_method(): void
    {
        $user = User::factory()->create();

        User::onlyTrashed()->forceDelete();

        User::factory()->create()->delete();

        $response = $this
            ->actingAs($user)
            ->get(route('users.trashed'));

        $this->assertNotEmpty($response);
    }

    public function test_new_users_can_be_created_using_controller_store_method(): void
    {
        $user = User::factory()->create();

        $userData = [
            'prefixname' => 'mr',
            'firstname' => 'Firstname',
            'middlename' => 'Middlename',
            'lastname' => 'Lastname',
            'suffixname' => 'Suffixname',
            'username' => 'Username',
            'email' => 'test-one@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $this->actingAs($user)
        ->post(route('users.store'), $userData);

        $response = $this->post('/login', [
            'email' => $userData['email'],
            'password' => $userData['password']
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_new_users_can_be_updated_using_controller_update_method(): void
    {
        $user = User::factory()->create();

        $userData = [
            'prefixname' => 'mr',
            'firstname' => 'Firstname Updated',
            'middlename' => 'Middlename Updated',
            'lastname' => 'Lastname Updated',
            'suffixname' => 'Suffixname Updated',
            'username' => 'username-updated',
            'email' => 'updated@example.com',
        ];

        $this->actingAs($user)
        ->put(route('users.update', $user->id), $userData);

        $user->refresh();

        $this->assertSame('Firstname Updated', $user->firstname);
        $this->assertSame('Middlename Updated', $user->middlename);
        $this->assertSame('updated@example.com', $user->email);
    }

    public function test_new_users_can_be_soft_deleted_using_controller_destroy_method(): void
    {
        $users = User::factory()->count(2)->create();

        $this->actingAs($users[0])
        ->delete(route('users.destroy', $users[1]->id));

        $this->assertSoftDeleted('users', [
            'id' => $users[1]->id,
            'email' => $users[1]->email,
        ]);

        $users[1]->refresh();

        // Assert the user has been soft-deleted
        $this->assertNotNull($users[1]->deleted_at);
    }
}
