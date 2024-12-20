<?php

namespace App\Http\Controllers;

use App\Models\Apartament;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ReservationsController extends Controller
{
    //
    public function index()
    {
        $items = Apartament::all();
        return view("reservations/index", compact('items'));
    }

    public function show(string $id)
    {
        $reserves = Reserve::where('user_id', $id)->get();
        if ($reserves->isEmpty()) {
            return redirect()->back()->with('error', 'No se encontraron reservas para este usuario.');
        }
        return view('reservations.show', compact('reserves'));
    }


    public function create($iduser, $idapto)
    {

        $user = User::find($iduser);
        //dd($user);
        $apto = Apartament::find($idapto);
        return view("reservations/create", compact('user', 'apto'));
    }

    private function generarNumeroAleatorio()
    {
        $numeroAleatorio = rand(25, 67);
        return $numeroAleatorio;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date_entry' => 'required|date',
            'date_out' => 'required|date',
            'user_id' => 'required|integer',
            'apartament_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return back()->withErrors([
                'error ' => $validator->errors()->all()
            ]);
        }

        $overlappingReserves = Reserve::where('apartament_id', $request->apartament_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('date_entry', [$request->date_entry, $request->date_out])
                    ->orWhereBetween('date_out', [$request->date_entry, $request->date_out]);
            })
            ->exists();

        if ($overlappingReserves) {
            return back()->withErrors(['error' => 'Las fechas seleccionadas se superponen con otras reservas.']);
        }
        $priceCalculate = $this->generarNumeroAleatorio() * $request->days; //* $request->days
        //dd($price);
        $date_entry_timestamp = strtotime($request->date_entry);
        $reserve = new Reserve();
        $reserve->booking_date = date('Y-m-d');
        $reserve->date_entry = Carbon::parse($request->date_entry)->format('Y-m-d');
        $reserve->date_out = Carbon::parse($request->date_out)->format('Y-m-d');
        $reserve->price = $priceCalculate;
        $reserve->user_id = $request->user_id;
        $reserve->apartament_id = $request->apartament_id;

        $reserve->save();
        return to_route('reservations');
    }

    public function edit($id)
    {
        $reserve = Reserve::find($id);
        //dd($reserve);
        return view('reservations/edit', compact('reserve'));
    }


    public function update(Request $request, string $id)
    {
        $priceCalculate = $this->generarNumeroAleatorio() * $request->days; //* $request->days
        $reserve = Reserve::find($id);

        $reserve->booking_date = date('Y-m-d');
        $reserve->date_entry = Carbon::parse($request->date_entry)->format('Y-m-d');
        $reserve->date_out = Carbon::parse($request->date_out)->format('Y-m-d');
        $reserve->price = $priceCalculate;
        $reserve->user_id = $request->user_id;
        $reserve->apartament_id = $request->apartament_id;
        $reserve->save();
        return to_route('reservations');
    }

    public function destroy(string $id)
    {
        $apto = Apartament::find($id);
        $apto->delete();
        return to_route('reservations');
    }
}
