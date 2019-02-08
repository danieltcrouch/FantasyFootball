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
                window.location.href = "https://football.religionandstory.com/draft.php?memberId=" + response;
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

    // return {
    //     qb: parseInt(       $( "#qb" ).val().replace(       /\D/g, '' ) ) || 0,
    //     rb: parseInt(       $( "#rb" ).val().replace(       /\D/g, '' ) ) || 0,
    //     wr: parseInt(       $( "#wr" ).val().replace(       /\D/g, '' ) ) || 0,
    //     te: parseInt(       $( "#te" ).val().replace(       /\D/g, '' ) ) || 0,
    //     k: parseInt(        $( "#k" ).val().replace(        /\D/g, '' ) ) || 0,
    //     dst: parseInt(      $( "#dst" ).val().replace(      /\D/g, '' ) ) || 0,
    //     dl: parseInt(       $( "#dl" ).val().replace(       /\D/g, '' ) ) || 0,
    //     lb: parseInt(       $( "#lb" ).val().replace(       /\D/g, '' ) ) || 0,
    //     db: parseInt(       $( "#db" ).val().replace(       /\D/g, '' ) ) || 0,
    //     wrTe: parseInt(     $( "#wrTe" ).val().replace(     /\D/g, '' ) ) || 0,
    //     wrRb: parseInt(     $( "#wrRb" ).val().replace(     /\D/g, '' ) ) || 0,
    //     wrRbTe: parseInt(   $( "#wrRbTe" ).val().replace(   /\D/g, '' ) ) || 0,
    //     qbWrRbTe: parseInt( $( "#qbWrRbTe" ).val().replace( /\D/g, '' ) ) || 0,
    //     dlLbDb: parseInt(   $( "#dlLbDb" ).val().replace(   /\D/g, '' ) ) || 0,
    //     bench: parseInt(    $( "#bench" ).val().replace(    /\D/g, '' ) ) || 0
    // };
}

function getScoring()
{
    var result = {};
    $( "#scoring input" ).each( function() {

        result[this.id] = this.value;
    } );
    return result;

    // return {
    //     passing: getPassing(),
    //     rushing: getRushing(),
    //     receiving: getReceiving(),
    //     fumbles: getFumbles(),
    //     kicking: getKicking(),
    //     returns: getReturns(),
    //     idp: getIDP(),
    //     defense: getDefense(),
    //     vor: getVOR()
    // };
}

// function getPassing()
// {
//     return {
//         passAttempts: parseInt( $( "#passAttempts" ).val().replace( /\D/g, '' ) ) || 0,
//         passComp: parseInt( $( "#passComp" ).val().replace( /\D/g, '' ) ) || 0,
//         passIncomp: parseInt( $( "#passIncomp" ).val().replace( /\D/g, '' ) ) || 0,
//         passYds: $( "#passYds" ).val(),
//         passTds: parseInt( $( "#passTds" ).val().replace( /\D/g, '' ) ) || 0,
//         passTd40: parseInt( $( "#passTd40" ).val().replace( /\D/g, '' ) ) || 0,
//         passIntercept: parseInt( $( "#passIntercept" ).val().replace( /\D/g, '' ) ) || 0,
//         passBonus300: parseInt( $( "#passBonus300" ).val().replace( /\D/g, '' ) ) || 0,
//         passBonus350: parseInt( $( "#passBonus350" ).val().replace( /\D/g, '' ) ) || 0,
//         passBonus400: parseInt( $( "#passBonus400" ).val().replace( /\D/g, '' ) ) || 0
//     };
// }
//
// function getRushing()
// {
//     return {
//         rushDsp: $( "#rushDsp" ).is( ":checked" ).toString(),
//         rushYds: $( "#rushYds" ).val(),
//         rushAttempts: parseInt( $( "#rushAttempts" ).val().replace( /\D/g, '' ) ) || 0,
//         rushTds: parseInt( $( "#rushTds" ).val().replace( /\D/g, '' ) ) || 0,
//         rushTd40: parseInt( $( "#rushTd40" ).val().replace( /\D/g, '' ) ) || 0,
//         rushConv: parseInt( $( "#rushConv" ).val().replace( /\D/g, '' ) ) || 0,
//         rushSacks: parseInt( $( "#rushSacks" ).val().replace( /\D/g, '' ) ) || 0,
//         rushBonus300: parseInt( $( "#rushBonus300" ).val().replace( /\D/g, '' ) ) || 0,
//         rushBonus350: parseInt( $( "#rushBonus350" ).val().replace( /\D/g, '' ) ) || 0,
//         rushBonus400: parseInt( $( "#rushBonus400" ).val().replace( /\D/g, '' ) ) || 0
//     };
// }
//
// function getReceiving()
// {
//     return {
//         receiveDsp: $( "#receiveDsp" ).is( ":checked" ).toString(),
//         receiveYds: $( "#receiveYds" ).val(),
//         receiveComp: parseInt( $( "#receiveComp" ).val().replace( /\D/g, '' ) ) || 0,
//         receiveTds: parseInt( $( "#receiveTds" ).val().replace( /\D/g, '' ) ) || 0,
//         receiveTd40: parseInt( $( "#receiveTd40" ).val().replace( /\D/g, '' ) ) || 0,
//         receiveBonus300: parseInt( $( "#receiveBonus300" ).val().replace( /\D/g, '' ) ) || 0,
//         receiveBonus350: parseInt( $( "#receiveBonus350" ).val().replace( /\D/g, '' ) ) || 0,
//         receiveBonus400: parseInt( $( "#receiveBonus400" ).val().replace( /\D/g, '' ) ) || 0
//     };
// }
//
// function getFumbles()
// {
//     return {
//         fumbleDsp: $( "#fumbleDsp" ).is( ":checked" ).toString(),
//         fumbles: parseInt( $( "#fumbles" ).val().replace( /\D/g, '' ) ) || 0
//     };
// }
//
// function getKicking()
// {
//     return {
//         kickEx: parseInt( $( "#kickEx" ).val().replace( /\D/g, '' ) ) || 0,
//         kickFg19: parseInt( $( "#kickFg19" ).val().replace( /\D/g, '' ) ) || 0,
//         kickFg29: parseInt( $( "#kickFg29" ).val().replace( /\D/g, '' ) ) || 0,
//         kickFg39: parseInt( $( "#kickFg39" ).val().replace( /\D/g, '' ) ) || 0,
//         kickFg49: parseInt( $( "#kickFg49" ).val().replace( /\D/g, '' ) ) || 0,
//         kickFg50: parseInt( $( "#kickFg50" ).val().replace( /\D/g, '' ) ) || 0,
//         kickFgMiss: parseInt( $( "#kickFgMiss" ).val().replace( /\D/g, '' ) ) || 0
//     };
// }
//
// function getReturns()
// {
//     return {
//         returnDsp: $( "#returnDsp" ).is( ":checked" ).toString(),
//         returnYds: $( "#returnYds" ).val(),
//         returnTds: parseInt( $( "#returnTds" ).val().replace( /\D/g, '' ) ) || 0
//     };
// }
//
// function getIDP()
// {
//     return {
//         idpDsp: $( "#idpDsp" ).is( ":checked" ).toString(),
//         idpTackleSolo: parseInt( $( "#idpTackleSolo" ).val().replace( /\D/g, '' ) ) || 0,
//         idpTackleAssist: parseInt( $( "#idpTackleAssist" ).val().replace( /\D/g, '' ) ) || 0,
//         idpSack: parseInt( $( "#idpSack" ).val().replace( /\D/g, '' ) ) || 0,
//         idpForced: parseInt( $( "#idpForced" ).val().replace( /\D/g, '' ) ) || 0,
//         idpRecovered: parseInt( $( "#idpRecovered" ).val().replace( /\D/g, '' ) ) || 0,
//         idpIntercept: parseInt( $( "#idpIntercept" ).val().replace( /\D/g, '' ) ) || 0,
//         idpDeflect: parseInt( $( "#idpDeflect" ).val().replace( /\D/g, '' ) ) || 0,
//         idpTds: parseInt( $( "#idpTds" ).val().replace( /\D/g, '' ) ) || 0,
//         idpSafety: parseInt( $( "#idpSafety" ).val().replace( /\D/g, '' ) ) || 0
//     };
// }
//
// function getDefense()
// {
//     return {
//         defSack: parseInt( $( "#defSack" ).val().replace( /\D/g, '' ) ) || 0,
//         defRecovered: parseInt( $( "#defRecovered" ).val().replace( /\D/g, '' ) ) || 0,
//         defIntercept: parseInt( $( "#defIntercept" ).val().replace( /\D/g, '' ) ) || 0,
//         defTds: parseInt( $( "#defTds" ).val().replace( /\D/g, '' ) ) || 0,
//         defSafety: parseInt( $( "#defSafety" ).val().replace( /\D/g, '' ) ) || 0,
//         defBlock: parseInt( $( "#defBlock" ).val().replace( /\D/g, '' ) ) || 0,
//         defYds: $( "#defYds" ).val()
//     };
// }
//
// function getVOR()
// {
//     return $( "#vor" ).val();
// }

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