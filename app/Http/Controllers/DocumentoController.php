<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documento;
use DB;
class DocumentoController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        
        $documento = Documento::create($data);
        
		return [
			'status'  => 201,
			'message' => 'Documento registrada con éxito',
			'data'    => compact('documento')
		];

    }

		public function search($busqueda)
    {


					// $cita = Patient::with(['user','dates' => function ($query)
					// {
					// 		$query->where('finished',1)->where('canceled',null);
					// 		$query->with('evaluations.fotos');
					// }])->find($id);


		// 	$checados = Documento::with('')
		// 	->join('documentos', 'departamentos.departamento_id', '=', 'documentos.departamento_id')
		// 	->where('checked', null)
		// 	->where('canceled', null)->Where('patient_id', $patient['patient_id'])->count();

		$data = DB::table('departamentos as d')
		->join('documentos as c', 'd.departamento_id', '=', 'c.departamento_id')
		->leftJoin('subdepartamentos as s','c.subdepartamento_id','=','s.subdepartamento_id')
		->select('c.nombre as doc_name','c.ruta','c.created_at', 'd.nombre as dep_name','s.nombre as sub_name')
		->Where('c.nombre', 'like', '%' . $busqueda . '%')
		->orWhere('c.ruta', 'like', '%' . $busqueda . '%')
		->orWhere('d.nombre', 'like', '%' . $busqueda . '%')
		->orWhere('s.nombre', 'like', '%' . $busqueda . '%')
		->get();
       
        
		return [
			'status'  => 201,
			'message' => 'Documento registrada con éxito',
			'data'    => compact('data')
		];

    }

	public function open() 
	{
		$data = "This data is open and can be accessed without the client being authenticated";
		return response()->json(compact('data'),200);

	}

	public function closed() 
	{
		$data = "Only authorized users can see this";
		return response()->json(compact('data'),200);
	}
}
