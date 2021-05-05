<?

namespace App\Library;

class Utilities
{

	/**
	 * Generates an alphanumeric randomized token of built-in complexity.
	 * If you ever encounter a non-unique value in your tables, call
	 * NeedMoreUniqueToken function to amp up the length of the token.
	 * 
	 * @return string The token
	 */
	public function CreateToken( $tokenLength )
	{
		$token = '';
		$codeAlphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$codeAlphabet .= 'abcdefghijklmnopqrstuvwxyz';
		$codeAlphabet .= '0123456789';
		$max = strlen( $codeAlphabet ); // edited

		for( $i = 0; $i < $tokenLength; $i++ ) {
			$token .= $codeAlphabet[$this->crypto_rand_secure( 0, $max - 1 )];
		}

		return $token;
	}

	private function crypto_rand_secure( $min, $max )
	{
		$range = $max - $min;
		if( $range < 1 )
			return $min; // not so random...
		$log = ceil( log( $range, 2 ) );
		$bytes = (int) ($log / 8) + 1; // length in bytes
		$bits = (int) $log + 1; // length in bits
		$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
		do {
			$rnd = hexdec( bin2hex( openssl_random_pseudo_bytes( $bytes ) ) );
			$rnd = $rnd & $filter; // discard irrelevant bits
		} while( $rnd > $range );
		return $min + $rnd;
	}

	private static $_instance = null;

	public static function Instance()
	{
		if( self::$_instance == null )
			self::$_instance = new Utilities;
		return self::$_instance;
	}

}