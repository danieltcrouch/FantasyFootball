<?php
session_start();
include_once( "visualUtility.php" );

function getGUID()
{
	$result = null;
    if (function_exists("com_create_guid"))
	{
        $result = str_replace( "-", "", trim(com_create_guid(), "{}") );
    }
	else
	{
        mt_srand((double)microtime()*10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $uuid = substr($charid, 0, 8)
            .substr($charid, 8, 4)
            .substr($charid,12, 4)
            .substr($charid,16, 4)
            .substr($charid,20,12);
        $result = $uuid;
    }
	return $result;
}

function convertToSettings( $flatSettings )
{
	$settings = [
		'memberId'	=> $flatSettings['memberId'],
		'settingsId'=> $flatSettings['settingsId'],
		'general'	=> [
			'draftType'	=> $flatSettings['general_draftType'],
			'season'	=> $flatSettings['general_season'],
			'positions'	=> $flatSettings['general_positions'],
			'adp'		=> $flatSettings['general_adp'],
			'leagueCap'	=> $flatSettings['general_leagueCap'],
			'aav'		=> $flatSettings['general_aav']
		],
		'league'	=> [
			'qb'		=> $flatSettings['league_qb'],
			'rb'		=> $flatSettings['league_rb'],
			'wr'		=> $flatSettings['league_wr'],
			'te'		=> $flatSettings['league_te'],
			'k'			=> $flatSettings['league_k'],
			'dst'		=> $flatSettings['league_dst'],
			'dl'		=> $flatSettings['league_dl'],
			'lb'		=> $flatSettings['league_lb'],
			'db'		=> $flatSettings['league_db'],
			'wrTe'		=> $flatSettings['league_wrTe'],	
			'wrRb'		=> $flatSettings['league_wrRb'],	
			'wrRbTe'	=> $flatSettings['league_wrRbTe'],
			'qbWrRbTe'	=> $flatSettings['league_qbWrRbTe'],
			'dlLbDb'	=> $flatSettings['league_dlLbDb'],	
			'bench'		=> $flatSettings['league_bench']
		],
		'scoring'	=> [
			'vor'		=> $flatSettings['scoring_vor'],
			'passing'	=> [
				'passAttempts'	=> $flatSettings['scoring_passing_passAttempts'],
				'passComp'		=> $flatSettings['scoring_passing_passComp'],
				'passIncomp'	=> $flatSettings['scoring_passing_passIncomp'],
				'passYds'		=> $flatSettings['scoring_passing_passYds'],
				'passTds'		=> $flatSettings['scoring_passing_passTds'],
				'passTd40'		=> $flatSettings['scoring_passing_passTd40'],
				'passIntercept'	=> $flatSettings['scoring_passing_passIntercept'],
				'passBonus300'	=> $flatSettings['scoring_passing_passBonus300'],
				'passBonus350'	=> $flatSettings['scoring_passing_passBonus350'],
				'passBonus400'	=> $flatSettings['scoring_passing_passBonus400']
			],
			'rushing'	=> [
				'rushDsp'		=> $flatSettings['scoring_rushing_rushDsp'],
				'rushYds'		=> $flatSettings['scoring_rushing_rushYds'],
				'rushAttempts'	=> $flatSettings['scoring_rushing_rushAttempts'],
				'rushTds'		=> $flatSettings['scoring_rushing_rushTds'],
				'rushTd40'		=> $flatSettings['scoring_rushing_rushTd40'],
				'rushConv'		=> $flatSettings['scoring_rushing_rushConv'],
				'rushSacks'		=> $flatSettings['scoring_rushing_rushSacks'],
				'rushBonus300'	=> $flatSettings['scoring_rushing_rushBonus300'],
				'rushBonus350'	=> $flatSettings['scoring_rushing_rushBonus350'],
				'rushBonus400'	=> $flatSettings['scoring_rushing_rushBonus400']
			],
			'receiving'	=> [
				'receiveDsp'		=> $flatSettings['scoring_receive_receiveDsp'],
				'receiveYds'		=> $flatSettings['scoring_receive_receiveYds'],
				'receiveComp'		=> $flatSettings['scoring_receive_receiveComp'],
				'receiveTds'		=> $flatSettings['scoring_receive_receiveTds'],
				'receiveTd40'		=> $flatSettings['scoring_receive_receiveTd40'],
				'receiveBonus300'	=> $flatSettings['scoring_receive_receiveBonus300'],
				'receiveBonus350'	=> $flatSettings['scoring_receive_receiveBonus350'],
				'receiveBonus400'	=> $flatSettings['scoring_receive_receiveBonus400']
			],
			'fumbles'	=> [
				'fumbleDsp'	=> $flatSettings['scoring_fumbles_fumbleDsp'],
				'fumbles'	=> $flatSettings['scoring_fumbles_fumbles']
			],
			'kicking'	=> [
				'kickEx'	=> $flatSettings['scoring_kicking_kickEx'],
				'kickFg19'	=> $flatSettings['scoring_kicking_kickFg19'],
				'kickFg29'	=> $flatSettings['scoring_kicking_kickFg29'],
				'kickFg39'	=> $flatSettings['scoring_kicking_kickFg39'],
				'kickFg49'	=> $flatSettings['scoring_kicking_kickFg49'],
				'kickFg50'	=> $flatSettings['scoring_kicking_kickFg50'],
				'kickFgMiss'=> $flatSettings['scoring_kicking_kickFgMiss']
			],
			'returning'	=> [
				'returnDsp'	=> $flatSettings['scoring_returning_returnDsp'],
				'returnYds'	=> $flatSettings['scoring_returning_returnYds'],
				'returnTds'	=> $flatSettings['scoring_returning_returnTds']
			],
			'idp'		=> [
				'idpDsp'		=> $flatSettings['scoring_idp_idpDsp'],
				'idpTackleSolo'	=> $flatSettings['scoring_idp_idpTackleSolo'],
				'idpTackleAssist'=> $flatSettings['scoring_idp_idpTackleAssist'],
				'idpSack'		=> $flatSettings['scoring_idp_idpSack'],
				'idpForced'		=> $flatSettings['scoring_idp_idpForced'],
				'idpRecovered'	=> $flatSettings['scoring_idp_idpRecovered'],
				'idpIntercept'	=> $flatSettings['scoring_idp_idpIntercept'],
				'idpDeflect'	=> $flatSettings['scoring_idp_idpDeflect'],
				'idpTds'		=> $flatSettings['scoring_idp_idpTds'],
				'idpSafety'		=> $flatSettings['scoring_idp_idpSafety']
			],
			'defense'	=> [
				'defSack'		=> $flatSettings['scoring_defense_defSack'],
				'defRecovered'	=> $flatSettings['scoring_defense_defRecovered'],
				'defIntercept'	=> $flatSettings['scoring_defense_defIntercept'],
				'defTds'		=> $flatSettings['scoring_defense_defTds'],
				'defSafety'		=> $flatSettings['scoring_defense_defSafety'],
				'defBlock'		=> $flatSettings['scoring_defense_defBlock'],
				'defYds'		=> $flatSettings['scoring_defense_defYds']
			]
		],
		'teams'		=> [
			'count'		=> $flatSettings['teams_count'],
			'userIndex'	=> $flatSettings['teams_userIndex'],
			'teamNames'	=> getTeamNames( $flatSettings['teamNames'] )
		]
	];
	
	return $settings;
}

function getTeamNames( $teamNames )
{
	return explode( ",", $teamNames );
}

function getPlayerCountFromPositions( $positions )
{
	return 10; //todo - fix this
}

function getPlayers()
{
	//Read from somewhere?
	return array("Stephen Crouch", "Daniel Crouch", "Michael Crouch", "Tina Crouch", "Jimmy Crouch", "Lauren Crouch", "Crystal Crouch", "Sarah Crouch", "James Crouch", "Elizabeth Crouch", "Lily Crouch");
}
?>