<!DOCTYPE html>
<html>
<head>
	<title>Fantasy Value Draft</title>
	<link rel="shortcut icon" type="image/png" href="images/football.png"/>
	<link rel="stylesheet" type="text/css" href="styles/stylesheet.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="javascript/setup.js"></script>
</head>

<body>

	<?php
	session_start();
	?>
		
	<div class="titleBanner">
		<div class="title">Fantasy Value Draft</div>
	</div>
	<div class="navBar">
		<span class="navTab">General</span>
		<span class="navTab">League</span>
		<span class="navTab">Scoring</span>
		<span class="navTab">Teams</span>
	</div>
	
	<div class="content">
	</div>

    <?php include("view/footer.html"); ?>
	<?php include("html/auction-modal.html"); ?>
	
	<script>
	$(document).ready(function () {
		$(".tab").hide();
		$("#general").show();
		
		$("input[name='draftType']").change(function(){
			toggleDraftType( this );
		});
		$("#auctionButton").click(function(){
			$("#auctionModal").show();
		});
	});
	
	function toggleDraftType( radioButton )
	{
		if ( $(radioButton).val() == "auction" )
		{
            $("#auctionButton").show();
			$("#auctionModal").show();
		}
		else
        {
            $("#auctionButton").hide();
			$("#auctionModal").hide();
		}
	}
	
	function startDraft()
	{
		$.post(
			"utility/controller.php",
			{
				action: 	"storeDraftSettings",
				settings:	JSON.stringify( getSettings() )
			},
			function ( response ) {
				window.location.href = "https://auctiondraftonline.000webhostapp.com/fantasy_football/draft.php?memberId=" + response;
			}
		);
	}
	</script>
	
</body>
</html>