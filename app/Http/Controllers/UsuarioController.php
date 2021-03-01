<?php

namespace App\Http\Controllers;
use App\Usuario;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Departamento;
use App\Documento;

class UsuarioController extends Controller
{







  //   public function storeUser(Request $request)
	// {
	// 	// return $request;
	// 	$data = $request->all();
	// 	$user = Usuario::where('usuario', $data['usuario'])->first();

	// 	if ($user) {
	// 		return [
	// 			'status' => 400,
	// 			'message'=>'El usuario ya existe'
	// 		];
	// 	}

	// 	$user = new Usuario();
	// 	$user->usuario                 = $data['usuario'];
	// 	$user->contraseña              = Hash::make($data['contraseña']);
	// 	$user->token                 = sha1(Carbon::now()->timestamp);
	// 	$user->departamento_id    		=$data['departamento_id'];
	// 	// try { $user->type            = $data['type']; } catch (\Throwable $th) {}
	// 	$user->save();

	// 	$token = JWTAuth::fromUser($user);

	// 	return [
	// 		'status'  => 201,
	// 		'message' => 'usuario creado con éxito',
	// 		'data'    => compact('user', 'token')
	// 	];
  //   }




			public function authenticate(Request $request)
					{
							// $credentials = $request->only('email', 'password');

							// try {
							// 		if (! $token = JWTAuth::attempt($credentials)) {
							// 				return response()->json(['error' => 'invalid_credentials'], 400);
							// 		}
							// } catch (JWTException $e) {
							// 		return response()->json(['error' => 'could_not_create_token'], 500);
							// }
							

							// return response()->json(compact('token'));



							$credentials = $request->only('email', 'password');
							$usuario	= Usuario::where($credentials['email'],'=','email');
							$user = Auth::user();
							if (Auth::attempt($credentials)) {
								// return route('administrador');
									return redirect('/admin');
							}
							else
							$error = 1;
								$departamentos = Departamento::with('subdepartamentos')->get();
								return view("index")
								->with('departamentos', $departamentos)
								->with('error',$error);
							// return redirect('/')->compact('error');
							
					}

			public function storeUser(Request $request)
					{

							$user = Usuario::create([
									'email' => $request->get('email'),
									'password' => Hash::make($request->get('password')),
									'token'			=> sha1(Carbon::now()->timestamp),          
									'departamento_id'   =>$request->get('departamento_id'),
							]);

							$token = JWTAuth::fromUser($user);

							return response()->json(compact('user','token'),201);
					}

			public function getAuthenticatedUser()
					{
									try {

													if (! $user = JWTAuth::parseToken()->authenticate()) {
																	return response()->json(['user_not_found'], 404);
													}

									} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

													return response()->json(['token_expired'], $e->getStatusCode());

									} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

													return response()->json(['token_invalid'], $e->getStatusCode());

									} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

													return response()->json(['token_absent'], $e->getStatusCode());

									}
									return redirect('/admin')->compact('user');
									// return response()->json(compact('user'));
					}


			public function updatename(Request $request,$id)
					{
						{
							$data = $request->all();
		
						$user                       = Usuario::find($id);
		
						$user->usuario                = $data['usuario'];
						$user->departamento_id				=$data['departamento_id'];
		
						$user->save();
						return redirect('/admin');
					
		
						}
					}


			public function updatepass(Request $request,$id)
					{
						{
							$data = $request->all();
		
						$user                       = Usuario::find($id);
		
						$user->password             = Hash::make($data['password']);
		
						$user->save();
						return redirect('/admin');
					
		
						}
					}









	
}
