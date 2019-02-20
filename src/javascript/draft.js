var settings;
var players;

var activeTeam;

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

            setPlayerHandler();
            setDraftType( settings.general.draftType );
        }
    );
}

function setPlayerHandler()
{
    $("#player").autocomplete( {source: players} );
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
   var player = $("#player").val().trim;
   if ( isValidPlayerPick( player ) )
   {
       insertPlayer( player );
       players.splice( players.indexOf(player), 1 );
       getNextPick();
   }
   else
   {
       alert( "You cannot choose this player." );
   }
}

function insertPlayer( player )
{
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


function updateOptimal()
{
    var player = getOptimalPlayer( players );

    $("#player").val( player );
   	$("#player").focus();
    $("#optimalPlayer").text( player );
}

function getOptimalPlayer() //todo - this needs to be AJAX call done server-side
{
    return ( players ) ? players[Math.floor(Math.random()*players.length)] : null;
}

function fillOptimalPlayer()
{
    $("#player").val( $("#optimalPlayer").text().trim() );
}

function getAvailablePlayers()
{
	return players;
}

function isValidPlayerPick()
{
    return true;
}

function displayInfo()
{
    showMessage( "Player Info", "Under construction..." );
}