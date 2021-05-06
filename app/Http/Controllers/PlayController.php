<?

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\SessionAuth;

use App\Http\Controllers\Controller;

class PlayController extends Controller {
	private $auth;
	
	public function Home( Request $request ) {
		if( !$this->auth->IsLoggedIn() )
			return redirect('/login')->with('errormsg','Please login to play');
	}
	
	public function __construct() {
		$this->auth = SessionAuth::Instance();
	}
}