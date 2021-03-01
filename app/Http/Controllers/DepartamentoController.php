<?php

namespace App\Http\Controllers;
use App\Departamento;
use App\Subdepartamento;
use App\Documento;

use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function store(Request $request)
    {
            $data = $request->all();
        // return $data;
        $data = $request->all();
        $departamento                = new Departamento();
        $departamento->nombre  = $data['nombre'];
		$departamento->save();

		return [
			'status'  => 201,
			'message' => 'departamento registrado con éxito',
			'data'    => compact('departamento')
		];
    }

    public function Showdpto() {
       

        $departamentos = Departamento::with('subdepartamentos')->get();
  
        return [
            'status' => 200,
            'message'=>'Lista de departamentos',
            'data' => compact('departamentos'),
        ];
     }

     public function index() {
        $error = 0;
        $departamentos = Departamento::with('subdepartamentos')->get();
        return view("index")
        ->with('departamentos', $departamentos)
        ->with('error',$error);
  
        // return [
        //     'status' => 200,
        //     'message'=>'Lista de departamentos',
        //     'data' => compact('departamentos'),
        // ];
     }

     public function admin() {

        $departamentos = Departamento::with('subdepartamentos')->get();
        $subdepartamentos = Subdepartamento::all();
        return view("administrator")
        ->with('departamentos', $departamentos)
        ->with('subdepartamentos', $subdepartamentos);

  
     }

     public function showdep(Departamento $departamento)
    {

			 $documentos = Documento::where('departamento_id', $departamento->departamento_id)->where('subdepartamento_id',0)->get();
            
				return view("documentos")
				->with('documentos', $documentos)
				->with('departamento', $departamento);
    }
}
