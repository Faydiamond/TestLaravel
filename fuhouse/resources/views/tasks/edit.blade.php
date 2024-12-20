@extends('layouts.navbar')
@section('menu')
<div class="container mt-4">
<h2>Editar task</h2>
<div class="row">
   <div class="col">
      <div class="card">
         <div class="card-body">
            <form  action="{{ route('updatetask', $task->id) }}"  method="post" id="task-form">
               @csrf
               @method('PUT')
               <div class="row">
                  <div class="col-md-3">
                     <div class="form-group mt-1">
                        <select class="form-select" aria-label="Default select example" name="incidencia_id" id="incidencia_id" required>
                           <option value="">incidencia por id</option>
                           @foreach ($incidencias as $incidencia)
                           <option value="{{ $incidencia->id }}">{{ $incidencia->description }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3 mt-2">
                     <select class="form-select" aria-label="Default select example" name="estate" id="estate" required>
                        <option selected>Estado</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="En proceso">En proceso</option>
                        <option value="Solucionada">Solucionada</option>
                        <option value="No Solucionada">No Solucionada</option>
                     </select>
                  </div>
                  <div class="col-md-3" mt-2>
                     <select class="form-select" aria-label="Default select example" name="cost_responsible" id="cost_responsible">
                        <option selected>Costo responsable</option>
                        <option value="Cliente">Cliente</option>
                        <option value="Propietario">Propietario</option>
                        <option value="Homeselect">Homeselect</option>
                     </select>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <div class="form-group mt-1">
                           <input type="number" class="form-control" min="1" pattern="^[0-9]+" id="price" placeholder="precio" name="price" required>
                        </div>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <textarea class="form-control" name="comentario" id="comentario" rows="3" placeholder="descripcion" disabled></textarea>
                     </div>
                  </div>
                  <div class="mt-3">
                     <button class="btn btn-primary" id="submit-btn">Agregar</button>
                     <a href="{{ route('tasks') }}" class="btn btn-secondary">Cancelar</a>
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
<script>
   document.addEventListener('DOMContentLoaded', () => {
      //declaro el dom
       const estateSelect = document.getElementById('estate');
       const comentarioTextarea = document.getElementById('comentario');
       const taskForm = document.getElementById('task-form');
   
       const toggleComentario = () => {
           const selectedValue = estateSelect.value;
           //logica para descativar segun 
           if (selectedValue === 'Solucionada' || selectedValue === 'No Solucionada') {
               comentarioTextarea.disabled = false;
               comentarioTextarea.required = true; 
           } else {
               comentarioTextarea.disabled = true;
               comentarioTextarea.required = false; 
               comentarioTextarea.value = ''; 
           }
       };
   
       taskForm.addEventListener('submit', (e) => {
           const selectedValue = estateSelect.value;
           if ((selectedValue === 'Solucionada' || selectedValue === 'No Solucionada') && !comentarioTextarea.value.trim()) {
               e.preventDefault(); 
               alert('Por favor, llene el campo de descripción si selecciona Solucionada o No Solucionada.');
           }
       });
       estateSelect.addEventListener('change', toggleComentario);
       toggleComentario();
   });
</script>
@endsection