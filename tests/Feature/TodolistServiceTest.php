<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodolistServiceNotNull()
    {
        $this->assertNotNull($this->todolistService);
    }

    public function testSimpanTodolist()
    {
        $this->todolistService->simpanTodo("1", "Bikin kopi.");

        $todo = Session::get("todolist");
        foreach($todo as $value){
            self::assertEquals("1", $value['id']);
            self::assertEquals("Bikin kopi.", $value['todo']);
        }
    }

    public function testGetTodolistKosong()
    {
        self::assertEquals([], $this->todolistService->getTodo());
    }

    public function testGetTodoNotKosong()
    {
        $harapan = [
            [
                "id" => "1",
                "todo" => "Buat kopi, biar heppy."
            ],
            [
                "id" => "2",
                "todo" => "Buka dekengan pusat dulu."
            ],
        ];

        $this->todolistService->simpanTodo("1", "Buat kopi, biar heppy.");
        $this->todolistService->simpanTodo("2", "Buka dekengan pusat dulu.");

        self::assertEquals($harapan, $this->todolistService->getTodo());
    }

    public function testHapusTodo()
    {
        $this->todolistService->simpanTodo("1", "Buat kopi, biar heppy.");
        $this->todolistService->simpanTodo("2", "Buka dekengan pusat dulu.");

        self::assertEquals(2, sizeof($this->todolistService->getTodo()));

        $this->todolistService->hapusTodo("3");

        self::assertEquals(2, sizeof($this->todolistService->getTodo()));

        $this->todolistService->hapusTodo("2");$this->todolistService->hapusTodo("2");

        self::assertEquals(1, sizeof($this->todolistService->getTodo()));

        $this->todolistService->hapusTodo("1");

        self::assertEquals(0, sizeof($this->todolistService->getTodo()));
    }
}
