<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IncidentsController extends Controller
{
    //
    public function index()
    {
        //$pass = Hash::make('123456');
        //dd($pass);
        $incidents = Incident::where('user_id', session(key: 'user_id'))->get();
        return view("incidents/index", compact('incidents'));
    }

    public function create()
    {
        $reserves =  Reserve::where('user_id', session('user_id'))->get();
        //dd($reserves);
        if ($reserves->isEmpty()) {
            return redirect()->back()->with('error', 'No se encontraron reservas para este usuario.');
        }
        return view("incidents/create", compact('reserves'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:180',
            'estate' => 'required|max:80',
        ]);


        if ($validator->fails()) {
            return back()->withErrors([
                'error ' => $validator->errors()->all()
            ]);
        }

        $incident = new Incident();
        $incident->reserve_id = $request->reserve_id;
        $incident->user_id = session('user_id');
        $incident->description = $request->description;
        $incident->estate = $request->estate;
        $incident->report = date('Y-m-d');

        $incident->save();
        return to_route('incidents');
    }

    public function edit($id)
    {
        $incident = Incident::find($id);
        $reserve =  Reserve::where('user_id', session('user_id'))->get();
        //dd($reserves);
        if ($reserve->isEmpty()) {
            return redirect()->back()->with('error', 'No se encontraron reservas para este usuario.');
        }
        return view('incidents/edit', compact('incident', 'reserve'));
    }

    public function destroy(string $id)
    {
        $incident = Incident::find($id);
        $incident->delete();
        return to_route('incidents');
    }
}
