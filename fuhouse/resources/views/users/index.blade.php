@extends('layouts.navbar')
@section('menu')
    <p>Usuarios</p>
    <div class="container">
        <div class="row">
           <div class="col">
              <div class="card">
                 <div class="card-body">
                    <a href="{{ route('create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Agregar usuario</a>
                    <hr>
                    <table class="table table-striped text-center">
                       <thead>
                          <tr>
                             <th>Id</th>
                             <th>Nombre</th>
                             <th>Correo</th>
                             <th>Acciones</th>
                          </tr>
                       </thead>
                       <tbody>
                         @forelse ($items as $item)
                          <tr>
                             <td>{{$item->id}}</td>
                             <td>{{$item->name}} </td>
                             <td>{{$item->email}} </td>
                             <td>
                           <form  action="{{route('destroy', $item->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                                 <a href="{{ route('show', $item->id) }}" class="btn btn-info">
                                     <i class="fa-solid fa-list"></i> Mostrar
                                 </a>
                                 <a href="{{ route('edit', $item->id)}}" class="btn btn-warning">
                                     <i class="fa-solid fa-pen-to-square"></i> Editar
                                 </a>
                                 <button class="btn btn-danger">
                                     <i class="fa-solid fa-trash"></i> Borrar
                                 </button>
                              </form>
                           </td>
                          </tr>
                          @empty
                          <tr>
                             <td> No hay registros.</td>
                         </tr>
                         @endforelse
                         
                       </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                     {{ $items->links() }}
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
@endsection

