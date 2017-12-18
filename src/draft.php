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
    $_SESSION['memberId'] = $id;

	$settings = json_encode( getDraftSettings( $id ) );
    $players = json_encode( getPlayers() );
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

    <?php include("view/footer.html"); ?>
    <?php include("modals/info-modal.html"); ?>

	<script>
	/*
	TODO:
	Yardage is 100, 150, 200 for all but first
	Set default values from ESPN (be able to dynamically set to other site's default values)
	Convert all px to em
	Validate each field by input type
	    String needs to not allow comma so that that it can be put into array
	Send email with link to draft page and member ID
	*/
	
	var settings = <?php echo $settings; ?>;
	var teams = <?php echo $teamNames; ?>;
	var players = <?php echo $players; ?>;

	var optimalInfo;

	var activeTeam;

	var FINAL_PICK;
	var MAX_PLAYERS;

	$(document).ready(function () {
        $("#player").autocomplete( {source: players} );
       	$("#player").keyup(function(e){
       		if(e.keyCode == 13)
       		{
                submitPlayerPick();
       		}
       		if(e.keyCode == 9)
       		{
       			fillOptimalPlayer();
       		}
       	});

        MAX_PLAYERS = <?php echo getPlayerCountFromPositions( $settings['league'] ); ?>;
        FINAL_PICK = teams.length * MAX_PLAYERS;

		setDraftType( "<?php echo $settings['general']['draftType'] ?>" );
	});

    function setDraftType( type )
	{
		$("#draftType").text( "" + type );
		if ( type == "auction" )
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
        updateUserAssets( <?php echo $settings['general']['leagueCap']; ?> );
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
        if ( currentPick != FINAL_PICK )
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
        if ( pick % teams.length == 0 )
        {
            var round = pick / teams.length + 1;
            $("#round").text( "" + round );
        }
        $("#pick").text( "" + pick );

        var teamIndex = pick % teams.length;
        $("#team").text( "" + teams[ teamIndex ] );
        activeTeam = teamIndex;
    }

    function fillOptimalPlayer()
    {
        $("#player").val( $("#optimalPlayer").text().trim() );
    }

    function displayInfo()
    {
        $("#infoModal").toggle();
    }

    function updateInfo()
    {
        optimalInfo.optimalPlayer = getOptimalPlayer( players );
        //todo
    }
	</script>
	
</body>
</html>