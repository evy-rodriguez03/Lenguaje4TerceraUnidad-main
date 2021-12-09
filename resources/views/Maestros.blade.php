@extends('plantilla')


@section('titulo')
Maestros
@endsection

@section('content')

@if(session('mensaje'))
<div class="alert alert-success">
    {{session('mensaje')}}
</div>
@endif

<h3>Maestros</h3>

<a type="button" class="btn btn-primary" href="{{route('maestro.crear')}}">Nuevo Profesor</a>


<form method="POST" action="{{route('maestro.buscar')}}">
    <h4>Buscar</h4>
    @csrf
    <input name="texto_buscar" id="texto_buscar">
</form>

<table class="table table-bordered table-success">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Numero_Identidad</th>
            <th scope="col">Fecha_nac</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Direccion</th>
            <th scope="col">Especialidad</th>
        </tr>
    </thead>
    <tbody>

        @forelse($maestros as $maestro)
        <tr>
            <td scope="col">{{$maestro->id}}</td>
            <td scope="col">{{$maestro->nombres}}</td>
            <td scope="col">
                <a href="{{route('maestro.mostrar',['id'=> $maestro->id] )}}">{{$maestro->apellidos}}</a>
            </td>
            <td scope="col">{{$maestro->numero_identidad}}</td>
            <td scope="col">{{$maestro->fecha_nac}}</td>
            <td scope="col">{{$maestro->telefono}}</td>
            <td scope="col">{{$maestro->direccion}}</td>
            <td scope="col">{{$maestro->especialidad}}</td>
            <td scope="col"> <a type="button" class="btn btn-warning"
                    href="{{route('maestro.editar',['id'=> $maestro->id] )}}">Editar</a> </td>
            <td scope="col">
                <form method="post" action="{{route('maestro.borrar',['id'=> $maestro->id] )}}"
                    onclick="return confirm('Desea Eliminar a este Maestro?')">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Eliminar" class="btn btn-danger">
                </form>
            </td>

        </tr>
        @empty
        <tr colspan='4'>
            <td>No hay Maestros</td>
        </tr>
        @endforelse

    </tbody>
</table>

{{$maestros->links()}}

@endsection
