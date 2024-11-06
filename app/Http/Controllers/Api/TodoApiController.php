<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\TodoRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TodoApiController extends Controller
{
    private $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function getTodos() : JsonResponse
    {
        $params = request()->only(['status']);

        $result = $this->todoRepository->getAllTodos($params);

        return response()->json($result);
    }

    public function store() : JsonResponse
    {
        DB::beginTransaction();
        try {
            $data = request()->only([
                'title',
                'description',
                'status'
            ]);

            $validator = Validator::make($data, [
                'title' => 'required',
                'description' => 'required',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                throw new Exception('Data Validation Error');
            }

            $this->todoRepository->createTodo($data);

            DB::commit();

            return response()->json([
                'message' => 'New Todo has been created!'
            ], 201);
        } catch (Exception $err) {
            DB::rollBack();

            return response()->json([
                'message' => $err->getMessage()
            ], 400);
        }
    }

    public function update($id) : JsonResponse
    {
        DB::beginTransaction();
        try {
            $data = request()->only([
                'title',
                'description',
                'status'
            ]);

            $validator = Validator::make($data, [
                'title' => 'required',
                'description' => 'required',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                throw new Exception('Data Validation Error');
            }

            $this->todoRepository->updateTodo($id, $data);

            DB::commit();

            return response()->json([
                'message' => 'Todo has been updated!'
            ], 201);
        } catch (Exception $err) {
            DB::rollBack();

            return response()->json([
                'message' => $err->getMessage()
            ], 400);
        }
    }

    public function deleteTodo($id) : JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->todoRepository->deleteTodo($id);

            DB::commit();

            return response()->json([
                'message' => 'Todo has been deleted!'
            ], 201);
        } catch (Exception $err) {
            DB::rollBack();

            return response()->json([
                'message' => $err->getMessage()
            ], 400);
        }
    }
}
