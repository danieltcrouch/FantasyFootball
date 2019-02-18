/********************AUTOFILL********************/


function preFill( preFillType )
{
    $.post(
        "php/controller.php",
        {
            action: 	 "getPreFillSettings",
            preFillType: preFillType
        },
        function ( response ) {
            response = JSON.parse( response );
            autoFill( response );
        }
    );
}


/********************LOAD********************/


function loadSetup( memberId )
{
    if ( memberId )
    {
        $.post(
            "php/controller.php",
            {
                action: 	"getDraftSettings",
                memberId:	memberId
            },
            function ( response ) {
                response = JSON.parse( response );
                autoFill( response );
            }
        );
    }
    else
    {
        hideAllTabs();
    }
}

function autoFill( settings )
{
    //GENERAL
    $( '#' + settings.general.draftType ).click();
    //Season
    //Position
    //ADP
    $( "#leagueCap" ).val( settings.general.leagueCap );
    $( "#aav>option:eq(" + settings.general.aav + ")" ).attr( "selected", true );

    //LEAGUE
    $( "#qb" ).val(       settings.league.qb );
    $( "#rb" ).val(       settings.league.rb );
    $( "#wr" ).val(       settings.league.wr );
    $( "#te" ).val(       settings.league.te );
    $( "#k" ).val(        settings.league.k );
    $( "#dst" ).val(      settings.league.dst );
    $( "#dl" ).val(       settings.league.dl );
    $( "#lb" ).val(       settings.league.lb );
    $( "#db" ).val(       settings.league.db );
    $( "#wrTe" ).val(     settings.league.wrTe );
    $( "#wrRb" ).val(     settings.league.wrRb );
    $( "#wrRbTe" ).val(   settings.league.wrRbTe );
    $( "#qbWrRbTe" ).val( settings.league.qbWrRbTe );
    $( "#dlLbDb" ).val(   settings.league.dlLbDb );
    $( "#bench" ).val(    settings.league.bench );

    //SCORING
    $( "#passAttempts" ).val(   settings.scoring.passing.passAttempts );
    $( "#passComp" ).val(       settings.scoring.passing.passComp );
    $( "#passIncomp" ).val(     settings.scoring.passing.passIncomp );
    $( "#passYds" ).val(        settings.scoring.passing.passYds );
    $( "#passTds" ).val(        settings.scoring.passing.passTds );
    $( "#passTd40" ).val(       settings.scoring.passing.passTd40 );
    $( "#passIntercept" ).val(  settings.scoring.passing.passIntercept );
    $( "#passBonus300" ).val(   settings.scoring.passing.passBonus300 );
    $( "#passBonus350" ).val(   settings.scoring.passing.passBonus350 );
    $( "#passBonus400" ).val(   settings.scoring.passing.passBonus400 );

    $( "#rushDsp" ).prop( "checked", settings.scoring.rushing.rushDsp );
    $( "#rushYds" ).val(        settings.scoring.rushing.rushYds );
    $( "#rushAttempts" ).val(   settings.scoring.rushing.rushAttempts );
    $( "#rushTds" ).val(        settings.scoring.rushing.rushTds );
    $( "#rushTd40" ).val(       settings.scoring.rushing.rushTd40 );
    $( "#rushConv" ).val(       settings.scoring.rushing.rushConv );
    $( "#rushSacks" ).val(      settings.scoring.rushing.rushSacks );
    $( "#rushBonus300" ).val(   settings.scoring.rushing.rushBonus300 );
    $( "#rushBonus350" ).val(   settings.scoring.rushing.rushBonus350 );
    $( "#rushBonus400" ).val(   settings.scoring.rushing.rushBonus400 );

    $( "#receiveDsp" ).prop( "checked", settings.scoring.receiving.receiveDsp );
    $( "#receiveYds" ).val(      settings.scoring.receiving.receiveYds );
    $( "#receiveComp" ).val(     settings.scoring.receiving.receiveComp );
    $( "#receiveTds" ).val(      settings.scoring.receiving.receiveTds );
    $( "#receiveTd40" ).val(     settings.scoring.receiving.receiveTd40 );
    $( "#receiveBonus300" ).val( settings.scoring.receiving.receiveBonus300 );
    $( "#receiveBonus350" ).val( settings.scoring.receiving.receiveBonus350 );
    $( "#receiveBonus400" ).val( settings.scoring.receiving.receiveBonus400 );

    $( "#fumbleDsp" ).prop( "checked", settings.scoring.fumbles.fumbleDsp );
    $( "#fumbles" ).val( settings.scoring.fumbles.fumbles );

    $( "#kickEx" ).val(     settings.scoring.kicking.kickEx );
    $( "#kickFg19" ).val(   settings.scoring.kicking.kickFg19 );
    $( "#kickFg29" ).val(   settings.scoring.kicking.kickFg29 );
    $( "#kickFg39" ).val(   settings.scoring.kicking.kickFg39 );
    $( "#kickFg49" ).val(   settings.scoring.kicking.kickFg49 );
    $( "#kickFg50" ).val(   settings.scoring.kicking.kickFg50 );
    $( "#kickFgMiss" ).val( settings.scoring.kicking.kickFgMiss );

    $( "#returnDsp" ).prop( "checked", settings.scoring.returning.returnDsp );
    $( "#returnYds" ).val( settings.scoring.returning.returnYds );
    $( "#returnTds" ).val( settings.scoring.returning.returnTds );

    $( "#idpDsp" ).prop( "checked", settings.scoring.idp.idpDsp );
    $( "#idpTackleSolo" ).val(   settings.scoring.idp.idpTackleSolo );
    $( "#idpTackleAssist" ).val( settings.scoring.idp.idpTackleAssist );
    $( "#idpSack" ).val(         settings.scoring.idp.idpSack );
    $( "#idpForced" ).val(       settings.scoring.idp.idpForced );
    $( "#idpRecovered" ).val(    settings.scoring.idp.idpRecovered );
    $( "#idpIntercept" ).val(    settings.scoring.idp.idpIntercept );
    $( "#idpDeflect" ).val(      settings.scoring.idp.idpDeflect );
    $( "#idpTds" ).val(          settings.scoring.idp.idpTds );
    $( "#idpSafety" ).val(       settings.scoring.idp.idpSafety );

    $( "#defSack" ).val(        settings.scoring.defense.defSack );
    $( "#defRecovered" ).val(   settings.scoring.defense.defRecovered );
    $( "#defIntercept" ).val(   settings.scoring.defense.defIntercept );
    $( "#defTds" ).val(         settings.scoring.defense.defTds );
    $( "#defSafety" ).val(      settings.scoring.defense.defSafety );
    $( "#defBlock" ).val(       settings.scoring.defense.defBlock );
    $( "#defYds" ).val(         settings.scoring.defense.defYds );

    $( "#vor" ).val( settings.scoring.vor );

    //TEAMS
    $( "#teamCount>option:eq(" + settings.teams.count + ")" ).attr( "selected", true );
    $( "#userIndex>option:eq(" + settings.teams.userIndex + ")" ).attr( "selected", true );
    setTeamNames( settings.teams.teamNames );
}

function setTeamNames( teamNames )
{
    for ( var i = 1; i <= teamNames.length ; i++ )
   	{
   		$( "#t" + i ).val( teamNames[i-1] );
   	}
}


/********************SUBMIT********************/


function finishSetup()
{
    if ( isValid() )
    {
        $.post(
            "php/controller.php",
            {
                action: 	"storeDraftSettings",
                settings:	JSON.stringify( getSettings() )
            },
            function ( response ) {
                window.location.href = "https://football.religionandstory.com/draft.php?memberId=" + JSON.parse( response );
            }
        );
    }
}

function isValid()
{
    return true;
}

function getSettings()
{
    return {
        general: getGeneral(),
        league: getLeague(),
        scoring: getScoring(),
        teams: getTeams()
    };
}

function getGeneral()
{
    return {
        draftType: getDraftType(),
        season: getSeason(),
        positions: getPositions(),
        adp: getADP(),
        leagueCap: getLeagueCap(),
        aav: getAAV()
    };
}

function getDraftType()
{
    return getSelectedRadioButtonId( "draftType" );
}

function getSeason()
{
    return (new Date()).getFullYear();
    //return $("#season").val();
}

function getPositions()
{
    return "";
    //return $("#positions").val();
}

function getADP()
{
    return "";
    //return $("#adp").val();
}

function getLeagueCap()
{
    return parseInt( $( "#leagueCap" ).val().replace( /\D/g, '' ) ) || 0;
}

function getAAV()
{
    return $( "#aav option:selected" ).val();
}

function getLeague()
{
    var result = {};
    $( "#league input" ).each( function() {

        result[this.id] = this.value;
    } );
    return result;
}

function getScoring()
{
    var result = {};
    $( "#scoring input" ).each( function() {
        result[this.id] = this.type === "checkbox" ? this.checked : this.value;
    } );
    return result;
}

function getTeams()
{
    return {
        count: getTeamCount(),
        teamNames: getTeamNames(),
        userIndex: getUserIndex()
    };
}

function getTeamCount()
{
    return parseInt( $( "#teamCount option:selected" ).val() );
}

function getTeamNames()
{
    var teamNames = [];
    $( "input[name='teamNames']" ).each( function() {
        teamNames.push( this.value );
    } );
    return teamNames;
}

function getUserIndex()
{
    return parseInt( $( "#userIndex option:selected" ).val() );
}