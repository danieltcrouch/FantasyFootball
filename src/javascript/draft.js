var settings;
var players;

var optimalInfo;

var activeTeam;

var FINAL_PICK;
var MAX_PLAYERS;

/*
TODO:
Validate each field by input type
    String needs to not allow comma so that that it can be put into array
Send email with link to draft page and member ID
*/

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
                setDraftType( settings.general.draftType );
                loadPlayers();

                MAX_PLAYERS = 0; //<?php echo getPlayerCountFromPositions( $settings['league'] ); ?>
                FINAL_PICK = teams.length * MAX_PLAYERS;
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
        }
    );
}

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

//***AUCTION***//

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

//***STANDARD***//

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
   if ( currentPick !== FINAL_PICK )
   {
       incrementPickCount();

       updateInfo();
       $( "#optimalPlayer" ).text( optimalInfo.optimalPlayer );
   }
   else
   {
       $("#player").prop('disabled', true);
   }
}

function incrementPickCount()
{
   var pick = parseInt( $("#pick").text().trim() ) + 1;
   updatePickCount( pick );
}

function updatePickCount( pick )
{
   if ( pick % settings.teams.length === 0 )
   {
       var round = pick / settings.teams.length + 1;
       $("#round").text( "" + round );
   }
   $("#pick").text( "" + pick );

   var teamIndex = pick % settings.teams.length;
   $("#team").text( "" + settings.teams[ teamIndex ] );
   activeTeam = teamIndex;
}

function fillOptimalPlayer()
{
   $("#player").val( $("#optimalPlayer").text().trim() );
}

function displayInfo()
{
   //
}

function updateInfo()
{
   optimalInfo.optimalPlayer = getOptimalPlayer( players );
   //todo
}