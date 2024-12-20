<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Throwable;
use App\Models\Reserves;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ReserveController extends Controller
{
    //
    public function getReser()
    {
        try {
            $reserves = Reserves::all();
            if ($reserves->isEmpty()) {
                $data = ['message' => "no hay reservas registrados", "status" => false];
                return response()->json($data, 404);
            }
            $data = ["status" => true, "data" => $reserves];
            return response()->json($data, 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function saveReserve(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [

                'date_entry' => 'required|date',
                'date_out' => 'required|date',
                'price' => 'required',
                'user_id' => 'required|integer',
                'apartament_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Error en la validación de datos',
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ], 400);
            }

            $user = User::find($request->user_id);

            if (!$user || !$user->role->rol == 'Cliente') {
                return response()->json([
                    'message' => 'El usuario no tiene el rol de cliente.',
                    'status' => false
                ], 403);
            }

            // Verificar si existe una reserva con fechas superpuestas
            $overlappingReserves = Reserves::where('apartament_id', $request->apartament_id)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('date_entry', [$request->date_entry, $request->date_out])
                        ->orWhereBetween('date_out', [$request->date_entry, $request->date_out]);
                })
                ->exists();

            if ($overlappingReserves) {
                return response()->json([
                    'message' => 'El apartamento ya está reservado en esas fechas.',
                    'status' => false
                ], 409); // Conflict
            }

            $reserve = Reserves::create([
                'booking_date' => Carbon::now()->toDateString(),
                'date_entry' =>  $request->date_entry,
                'date_out' => $request->date_out,
                'price' => $request->price,
                'user_id' => $request->user_id,
                'apartament_id' => $request->apartament_id,
            ]);
            if (!$reserve) {
                return response()->json(["status" => false, 'message' => 'Error al crear la reserva.'], 500);
            }
            $data = ["status" => true, 'data' => $reserve];
            return response()->json($data, status: 201);
        } catch (Throwable $th) {
            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function getReserveById($id)
    {
        try {
            $reserv = Reserves::find($id);
            if (!$reserv) {
                return response()->json(["status" => false, 'message' => 'Error, no existe la reserva.'], 404);
            }
            $data = ["status" => true, 'data' => $reserv];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function updateReserve($id, Request $request)
    {
        try {
            $Reserv = Reserves::find($id);
            if (!$Reserv) {
                return response()->json(["status" => false, 'message' => 'Error, no existe la reserva y por ende no se puede actualizar.'], 404);
            }

            $Reserv->date_entry = $request->date_entry;
            $Reserv->date_out = $request->date_out;
            $Reserv->price = $request->price;
            $Reserv->user_id = $request->user_id;
            $Reserv->apartament_id = $request->apartament_id;

            $Reserv->save();
            $data = ["status" => true, 'message' => 'Reserva actualizada.', 'data' => $Reserv];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function deleteReserve($id)
    {
        try {
            $reserve = Reserves::find($id);
            if (!$reserve) {
                return response()->json(["status" => false, 'message' => 'Error, no existe la reserva  y por ende no se puede eliminar.'], 404);
            }
            $reserve->delete();
            $data = ["status" => true, 'message' => 'Reserva eliminada.'];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {
            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }
}
