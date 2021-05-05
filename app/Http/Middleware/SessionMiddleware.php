<?

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Library\SessionAuth;
use Illuminate\Support\Facades\View;

class SessionMiddleware {
	protected $auth;
	
	public function handle( Request $request, Closure $next ) {
		if( $this->auth->CheckSessionWithRequest( $request ) ) {
			View::share('IsLoggedIn', true );
			View::share('username', $this->auth->GetUsername() );
			View::share('userid', $this->auth->GetUserid() );
		} else {
			View::share('IsLoggedIn', false );
		}
		
		return $next( $request );
	}
	
	public function __construct() {
		$this->auth = SessionAuth::Instance();
	}
}