<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodoPage(){
        $this->withSession([
            "user" => "irfan_em",
            "todolist" => [
                ["id" => "1",
                "todo" => "Bikin kopi dulu ngga sih ?"],
                ["id" => "2",
                "todo" => "Buka dekengan pusat dulu dong"],
            ]
        ])->get("/todolist")
            -> assertSeeText("1")
            ->assertSessionHas("user", "irfan_em")
            ->assertSeeText("Bikin kopi dulu ngga sih ?")
            -> assertSeeText("2")
            ->assertSeeText("Buka dekengan pusat dulu dong");;
    }

    public function testTambahTodoGagal()
    {
        $this->withSession([
            "user" => "irfan_em"
        ])->post("/todolist", [])
            ->assertSeeText("Todolist-e diisi !");
    }

    public function testTambahTodoSukses()
    {
        $this->withSession([
            "user" => "irfan_em"
        ])->post("/todolist", [
            "todo" => "Bikin kopi dulu ngga sih ?"
        ])->assertRedirect("/todolist");
    }

    public function testHapusTodo()
    {
        $this->withSession([
            "user" => "irfan_em",
            "todolist" => [
                ["id" => "1",
                "todo" => "Bikin kopi dulu ngga sih ?"],
                ["id" => "2",
                "todo" => "Buka dekengan pusat dulu dong"],
            ]
        ])->post("/todolist/2/hapus")
            -> assertRedirect("/todolist");
    }
}
