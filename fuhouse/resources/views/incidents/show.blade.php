@extends('layouts.navbar')
@section('menu')
<div class="container mt-4">
   <h2>Mostrar la info de {{$user->name}}</h2>
   <div class="row">
      <div class="col">
         <div class="card">
            <div class="card-body">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> {{$user->id}}</td>
                            <td> {{$user->name}}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('users') }}" class="btn btn-secondary mt-2">Cancelar </a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection