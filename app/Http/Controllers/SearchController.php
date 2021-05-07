<?

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Controllers\Controller;

class SearchController extends Controller {
	private $respData = ['success' => true];
	
	public function SearchHints( Request $request ) {
		$searchterm = trim( $request->input('term') );
		if( $searchterm === null || $searchterm === '' ) {
			$this->Error('Invalid term');
			return response()->json( $this->respData );
		}
		
		$rows = DB::table('users')
			->select('username')
			->where('username','LIKE',"%{$searchterm}%")
			->get();
		
		$jsResults = [];
		foreach( $rows as $row )
			$jsResults[] = $row->username;
		return response()->json( $jsResults );
	}
	
	public function SearchResults( Request $request ) {
		$this->validate( $request, [
			'searchname' => 'required|min:3|max:50|alpha_num'
		]);
		
		$searchterm = trim( $request->input('searchname') );
		$rows = DB::table('users')
			->select('id', 'username')
			->where('username','LIKE',"%{$searchterm}%")
			->get();
		
		return view('searchresults',['rows'=>$rows,'term'=>$searchterm]);
	}
	
	public function __construct() {
		
	}
	
	private function Param( $name, $value )
	{
		$this->respData[$name] = $value;
	}
	
	private function Error( $errMessage )
	{
		$this->respData['ErrorMessage'] = $errMessage;
		$this->respData['success'] = false;
	}
}