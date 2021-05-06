<?

namespace App\Library;

use DB;

class ScoreSystem {
	public function RecordGame( $userid, $fightid, $score ) {
		DB::table('scores')
			->insert([
				'userid' => $userid,
				'fightid' => $fightid,
				'score' => $score,
				'createdate' => now()
			]);
	}
	
	public function GetUserScores( $userid ) {
		return DB::table('scores')
			->where('userid',$userid)
			->orderBy('createdate','desc')
			->get();
	}
	
	public function GetHighScores() {
		return DB::table('scores')
			->join('users','users.id','=','scores.userid')
			->select('users.id as userid','users.username',DB::raw('SUM(scores.score) as totalscore'))
			->groupBy('userid')
			->orderBy('totalscore','desc')
			->get();
	}
	
	public function GetFightScores( $fightid ) {
		return DB::table('scores')
			->join('users','users.id','=','scores.userid')
			->where('scores.fightid',$fightid)
			->select('users.id as userid','users.username',DB::raw('SUM(scores.score) as totalscore'))
			->groupBy('userid')
			->orderBy('totalscore','desc')
			->get();
	}
	
	public function __construct() {
		
	}
	
	private static $_instance = null;
	
	public static function Instance() {
		if (self::$_instance == null)
			self::$_instance = new ScoreSystem();
		return self::$_instance;
	}
}