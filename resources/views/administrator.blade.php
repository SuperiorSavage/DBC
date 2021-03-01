@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-2" style="margin-top: 4%;"></div>
		<div class="col-md-8" style="margin-top: 4%;">
			<div id="logo" class="text-center">
				<img src="https://aluxiluminacion.com/images_mayoristas/35.png" width="220" height="70"
					class="d-inline-block align-top" alt="" loading="lazy">
				<h1>Base De datos del conocimiento</h1>
				<h3>Bienvenido {{Auth::user()->usuario}}</h3>
			</div>
		</div>
		<div class="col-md-2" style="margin-top: 4%;"><a href="/" type="submit" class="btn btn-primary">Regresar</a></div>
	</div>

	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<nav>
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					<a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
						aria-controls="nav-home" aria-selected="true">Cambiar contraseña</a>
					<a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
						aria-controls="nav-profile" aria-selected="false">documentos</a>
					<a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
						aria-controls="nav-contact" aria-selected="false">Informacion del usuario</a>
				</div>
			</nav>
			<div class="tab-content" id="nav-tabContent">


				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
					<form action="/updatepass/{{Auth::user()->usuario_id}}" method="post" style="margin-top: 4%;" id="up-pass">
						<div class="form-group">
							<h4>Actualizar contraseña</h4>
							<label for="exampleInputEmail1">Nueva contraseña</label>
							<input name="password" type="password" class="form-control" id="password">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Repita contraseña</label>
							<input name="confirmpassword" type="password" class="form-control" id="confirmpassword">
						</div>
						<button disabled id="btnpass" type="submit" class="btn btn-primary">Actualizar contraseña</button>
						<!-- <div class="registrationFormAlert" style="color:green;" id="CheckPasswordMatch"> -->
					</form>
				</div>

				<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
					<form style="margin-top: 4%;">
						<div class="form-group">
							<h4>Subir Documentos</h4>
							<label for="exampleInputEmail1">Nombre del documento</label>
							<input type="text" class="form-control" id="exampleInputPassword1">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Documento</label>
							<input type="file" class="form-control-file" id="exampleFormControlFile1">
						</div>
						<div class="form-group">
							<label for="Departamentos">Departamento</label>
							<select class="form-control" id="Departamentos">
								<option selected disabled >seleccione una opcion</option>

								@isset($departamentos)
								@if(count($departamentos))
								@foreach($departamentos as $departamento)
								<option value="{{$departamento->departamento_id}}" >{{$departamento->nombre}}</option>
								@endforeach
								@else
								<option>sin opciones</option>
								@endif
								@endisset

							</select>
						</div>

						<div class="form-group">
							<label for="Subdepartamentos">Subdepartamento</label>
							<select class="form-control" id="Subdepartamentos">
							<option selected disabled >seleccione una opcion</option>
								@isset($subdepartamentos)
								@if(count($subdepartamentos))
								@foreach($subdepartamentos as $subdepartamento)
								<option value="{{$subdepartamento->departamento_id}}" >{{$subdepartamento->nombre}}</option>
								@endforeach
								@else
								<option>sin opciones</option>
								@endif
								@endisset
							</select>
						</div>
						<button type="submit" class="btn btn-primary">Subir documento</button>
					</form>
				</div>


				<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
					<form action="/upname/{{Auth::user()->usuario_id}}" method="post" style="margin-top: 4%;">
						<div class="form-group">
							<h4>Actualizar informacion del usuario</h4>
							<label for="exampleInputEmail1">Nombre completo</label>
							<input type="text" class="form-control" id="usuario" name="usuario" value="{{Auth::user()->usuario}}">
						</div>
						<div class="form-group">
							<label for="exampleFormControlSelect1">Departamento Actual</label>
							<select class="form-control" id="departamento_id" name="departamento_id">
								<option value="{{Auth::user()->departamento_id}}" selected disabled >seleccione una opcion</option>

								@isset($departamentos)
								@if(count($departamentos))
								@foreach($departamentos as $departamento)
								<option value="{{$departamento->departamento_id}}" >{{$departamento->nombre}}</option>
								@endforeach
								@else
								<option>sin opciones</option>
								@endif
								@endisset

							</select>
						</div>
						<button type="submit" class="btn btn-primary">Actualizar Usuario</button>
					</form>
				</div>


			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>
<script type="text/javascript">
	// $('#confirmpassword').on('change' , function() 
	// {
	// 	var password  =  $('#password').val();
	// 	var confirmpassword = $('#confirmpassword').val();
	// 	if(password == confirmpassword)
	// 	{
	// 		$("#btnpass").prop('disabled', false);
	// 	}
	// 	else 
	// 	$("#btnpass").html("<button disabled  class='btn btn-danger'>las contrseñas no coinciden</button>");
		
	// });

	// $("#up-pass").validate({
	// 	rules: {
  //         password: { 
  //               required: true, minlength: 5
  //         }, 
  //         confirmpassword: { 
  //               required: true, equalTo: "#password", minlength: 5
  //         }, 
  //       },
  //       messages: {
  //        description: "Please enter a short description.",
  //        gender: "Please select your gender."

  //       }
  //     });

	function checkPasswordMatch() {
        var password = $("#password").val();
        var confirmPassword = $("#confirmpassword").val();
        if (password != confirmPassword)
            // $("#CheckPasswordMatch").html("Passwords does not match!");
						$("#btnpass").prop('disabled', true);
        else
            // $("#CheckPasswordMatch").html("Passwords match.");
						$("#btnpass").prop('disabled', false);
    }
    $(document).ready(function () {
       $("#confirmpassword").keyup(checkPasswordMatch);
    });
    </script>
	</script>
@endsection