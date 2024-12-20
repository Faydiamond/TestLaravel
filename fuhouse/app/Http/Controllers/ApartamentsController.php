<?php

namespace App\Http\Controllers;

use App\Models\Apartament;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApartamentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:users');
    }


    public function create()
    {
        $cities = City::all();
        return view("apartaments/create", compact('cities'));
    }
    public function index()
    {
        $items = Apartament::all();
        return view("apartaments/index", compact('items'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:180|unique:apartaments',
            'description' => 'required|max:255',
            'image_url' => 'string',
            'city_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return back()->withErrors([
                'error ' => $validator->errors()->all()
            ]);
        }

        $apto = new Apartament();
        $apto->name = $request->name;
        $apto->description = $request->description;
        $apto->image_url = $request->image_url;
        $apto->city_id = $request->city_id;
        $apto->save();
        return to_route('apartaments');
    }

    public function show(string $id)
    {
        //$user = User::find($id);
        //return to_route('users/show', compact('user'));
        //return view('users/show', compact('user'));
    }


    public function edit(string $id)
    {
        $apto = Apartament::find($id);
        dd($apto);
        $cities = City::all();
        return view('apartaments/edit', compact('apto', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $apto = Apartament::find($id);
        $apto->name = $request->name;
        $apto->description = $request->description;
        $apto->image_url = $request->image_url;
        $apto->city_id = $request->city_id;
        $apto->save();
        return to_route('apartaments');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $apto = Apartament::find($id);
        $apto->delete();
        return to_route('apartaments');
    }
}
