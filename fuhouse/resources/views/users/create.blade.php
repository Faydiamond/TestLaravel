@extends('layouts.navbar')
@section('menu')
<div class="container mt-4">
   <h2>Agregar nuevo usuario</h2>
   <div class="row">
      <div class="col">
         <div class="card">
            <div class="card-body">
               <form action="{{ route('store') }}" method="post">
                  @csrf
                  @method('POST')
                  <div class="form-group mt-1">
                     <input type="input" class="form-control" id="name" placeholder="nombre" name="name" required>
                  </div>
                  <div class="form-group mt-1">
                     <input type="input" class="form-control" id="email" placeholder="correo" name="email" required>
                  </div>
                  <div class="form-group mt-1">
                     <input type="input" class="form-control" id="telphone" placeholder="telefono" name="telphone">
                  </div>
                  <div class="form-group mt-1">
                     <input type="password" class="form-control" id="password" placeholder="clave" name="password" required>
                  </div>
                  <div class="form-group mt-1">
                     <select name="role_id" id="role_id" required>
                        <option value="">Seleccione un rol</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->rol}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group mt-1">
                     <select name="city_id" id="city_id" required>
                        <option value="">Seleccione una ciudad</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->city }}</option>
                        @endforeach
                    </select>
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