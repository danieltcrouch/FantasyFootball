<!DOCTYPE html>
<html>
<head>
	<title>Fantasy Value Draft</title>
	<link rel="shortcut icon" type="image/png" href="resources/football.png"/>
	<link rel="stylesheet" type="text/css" href="styles/stylesheet.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="utility/utility.js"></script>
</head>

<body>

	<?php
	session_start();
	?>

	<div class="imageBanner" style="background-image: url(resources/football_banner.jpeg); height: 300px;"></div>
	<div class="titleBanner">
		<div class="subTitle">Welcome to</div>
		<div class="title">Fantasy Value Draft</div>
	</div>

	<div class="content">
		<button onclick="gotoSetUp()">Enter Site</button>
	</div>

    <?php include("view/footer.html"); ?>

	<script>
	function gotoSetUp()
	{
		window.location.href = "https://auctiondraftonline.000webhostapp.com/fantasy_football/setup.php";
	}
	</script>

</body>
</html>