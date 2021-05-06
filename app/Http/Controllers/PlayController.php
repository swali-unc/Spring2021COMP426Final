<?

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\SessionAuth;
use App\Library\GameState;
use App\Library\Fighters;

use App\Http\Controllers\Controller;

class PlayController extends Controller {
	private $auth;
	private $fighters;
	
	public function Home( Request $request ) {
		if( !$this->auth->IsLoggedIn() )
			return redirect('/login')->with('errormsg','Please login to play');
		$gs = new GameState();
		
		if( $gs->IsInGame() ) {
			// TODO: in-game
			return view('ingame',['gs'=>$gs]);
		}
		
		return view('fightselect',['fighters'=>$this->fighters]);
	}
	
	public function __construct() {
		$this->auth = SessionAuth::Instance();
		$this->fighters = Fighters::Instance();
	}
}