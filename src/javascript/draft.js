var settings;
var players;

var activeTeam;

var usedPlayers;

var FINAL_PICK;
var MAX_PLAYERS;

function loadSettings( memberId )
{
    if ( memberId )
    {
        $.post(
            "php/controller.php",
            {
                action:   "getDraftSettings",
                memberId: memberId
            },
            function ( response ) {
                settings = JSON.parse( response );
                MAX_PLAYERS = 3; //<?php echo getPlayerCountFromPositions( $settings['league'] ); ?>
                FINAL_PICK = settings.teams.count * MAX_PLAYERS;

                loadPlayers();
            }
        );
    }
    else
    {
        window.location = "https://football.religionandstory.com/";
    }
}

function loadPlayers()
{
    $.post(
        "php/controller.php",
        {
            action: "getPlayers"
        },
        function ( response ) {
            players = JSON.parse( response );
            usedPlayers = [];

            setPlayerInputHandler();
            setDraftType( settings.general.draftType );
        }
    );
}

function setPlayerInputHandler()
{
    updatePlayerInputAutocomplete();
    $("#player").keyup( function(e){
        if(e.keyCode === 13)
        {
            submitPlayerPick();
        }
        if(e.keyCode === 9)
        {
            fillOptimalPlayer();
        }
    } );
}

function updatePlayerInputAutocomplete()
{
    var playerNames = players.map( player => player.name );
    $("#player").autocomplete( {source: playerNames} );
}

function setDraftType( type )
{
	$("#draftType").text( "" + type.charAt(0).toUpperCase() + type.slice(1) );
	if ( type === "auction" )
	{
		$("#auctionDisplay").show();
		$("#standardDisplay").hide();
        initializeAuction();
	}
	else
	{
		$("#auctionDisplay").hide();
		$("#standardDisplay").show();
        initializeStandard();
	}
}


/********************STANDARD********************/


function initializeStandard()
{
   updatePickCount( 0 );
   getNextPick();
}

function submitPlayerPick()
{
   var player = $("#player").val().trim();
   var playerId = getPlayerIdFromName( player );
   if ( isValidPlayerPick( playerId ) )
   {
       insertPlayer( playerId );
       usedPlayers.push( playerId );
       players.splice( players.indexOf(playerId), 1 );
       updatePlayerInputAutocomplete();
       getNextPick();
   }
   else
   {
       alert( "You cannot choose this player." );
   }
}

function insertPlayer( player )
{
    $( "#player_0_cell_0-0" ).html( players[player].name );
    $( "#player_0_cell_0-0" ).css( "color", "red" );

   //todo - get player position
   //place player in that cell
   //else place in bench
   //else place in first available
}

function getNextPick()
{
   var currentPick = parseInt( $("#pick").text().trim() );
   var currentRound = parseInt( $("#round").text().trim() );
   var totalPick = currentPick + ( settings.teams.count * (currentRound-1) );
   if ( totalPick !== FINAL_PICK )
   {
       updatePickCount( totalPick + 1 );
       updateOptimal();
   }
   else
   {
       $("#player").val( "None" );
       $("#player").prop('disabled', true);
   }
}

function updatePickCount( pick )
{
    var teamCount = settings.teams.count;
    var pickIndex = pick - 1;
    if ( pickIndex % teamCount === 0 )
    {
        var round = ( pickIndex / teamCount ) + 1;
        $("#round").text( "" + round );
    }
    $("#pick").text( "" + ( pickIndex % teamCount + 1) );

    var teamIndex = pickIndex % teamCount;
    var teamName = ( teamIndex + 1 == settings.teams.userIndex ) ? "You" : settings.teams.teamNames[ teamIndex ];
    $("#team").text( teamName );
    activeTeam = teamIndex;
}


/********************AUCTION********************/


function initializeAuction()
{
    updateUserAssets( settings.general.leagueCap );
    //updateUserAssets( <?php echo $settings['general']['leagueCap']; ?> );
    //todo - under construction
}

/*function payMoney( cost )
{
    if ( $("#draftType").text() == "auction" )
    {
        var userIndex = settings.teams.userIndex;
        var teamIndex = $( activeCell ).attr( 'id' ).split( "_" )[1];
        if ( teamIndex == userIndex )
        {
            var money = parseInt( $("#money").text().trim() );
            money -= cost;
            updateUserAssets( money );
        }
    }
}*/

function updateUserAssets( money )
{
    $("#money").text( "" + money );
}


/********************OPTIMIZE********************/


function getOptimalPlayer( callback )
{
    var currentDraft = JSON.stringify( {
        usedPlayers: usedPlayers
    } );

    $.post(
        "php/controller.php",
        {
            action: "getOptimalPlayer",
            currentDraft: currentDraft
        },
        callback
    );
}

function updateOptimal()
{
    getOptimalPlayer( updateOptimalCallback );
}

function updateOptimalCallback( response )
{
    var result = response ? players[response].name : "No Optimal Player Found";
    $("#optimalPlayer").text( result );

    fillOptimalPlayer();
    $("#player").focus();
}

function fillOptimalPlayer()
{
    $("#player").val( $("#optimalPlayer").text().trim() );
}


/********************OTHER********************/


function getAvailablePlayerIds()
{
	return getPlayerIds().filter(function(id){ return !usedPlayers.includes(id); });
}

function getAvailablePlayers()
{
    var playerIds = getAvailablePlayerIds();
	return players.filter(function(value,key){ return playerIds.includes(key); });
}

function getPlayerIds()
{
    return Object.keys(players);
}

function getPlayerIdFromName( playerName )
{
    return getPlayerIds().find( key => players[key].name === playerName );
}

function isValidPlayerPick( playerId )
{
    return getPlayerIds().includes( playerId );
}

function displayInfo()
{
    showMessage( "Player Info", "Under construction..." );
}