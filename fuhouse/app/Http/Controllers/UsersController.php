<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Rol;
use App\Models\City;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }


    public function create()
    {
        $cities = City::all();
        $roles = Rol::all();
        return view("users/create", compact('cities', 'roles'));
    }
    public function index()
    {
        //$pass = Hash::make('123456');
        //dd($pass);
        $items = User::paginate(5);
        return view("users/index", compact('items'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->merge([
            'email' => strtolower($request->email),
        ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:255',
            'telphone' => 'required|max:25',
            'role_id' => 'required|integer',
            'city_id' => 'required|integer'
        ]);


        if ($validator->fails()) {
            return back()->withErrors([
                'error ' => $validator->errors()->all()
            ]);
        }

        if (User::where('email', $request->email)->exists()) {
            return back()->withErrors([
                'error' => 'El correo ingresado ya está registrado.',
            ]);
        }

        $city = City::find($request->city_id);

        if (!$city || $city->city === '') {
            return back()->withErrors(['error' => 'La ciudad no se encontró.']);
        }
        $rol = Rol::find($request->role_id);
        if (!$rol || $rol->rol === '') {
            return back()->withErrors(['error' => 'El rol no se encontró.']);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->telphone = $request->telphone;
        $user->password =  Hash::make($request->password);;
        $user->role_id = $request->role_id;
        $user->city_id = $request->city_id;

        $user->save();
        return to_route('users');
    }

    public function show(string $id)
    {
        $user = User::find($id);
        //return to_route('users/show', compact('user'));
        return view('users/show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::find($id);
        $cities = City::all();
        $roles = Rol::all();
        return view('users/edit', compact('user', 'cities', 'roles')); //edit
    }


    public function update(Request $request, string $id)
    {
        //
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->telphone = $request->telphone;
        $user->password = $request->password;
        $user->role_id = $request->role_id;
        $user->city_id = $request->city_id;

        $user->save();

        return to_route('users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::find($id);
        $user->delete();
        return to_route('users');
    }
}
