@extends('layouts.navbar')
@section('menu')
<p>reservas</p>

<div class="container">
   <div class="row">
   <div class="col">
   <div class="card">
   <div class="card-body">
     
   </div>
   <div class="container">
      <div class="row">
         @forelse ($items as $item)
         <div class="col-md-4">
            <div class="card position-relative mb-3" >
              
               <img src="{{$item->image_url}}" class="card-img-top img-fluid" alt="...">
               <div class="card-body">
                 
                  <h5 class="card-title">{{ $item->name }}</h5>
                  <p class="card-text">{{ $item->description }}</p>
                  <a href="" class="btn btn-primary">Reservar</a>

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