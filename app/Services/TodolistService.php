<?php

namespace App\Services;

interface TodolistService
{
    public function simpanTodo(string $id, string $todo): void;
}
