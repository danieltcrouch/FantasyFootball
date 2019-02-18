<?php
include_once( "utility.php" );

function storeDraftSettings( $settings )
{
	$mysqli = getMySql();
	
	$memberId		= getGUID();
	$settingsId		= getGUID();

	$insertMember	= "INSERT INTO members			(m_id, s_id)
											 VALUES ('" . $memberId . "', '" . $settingsId . "')";
	$insertSGeneral	= "INSERT INTO settingsGeneral	(s_id, sg_draftType, sg_season, sg_positions, sg_adp, sg_leagueCap, sg_aav)
											 VALUES ('" . $settingsId . "', '" . $settings->general->draftType . "', '" . $settings->general->season . "', '" . $settings->general->positions . "', '" . $settings->general->adp . "', " . $settings->general->leagueCap . ", '" . $settings->general->aav . "')";
	$insertSLeague	= "INSERT INTO settingsLeague	(s_id, sl_qb, sl_rb, sl_wr, sl_te, sl_k, sl_dst, sl_dl, sl_lb, sl_db, sl_wrTe, sl_wrRb, sl_wrRbTe, sl_qbWrRbTe, sl_dlLbDb, sl_bench)
											 VALUES ('" . $settingsId . "', " . $settings->league->qb . ", " . $settings->league->rb . ", " . $settings->league->wr . ", " . $settings->league->te . ", " . $settings->league->k . ", " . $settings->league->dst . ", " . $settings->league->dl . ", " . $settings->league->lb . ", " . $settings->league->db . ", " . $settings->league->wrTe . ", " . $settings->league->wrRb . ", " . $settings->league->wrRbTe . ", " . $settings->league->qbWrRbTe . ", " . $settings->league->dlLbDb . ", " . $settings->league->bench . " )";
	$insertSScoring	= "INSERT INTO settingsScoring	(s_id, ss_vor)
											 VALUES ('" . $settingsId . "', '" . $settings->scoring->vor . "')";
	$insertSTeams	= "INSERT INTO settingsTeams	(s_id, st_count, st_userIndex)
											 VALUES ('" . $settingsId . "', " . $settings->teams->count . ", " . $settings->teams->userIndex . ")";
	
	$insertPassing	= "INSERT INTO scoringPassing	(s_id, scp_passAttempts, scp_passComp, scp_passIncomp, scp_passYds, scp_passTds, scp_passTd40, scp_passIntercept, scp_passBonus300, scp_passBonus350, scp_passBonus400)
											 VALUES ('" . $settingsId . "', " . $settings->scoring->passAttempts . ", " . $settings->scoring->passComp . ", " . $settings->scoring->passIncomp . ", '" . $settings->scoring->passYds . "', " . $settings->scoring->passTds . ", " . $settings->scoring->passTd40 . ", " . $settings->scoring->passIntercept . ", " . $settings->scoring->passBonus300 . ", " . $settings->scoring->passBonus350 . ", " . $settings->scoring->passBonus400 . ")";
	$insertRushing	= "INSERT INTO scoringRushing	(s_id, scru_rushDsp, scru_rushYds, scru_rushAttempts, scru_rushTds, scru_rushTd40, scru_rushConv, scru_rushSacks, scru_rushBonus300, scru_rushBonus350, scru_rushBonus400)
											 VALUES ('" . $settingsId . "', " . $settings->scoring->rushDsp . ", '" . $settings->scoring->rushYds . "', " . $settings->scoring->rushAttempts . ", " . $settings->scoring->rushTds . ", " . $settings->scoring->rushTd40 . ", " . $settings->scoring->rushConv . ", " . $settings->scoring->rushSacks . ", " . $settings->scoring->rushBonus300 . ", " . $settings->scoring->rushBonus350 . ", " . $settings->scoring->rushBonus400 . ")";
	$insertReceiving= "INSERT INTO scoringReceiving	(s_id, scrc_receiveDsp, scrc_receiveYds, scrc_receiveComp, scrc_receiveTds, scrc_receiveTd40, scrc_receiveBonus300, scrc_receiveBonus350, scrc_receiveBonus400)
											 VALUES ('" . $settingsId . "', " . $settings->scoring->receiveDsp . ", '" . $settings->scoring->receiveYds . "', " . $settings->scoring->receiveComp . ", " . $settings->scoring->receiveTds . ", " . $settings->scoring->receiveTd40 . ", " . $settings->scoring->receiveBonus300 . ", " . $settings->scoring->receiveBonus350 . ", " . $settings->scoring->receiveBonus400 . ")";
	$insertFumbles	= "INSERT INTO scoringFumbles	(s_id, scf_fumbleDsp, scf_fumbles)
											 VALUES ('" . $settingsId . "', " . $settings->scoring->fumbleDsp . ", " . $settings->scoring->fumbles . ")";
	$insertKicking	= "INSERT INTO scoringKicking	(s_id, sck_kickEx, sck_kickFg19, sck_kickFg29, sck_kickFg39, sck_kickFg49, sck_kickFg50, sck_kickFgMiss)
											 VALUES ('" . $settingsId . "', " . $settings->scoring->kickEx . ", " . $settings->scoring->kickFg19 . ", " . $settings->scoring->kickFg29 . ", " . $settings->scoring->kickFg39 . ", " . $settings->scoring->kickFg49 . ", " . $settings->scoring->kickFg50 . ", " . $settings->scoring->kickFgMiss . ")";
	$insertReturns	= "INSERT INTO scoringReturns	(s_id, scrt_returnDsp, scrt_returnYds, scrt_returnTds)
											 VALUES ('" . $settingsId . "', " . $settings->scoring->returnDsp . ", '" . $settings->scoring->returnYds . "', " . $settings->scoring->returnTds . ")";
	$insertIdp		= "INSERT INTO scoringIdp		(s_id, sci_idpDsp, sci_idpTackleSolo, sci_idpTackleAssist, sci_idpSack, sci_idpForced, sci_idpRecovered, sci_idpIntercept, sci_idpDeflect, sci_idpTds, sci_idpSafety)
											 VALUES ('" . $settingsId . "', " . $settings->scoring->idpDsp . ", " . $settings->scoring->idpTackleSolo . ", " . $settings->scoring->idpTackleAssist . ", " . $settings->scoring->idpSack . ", " . $settings->scoring->idpForced . ", " . $settings->scoring->idpRecovered . ", " . $settings->scoring->idpIntercept . ", " . $settings->scoring->idpDeflect . ", " . $settings->scoring->idpTds . ", " . $settings->scoring->idpSafety . ")";
	$insertDefense	= "INSERT INTO scoringDefense	(s_id, scd_defSack, scd_defRecovered, scd_defIntercept, scd_defTds, scd_defSafety, scd_defBlock, scd_defYds)
											 VALUES ('" . $settingsId . "', " . $settings->scoring->defSack . ", " . $settings->scoring->defRecovered . ", " . $settings->scoring->defIntercept . ", " . $settings->scoring->defTds . ", " . $settings->scoring->defSafety . ", " . $settings->scoring->defBlock . ", '" . $settings->scoring->defYds . "')";
	
	$insertTeamNames= "INSERT INTO teamNames        (s_id, tn_teamIndex, tn_teamName)
                                             VALUES ";
	for ( $i = 0; $i < $settings->teams->count; $i++ )
    {
        if ($i != 0)
        {
            $insertTeamNames .= ", ";
        }
        $insertTeamNames .= "('" . $settingsId . "', " . $i . ", '" . $settings->teams->teamNames[$i] . "')";
    }

    //semi-colon on all but last query
    $query = $insertMember . "; " . $insertSGeneral . "; " . $insertSLeague . "; " . $insertSScoring . "; " . $insertSTeams . "; " .
			 $insertPassing . "; " . $insertRushing . "; " . $insertReceiving . "; " . $insertFumbles . "; " . $insertKicking . "; " . $insertReturns . "; " . $insertIdp . "; " . $insertDefense . "; " .
			 $insertTeamNames;

	$mysqli->multi_query($query);
	$mysqli->close();

    $_SESSION['memberId'] = $memberId;
    $memberId = $query;
	return $memberId;
}

function getDraftSettings( $memberId )
{
	$mysqli = getMySql();
	$result = $mysqli->query(
				"SELECT
					m.m_id				AS memberId,
					m.s_id				AS settingsId,
					sg.sg_draftType		AS general_draftType,
					sg.sg_season		AS general_season,
					sg.sg_positions		AS general_positions,
					sg.sg_adp			AS general_adp,
					sg.sg_leagueCap		AS general_leagueCap,
					sg.sg_aav			AS general_aav,
					sl.sl_qb			AS league_qb,
					sl.sl_rb			AS league_rb,
					sl.sl_wr			AS league_wr,
					sl.sl_te			AS league_te,
					sl.sl_k				AS league_k,
					sl.sl_dst			AS league_dst,
					sl.sl_dl			AS league_dl,
					sl.sl_lb			AS league_lb,
					sl.sl_db			AS league_db,
					sl.sl_wrTe			AS league_wrTe,
					sl.sl_wrRb			AS league_wrRb,
					sl.sl_wrRbTe		AS league_wrRbTe,
					sl.sl_qbWrRbTe		AS league_qbWrRbTe,
					sl.sl_dlLbDb		AS league_dlLbDb,
					sl.sl_bench			AS league_bench,
					ss.ss_vor			AS scoring_vor,
					scp.scp_passAttempts		AS scoring_passing_passAttempts,
					scp.scp_passComp			AS scoring_passing_passComp,
					scp.scp_passIncomp			AS scoring_passing_passIncomp,
					scp.scp_passYds				AS scoring_passing_passYds,
					scp.scp_passTds				AS scoring_passing_passTds,
					scp.scp_passTd40			AS scoring_passing_passTd40,
					scp.scp_passIntercept		AS scoring_passing_passIntercept,
					scp.scp_passBonus300		AS scoring_passing_passBonus300,
					scp.scp_passBonus350		AS scoring_passing_passBonus350,
					scp.scp_passBonus400		AS scoring_passing_passBonus400,
					scru.scru_rushDsp			AS scoring_rushing_rushDsp,
					scru.scru_rushYds			AS scoring_rushing_rushYds,
					scru.scru_rushAttempts		AS scoring_rushing_rushAttempts,
					scru.scru_rushTds	    	AS scoring_rushing_rushTds,
					scru.scru_rushTd40	    	AS scoring_rushing_rushTd40,
					scru.scru_rushConv	    	AS scoring_rushing_rushConv,
					scru.scru_rushSacks			AS scoring_rushing_rushSacks,
					scru.scru_rushBonus300		AS scoring_rushing_rushBonus300,
					scru.scru_rushBonus350		AS scoring_rushing_rushBonus350,
					scru.scru_rushBonus400		AS scoring_rushing_rushBonus400,
					scrc.scrc_receiveDsp		AS scoring_receive_receiveDsp,
					scrc.scrc_receiveYds		AS scoring_receive_receiveYds,
					scrc.scrc_receiveComp		AS scoring_receive_receiveComp,
					scrc.scrc_receiveTds		AS scoring_receive_receiveTds,
					scrc.scrc_receiveTd40		AS scoring_receive_receiveTd40,
					scrc.scrc_receiveBonus300	AS scoring_receive_receiveBonus300,
					scrc.scrc_receiveBonus350	AS scoring_receive_receiveBonus350,
					scrc.scrc_receiveBonus400	AS scoring_receive_receiveBonus400,
					scf.scf_fumbleDsp			AS scoring_fumbles_fumbleDsp,
					scf.scf_fumbles				AS scoring_fumbles_fumbles,
					sck.sck_kickEx				AS scoring_kicking_kickEx,
					sck.sck_kickFg19			AS scoring_kicking_kickFg19,
					sck.sck_kickFg29			AS scoring_kicking_kickFg29,
					sck.sck_kickFg39			AS scoring_kicking_kickFg39,
					sck.sck_kickFg49			AS scoring_kicking_kickFg49,
					sck.sck_kickFg50			AS scoring_kicking_kickFg50,
					sck.sck_kickFgMiss			AS scoring_kicking_kickFgMiss,
					scrt.scrt_returnDsp			AS scoring_returning_returnDsp,
					scrt.scrt_returnYds			AS scoring_returning_returnYds,
					scrt.scrt_returnTds			AS scoring_returning_returnTds,
					sci.sci_idpDsp			    AS scoring_idp_idpDsp,
					sci.sci_idpTackleSolo	    AS scoring_idp_idpTackleSolo,
					sci.sci_idpTackleAssist     AS scoring_idp_idpTackleAssist,
					sci.sci_idpSack		        AS scoring_idp_idpSack,
					sci.sci_idpForced		    AS scoring_idp_idpForced,
					sci.sci_idpRecovered	    AS scoring_idp_idpRecovered,
					sci.sci_idpIntercept	    AS scoring_idp_idpIntercept,
					sci.sci_idpDeflect		    AS scoring_idp_idpDeflect,
					sci.sci_idpTds			    AS scoring_idp_idpTds,
					sci.sci_idpSafety		    AS scoring_idp_idpSafety,
					scd.scd_defSack				AS scoring_defense_defSack,
					scd.scd_defRecovered		AS scoring_defense_defRecovered,
					scd.scd_defIntercept		AS scoring_defense_defIntercept,
					scd.scd_defTds				AS scoring_defense_defTds,
					scd.scd_defSafety			AS scoring_defense_defSafety,
					scd.scd_defBlock			AS scoring_defense_defBlock,
					scd.scd_defYds				AS scoring_defense_defYds,
					st.st_count			AS teams_count,
					st.st_userIndex		AS teams_userIndex,
					GROUP_CONCAT(tn.tn_teamName ORDER BY tn.tn_teamIndex ASC SEPARATOR ',') AS teams_teamNames
				FROM members m
				LEFT JOIN settingsGeneral sg ON m.s_id = sg.s_id
				LEFT JOIN settingsLeague sl ON m.s_id = sl.s_id
				LEFT JOIN settingsScoring ss ON m.s_id = ss.s_id
					LEFT JOIN scoringPassing scp ON m.s_id = scp.s_id
					LEFT JOIN scoringRushing scru ON m.s_id = scru.s_id
					LEFT JOIN scoringReceiving scrc ON m.s_id = scrc.s_id
					LEFT JOIN scoringFumbles scf ON m.s_id = scf.s_id
					LEFT JOIN scoringKicking sck ON m.s_id = sck.s_id
					LEFT JOIN scoringReturns scrt ON m.s_id = scrt.s_id
					LEFT JOIN scoringIdp sci ON m.s_id = sci.s_id
					LEFT JOIN scoringDefense scd ON m.s_id = scd.s_id
				LEFT JOIN settingsTeams st ON m.s_id = st.s_id
					LEFT JOIN teamNames tn ON m.s_id = tn.s_id
				WHERE m.m_id = '" . $memberId . "'"
				);
	$mysqli->close();

    $_SESSION['memberId'] = $memberId;
    return convertToSettings( $result->fetch_assoc() );
}

function getMySql()
{
    $mysqli = new mysqli( 'localhost', 'religiv3_admin', '1corinthians3:9', 'religiv3_football' );

	if ( $mysqli->connect_errno )
	{
		printf( "Connect failed: %s\n", $mysqli->connect_error );
		exit();
	}

	return $mysqli;
}
?>