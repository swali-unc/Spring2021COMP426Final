import fightapi from '/js/fightapi.js'
import comp426twitter from '/js/comptwitterapi.js'

$( () => {
	window.apiInst = new fightapi();
	window.twapi = new comp426twitter();
	window.apiInst.addErrorCallback( CatchAPIError );
	window.twapi.addErrorCallback( CatchTWError );
	
	window.TweetForMe = TweetForMe;
	window.FinishGame = FinishGame;
	window.indices = ['tl','tr','tm','cl','cm','cr','bl','bm','br'];
	window.gridclickable = {
		'tl': false,
		'tr': false,
		'tm': false,
		'cl': false,
		'cr': false,
		'cm': false,
		'bl': false,
		'br': false,
		'bm': false
	};
	window.ClickGrid = ClickGrid;
	window.inQuery = true;
	
	CreateBoard();
});

function CreateBoard() {
	let gs = window.apiInst.getStatus();
	gs.then( (response) => {
		CheckProgress( response.data );
	});
}

function CheckProgress( gs ) {
	if( gs.inprogress == false ) {
		if( gs.won == true )
			$('#statusmsg').text('Congrats, you won!');
		else if( gs.lost == true )
			$('#statusmsg').text('You lost!');
		else
			$('#statusmsg').text('Draw!');
		$('#statusmsg').append('<br /><button onclick="window.FinishGame();">Play Again</button>');
	}
	
	updategrid( 'tl', gs.gamestate.tl );
	updategrid( 'tm', gs.gamestate.tm );
	updategrid( 'tr', gs.gamestate.tr );
	updategrid( 'cl', gs.gamestate.cl );
	updategrid( 'cm', gs.gamestate.cm );
	updategrid( 'cr', gs.gamestate.cr );
	updategrid( 'bl', gs.gamestate.bl );
	updategrid( 'bm', gs.gamestate.bm );
	updategrid( 'br', gs.gamestate.br );
	
	$('#quote').html( gs.quote );
	
	window.inQuery = false;
}

function updategrid( elementid, data ) {
	if( data == -1 ) {
		$(`#${elementid}`).html('<div class="gridentry">X</div>');
		window.gridclickable[elementid] = false;
	} else if( data == 1 ) {
		$(`#${elementid}`).html('<div class="gridentry">O</div>');
		window.gridclickable[elementid] = false;
	} else {
		$(`#${elementid}`).html('');
		window.gridclickable[elementid] = true;
	}
}

export function FinishGame() {
	window.apiInst.finish().then( (response) => {
		window.location.href = '/play';
	});
}

export function ClickGrid( index ) {
	if( window.inQuery ) return;
	if( window.gridclickable[index] == false )
		return;
	window.inQuery = true;
	
	$(`#${index}`).html('<div class="loader"></div>');
	
	let newgs = window.apiInst.move( index )
		.then( (response) => CheckProgress( response.data ) );
}

function CatchAPIError( errStr ) {
	$('#errors').text('Error during API transaction:<br /><br />' + errStr);
	$('#errors').css('display','block');
}

function CatchTWError( errStr ) {
	$('#tweetbtn').text('Error!');
	$('#errors').html('Could not post to the twitter api, make sure you <a href="/comptwitterlogin">log in here</a><br />' + errStr);
	$('#errors').css('display','block');
}

export function TweetForMe( str ) {
	$('#tweetbtn').attr('disabled','disabled');
	$('#tweetbtn').text('Posting..');
	
	/*window.twapi.createTweet( str ).then( (resp) => {
		$('#tweetbtn').text('Done!');
	});*/
	$.ajax({
		url: 'https://comp426-1fa20.cs.unc.edu/a09/tweets',
		type: 'POST',
		data: {
			'body': str
		},
		xhrFields: {
			withCredentials: true,
		},
	}).then(() => {
		$('#tweetbtn').text('Done!');
	}).catch(() => {
		CatchTWError('');
	});
}