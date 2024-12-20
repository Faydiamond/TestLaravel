@extends('layouts.navbar')

@section('menu')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h3>Mis Reservas</h3>
                    <div class="row">
                        @forelse ($reserves as $reserve)
                            <div class="col-md-4">
                                <div class="card">
                                    <form  action="{{route('destroyApto', $reserve->id)}}"  method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm position-absolute top-0 end-0 m-2 delete-button" data-id="{{ $reserve->id }}">X</button>
                                     </form>
                                    <div class="card-body">
                                        <p><strong>Usuario:</strong> {{ $reserve->user->name }}</p>
                                        <p><strong>Apartamento:</strong> {{ $reserve->apartament->name }}</p> 
                                        <p><strong>Fecha de entrada:</strong> {{ $reserve->date_entry }}</p>
                                        <p><strong>Fecha de salida:</strong> {{ $reserve->date_out }}</p>
                                        <p><strong>Precio:</strong> ${{ number_format($reserve->price, 2) }}</p> 
                                        <a href="{{ route('editreserve',$reserve->id) }}" type="button" class="btn btn-warning">Editar</a>
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