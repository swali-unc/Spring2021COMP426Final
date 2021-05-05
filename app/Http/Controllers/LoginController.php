<?

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\SessionAuth;

use App\Http\Controllers\Controller;

class LoginController extends Controller {
	private $auth;
	
	public function LoginPage( Request $request ) {
		if( $this->auth->IsLoggedIn() )
			return redirect('/');
		return view('login');
	}
	
	public function RegisterPage( Request $request ) {
		if( $this->auth->IsLoggedIn() )
			return redirect('/');
		return view('register');
	}
	
	public function CreateUser( Request $request ) {
		$this->validate( $request, [
				'username' => 'required|alpha|max:50|min:3',
				'password' => 'required|max:50|min:3',
		]);
		
		$username = $request->input( 'username' );
		$password = $request->input( 'password' );
		
		$result = $this->auth->CreateUser( $username, $password );
		return $result ? redirect('/login')->with('errormsg','Account created, please log in') : view('register',['errormsg'=>'Username not allowed or already taken']);
	}
	
	public function LogoutPage( Request $request ) {
		$this->auth->CloseSession();
		$this->auth->RemoveSessionCookie();
		return redirect('/');
	}
	
	public function AttemptLogin( Request $request ) {
		$this->validate( $request, [
			'username' => 'required',
			'password' => 'required',
		]);
		
		$username = $request->input( 'username' );
		$password = $request->input( 'password' );
		
		list( $success, $authresult ) = $this->auth->CheckCredentials( $username, $password );
		
		if( $success !== true )
			return view('login',['errormsg'=>$authresult]);
		list( $cookiename, $token ) = $this->auth->CreateSession( $authresult );
		return redirect( '/' )
			->withCookie( $cookiename, $token, 20160 );
	}
	
	public function __construct() {
		$this->auth = SessionAuth::Instance();
	}
}