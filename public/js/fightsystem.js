import fightapi from '/js/fightapi.js'

$( () => {
	window.apiInst = new fightapi();
	window.apiInst.addErrorCallback( CatchAPIError );
	
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
	
	$(`#${index}`).html('<div id="loader"></div>');
	
	let newgs = window.apiInst.move( index )
		.then( (response) => CheckProgress( response.data ) );
}

function CatchAPIError( errStr ) {
	$('#errors').text('Error during API transaction:<br /><br />' + errStr);
	$('#errors').css('display','block');
}