<?

/*
 *	Kush-Master Professor- KMP
 *	Jack of Spades- 283
 *	Don Operator- 530
 *	John Magic- 550
 *	miniJan Program- 520
 *	Mecha Plaisted- 455
 */

namespace App\Library;

class Fighters {
	private $data;
	private $kmp;
	private $jack;
	private $porter;
	private $majikes;
	private $prins;
	private $plaisted;
	private $idlookupcache;
	
	public function GetFights() {
		return $this->data;
	}
	
	public function GetFight( $id ) {
		if( isset( $this->idlookupcache[$id] ) )
			return $this->idlookupcache[$id];
		
		foreach( $this->data as $fight ) {
			if( $fight['id'] == $id )
				return $fight;
		}
		
		return null;
	}
	
	public function GetRandomQuote( $id ) {
		$fighter = $this->GetFight( $id );
		if( $fighter === null ) return null;
		
		$numquotes = count( $fighter['taunts'] );
		$quoteid = mt_rand(0, $numquotes - 1);
		return $fighter['taunts'][$quoteid];
	}
	
	public function __construct() {
		$this->kmp = [
			'id' => 1,
			'name' => 'Kush-Master Professor',
			'logo' => '/img/kmpcomic.png',
			'taunts' => [
				'Challenge me and you\'ll be caught in my web.. programming',
				'YOU DARE APPROACH THE KUSH-MASTER PROFESSOR?',
				'You\'ll need a lot of files and databases to keep up with me',
			]
		];
		
		$this->porter = [
			'id' => 2,
			'name' => 'Don Operator',
			'logo' => '/img/portercomic.png',
			'taunts' => [
				'If you can\'t handle Operating Systems, how can you operate a battle against me?',
				'I\'ll only need one page of memory to defeat you, and it might not even need to be mapped',
				'Your process is about to be blocked',
				'<i>fork</i> all you want, I can handle you in a single core'
			]
		];
		
		$this->majikes = [
			'id' => 3,
			'name' => 'John Magic',
			'logo' => '/img/majikescomic.png',
			'taunts' => [
				'I\'ll go easy on you, you\'ll only need an algorithm of complexity of n<sup>n</sup> to defeat me',
				'My matrix chain multiplication says I can defeat you in 1 turn, how embarrassing',
				'Even if it\'s in my name, it won\'t take any magic to defeat you',
			]
		];
		
		$this->prins = [
			'id' => 4,
			'name' => 'miniJan',
			'logo' => '/img/prinscomic.png',
			'taunts' => [
				'You can\'t handle the full version, so miniJava is more than enough to defeat you',
				'You will lose, I already know that at compile time',
				'The number of registers required to defeat you is 1'
			]
		];
		
		$this->jack = [
			'id' => 5,
			'name' => 'Jack of Spades',
			'logo' => '/img/jackcomic.png',
			'taunts' => [
				'Here is a neat card trick: your defeat',
				'Your defeat will not be very discrete',
				'Did I ever show you that I can prove via induction that no student can defeat me?'
			]
		];
		
		$this->plaisted = [
			'id' => 6,
			'name' => 'Mecha-Plaisted',
			'logo' => '/img/plaisted.png',
			'taunts' => [
				'MECHA PLAISTED ONLINE: PART MAN, PART FINITE AUTOMATA, FULL KICK-YOUR-ASS',
				'LOADING CFG G=({S,YOU,ME,e,i,l,n,o,s,w},{e,i,l,n,o,s,w},{YOU-&gt; lose, ME-&gt; win, S-&gt; YOU, S-&gt; ME}, S)',
				'YOU WINNING IS NOT A REGULAR LANGUAGE'
			]
		];
		
		$this->data = [
			$this->kmp, $this->jack, $this->porter, $this->majikes, $this->prins, $this->plaisted,
		];
		
		$this->idlookupcache = [
			0 => null,
			$this->kmp['id'] => $this->kmp,
			$this->porter['id'] => $this->porter,
			$this->majikes['id'] => $this->majikes,
			$this->prins['id'] => $this->prins,
			$this->jack['id'] => $this->jack,
			$this->plaisted['id'] => $this->plaisted,
		];
	}
	
	private static $_instance = null;
	
	public static function Instance() {
		if (self::$_instance == null)
			self::$_instance = new Fighters();
		return self::$_instance;
	}
}