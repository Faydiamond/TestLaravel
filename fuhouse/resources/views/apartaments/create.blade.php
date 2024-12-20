@extends('layouts.navbar')
@section('menu')
<div class="container mt-4">
   <h2>Agregar nuevo apartamento</h2>
   <div class="row">
      <div class="col">
         <div class="card">
            <div class="card-body">
               <form action="{{ route('storeApto') }}" method="post">
                  @csrf
                  @method('POST')
                  <div class="form-group mt-2">
                     <input type="input" class="form-control" id="name" placeholder="nombre" name="name" required>
                  </div>
                  <div class="form-group mt-2">
                     <input type="input" class="form-control" id="description" placeholder="descripcion" name="description" required>
                  </div>
                  <div class="form-group mt-2">
                     <input type="input" class="form-control" id="image_url" placeholder="url de la imagen" name="image_url" required>
                  </div>
                  <div class="form-group mt-2">
                     <select name="city_id" id="city_id" required>
                        <option value="">Seleccione una ciudad</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->city }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="mt-5" >
                    <button class="btn btn-primary"> Agregar </button>
                    <a href="{{ route('apartaments') }}" class="btn btn-secondary">Cancelar</a>
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