@extends('layouts.navbar')
@section('menu')
<div class="container mt-4">
   <h2>Editar incidente</h2>
   <div class="row">
      <div class="col">
         <div class="card">
            <div class="card-body">
               <form action="" method="post">
                  @csrf
                  @method('PUT')
                  <div class="row">
                     <div class="col-md-3">
                        <div class="form-group mt-1">
                           <select class="form-select" aria-label="Default select example"  name="reserve_id" id="reserve_id" required> 
                              <option value="">reserva por fecha de entrada</option>
                              @foreach ($reserve as $res)
                                  <option value="{{ $incident->id }}">{{ $res->booking_date}}</option>
                              @endforeach
                           </select>
                           
                        </div>
                     </div>
                     <div class="col-md-3">
                        <select class="form-select" aria-label="Default select example"   name="estate" id="estate" >
                           <option selected>Estado</option>
                           <option value="Pendiente">Pendiente</option>
                           <option value="En proceso">En proceso</option>
                           <option value="Solucionada">Solucionada</option>
                           <option value="No Solucionada">No Solucionada</option>
                        </select>
                     </div>
                     <div class="col-md-6"></div>
                  </div>
                  <div class="mb-3">
                     <label for="exampleFormControlTextarea1" class="form-label">Descripcion</label>
                     <textarea class="form-control" name="description" id="description" rows="3" value="{{ $incident->description }}"></textarea>
                  </div>
                  <div class="mt-3" >
                     <button class="btn btn-primary"> Agregar </button>
                     <a href="{{ route('login') }}" class="btn btn-secondary">Cancelar</a>
                  </div>
               </form>
               @if ($errors->any())
               <div class="alert alert-danger mt-3">
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
@endsection