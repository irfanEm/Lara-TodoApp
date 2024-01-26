<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testTamu()
    {
        $this->get("/")
            ->assertRedirect("/login");
    }

    public function testMember()
    {
        $this->withSession([
            "user" => "irfan_em"
        ])
            ->get("/")
            ->assertRedirect("/todolist");
    }
}
