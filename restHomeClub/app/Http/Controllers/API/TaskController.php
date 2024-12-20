<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;
use App\Models\Incident;
use App\Models\User;
use Throwable;


class TaskController extends Controller
{
    //
    public function getTasks()
    {
        try {
            $tasks = Task::all();
            if ($tasks->isEmpty()) {
                $data = ['message' => "no hay tareas registradas", "status" => false];
                return response()->json($data, 404);
            }
            $data = ["status" => true, "data" => $tasks];
            return response()->json($data, 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function saveTask(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer',
                'incidencia_id' => 'required|integer',
                'description' => 'required|max:180',
                'estate' => 'required|max:180',
                'price' => 'required',
                'cost_responsible' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Error en la validación de datos',
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ], 400);
            }

            $user = User::find($request->user_id);
            if (!$user) {
                return response()->json([
                    'message' => 'El usuario no existe.',
                    'status' => false
                ], 403);
            }

            $apto = Incident::find($request->incidencia_id);
            if (!$apto) {
                return response()->json([
                    'message' => 'El apto no existe.',
                    'status' => false
                ], 403);
            }

            $task = Task::create([
                'user_id' =>  $request->user_id,
                'incidencia_id' =>  $request->incidencia_id,
                'description' =>  $request->description,
                'estate' => $request->estate,
                'price' =>  $request->price,
                'cost_responsible' =>  $request->cost_responsible,
            ]);
            if (!$task) {
                return response()->json(["status" => false, 'message' => 'Error al crear la reserva.'], 500);
            }
            $data = ["status" => true, 'data' => $task];
            return response()->json($data, status: 201);
        } catch (Throwable $th) {
            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function getTasktById($id)
    {
        try {
            $task = Task::find($id);
            if (!$task) {
                return response()->json(["status" => false, 'message' => 'Error, no existe la tarea.'], 404);
            }
            $data = ["status" => true, 'data' => $task];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function updateTask($id, Request $request)
    {
        try {
            $task = Task::find($id);
            if (!$task) {
                return response()->json(["status" => false, 'message' => 'Error, no existe la tarea y por ende no se puede actualizar.'], 404);
            }
            if ($request->has('user_id')) {
                $task->user_id = $request->user_id;
            }
            if ($request->has('incidencia_id')) {
                $task->incidencia_id = $request->incidencia_id;
            }
            if ($request->has('description')) {
                $task->description = $request->description;
            }
            if ($request->has('estate')) {
                $task->estate = $request->estate;
            }
            if ($request->has('price')) {
                $task->price = $request->price;
            }
            if ($request->has('cost_responsible')) {
                $task->cost_responsible = $request->cost_responsible;
            }

            $user = User::find($request->user_id);
            if (!$user) {
                return response()->json([
                    'message' => 'El usuario no existe.',
                    'status' => false
                ], 403);
            }

            $apto = Incident::find($request->incidencia_id);
            if (!$apto) {
                return response()->json([
                    'message' => 'El apto no existe.',
                    'status' => false
                ], 403);
            }
            $task->save();
            $data = ["status" => true, 'message' => 'Tarea actualizada.', 'data' => $task];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {
            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function deleteTask($id)
    {
        try {
            $task = Task::find($id);
            if (!$task) {
                return response()->json(["status" => false, 'message' => 'Error, no existe la tarea  y por ende no se puede eliminar.'], 404);
            }
            $task->delete();
            $data = ["status" => true, 'message' => 'tarea eliminada.'];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {
            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }
}
