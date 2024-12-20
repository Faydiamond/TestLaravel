@extends('layouts.navbar')
@section('menu')
<p>Apartamentos</p>
<div class="container">
<div class="row">
<div class="col">
<div class="card">
<div class="card-body">
   <a href="{{ route('createApto') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Agregar apartamento</a>
   <hr>
</div>
<div class="container">
   <div class="row">
      @forelse ($items as $item)
      <div class="col-md-4">
         <div class="card position-relative mb-3" style="width: 22rem;">
            <img src="https://imagenesestatic.s3.ca-central-1.amazonaws.com/sabana.jpg" class="card-img-top img-fluid" alt="...">
            <form  action="{{route('destroyApto', $item->id)}}" method="POST">
               @csrf
               @method('DELETE')
               <button class="btn btn-outline-danger btn-sm position-absolute top-0 end-0 m-2 delete-button" data-id="{{ $item->id }}">X</button>
            </form>
            <div class="card-body">
               <h5 class="card-title">{{ $item->name }}</h5>
               <p class="card-text">{{ $item->description }}</p>
               <a href="{{ route('editApto', $item->id) }}" class="btn btn-primary">Editar</a>
            </div>
         </div>
      </div>
      @empty
      <div class="col-md-12">
         <p>No hay registros.</p>
      </div>
      @endforelse
   </div>
</div>
@endsection