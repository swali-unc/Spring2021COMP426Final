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
			return view('ingame',['gs'=>$gs]);
		}
		
		return view('fightselect',['fighters'=>$this->fighters->GetFights()]);
	}
	
	public function CreateFight( Request $request, $fightid ) {
		if( !$this->auth->IsLoggedIn() )
			return redirect('/login')->with('errormsg','Please login to play');
		
		$fightdata = $this->fighters->GetFight( $fightid );
		if( $fightdata == null )
			return back();
		
		$gs = new GameState();
		if( $gs->IsInGame() )
			return back();
		
		if( !$gs->CreateGame( $fightid ) )
			return back();
		
		// 50-50 chance for opponent to go first as AI
		if( mt_rand(0,1) == 1 )
			$gs->MakeAIMove();
		
		return redirect('/play');
	}
	
	public function Move( Request $request, $mvindex ) {
		if( !$this->auth->IsLoggedIn() )
			return redirect('/login')->with('errormsg','Please login to play');
		$gs = new GameState();
		if( !$gs->IsInGame() )
			return redirect('/play');
	
		$result = $gs->MakeMove( $mvindex, 1 );
		$gs->IsGameCompleted();
		
		return $this->Status( $request );
	}
	
	public function Status( Request $request ) {
		if( !$this->auth->IsLoggedIn() )
			return redirect('/login')->with('errormsg','Please login to play');
		$gs = new GameState();
		
		return json_encode([
			'inprogress' => $gs->IsInProgress(),
			'won' => $gs->IsWon(),
			'lost' => $gs->IsLost(),
			'draw' => $gs->IsDraw(),
			'fightid' => $gs->GetFight(),
			'fight' => $this->fighters->GetFight( $gs->GetFight() ),
			'gamestate' => $gs->GetGameRow()
		]);
	}
	
	public function FinishGame( Request $request ) {
		if( !$this->auth->IsLoggedIn() )
			return redirect('/login')->with('errormsg','Please login to play');
		$gs = new GameState();
		return json_encode(['finish'=>$gs->CompleteGame()]);
	}
	
	public function __construct() {
		$this->auth = SessionAuth::Instance();
		$this->fighters = Fighters::Instance();
	}
}