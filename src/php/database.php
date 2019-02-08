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
											 VALUES ('" . $settingsId . "', " . $settings->scoring->passing->passAttempts . ", " . $settings->scoring->passing->passComp . ", " . $settings->scoring->passing->passIncomp . ", '" . $settings->scoring->passing->passYds . "', " . $settings->scoring->passing->passTds . ", " . $settings->scoring->passing->passTd40 . ", " . $settings->scoring->passing->passIntercept . ", " . $settings->scoring->passing->passBonus300 . ", " . $settings->scoring->passing->passBonus350 . ", " . $settings->scoring->passing->passBonus400 . ")";
	$insertRushing	= "INSERT INTO scoringRushing	(s_id, scru_rushDsp, scru_rushYds, scru_rushAttempts, scru_rushTds, scru_rushTd40, scru_rushConv, scru_rushSacks, scru_rushBonus300, scru_rushBonus350, scru_rushBonus400)
											 VALUES ('" . $settingsId . "', " . $settings->scoring->rushing->rushDsp . ", '" . $settings->scoring->rushing->rushYds . "', " . $settings->scoring->rushing->rushAttempts . ", " . $settings->scoring->rushing->rushTds . ", " . $settings->scoring->rushing->rushTd40 . ", " . $settings->scoring->rushing->rushConv . ", " . $settings->scoring->rushing->rushSacks . ", " . $settings->scoring->rushing->rushBonus300 . ", " . $settings->scoring->rushing->rushBonus350 . ", " . $settings->scoring->rushing->rushBonus400 . ")";
	$insertReceiving= "INSERT INTO scoringReceiving	(s_id, scrc_receiveDsp, scrc_receiveYds, scrc_receiveComp, scrc_receiveTds, scrc_receiveTd40, scrc_receiveBonus300, scrc_receiveBonus350, scrc_receiveBonus400)
											 VALUES ('" . $settingsId . "', " . $settings->scoring->receiving->receiveDsp . ", '" . $settings->scoring->receiving->receiveYds . "', " . $settings->scoring->receiving->receiveComp . ", " . $settings->scoring->receiving->receiveTds . ", " . $settings->scoring->receiving->receiveTd40 . ", " . $settings->scoring->receiving->receiveBonus300 . ", " . $settings->scoring->receiving->receiveBonus350 . ", " . $settings->scoring->receiving->receiveBonus400 . ")";
	$insertFumbles	= "INSERT INTO scoringFumbles	(s_id, scf_fumbleDsp, scf_fumbles)
											 VALUES ('" . $settingsId . "', " . $settings->scoring->fumbles->fumbleDsp . ", " . $settings->scoring->fumbles->fumbles . ")";
	$insertKicking	= "INSERT INTO scoringKicking	(s_id, sck_kickEx, sck_kickFg19, sck_kickFg29, sck_kickFg39, sck_kickFg49, sck_kickFg50, sck_kickFgMiss)
											 VALUES ('" . $settingsId . "', " . $settings->scoring->kicking->kickEx . ", " . $settings->scoring->kicking->kickFg19 . ", " . $settings->scoring->kicking->kickFg29 . ", " . $settings->scoring->kicking->kickFg39 . ", " . $settings->scoring->kicking->kickFg49 . ", " . $settings->scoring->kicking->kickFg50 . ", " . $settings->scoring->kicking->kickFgMiss . ")";
	$insertReturns	= "INSERT INTO scoringReturns	(s_id, scrt_returnDsp, scrt_returnYds, scrt_returnTds)
											 VALUES ('" . $settingsId . "', " . $settings->scoring->returns->returnDsp . ", '" . $settings->scoring->returns->returnYds . "', " . $settings->scoring->returns->returnTds . ")";
	$insertIdp		= "INSERT INTO scoringIdp		(s_id, sci_idpDsp, sci_idpTackleSolo, sci_idpTackleAssist, sci_idpSack, sci_idpForced, sci_idpRecovered, sci_idpIntercept, sci_idpDeflect, sci_idpTds, sci_idpSafety)
											 VALUES ('" . $settingsId . "', " . $settings->scoring->idp->idpDsp . ", " . $settings->scoring->idp->idpTackleSolo . ", " . $settings->scoring->idp->idpTackleAssist . ", " . $settings->scoring->idp->idpSack . ", " . $settings->scoring->idp->idpForced . ", " . $settings->scoring->idp->idpRecovered . ", " . $settings->scoring->idp->idpIntercept . ", " . $settings->scoring->idp->idpDeflect . ", " . $settings->scoring->idp->idpTds . ", " . $settings->scoring->idp->idpSafety . ")";
	$insertDefense	= "INSERT INTO scoringDefense	(s_id, scd_defSack, scd_defRecovered, scd_defIntercept, scd_defTds, scd_defSafety, scd_defBlock, scd_defYds)
											 VALUES ('" . $settingsId . "', " . $settings->scoring->defense->defSack . ", " . $settings->scoring->defense->defRecovered . ", " . $settings->scoring->defense->defIntercept . ", " . $settings->scoring->defense->defTds . ", " . $settings->scoring->defense->defSafety . ", " . $settings->scoring->defense->defBlock . ", '" . $settings->scoring->defense->defYds . "')";
	
	$insertTeamNames= "INSERT INTO teamNames        (s_id, tn_teamIndex, tn_teamName)
                                             VALUES ";
	for ( $i = 0; $i < $settings->teams->count; $i++ )
    {
        if ($i != 0)
        {
            $insertTeamNames .= ", ";
        }
        $insertTeamNames .= "('" . $settingsId . "', " . $i . ", '" . $settings->teams->teamNames[$i] . "')";
        //todo - change this to implode logic and make inline like the others
    }

    //semi-colon on all but last query
    $query = $insertMember . "; " . $insertSGeneral . "; " . $insertSLeague . "; " . $insertSScoring . "; " . $insertSTeams . "; " .
			 $insertPassing . "; " . $insertRushing . "; " . $insertReceiving . "; " . $insertFumbles . "; " . $insertKicking . "; " . $insertReturns . "; " . $insertIdp . "; " . $insertDefense . "; " .
			 $insertTeamNames;

	$mysqli->multi_query($query);
	$mysqli->close();

    $_SESSION['memberId'] = $memberId;
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
				JOIN settingsGeneral sg ON m.s_id = sg.s_id
				JOIN settingsLeague sl ON m.s_id = sl.s_id
				JOIN settingsScoring ss ON m.s_id = ss.s_id
					JOIN scoringPassing scp ON m.s_id = scp.s_id
					JOIN scoringRushing scru ON m.s_id = scru.s_id
					JOIN scoringReceiving scrc ON m.s_id = scrc.s_id
					JOIN scoringFumbles scf ON m.s_id = scf.s_id
					JOIN scoringKicking sck ON m.s_id = sck.s_id
					JOIN scoringReturns scrt ON m.s_id = scrt.s_id
					JOIN scoringIdp sci ON m.s_id = sci.s_id
					JOIN scoringDefense scd ON m.s_id = scd.s_id
				JOIN settingsTeams st ON m.s_id = st.s_id
					LEFT JOIN teamNames tn ON m.s_id = tn.s_id
				WHERE m.m_id = '" . $memberId . "'"
				);
	$mysqli->close();

    $_SESSION['memberId'] = $memberId;
    return convertToSettings( $result->fetch_assoc() );
}

function getMySql()
{
    //todo
    //$mysqli = new mysqli( 'localhost', 'religiv3_admin', '1corinthians3:9', 'religiv3_turing' );
	$mysqli = new mysqli( 'localhost', 'id125953_dcrouch1', '1corinthians619', 'id125953_auctiondraftonline' );
	
	if ( $mysqli->connect_errno )
	{
		printf( "Connect failed: %s\n", $mysqli->connect_error );
		exit();
	}

	return $mysqli;
}
?>