@extends('layouts.navbar')
@section('menu')
<p>Usuarios</p>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
               
                <div class="card-body">
                    <div class="row">
                        @forelse ($incidents as $incident)
                      
                            <div class="col-md-4"> 
                                <div class="card position-relative mb-3">
                                    <div class="card-body">
                                        <form  action="{{route('destroyincident', $incident->id)}}"  method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm position-absolute top-0 end-0 m-2 delete-button" data-id="{{ $incident->id }}">X</button>
                                         </form>
                                        <h5 class="card-title">{{ $incident->estate }}</h5>
                                        <p class="card-text">{{ $incident->description }}</p> 
                                        <a href="{{ route('editincident',$incident->id) }}" type="button" class="btn btn-warning">Editar</a>
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
            </div>
        </div>
    </div>
</div>
@endsection