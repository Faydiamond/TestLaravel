<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Apartament;
use Throwable;

class ApartamentController extends Controller
{
    //
    public function getAptaments()
    {
        try {
            $apartaments = Apartament::all();
            if ($apartaments->isEmpty()) {
                $data = ['message' => "no hay apartamentos registrados", "status" => false];
                return response()->json($data, 404);
            }
            $data = ["status" => true, "data" => $apartaments];
            return response()->json($data, 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function saveApartament(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:180|unique:apartaments',
                'description' => 'required|max:255',
                'image_url' => 'string',
                'city_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Error en la validación de datos',
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ], 400);
            }

            $apto = Apartament::create([
                'name' => $request->name,
                'description' => $request->description,
                'image_url' => $request->image_url,
                'city_id' => $request->city_id
            ]);
            if (!$apto) {
                return response()->json(["status" => false, 'message' => 'Error al crear el apartamento.'], 500);
            }
            $data = ["status" => true, 'data' => $apto];
            return response()->json($data, status: 201);
        } catch (Throwable $th) {
            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function getAptoyById($id)
    {
        try {
            $apto = Apartament::find($id);
            if (!$apto) {
                return response()->json(["status" => false, 'message' => 'Error, no existe el apartamento.'], 404);
            }
            $data = ["status" => true, 'data' => $apto];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function deleteApto($id)
    {
        try {
            $apto = Apartament::find($id);
            if (!$apto) {
                return response()->json(["status" => false, 'message' => 'Error, no existe el apto y por ende no se puede eliminar.'], 404);
            }
            $apto->delete();
            $data = ["status" => true, 'message' => 'Apartamento eliminado.'];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {
            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function updateApto($id, Request $request)
    {
        try {
            $apto = Apartament::find($id);
            if (!$apto) {
                return response()->json(["status" => false, 'message' => 'Error, no existe el apartamento y por ende no se puede actualizar.'], 404);
            }

            $validator = validator::make($request->all(), [
                'name' => 'required|max:180|unique:apartaments',
                'description' => 'required|max:255',
                'image_url' => 'string',
                'city_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Error en la validación de datos',
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ], 400);
            }

            $apto->name = $request->name;
            $apto->description = $request->description;
            $apto->image_url = $request->image_url;
            $apto->city_id = $request->city_id;

            $apto->save();
            $data = ["status" => true, 'message' => 'Apartamento actualizado.', 'data' => $apto];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }
}
