<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index()
    {
        $alumnos = Alumno::paginate(10);

        return view('Alumno')->with('alumnos', $alumnos);
    }

    public function crear()
    {
        return view('crearAlumnos');
    }


    public function mostrar($id)
    {
        $em = Alumno::findOrFail($id);
        return view('ver')->with('alumno', $em);
    }



    public function guardar(Request $request)
    {
        $nuevoAlumno = new Alumno();
        $nuevoAlumno->nombres = $request->nombres;
        $nuevoAlumno->apellidos = $request->apellidos;
        $nuevoAlumno->edad = $request->edad;
        $nuevoAlumno->numero_identidad = $request->numero_identidad;
        $nuevoAlumno->telefono = $request->telefono;
        $nuevoAlumno->direccion = $request->direccion;
        $nuevoAlumno->nombre_padre = $request->nombre_padre;
        $nuevoAlumno->nombre_madre = $request->nombre_madre;

        $nuevoAlumno->save();

        return redirect()->route('alumno.index')->with('mensaje', 'El Alumno fue registrado exitosamente');
    }



    public function buscar(Request $request)
    {
        $alumnos =  Alumno::where('nombres', 'like', '%' . $request->texto_buscar . '%')->paginate(10);
        return view('Alumno')->with('alumnos', $alumnos);
    }

    public function eliminar($id)
    {
        Alumno::destroy($id);
        return redirect()->route('alumno.index')->with('mensaje', 'Eliminado con exito.');
    }



    public function editar($id)
    {
        $em = Alumno::findOrFail($id);
        return view('modificarAlumnos')->with('alumno', $em);
    }





    public function actualizar(Request $request, $id)
    {
        $nuevoAlumno = Alumno::findOrFail($id);

        $nuevoAlumno->nombres = $request->nombres;
        $nuevoAlumno->apellidos = $request->apellidos;
        $nuevoAlumno->edad = $request->edad;
        $nuevoAlumno->numero_identidad = $request->identidad;
        $nuevoAlumno->telefono = $request->telefono;
        $nuevoAlumno->direccion = $request->direccion;
        $nuevoAlumno->nombre_padre = $request->nombre_padre;
        $nuevoAlumno->nombre_madre = $request->nombre_madre;
        $nuevoAlumno->save();

        return redirect()->route('alumno.index')->with('mensaje', 'El Alumno fue modificado exitosamente');
    }
}
