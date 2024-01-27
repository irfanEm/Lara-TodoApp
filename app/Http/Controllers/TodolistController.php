<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Egulias\EmailValidator\Result\Reason\EmptyReason;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todoPage(Request $request): Response
    {
        $todolist = $this->todolistService->getTodo();
        return response()->view('todolist.todolist', [
            "title" => "Todolist",
            "todolist" => $todolist
        ]);
    }

    public function tambahTodo(Request $request): RedirectResponse
    {
        $todo = $request->input("todo");

        if(empty($todo)){
            $todolist = $this->todolistService->getTodo();
            return response()->view("todolist.todolist", [
                "title" => "Todolist",
                "todolist" => $todolist,
                "error" => "Todolist-e diisi !"
            ]);
        }

        $this->todolistService->simpanTodo(uniqid(), $todo);

        return redirect()->action([TodolistController::class, 'todoPage']);
    }

    public function hapusTodo(Request $request, string $todoId): RedirectResponse
    {
        $this->todolistService->hapusTodo($todoId);
        return redirect()->action([TodolistController::class, 'todoPage']);
    }
}
