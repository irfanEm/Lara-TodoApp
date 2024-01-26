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
}
