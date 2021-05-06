<?

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\SessionAuth;
use App\Library\Fighters;
use App\Library\ScoreSystem;

use App\Http\Controllers\Controller;

class ScoreController extends Controller {
	private $auth;
	private $fighters;
	private $scoresystem;
	
	public function MyScores( Request $request ) {
		if( !$this->auth->IsLoggedIn() )
			return redirect('/login')->with('errormsg','Please login to view your own scores');
		$userid = $this->auth->GetUserid();
		
		return UserScores( $request, $userid );
	}
	
	public function UserScores( Request $request, $userid ) {
		$scores = $this->scoresystem->GetUserScores( $userid );
		return view('userscore',['scores'=>$scores,'personname'=>$this->auth->GetUsername($userid)]);
	}
	
	public function HighScores( Request $request ) {
		$scores = $this->scoresystem->GetHighScores();
		return view('highscores',['scores'=>$scores]);
	}
	
	public function FightScores( Request $request, $fightid ) {
		$fighter = $this->fighters->GetFight( $fightid );
		if( $fighter === null )
			return redirect('/score')->with('errormsg','Invalid fighter id for fight high scores');
		$scores = $this->scoresystem->GetFightScores( $fightid );
		
		return view('fightscores',['scores'=>$scores,'fighter'=>$fighter]);
	}
	
	public function __construct() {
		$this->auth = SessionAuth::Instance();
		$this->fighters = Fighters::Instance();
		$this->scoresystem = ScoreSystem::Instance();
	}
}