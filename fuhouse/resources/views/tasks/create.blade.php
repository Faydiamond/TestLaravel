@extends('layouts.navbar')
@section('menu')
<div class="container mt-4">
   <h2>Agregar nuevo incidente</h2>
   <div class="row">
      <div class="col">
         <div class="card">
            <div class="card-body">
               <form action="{{route('storetask')}}" method="post">
                  @csrf
                  @method('POST')
                  <div class="row">
                     <div class="col-md-3">
                        <div class="form-group mt-1">
                           <select class="form-select" aria-label="Default select example"  name="incidencia_id" id="incidencia_id" required> 
                              <option value="">incidencia por id</option>
                              @foreach ($incidencias as $incidencia)
                                  <option value="{{ $incidencia->id }}">{{ $incidencia->description}}</option>
                              @endforeach
                           </select>
                           
                        </div>
                     </div>
                     <div class="col-md-3 mt-2">
                        <select class="form-select" aria-label="Default select example"   name="estate" id="estate" >
                           <option selected>Estado</option>
                           <option value="Pendiente">Pendiente</option>
                           <option value="En proceso">En proceso</option>
                           <option value="Solucionada">Solucionada</option>
                           <option value="No Solucionada">No Solucionada</option>
                        </select>
                     </div>
                     <div class="col-md-3" mt-2>
                        <select class="form-select" aria-label="Default select example"  name="cost_responsible" id="cost_responsible" >
                           <option selected>Costo responsable</option>
                           <option value="Cliente">Cliente</option>
                           <option value="Propietario">Propietario</option>
                           <option value="Homeselect">Homeselect</option>
                        </select>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-12">
                           <div class="form-group mt-1">
                              <input type="number" class="form-control" min="1" pattern="^[0-9]+" id="price" placeholder="precio" name="price" required>
                           </div>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-12">
                           <textarea class="form-control" name="description" id="description" rows="3" placeholder="descripcion"></textarea>
                        </div>
                     </div>
                     <div class="mt-3">
                        <button class="btn btn-primary"> Agregar </button>
                        <a href="{{ route('tasks') }}" class="btn btn-secondary">Cancelar</a>
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