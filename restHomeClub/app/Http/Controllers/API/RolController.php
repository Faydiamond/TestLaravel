<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Rol;
use Throwable;

class RolController extends Controller
{
    //
    public function getRols()
    {
        try {
            $rols = Rol::all();
            if ($rols->isEmpty()) {
                $data = ['message' => "no hay roles registrados", "status" => false];
                return response()->json($data, 404);
            }
            $data = ["status" => true, "data" => $rols];
            return response()->json($data, 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }
    public function saveRol(Request $request)
    {
        try {
            $validator = validator::make($request->all(), ['rol' => 'required  | max:100']);
            if ($validator->fails()) {
                $data = ['message' => "Error en la validacion de datos", "status" => false];
                return response()->json($data, 400);
            }
            $rol = Rol::create([
                'rol' => $request->rol,
            ]);
            if (!$rol) {
                return response()->json(["status" => false, 'message' => 'Error al crear el rol.'], 500);
            }
            $data = ["status" => true, 'data' => $rol];
            return response()->json($data, status: 201);
        } catch (Throwable $th) {
            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function deleteRol($id)
    {
        try {
            $rol = Rol::find($id);
            if (!$rol) {
                return response()->json(["status" => false, 'message' => 'Error, no existe el rol y por ende no s epuede eliminar.'], 404);
            }
            $rol->delete();
            $data = ["status" => true, 'message' => 'Rol eliminado.'];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function getRolById($id)
    {
        try {
            $rol = Rol::find($id);
            if (!$rol) {
                return response()->json(["status" => false, 'message' => 'Error, no existe el rol.'], 404);
            }
            $data = ["status" => true, 'data' => $rol];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function updateRol($id, Request $request)
    {
        try {
            $rol = Rol::find($id);
            if (!$rol) {
                return response()->json(["status" => false, 'message' => 'Error, no existe el rol y por ende no s epuede eliminar.'], 404);
            }
            $validator = validator::make($request->all(), ['rol' => 'required  | max:100']);
            if ($validator->fails()) {
                $data = ['message' => "Error en la validacion de datos", "status" => false];
                return response()->json($data, 400);
            }

            $rol->rol = $request->rol; //asigno a mi atributo rol su valor
            $rol->save();
            $data = ["status" => true, 'message' => 'Rol actualizado.', 'data' => $rol];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }
}
