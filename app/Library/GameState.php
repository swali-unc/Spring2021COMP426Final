<?

namespace App\Library;

use DB;
use App\Library\SessionAuth;

class GameState {
	private $playerid;
	private $gamerow;
	
	public function IsInGame() {
		return $this->gamerow !== null;
	}
	
	public function GetGameRow() {
		return $this->gamerow;
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
			$gamerow = null;
			return;
		}
		
		$this->gamerow = $rows[0];
	}
}