<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserModuleTest extends TestCase
{
    /** @test */
    function it_show_the_users_list()
    {
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('Pedro')
            ->assertSee('Jose');
    }

    /** @test */
    function it_shows_a_default_message_if_the_users_list_is_empty()
    {
        $this->get('/usuarios?empty')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('No hay usuarios registrados.');
    }

    /** @test */
    function it_loads_the_users_details_page()
    {
        $this->get('/usuarios/5')
            ->assertStatus(200)
            ->assertSee('Mostrando detalles del usuario 5');
    }

    /** @test */
    function it_loads_the_new_users_page()
    {
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Crear nuevo usuario');
    }

    /** @test */
    function it_loads_the_edit_users_page()
    {
        $this->get('/usuarios/5/editar')
            ->assertStatus(200)
            ->assertSee('Editando usuario 5');
    }
}
