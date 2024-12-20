<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\City;
use Throwable;

class CityController extends Controller
{
    //
    public function getCitys()
    {
        try {
            $rols = City::all();
            if ($rols->isEmpty()) {
                $data = ['message' => "no hay ciudades registradas", "status" => false];
                return response()->json($data, 404);
            }
            $data = ["status" => true, "data" => $rols];
            return response()->json($data, 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function saveCity(Request $request)
    {
        try {
            $validator = validator::make($request->all(), ['city' => 'required  | max:100']);
            if ($validator->fails()) {
                $data = ['message' => "Error en la validacion de datos", "status" => false];
                return response()->json($data, 400);
            }
            $city = City::create([
                'city' => $request->city,
            ]);
            if (!$city) {
                return response()->json(["status" => false, 'message' => 'Error al crear la ciudad.'], 500);
            }
            $data = ["status" => true, 'data' => $city];
            return response()->json($data, status: 201);
        } catch (Throwable $th) {
            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function deleteCity($id)
    {
        try {
            $city = City::find($id);
            if (!$city) {
                return response()->json(["status" => false, 'message' => 'Error, no existe la ciudad y por ende no s epuede eliminar.'], 404);
            }
            $city->delete();
            $data = ["status" => true, 'message' => 'Ciudad eliminada.'];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function getCityById($id)
    {
        try {
            $city = City::find($id);
            if (!$city) {
                return response()->json(["status" => false, 'message' => 'Error, no existe la ciudad.'], 404);
            }
            $data = ["status" => true, 'data' => $city];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function updateCity($id, Request $request)
    {
        try {
            $city = City::find($id);
            if (!$city) {
                return response()->json(["status" => false, 'message' => 'Error, no existe el rol y por ende no se puede actualizar.'], 404);
            }
            $validator = validator::make($request->all(), ['city' => 'required  | max:100']);
            if ($validator->fails()) {
                $data = ['message' => "Error en la validacion de datos", "status" => false];
                return response()->json($data, 400);
            }

            $city->city = $request->city;
            $city->save();
            $data = ["status" => true, 'message' => 'Ciudad actualizada.', 'data' => $city];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }
}
