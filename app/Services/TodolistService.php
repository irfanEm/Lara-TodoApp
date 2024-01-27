<?php

namespace App\Services;

interface TodolistService
{
    public function simpanTodo(string $id, string $todo): void;

    public function getTodo(): array;

    public function hapusTodo(string $idTodo);
}
