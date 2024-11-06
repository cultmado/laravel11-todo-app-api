<?php

namespace App\Repositories;

use App\Interfaces\TodoRepositoryInterface;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;

class TodoRepository implements TodoRepositoryInterface
{
    public function getAllTodos(array $params = [])
    {
        return Todo::when(isset($params['status']) && in_array($params['status'], ['Pending', 'Completed']), function($qry) use ($params) {
            $qry->where('status', $params['status']);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    }

    public function getTodoById($id)
    {
        return Todo::find($id);
    }

    public function deleteTodo($id)
    {
        return Todo::destroy($id);
    }

    public function createTodo(array $data)
    {
        return Todo::create($data);
    }

    public function updateTodo($id, array $data)
    {
        return Todo::whereId($id)->update($data);
    }
}
