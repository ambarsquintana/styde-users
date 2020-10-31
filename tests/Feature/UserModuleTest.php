<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_show_the_users_list()
    {
        User::factory()->create([
            'name' => 'Jane Evans',
        ]);

        User::factory()->create([
            'name' => 'Ryan Gold',
        ]);

        $this->get('usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('Jane Evans')
            ->assertSee('Ryan Gold');
    }

    /** @test */
    function it_shows_a_default_message_if_the_users_list_is_empty()
    {
        $this->get('usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('No hay usuarios registrados.');
    }

    /** @test */
    function it_displays_the_users_details()
    {
        $user = User::factory()->create([
            'name' => 'Ryan Gold',
        ]);

        $this->get("usuarios/{$user->id}")
            ->assertStatus(200)
            ->assertSee('Ryan Gold');
    }

    /** @test */
    function it_loads_the_new_users_page()
    {
        $this->get('usuarios/crear')
            ->assertStatus(200)
            ->assertViewIs('users.create')
            ->assertSee('Crear usuarios');
    }

    /** @test */
    function it_loads_the_edit_users_page()
    {
        $user = User::factory()->create();

        $this->get("usuarios/{$user->id}/editar")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee('Editar usuarios')
            ->assertViewHas('user', $user);
    }

    /** @test */
    function it_displays_a_404_error_if_the_user_is_not_found()
    {
        $this->get('usuarios/999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
    }

    /** @test */
    function it_creates_a_new_user()
    {
        $this->post('usuarios', [
            'name' => 'Ryan Gold',
            'email' => 'ryan@example.com',
            'password' => '1234567',
        ])->assertRedirect(route('users.index'));

        $this->assertCredentials([
            'name' => 'Ryan Gold',
            'email' => 'ryan@example.com',
            'password' => '1234567',
        ]);
    }

    /** @test */
    function the_name_is_required()
    {
        $this->from('usuarios/crear')
            ->post('usuarios', [
                'name' => '',
                'email' => 'ryan@example.com',
                'password' => '1234567',
            ])
            ->assertRedirect('usuarios/crear')
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', ['email' => 'ryan@example.com']);
    }

    /** @test */
    function the_email_is_required()
    {
        $this->from('usuarios/crear')
            ->post('usuarios', [
                'name' => 'Ryan Gold',
                'email' => '',
                'password' => '1234567',
            ])
            ->assertRedirect('usuarios/crear')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_email_must_be_valid()
    {
        $this->from('usuarios/crear')
            ->post('usuarios', [
                'name' => 'Ryan Gold',
                'email' => 'invalid-email',
                'password' => '1234567',
            ])
            ->assertRedirect('usuarios/crear')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_email_must_be_unique()
    {
        User::factory()->create([
            'email' => 'ryan@example.com',
        ]);

        $this->from('usuarios/crear')
            ->post('usuarios', [
                'name' => 'Ryan Gold',
                'email' => 'ryan@example.com',
                'password' => '1234567',
            ])
            ->assertRedirect('usuarios/crear')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
    }

    /** @test */
    function the_password_is_required()
    {
        $this->from('usuarios/crear')
            ->post('usuarios', [
                'name' => 'Ryan Gold',
                'email' => 'ryan@example.com',
                'password' => '',
            ])
            ->assertRedirect('usuarios/crear')
            ->assertSessionHasErrors(['password']);

        $this->assertDatabaseMissing('users', ['email' => 'ryan@example.com']);
    }

    /** @test */
    function the_password_must_be_longer_than_six_characters()
    {
        $this->from('usuarios/crear')
            ->post('usuarios', [
                'name' => 'Ryan Gold',
                'email' => 'ryan@example.com',
                'password' => '123456',
            ])
            ->assertRedirect('usuarios/crear')
            ->assertSessionHasErrors(['password']);

        $this->assertDatabaseMissing('users', ['email' => 'ryan@example.com']);
    }

    /** @test */
    function it_updates_a_user()
    {
        $user = User::factory()->create();

        $this->put("usuarios/{$user->id}", [
            'name' => 'Ryan Gold',
            'email' => 'ryan@example.com',
            'password' => '1234567',
        ])
        ->assertRedirect("usuarios/{$user->id}");

        $this->assertCredentials([
            'name' => 'Ryan Gold',
            'email' => 'ryan@example.com',
            'password' => '1234567',
        ]);
    }

    /** @test */
    function the_name_is_required_when_updating_the_user()
    {
        $user = User::factory()->create();

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
                'name' => '',
                'email' => 'ryan@example.com',
                'password' => '1234567',
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', ['email' => 'ryan@example.com']);
    }

    /** @test */
    function the_email_is_required_when_updating_the_user()
    {
       $user = User::factory()->create();

       $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
                'name' => 'Ryan Gold',
                'email' => '',
                'password' => '1234567',
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['name' => 'Ryan Gold']);
    }

    /** @test */
    function the_email_must_be_valid_when_updating_the_user()
    {
       $user = User::factory()->create();

       $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
                'name' => 'Ryan Gold',
                'email' => 'correo-no-valido',
                'password' => '1234567',
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['name' => 'Ryan Gold']);
    }

    /** @test */
    function the_email_must_be_unique_when_updating_the_user()
    {
        User::factory()->create([
            'email' => 'jane@example.com',
        ]);

        $user = User::factory()->create([
            'email' => 'ryan@example.com',
        ]);

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
                'name' => 'Ryan Gold',
                'email' => 'jane@example.com',
                'password' => '1234567',
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseHas('users', [
            'email' => 'ryan@example.com',
        ]);
    }

    /** @test */
    function the_users_email_can_stay_the_same_when_updating_the_user()
    {
        $user = User::factory()->create([
            'email' => 'ryan@example.com',
        ]);

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
                'name' => 'Ryan Gold',
                'email' => 'ryan@example.com',
                'password' => '12345678',
            ])
            ->assertRedirect("usuarios/{$user->id}");

        $this->assertDatabaseHas('users', [
            'name' => 'Ryan Gold',
            'email' => 'ryan@example.com',
        ]);
    }

    /** @test */
    function the_password_is_opcional_when_updating_a_user()
    {
        $oldPassword = 'clave_anterior';

        $user = User::factory()->create([
            'password' => bcrypt($oldPassword),
        ]);

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
                'name' => 'Ryan Gold',
                'email' => 'ryan@example.com',
                'password' => '',
            ])
            ->assertRedirect("usuarios/{$user->id}");

        $this->assertCredentials([
            'name' => 'Ryan Gold',
            'email' => 'ryan@example.com',
            'password' => $oldPassword,
        ]);
    }

    /** @test */
    function it_loads_deletes_a_user()
    {
        $user = User::factory()->create();

        $this->delete("usuarios/{$user->id}")
            ->assertRedirect('usuarios');

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
