<?

namespace App\Library;

use DB;
use App\Library\SessionAuth;
use App\Library\ScoreSystem;

class GameState {
	private $playerid = null;
	private $gameid = null;
	private $gamerow = null;
	private $indexes = ['tl','tr','tm','cl','cm','cr','bl','bm','br'];
	private $winner = null; // -1 for enemy, 0 for none, 1 for player, 2 for draw
	private $fightid = null;
	
	public function IsInGame() {
		return $this->gamerow !== null;
	}
	
	public function GetGameRow() {
		return $this->gamerow;
	}
	
	public function MakeMove( $index, $value, $gameid = null ) {
		if( $gameid === null ) $gameid = $this->gameid;
		if( !$this->IsValidIndex( $index ) ) return false;
		if( !$this->IsValidValue( $value ) ) return false;
		DB::table('games')
			->where('id',$gameid)
			->update([$index => $value]);
		$this->gamerow->$index = $value;
		$this->IsGameCompleted();
		return true;
	}
	
	public function MakeAIMove( $gameid = null ) {
		if( $gameid === null ) $gameid = $this->gameid;
		$freeIndices = [];
		foreach( $this->indexes as $idx ) {
			if( $this->gamerow->$idx == 0 )
				$freeIndices[] = $idx;
		}
		
		$numMoves = count( $freeIndices );
		if( $numMoves === 0 )
			return false;
		
		$moveIdx = mt_rand( 0, $numMoves - 1 );
		return $this->MakeMove( $freeIndices[$moveIdx], -1 );
	}
	
	public function IsMoveValid( $index ) {
		return $this->IsValidIndex( $index ) && $this->gamerow->$index == 0;
	}
	
	public function IsDraw() {
		return $this->winner == 2;
	}
	
	public function IsWon() {
		return $this->winner == 1;
	}
	
	public function IsLost() {
		return $this->winner == -1;
	}
	
	public function IsInProgress() {
		return $this->winner == 0;
	}
	
	public function IsGameCompleted() {
		// check for 3 in cols, rows, or diagonals
		// this is ugly, but whatever, tic tac toe doesn't need to scale, and if it does,
		// this can be easily rewritten with arrays
		if( $this->gamerow->tl == $this->gamerow->tm && $this->gamerow->tm == $this->gamerow->tr && $this->gamerow->tr != 0 ) {
			$this->winner = $this->gamerow->tl;
			return true;
		}
		if( $this->gamerow->cl == $this->gamerow->cm && $this->gamerow->cm == $this->gamerow->cr && $this->gamerow->cr != 0 ) {
			$this->winner = $this->gamerow->cl;
			return true;
		}
		if( $this->gamerow->bl == $this->gamerow->bm && $this->gamerow->bm == $this->gamerow->br && $this->gamerow->br != 0 ) {
			$this->winner = $this->gamerow->bl;
			return true;
		}
		//col
		if( $this->gamerow->tl == $this->gamerow->cl && $this->gamerow->cl == $this->gamerow->bl && $this->gamerow->cl != 0 ) {
			$this->winner = $this->gamerow->tl;
			return true;
		}
		if( $this->gamerow->tm == $this->gamerow->cm && $this->gamerow->cm == $this->gamerow->bm && $this->gamerow->bm != 0 ) {
			$this->winner = $this->gamerow->cm;
			return true;
		}
		if( $this->gamerow->tr == $this->gamerow->cr && $this->gamerow->cr == $this->gamerow->br && $this->gamerow->br != 0 ) {
			$this->winner = $this->gamerow->br;
			return true;
		}
		//diag
		if( $this->gamerow->tl == $this->gamerow->cm && $this->gamerow->cm == $this->gamerow->br && $this->gamerow->br != 0 ) {
			$this->winner = $this->gamerow->br;
			return true;
		}
		if( $this->gamerow->tr == $this->gamerow->cm && $this->gamerow->cm == $this->gamerow->bl && $this->gamerow->bl != 0 ) {
			$this->winner = $this->gamerow->bl;
			return true;
		}
		
		foreach( $this->indexes as $i ) {
			if( $this->gamerow->$i == 0 )
				return false;
		}
		
		$this->winner = 2;
		return true;
	}
	
	public function CompleteGame() {
		if( $this->winner == 0 ) return false;
		$score = $this->winner == -1 ? 0 : ($this->winner == 2 ? mt_rand(1,9) : mt_rand(10,50));
		ScoreSystem::Instance()->RecordGame( $this->playerid, $this->fightid, $score );
		
		DB::table('games')
			->where('id',$this->gameid)
			->delete();
		return true;
	}
	
	public function CreateGame( $fightid ) {
		if( $this->IsInGame() ) return false;
		$id = DB::table('games')
			->insertGetId([
				'userid' => $this->playerid,
				'fightid' => $fightid
			]);
		$this->gameid = $id;
		$this->fightid = $fightid;
		$this->winner = 0;
		$this->gamerow = new \stdClass();
		$this->gamerow->id = $id;
		$this->gamerow->fightid = $fightid;
		$this->gamerow->userid = $this->playerid;
		foreach( $this->indexes as $idx )
			$this->gamerow->$idx = 0;
		return $id;
	}
	
	private function IsValidIndex( $index ) {
		return in_array( $index, $this->indexes, true );
	}
	
	private function IsValidValue( $value ) {
		return in_array( $value, [1,0,-1], true );
	}
	
	public function GetFight() {
		return $this->fightid;
	}
	
	public function __construct( $playerid = -1 ) {
		if( $playerid == -1 ) {
			$playerid = SessionAuth::Instance()->GetUserid();
			if( $playerid == null )
				throw new Exception('Cannot initailize GameState with an invalid player id');
		}
		
		$this->playerid = $playerid;
		
		$rows = DB::table('games')
			->where('userid',$playerid)
			->limit(1)
			->get();
		
		if( count( $rows ) == 0 ) {
			$this->gamerow = null;
			return;
		}
		
		$this->gamerow = $rows[0];
		$this->gameid = $this->gamerow->id;
		$this->fightid = $this->gamerow->fightid;
		$this->IsGameCompleted();
	}
}