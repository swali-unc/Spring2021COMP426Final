<?

namespace App\Library;

use DB;
use Illuminate\Http\Request;
use App\Library\Utilities;

class SessionAuth {
	private $cookiename = 'LoginToken';
	private $userid = null;
	private $username = null;
	private $logintoken = null;
	private $isLoggedIn = false;
	private $tokenlength = 20;
	private $sessionid = null;
	
	public function CheckCredentials( $username, $password ) {
		$row = $this->GetUserRow( $username );
		if( $row === false ) return [false,'Username not found'];
		if( !password_verify( $password, $row->passhash ) ) return [false,'Invalid password'];
		
		return [true,$row->id];
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
			->select('users.*', 'sessions.id as sessionid')
			->where('sessions.tokenid',$tokenid)
			->limit(1)
			->get();
		if( count( $rows ) === 0 ) return false;
		
		$row = $rows[0];
		$this->username = $row->username;
		$this->logintoken = $tokenid;
		$this->isLoggedIn = true;
		$this->userid = $row->id;
		$this->sessionid = $row->sessionid;
		
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
		
		return [$this->cookiename,$token];
	}
	
	public function CloseSession() {
		if( $this->sessionid === null ) return false;
		
		DB::table('sessions')
			->where('id',$this->sessionid)
			->limit(1)
			->delete();
	}
	
	public function CreateUser( $username, $password ) {
		$passhash = password_hash( $password, PASSWORD_DEFAULT );
		$userrow = $this->GetUserRow( $username );
		
		if( $userrow !== false )
			return false;
		
		DB::table('users')->insert(['username'=>$username,'passhash'=>$passhash]);
		return true;
	}
	
	public function RemoveSessionCookie() {
		\Cookie::queue( \Cookie::forget( $this->cookiename ) );
	}
	
	public function IsLoggedIn() {
		return $this->isLoggedIn;
	}
	
	public function GetUsername() {
		return $this->username;
	}
	
	public function GetUsername( $userid ) {
		if( $this->userid == $userid )
			return $this->username;
		$rows = DB::table('users')
			->select('username')
			->where('id',$userid)
			->limit(1)
			->get();
		return count($rows) == 0 ? null : $rows[0]->username;
	}
	
	public function GetUserid() {
		return $this->userid;
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