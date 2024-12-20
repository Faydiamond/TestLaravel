@extends('layouts.navbar')
@section('menu')
<div class="container mt-4">
    <h2>Actualizar usuario</h2>
    <div class="row">
       <div class="col">
          <div class="card">
             <div class="card-body">
                <form action="{{ route('update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                 
                   <div class="form-group mt-1">
                      <input type="input" class="form-control" id="name" placeholder="nombre" name="name" required value={{$user->name}}>
                   </div>
                   <div class="form-group mt-1">
                      <input type="input" class="form-control" id="email" placeholder="correo" name="email" required value={{$user->email}}>
                   </div>
                   <div class="form-group mt-1">
                      <input type="input" class="form-control" id="telphone" placeholder="telefono" name="telphone" value={{$user->telphone}}>
                   </div>
                   <div class="form-group mt-1">
                      <input type="password" class="form-control" id="password" placeholder="clave" name="password" required value={{$user->password}}>
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
                     <button class="btn btn-warning"> Actualizar </button>
                     <a href="{{ route('users') }}" class="btn btn-secondary">Cancelar</a>
                   </div>
                </form>
             </div>
          </div>
       </div>
    </div>
 </div>
 @endsection