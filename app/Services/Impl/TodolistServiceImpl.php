<?php

namespace App\Services\Impl;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{
    public function simpanTodo(string $id, string $todo): void
    {
        if(!Session::exists("todolist"))
        {
            Session::put("todolist", []);
        }

        Session::push("todolist", [
            "id" => $id,
            "todo" => $todo
        ]);
    }
    
    public function getTodo(): array
    {
        return Session::get("todolist", []);
    }

    public function hapusTodo(string $idTodo)
    {
        $todolist = Session::get("todolist");

        foreach($todolist as $id => $value)
        {
            if($value['id'] == $idTodo){
                unset($todolist[$id]);
                break;
            }
        }

        Session::put("todolist", $todolist);
    }
}
