<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_show_the_users_list()
    {
        factory(User::class)->create([
            'name' => 'Jane'
        ]);

        factory(User::class)->create([
            'name' => 'Ryan'
        ]);

        $this->get('usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('Jane')
            ->assertSee('Ryan');
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
        $user = factory(User::class)->create([
            'name' => 'Ryan Gold'
        ]);

        $this->get('usuarios/'.$user->id)
            ->assertStatus(200)
            ->assertSee('Ryan Gold');
    }

    /** @test */
    function it_loads_the_new_users_page()
    {
        $this->get('usuarios/crear')
            ->assertStatus(200)
            ->assertSee('Crear usuarios');
    }

    /** @test */
    function it_loads_the_edit_users_page()
    {
        $this->get('usuarios/5/editar')
            ->assertStatus(200)
            ->assertSee('Editando usuario 5');
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
            'password' => '1234567'
        ])->assertRedirect(route('users.index'));

        $this->assertCredentials([
            'name' => 'Ryan Gold',
            'email' => 'ryan@example.com',
            'password' => '1234567'
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

        $this->assertDatabaseMissing('users', [
            'email' => 'ryan@example.com',
        ]);
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
                'password' => '1234567'
            ])
            ->assertRedirect('usuarios/crear')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_email_must_be_unique()
    {
        factory(User::class)->create([
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
                'password' => ''
            ])
            ->assertRedirect('usuarios/crear')
            ->assertSessionHasErrors(['password']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_password_must_be_longer_than_six_characters()
    {
        $this->from('usuarios/crear')
            ->post('usuarios', [
                'name' => 'Ryan Gold',
                'email' => 'ryan@example.com',
                'password' => '123456'
            ])
            ->assertRedirect('usuarios/crear')
            ->assertSessionHasErrors(['password']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function it_loads_the_edit_user_page()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

        $this->get("usuarios/{$user->id}/editar")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee('Editar usuarios')
            ->assertViewHas('user', $user);
    }
}
