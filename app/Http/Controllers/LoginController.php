<?

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\SessionAuth;

class LoginController {
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
			return view('login',['loginerror'=>$authresult]);
		list( $cookiename, $token ) = $this->auth->CreateSession( $authresult );
		return redirect( '/' )
			->withCookie( $cookiename, $token, 20160 );
	}
	
	public function __construct() {
		$this->auth = SessionAuth::Instance();
	}
}