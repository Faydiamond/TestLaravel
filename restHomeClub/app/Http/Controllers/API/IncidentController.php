<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Throwable;
use App\Models\Incident;
use App\Models\User;
use App\Models\Apartament;

class IncidentController extends Controller
{
    //
    public function getIncidents()
    {
        try {
            $incidents = Incident::all();
            if ($incidents->isEmpty()) {
                $data = ['message' => "no hay reservas inicidentes", "status" => false];
                return response()->json($data, 404);
            }
            $data = ["status" => true, "data" => $incidents];
            return response()->json($data, 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function saveIncident(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'description' => 'required|max:180',
                'estate' => 'required|max:180',
                'report' => 'required',
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
                    'message' => 'El usuario no  existe o no tiene el rol de cliente.',
                    'status' => false
                ], 403);
            }

            $apto = Apartament::find($request->apartament_id);
            if (!$apto) {
                return response()->json([
                    'message' => 'El apto no existe.',
                    'status' => false
                ], 403);
            }

            $reserve = Incident::create([
                'description' =>  $request->description,
                'estate' =>  $request->estate,
                'report' =>  $request->report,
                'user_id' =>  $request->user_id,
                'apartament_id' =>  $request->apartament_id,
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
    public function getIncidentById($id)
    {
        try {
            $incident = Incident::find($id);
            if (!$incident) {
                return response()->json(["status" => false, 'message' => 'Error, no existe el incidente.'], 404);
            }
            $data = ["status" => true, 'data' => $incident];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function updateIncident($id, Request $request)
    {
        try {
            $Reserv = Incident::find($id);
            if (!$Reserv) {
                return response()->json(["status" => false, 'message' => 'Error, no existe la reserva y por ende no se puede actualizar.'], 404);
            }
            if ($request->has('description')) {
                $Reserv->description = $request->description;
            }
            if ($request->has('estate')) {
                $Reserv->estate = $request->estate;
            }
            if ($request->has('report')) {
                $Reserv->report = $request->report;
            }
            if ($request->has('user_id')) {
                $Reserv->user_id = $request->user_id;
            }
            if ($request->has('apartament_id')) {
                $Reserv->apartament_id = $request->apartament_id;
            }

            $Reserv->save();
            $data = ["status" => true, 'message' => 'Reserva actualizada.', 'data' => $Reserv];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function deleteIncident($id)
    {
        try {
            $incident = Incident::find($id);
            if (!$incident) {
                return response()->json(["status" => false, 'message' => 'Error, no existe el incidente  y por ende no se puede eliminar.'], 404);
            }
            $incident->delete();
            $data = ["status" => true, 'message' => 'Incidente eliminada.'];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {
            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }
}
