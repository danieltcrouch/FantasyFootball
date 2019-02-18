<?php include("$_SERVER[DOCUMENT_ROOT]/php/startup.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <?php includeHeadInfo(); ?>
</head>

<body>

	<!--Header-->
    <?php includeHeader(); ?>
    <div class="col-10 header">
        <div class="title center"><span class="clickable">
            Fantasy Value Draft
            <img style="width: .5em; padding-bottom: .25em" src="<?php getHelpImage() ?>" alt="help">
        </span></div>
        <div id="instructions" style="display: none">
            Use this Fantasy Football Draft tool to determine the most efficient draft picks. Compare this tool to <a class="link" href="http://fantasyfootballanalytics.net/">FantasyFootballAnalytics</a>.
        </div>
    </div>

    <!--Main-->
    <div class="col-10 main">
        <div class="subtitle center">Set-up Draft Now!</div>
        <div class="center">
            <button class="button" style="width: 10em; margin-top: 1em" onclick="goToSetup()">Start Set-Up</button>
        </div>
        <div class="center">
            <button class="button" style="width: 10em; margin-top: 1em" onclick="login()">Login</button>
        </div>
    </div>

</body>
<script>
    function goToSetup()
    {
        window.location = "https://football.religionandstory.com/setup.php";
    }

    function login()
    {
        var memberId = "<?php echo $_SESSION['memberId']; ?>";
        if ( memberId )
        {
            window.location = "https://football.religionandstory.com/draft.php?memberId=" + memberId;
        }
        else
        {
            showPrompt( "Login", "Enter Member ID:", function(id) {
                if ( id )
                {
                    window.location = "https://football.religionandstory.com/draft.php?memberId=" + id;
                }
            } );
        }
    }
</script>
<?php includeModals(); ?>
</html>