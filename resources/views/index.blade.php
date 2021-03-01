@extends('layouts.app')
@section('content')
<div class="container-well">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8 " style="margin-top: 2%;">
			<div class="row">
				<div id="logo" class="text-center">
					<img src="https://aluxiluminacion.com/images_mayoristas/35.png" width="220" height="70"
						class="d-inline-block align-top" alt="" loading="lazy">
					<h1>Base De datos del conocimiento</h1>
				</div>
			</div>
			<div class="row">
				@if($error == 1)
				<div class="col-12 mb-5">
					<div class="alert alert-danger" role="alert">
						Credenciales incorrectas
					</div>
				</div>
				@else
				<div class="col-12 mb-5">
				
				</div>
				@endif

				<form role="form" id="form-buscar" style="margin: 0 auto;">
					<div class="form-group">
						<div class="input-group">
							<input id="busqueda" class="form-control" type="text" name="search" placeholder="Buscar..." required />
							<span class="input-group-btn">
								<button class="btn btn-primary" id="buscar">
									<i class="glyphicon glyphicon-search" aria-hidden="true"></i> Buscar
								</button>
							</span>
						</div>
					</div>
				</form>

			</div>

			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<div class="row">

						@isset($departamentos)
						@if(count($departamentos))
						@foreach($departamentos as $departamento)

						<div class="col-md-4 col-4 col-xl-4">
							<div class="card">
								<div class="card-body" style="width: 15rem; height:8rem;">
									<h5 class="card-title">{{$departamento->nombre}}</h5>

									<div class="dropdown">
										<a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
											data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Más</a>

										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											@if(count($departamento->subdepartamentos))
											@foreach($departamento->subdepartamentos as $subdepartamento)
											<a class="dropdown-item"
												href="/subdepartamento/{{$subdepartamento->subdepartamento_id}}">{{$subdepartamento->nombre}}</a>
											@endforeach
											@else
											<a class="dropdown-item" href="#">Sin Datos</a>
											@endif
										</div>
										<div class="btn-group">
											<a href="/departamento/{{$departamento->departamento_id}}" type="button"
												class="btn btn-success">Documentos</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
						@else
						<div class="col-12 mb-5">
							<div class="card card-view">
								<div class="card-body">
									<p class="page-subtitle text-center">No hay Departamentos</p>
								</div>
							</div>
						</div>
						@endif
						@endisset

					</div>
				</div>
				<div class="col-md-1"></div>
				<div class="class col-md-1">

				</div>
				<div class="class col-md-10">

					<table class="table hide" id="records_table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Departamento del documento</th>
								<th scope="col">Nombre del Archivo</th>
								<th scope="col">Archivo</th>
								<th scope="col">Fecha de publicacion</th>
							</tr>
						</thead>


					</table>

					<div class="hide" id="imageqr2"></div>

				</div>
				<div class="class col-md-1">

				</div>
			</div>

		</div>
		<div class="col-md-2" style="margin-top: 2%;">
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
				Administrar
			</button>

			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Acceso al administrador</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
















							<form action="/login" method="POST">
								@csrf
								<div class="form-group">
									<label for="exampleInputEmail1">Usuario</label>
									<input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">

								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Contraseña</label>
									<input type="password" class="form-control" id="password" name="password">
								</div>
								<!-- <a href="#" type="submit" class="btn btn-primary" >Entrar</a> -->
								<button type="submit" class="btn btn-primary">Entrar</button>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>


</div>
<script data-require="jquery@2.0.3" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script>
	$("#buscar").click(function (e) {
		e.preventDefault();
		var data = "";
		var busqueda = $("#busqueda").val();


		// $.get('{{url("/userdata")}}' + '/' + postcode + '/' + email, function(data, status){});
		$.ajax({
			type: 'GET',
			url: '{{url("/busqueda")}}' + '/' + busqueda,
			dataType: 'json',
			success: function (response) {

				var trHTML = '';


				console.log('nadita', response.data.data.length)
				if (response.data.data.length === 0) {
					console.log('nadita', response.data.data)
					$("#imageqr2").html("<div class='col-12 mb-5'><div class='card card-view'><div class='card-body'><p class='page-subtitle text-center'>No hay Documentos relacionados con la busqueda</p></div></div></div>");
					$("#imageqr2").removeClass('hide');
				}
				else {
					var ggggggg = '';
					console.log('varvar', trHTML);
					$('#records_table').append(ggggggg);
					$.each(response.data.data, function (i, item) {
						trHTML += '<tr><td>' + item.dep_name + '</td><td>' + item.doc_name + '</td><td> <a style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" href=' + item.ruta + '>' + item.doc_name + '</a></td><td>' + item.created_at + '</td></tr>';
					});
					$('#records_table').append(trHTML);
					$('#records_table').removeClass('hide');
				}



			},
			error: function () {
				alert('Error occured');
			}
		});

	});
</script>
@endsection