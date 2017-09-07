<!DOCTYPE html>
<html>
<head>
	<title>Fantasy Value Draft</title>
	<link rel="shortcut icon" type="image/png" href="resources/football.png"/>
	<link rel="stylesheet" type="text/css" href="styles/stylesheet.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="utility/utility.js"></script>
	
	<!-- AutoComplete -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>

	<?php
	session_start();
	include_once( "utility/utility.php" );
	include_once( "utility/database.php" );

	$id = ( isset($_GET['memberId']) ? $_GET['memberId'] : $_SESSION['memberId'] );

	$settings = json_encode( getDraftSettings( $id ) );
	$teamCount = $settings['teams']['count'];
	$teamNames = $settings['teams']['teamNames'];
	$playerCount = getPlayerCountFromPositions( $settings['general']['positions'] );
	$draftType = $settings['general']['draftType'];
	$leagueCap = $settings['general']['leagueCap'];
	
	$players = json_encode( getPlayers() );
	?>
		
	<div class="titleBanner">
		<div class="title">Draft Center</div>
	</div>
	<div class="navBar">
		<span class="navPage" onclick="back()">Back</span>
		<span class="navPage" onclick="back()">Sign-In</span>
	</div>
	
	<div class="content">
		<br/>
		<label>Draft Type: </label><span id="draftType">standard</span><br/>
		<span id="moneyDisplay"><label>User Assets: </label>$<span id="money">0</span></span><br/>
		<label>Click a cell below.</label><br/><br/>
		
		<?php include("pages/player-tables.php"); ?>
	</div>
	
	<?php include("modals/player-modal.html"); ?>

	<div class="footerBanner">
		<div class="footer">Fantasy Value Draft | <a href="/">About</a> | <a href="mailto:stephen.s.crouch@gmail.com">Contact</a></div>
	</div>

	<script>
	/*
	TODO:
	Yardage is 100, 150, 200 for all but first
	Instead of placeholders, have default values?
	footer to php include
	Convert all px to em
	Ask Keith about organization

	Number of teams, Order in Draft

	Layout:
	Send to Draft page, have link to sandbox
	Send email with link to both and member ID
	draft page (and sandbox) is relative to draft type
	All pages should have "Undo"
	    Standard
	In order: enter team picks (display round and pick number and team Name)
	Be able to see team names and their present picks
	See your optimal team? (with bye? and pick?)
	See your best pick (and make it selectable)
	See next three top picks?
    See various lists by position? (e.g. Best by VOR)
    Display points?
    Display PPP?
	    Auction
    ...
        Sandbox
    Auto Draft
	*/
	
	var settings = <?php echo $settings; ?>;
	var players = <?php echo $players; ?>;
	var activeCell;
	
	$(document).ready(function () {
		$("td").click(function () {
			activeCell = this;
			$("#playerModal").show();
		});
		
		setDraftType( "<?php echo $draftType ?>", <?php echo $leagueCap ?> );
	});
	
	function setDraftType( type, money )
	{
		$("#draftType").text( "" + type );
		if ( type == "auction" )
		{
			$("#moneyDisplay").show();
			updateMoneyDisplay( money );
		}
		else
		{
			$("#moneyDisplay").hide();
		}
	}

	function payMoney( cost )
	{
		if ( $("#draftType").text() == "auction" )
		{
			var userIndex = settings.teams.userIndex;
			var teamIndex = $( activeCell ).attr( 'id' ).split( "_" )[1];
			if ( teamIndex == userIndex )
			{
				var money = parseInt( $("#money").text().trim() );
				money -= cost;
				updateMoneyDisplay( money );
			}
		}
	}

	function updateMoneyDisplay( money )
	{
		$("#money").text( "" + money );
	}
	</script>
	
</body>
</html>