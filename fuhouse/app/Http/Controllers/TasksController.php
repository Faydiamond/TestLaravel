<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{

    public function index()
    {
        $tasks =  Task::paginate(5);
        //
        return view("tasks/index", compact('tasks'));
    }

    public function create()
    {
        $incidencias = Incident::all();
        return view("tasks/create", compact('incidencias'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:180',
            'estate' => 'required|max:80',
            'price' => 'required',
            'incidencia_id' => 'required',

        ]);


        if ($validator->fails()) {
            return back()->withErrors([
                'error ' => $validator->errors()->all()
            ]);
        }

        $task = new Task();
        $task->description = $request->description;
        $task->incidencia_id = $request->incidencia_id;
        $task->estate = $request->estate;
        $task->price = $request->price;
        $task->cost_responsible = $request->cost_responsible;
        $task->save();
        return to_route('tasks');
    }


    public function edit($id)
    {
        $task = Task::find($id);
        $incidencias = Incident::all();
        return view('tasks/edit', compact('task', 'incidencias'));
    }

    public function update(Request $request, string $id)
    {

        $task = Task::find($id);
        $task->incidencia_id = $request->incidencia_id;
        $task->estate = $request->estate;
        $task->price = $request->price;
        $task->cost_responsible = $request->cost_responsible;
        $task->comentario = $request->comentario;
        $task->save();
        return to_route('tasks');
    }

    /*
    

    public function show(string $id)
    {
        $user = User::find($id);
        //return to_route('users/show', compact('user'));
        return view('users/show', compact('user'));
    }

   
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

   
    public function destroy(string $id)
    {
        //
        $user = User::find($id);
        $user->delete();
        return to_route('users');
    }*/
}
