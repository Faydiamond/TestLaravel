<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Throwable;

class UserController extends Controller
{
    //
    public function getUsers()
    {
        try {
            $users = User::all();
            if ($users->isEmpty()) {
                $data = ['message' => "no hay usuarios registrados", "status" => false];
                return response()->json($data, 404);
            }
            $data = ["status" => true, "data" => $users];
            return response()->json($data, 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function saveUser(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'email' => 'required|email|unique:users',
                'password' => 'required|max:255',
                'telphone' => 'required|max:25',
                'role_id' => 'required|integer',
                'city_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Error en la validación de datos',
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ], 400);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'telphone' => $request->telphone,
                'password' => $request->password,
                'role_id' => $request->role_id,
                'city_id' => $request->city_id
            ]);
            if (!$user) {
                return response()->json(["status" => false, 'message' => 'Error al crear el usuario.'], 500);
            }
            $data = ["status" => true, 'data' => $user];
            return response()->json($data, status: 201);
        } catch (Throwable $th) {
            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json(["status" => false, 'message' => 'Error, no existe el usuario y por ende no se puede eliminar.'], 404);
            }
            $user->delete();
            $data = ["status" => true, 'message' => 'Usuario eliminado.'];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function getUseryById($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json(["status" => false, 'message' => 'Error, no existe el usuario.'], 404);
            }
            $data = ["status" => true, 'data' => $user];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }


    public function updateUser($id, Request $request)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json(["status" => false, 'message' => 'Error, no existe el usuario y por ende no se puede actualizar.'], 404);
            }

            $validator = validator::make($request->all(), [
                'name' => 'required|max:100',
                'email' => 'required|email',
                'password' => 'required|max:255',
                'telphone' => 'required|max:25',
                'role_id' => 'required|integer',
                'city_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Error en la validación de datos',
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ], 400);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->telphone = $request->telphone;
            $user->password = $request->password;
            $user->role_id = $request->role_id;
            $user->city_id = $request->city_id;

            $user->save();
            $data = ["status" => true, 'message' => 'Usuario actualizado.', 'data' => $user];
            return response()->json($data, status: 200);
        } catch (Throwable $th) {

            return response()->json(["status" => false, 'message' => $th->getMessage()], 500);
        }
    }
}
