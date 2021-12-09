<?php

namespace App\Http\Controllers;

use App\Models\Maestro;
use Illuminate\Http\Request;

class MaestroController extends Controller
{
    public function index()
    {
        $maestros  = Maestro::paginate(10);
        return view('Maestros')->with('maestros', $maestros);
    }

    public function crear()
    {
        return view('crearMaestros');
    }


    public function mostrar($id)
    {
        $em = Maestro::findOrFail($id);
        return view('ver')->with('maestro', $em);
    }



    public function guardar(Request $request)
    {
        $nuevoMaestro = new Maestro();
        $nuevoMaestro->nombres = $request->nombres;
        $nuevoMaestro->apellidos = $request->apellidos;
        $nuevoMaestro->numero_identidad = $request->numero_identidad;
        $nuevoMaestro->fecha_nac = $request->fecha_nac;
        $nuevoMaestro->telefono = $request->telefono;
        $nuevoMaestro->direccion = $request->direccion;
        $nuevoMaestro->especialidad = $request->especialidad;

        $nuevoMaestro->save();
        return redirect()->route('maestro.index')->with('mensaje', 'El Maestro fue registrado exitosamente');
    }



    public function buscar(Request $request)
    {
        $maestros =  Maestro::where('nombres', 'like', '%' . $request->texto_buscar . '%')->paginate(10);
        return view('Maestros')->with('maestros', $maestros);
    }

    public function eliminar($id)
    {
        Maestro::destroy($id);
        return redirect()->route('maestro.index')->with('mensaje', 'Eliminado con exito.');
    }



    public function editar($id)
    {
        $em = Maestro::findOrFail($id);
        return view('modificarMaestros')->with('maestro', $em);
    }





    public function actualizar(Request $request, $id)
    {
        $nuevoMaestro = Maestro::findOrFail($id);
        $nuevoMaestro->nombres = $request->nombres;
        $nuevoMaestro->apellidos = $request->apellidos;
        $nuevoMaestro->numero_identidad = $request->numero_identidad;
        $nuevoMaestro->fecha_nac = $request->fecha_nac;
        $nuevoMaestro->telefono = $request->telefono;
        $nuevoMaestro->direccion = $request->direccion;
        $nuevoMaestro->especialidad = $request->especialidad;

        $nuevoMaestro->save();


        return redirect()->route('maestro.index')->with('mensaje', 'El Maestro fue modificado exitosamente');
    }
}
