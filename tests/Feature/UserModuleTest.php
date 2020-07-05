<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_show_the_users_list()
    {
        factory(User::class)->create([
            'name' => 'Pedro'
        ]);

        factory(User::class)->create([
            'name' => 'Jose'
        ]);

        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('Pedro')
            ->assertSee('Jose');
    }

    /** @test */
    function it_shows_a_default_message_if_the_users_list_is_empty()
    {
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('No hay usuarios registrados.');
    }

    /** @test */
    function it_displays_the_users_details()
    {
        $user = factory(User::class)->create([
            'name' => 'Ambar Quintana'
        ]);

        $this->get('/usuarios/'.$user->id)
            ->assertStatus(200)
            ->assertSee('Ambar Quintana');
    }

    /** @test */
    function it_loads_the_new_users_page()
    {
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Crear usuarios');
    }

    /** @test */
    function it_loads_the_edit_users_page()
    {
        $this->get('/usuarios/5/editar')
            ->assertStatus(200)
            ->assertSee('Editando usuario 5');
    }

    /** @test */
    function it_displays_a_404_error_if_the_user_is_not_found()
    {
        $this->get('/usuarios/999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
    }

    /** @test */
    function it_creates_a_new_user()
    {
        $this->post('/usuarios', [
            'name' => 'Ambar Quintana',
            'email' => 'ambarsquintana@gmail.com',
            'password' => '123456'
        ])->assertRedirect(route('users.index'));

        $this->assertCredentials([
            'name' => 'Ambar Quintana',
            'email' => 'ambarsquintana@gmail.com',
            'password' => '123456'
        ]);
    }
}
