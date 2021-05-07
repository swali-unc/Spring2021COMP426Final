<?

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Controllers\Controller;

class TwitchController extends Controller {
	public function ViewChess( Request $request ) {
		$url = 'https://api.twitch.tv/helix/search/channels?query=Chess';
		$Authorization = env('TWITCHAPI_OAUTH','');
		$clientid = env('TWITCHAPI_CLIENTID','');
		
		$options = [
			'http' => [
				'header' => "Authorization: {$Authorization}\r\nclient-id: {$clientid}\r\n",
				'method' => 'GET'
			]
		];
		$context = stream_context_create($options);
		$result = file_get_contents( $url, false, $context );
		
		$js = json_decode( $result );
		
		return view('stream',['js'=>$js]);
	}
	
	public function __construct() {
		
	}
}