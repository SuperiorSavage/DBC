@extends('layouts.app')
@section('content')

<body>
	<div class="container" style="margin-top: 5%;">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="row">
					<div id="logo" class="text-center">
						<img src="https://aluxiluminacion.com/images_mayoristas/35.png" width="220" height="70"
							class="d-inline-block align-top" alt="" loading="lazy">
						<h1>{{$departamento->nombre}}</h1>
						<!-- <h1>{{$documentos}}</h1> -->
					</div>
					<br>
					<br>
					<br>
	
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Nombre del Archivo</th>
								<th scope="col">Archivo</th>
								<th scope="col">Fecha de publicacion</th>
							</tr>
						</thead>
	
						<tbody>
	
							@isset($documentos)
							@if(count($documentos))
							@foreach($documentos as $documento)
							<tr>
								<td>{{$documento->nombre}}</td>
								<td>
									<a href="{{$documento->ruta}}">{{$documento->nombre}}</a>
	
								</td>
								<td>{{$documento->created_at}}</td>
							</tr>
							@endforeach
							@else
							<div class="col-12 mb-5">
								<div class="card card-view">
									<div class="card-body">
										<p class="page-subtitle text-center">No hay Documentos</p>
									</div>
								</div>
							</div>
							@endif
							@endisset
	
						</tbody>
					</table>
	
	
	
				</div>
			</div>
			<div class="col-md-2"><a href="/" type="submit" class="btn btn-primary">Regresar al inicio</a></div>
		</div>
		
	</div>
</body>
@endsection