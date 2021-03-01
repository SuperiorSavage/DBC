<?php

namespace App\Http\Controllers;
use App\Subdepartamento;
use App\Documento;
use App\Departamento;
use App\DepartamentoSubdepartamento;

use Illuminate\Http\Request;

class SubdepartamentoController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->only('nombre');
        $datadpto = $request->only('departamento_id');

        $subdepartamento = Subdepartamento::create($data);
        $datadpto['subdepartamento_id'] = $subdepartamento->subdepartamento_id;

        $pibote = DepartamentoSubdepartamento::create($datadpto);
	
		return [
			'status'  => 201,
			'message' => 'subcategoria registrada con éxito',
			'data'    => compact('datadpto','subdepartamento')
		];

    }

    public function showSub(Subdepartamento $subdepartamento)
    {
                $departamento = Subdepartamento::with('departamentos')->where('subdepartamentos.subdepartamento_id', $subdepartamento->subdepartamento_id)->first();
                // ->where('subdepartamento_id', $subdepartamento->subdepartamento_id)->first();
			 $documentos = Documento::where('subdepartamento_id', $subdepartamento->subdepartamento_id)->get();
				return view("subdocumentos")
				->with('documentos', $documentos)
				->with('subdepartamento', $subdepartamento)
                ->with('departamento', $departamento);
    }


}
