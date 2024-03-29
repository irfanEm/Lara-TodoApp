<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testLoginSukses()
    {
        $this->post('/login', [
            'user' => 'irfan_em',
            'password' => '271197'
        ]) -> assertRedirect("/")->assertSessionHas('user','irfan_em');
    }

    public function testLoginVallErr()
    {
        $this->post("/login", [])
            ->assertSeeText('User atau password harus diisi !')->assertSeeText('Login');
    }

    public function testLoginUserOrPasswordSalah()
    {
        $this->post("/login", [
            "user" => "balqis_fa",
            "password" => "salah"
        ])
            ->assertSeeText('User atau password salah !')->assertSeeText('Login');
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "balqis_fa"
        ])->post("/logout")
            ->assertRedirect("/")
            ->assertSessionMissing("user");
    }

    public function testLogoutGuest()
    {
        $this->post("/logout")
            ->assertRedirect("/");
    }

    public function testLoginSuccess()
    {
        $this->post("/login", [
            "user" => "irfan_em",
            "password" => "271197"
        ])->assertRedirect("/")
            ->assertSessionHas("user", "irfan_em")
            ->assertRedirect("/");
    }

    public function testLoginUserSudahLogin()
    {
        $this->withSession([
            "user" => "irfan_em"
        ])->post("/login", [
            "user" => "irfan_em",
            "password" => "271197"
        ])->assertRedirect("/")
            ->assertRedirect("/");
    }
}
