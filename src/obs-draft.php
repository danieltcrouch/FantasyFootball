<!DOCTYPE html>
<html>
<head>
	<title>Fantasy Value Draft</title>
	<link rel="shortcut icon" type="image/png" href="images/football.png"/>
	<link rel="stylesheet" type="text/css" href="styles/stylesheet.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="javascript/setup.js"></script>
	
	<!-- AutoComplete -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>

	<?php
	session_start();
	include_once("php/utility.php");
	include_once("php/database.php");


	$teamNames = $settings['teams']['teamNames'];

	?>
		
	<div class="titleBanner">
		<div class="title">Draft Center</div>
	</div>
	<div class="navBar">
		<span class="navPage" onclick="back()">Back</span>
		<span class="navPage" onclick="back()">Sandbox</span>
		<span class="navPage" onclick="back()">Sign-In</span>
	</div>
	
	<div class="content">
		<br/>
		<label>Draft Type: </label><span id="draftType">standard</span><br/>
		<label>Round: </label><span id="round">1</span>, <label>Pick: </label><span id="pick">1</span><br/>

		<div id="standardDisplay">
            <label>Active Team: </label><span id="team">You</span><br/>
            <button onclick="displayInfo()">Other Info</button><br/>
            <button onclick="fillOptimalPlayer()">Optimal Player</button><br/>

            <div class="inputSection">
                <input type="text" id="player" style="width: 60%;"/>
            </div>

            <label>Optimal Player: </label><span id="optimalPlayer">--</span>
            <br/>
            <br/>
           	<button onclick="submitPlayerPick()">Submit</button>
        </div>
		<div id="auctionDisplay">
            <label>User Assets: </label>$<span id="money">0</span><br/>
            This draft type is still under construction.
        </div>

		<?php generateTables( $settings['teams']['count'], $settings['league'], $teamNames ); ?>
	</div>


	<script>
	</script>
	
</body>
</html>