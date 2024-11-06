<?php

namespace App\Interfaces;

interface TodoRepositoryInterface
{
    public function getAllTodos(array $params = []);
    public function getTodoById($id);
    public function deleteTodo($id);
    public function createTodo(array $data);
    public function updateTodo($id, array $data);
}
