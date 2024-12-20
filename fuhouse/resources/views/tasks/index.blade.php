@extends('layouts.navbar')
@section('menu')
    <p>Tareas</p>
    <div class="container">
        <div class="row">
           <div class="col">
              <div class="card">
                 <div class="card-body">
                    <a href=" {{route('taskscreate')}} " class="btn btn-primary"><i class="fa-solid fa-plus"></i>Agregar tarea</a>
                    <hr>
                    <table class="table table-striped text-center">
                       <thead>
                          <tr>
                             <th>Id</th>
                             <th>description</th>
                             <th>estate</th>
                             <th>descripcion</th>
                          </tr>
                       </thead>
                       <tbody>
                         @forelse ($tasks as $task)
                          <tr>
                             <td>{{$task->id}}</td>
                             <td>{{$task->description}} </td>
                             <td>{{$task->estate}} </td>
                             <td>
                              @if ($task->incidencia) 
                                  {{ $task->incidencia->description }} 
                              @else
                                  Sin Incidencia 
                              @endif
                          </td>
                             <td>
                           <form  action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <!--
                                 <a href="" class="btn btn-info">
                                     <i class="fa-solid fa-list"></i> Mostrar
                                 </a>-->
                                 <a href="{{ route('editask', $task->id)}}" class="btn btn-warning">
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
                     {{ $tasks->links() }}
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
@endsection

