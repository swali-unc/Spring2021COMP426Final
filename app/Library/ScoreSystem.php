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
	
	public function __construct() {
		
	}
	
	private static $_instance = null;
	
	public static function Instance() {
		if (self::$_instance == null)
			self::$_instance = new ScoreSystem();
		return self::$_instance;
	}
}