<?

namespace App\Library;

use DB;
use Illuminate\Http\Request;
use App\Library\Utilities;

class SessionAuth {
	private $cookiename = 'LoginToken';
	private $username = null;
	private $logintoken = null;
	private $isLoggedIn = false;
	private $tokenlength = 20;
	
	public function CheckCredentials( $username, $password ) {
		$row = $this->GetUserRow( $username );
		if( $row === false ) return 'Username not found';
		if( !password_verify( $password, $row->passhash ) ) return 'Invalid password';
		
		return true;
	}
	
	public function CheckSessionWithRequest( Request $request ) {
		if( !\Cookie::has( $this->cookiename ) )
			return false;
		
		$token = $request->cookie( $this->cookiename );
		$this->CheckSession( $token );
		return true;
	}
	
	public function CheckSession( $tokenid ) {
		$rows = DB::table('users')
			->join('sessions', 'users.id', '=', 'sessions.userid')
			->select('users.*')
			->where('sessions.tokenid',$tokenid)
			->limit(1)
			->get();
		if( count( $rows ) === 0 ) return false;
		
		$row = $rows[0];
		$this->username = $row['username'];
		$this->logintoken = $tokenid;
		$this->isLoggedIn = true;
		
		return true;
	}
	
	public function CreateSession( $userid ) {
		do {
			$token = Utilities::Instance()->CreateToken( ++$this->tokenlength );
			$sessioninfo = DB::table('sessions')
				->where('tokenid',$token)
				->limit(1)
				->get();
			$isUsed = count( $sessioninfo ) > 0;
		} while( $isUsed == true );
		
		DB::table('sessions')->insert(['tokenid' => $token, 'userid' => $userid]);
		
		return $token;
	}
	
	public function CreateUser( $username, $password ) {
		$passhash = password_hash( $password, PASSWORD_DEFAULT );
		$userrow = $this->GetUserRow( $username );
		
		if( $userrow !== false )
			return false;
		
		DB::table('users')->insert(['username'=>$username,'passhash'=>$passhash]);
		return true;
	}
	
	private function RemoveSessionCookie() {
		\Cookie::queue( \Cookie::forget( $this->cookiename ) );
	}
	
	public function IsLoggedIn() {
		return $this->isLoggedIn;
	}
	
	public function GetUsername() {
		return $this->username;
	}
	
	private function GetUserRow( $username ) {
		$rows = DB::table('users')
				->where('username',$username)
				->limit(1)
				->get();
		
		return count( $rows ) == 0 ? false : $rows[0];
	}
	
	private static $_instance = null;
	
	public static function Instance() {
		if (self::$_instance == null)
			self::$_instance = new SessionAuth ();
		return self::$_instance;
	}
}