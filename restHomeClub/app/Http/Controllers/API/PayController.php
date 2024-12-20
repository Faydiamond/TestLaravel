<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Throwable;
use App\Models\Pays;
use App\Models\Task;
use App\Models\Reserves;
use Illuminate\Support\Facades\Log;

class PayController extends Controller
{
    //
    public function getPays()
    {
        try {
            $pays = Pays::all();
            if ($pays->isEmpty()) {
                $data = ['message' => "no hay pagos registrados", "status" => false];
                return response()->json($data, 404);
            }
            $data = ["status" => true, "data" => $pays];
            return response()->json($data, 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function getPayById($id)
    {
        try {
            $pay = Pays::find($id);
            if (!$pay) {
                return response()->json(["status" => false, 'message' => 'Error, no existe el pago.'], 404);
            }
            $data = ["status" => true, 'data' => $pay];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {
            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function savePay(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'task_id' => 'required|integer',
                'reservation_id' => 'required|integer',
                'price' => 'required',
                'cost_responsible' => 'required|max:40',
                //'apartament_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Error en la validación de datos',
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ], 400);
            }

            $task = Task::find($request->task_id);
            if (!$task) {
                return response()->json([
                    'message' => 'La tarea no existe.',
                    'status' => false
                ], 403);
            }

            $reserveFound = Reserves::find($request->reservation_id);
            if (!$reserveFound) {
                return response()->json([
                    'message' => 'La reserva no existe.',
                    'status' => false
                ], 403);
            }

            //'Cliente', 'Propietario', 'Homeselect'
            $pay = Pays::create([
                'booking_date' => Carbon::now()->toDateString(),
                'task_id' =>  $request->task_id,
                'reservation_id' => $request->reservation_id,
                'price' => $request->price,
                'cost_responsible' => $request->cost_responsible,
                'apartament_id' => $request->apartament_id
            ]);
            if (!$pay) {
                return response()->json(["status" => false, 'message' => 'Error al crear el pago.'], 500);
            }
            $data = ["status" => true, 'data' => $pay];
            return response()->json($data, status: 201);
        } catch (Throwable $th) {
            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }
}
