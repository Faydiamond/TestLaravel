@extends('layouts.navbar')
@section('menu')
<div class="container mt-4">
   <div class="row justify-content-center">
      <div class="col-md-6">
         <div class="card">
            <div class="card-img-top d-flex justify-content-center mt-3">
               <img src="{{ $apto->image_url }}" class="img-fluid" alt="Imagen del apartamento" style="max-width: 20rem;">
            </div>
            <div class="card-body">
               <h5 class="card-title">{{$apto->name}}</h5>
               <p class="card-text">{{$apto->description}}</p>
               <form action="{{ route('storeReservation') }}" method="post">
                  @csrf
                  @method('POST')
                  <input type="hidden" name="apartament_id" value="{{$apto->id }}">
                  <input type="hidden" name="user_id" value="{{$user->id }}">
                  <div class="row">
                     <div class="col">
                        <div class="form-group">
                           <label for="fecha_reserva">Fecha de ingreso</label>
                           <input type="date" class="form-control" id="date_entry" name="date_entry" required>
                        </div>
                     </div>
                     <div class="col">
                        <div class="form-group">
                           <label for="fecha_reserva">Fecha de salida</label>
                           <input type="date" class="form-control" id="fecha_reserva" name="date_out" required>
                        </div>
                     </div>
                  </div>
                  <div class="form-group mt-1">
                     <input type="number" class="form-control" min="1" pattern="^[0-9]+" id="days" placeholder="Nro.dias" name="days" required>
                  </div>
                  <div class="mt-3">
                     <button class="btn btn-primary"> Agregar </button>
                     <a href="{{ route('reservations') }}" class="btn btn-secondary">Cancelar</a>
                  </div>
                  @if ($errors->any())
                  <div class="alert alert-danger mt-3">
                     <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                     </ul>
                  </div>
                  @endif
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection