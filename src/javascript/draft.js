function getOptimalPlayer() //todo - all of this...
{
	var player = players[Math.floor(Math.random()*players.length)];;
	$("#player").val( player );
	$("#player").focus();
}

function getAvailablePlayers()
{
	return players;
}

function isValidPlayerPick()
{
	return true;
}