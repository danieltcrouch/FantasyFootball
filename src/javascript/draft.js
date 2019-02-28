var settings;
var players;

var activeTeamIndex;
var teams;

var usedPlayers;

var MAX_PLAYERS;
var FINAL_PICK;

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

                activeTeamIndex = -1;
                teams = generateTeams( settings.teams, settings.league );

                MAX_PLAYERS = getMaxPlayers( settings.league );
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
    var playerNames = getAvailablePlayers().map( player => player.name );
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

function getMaxPlayers( league )
{
    var result = 0;
    for ( let pos of Object.keys( league ) )
    {
        result += league[pos];
    }
    return result;
}

function generateTeams( teamInfo, league )
{
    var teams = [];
    for ( let i = 0; i < teamInfo.count; i++ )
    {
        teams.push( new Team( i, teamInfo.teamNames[i], league ) );
    }
    return teams;
}


/********************TEAM********************/


class Team
{
    constructor( index, name, leaguePositions )
    {
        this.index = 0;
        this.name = name || ("Team " + this.index);
        this.positions = leaguePositions;
        this.playerIds = [];
    }

    getPositionIndexToFill( player )
    {
        var result = "qb0";
        if ( this.playerIds.length < MAX_PLAYERS )
        {
            var position = null;
            if ( this.positions[player.position] > 0 )
            {
                position = player.position;
            }
            else if ( this.positions["bench"] > 0 )
            {
                position = "bench";
            }

            if ( position == null )
            {
                for ( let pos of Object.keys( this.positions ) )
                {
                    if ( this.positions[pos] > 0 )
                    {
                        position = pos;
                        break;
                    }
                }
            }

            var index = settings.league[position] - this.positions[position];
            result = "" + position + index;
        }

        return result;
    }

    addPlayer( playerId, position )
    {
        this.positions[position]--;
        this.playerIds.push( playerId );
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
       updatePlayerList( playerId );
       getNextPick();
   }
   else
   {
       alert( "You cannot choose this player." );
   }
}

function insertPlayer( playerId )
{
    var positionIndex = teams[activeTeamIndex].getPositionIndexToFill( players[playerId] );
    var cellId = "player_" + activeTeamIndex + "_cell_" + positionIndex;
    var cell = $( "#" + cellId );
    cell.html( players[playerId].name );
    cell.addClass( "full" );

    $( ".full" ).css( "color", "black" );
    cell.css( "color", "red" );

    var position = positionIndex.replace(/[0-9]/g, "");
    teams[activeTeamIndex].addPlayer( playerId, position );
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
    activeTeamIndex = teamIndex;
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


function updatePlayerList( playerId )
{
    usedPlayers.push( playerId );
    players.splice( players.indexOf(playerId), 1 );
    updatePlayerInputAutocomplete();
}

function getAvailablePlayerIds()
{
	return getPlayerIds().filter(function(id){ return !usedPlayers.includes(id); });
}

function getAvailablePlayers()
{
    var playerIds = getAvailablePlayerIds();
	return players.filter(function(value,key){ return playerIds.includes(key + ""); });
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
    var player = players[ getPlayerIdFromName( $("#player").val() ) ];
    var playerInfo = "<strong>Name:</strong> " + player.name +
                     " <br/><strong>Position:</strong> " + player.position +
                     " <br/><strong>Value:</strong> " + player.value +
                     " <br/><img src='" + player.image + "' height='300px' alt='Profile'>";
    showMessage( "Player Info", playerInfo );
}