<?php include("$_SERVER[DOCUMENT_ROOT]/php/startup.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <?php
    $pageTitle  = "Fantasy Draft Setup";
    includeHeadInfo();
    ?>
    <script src="javascript/setup.js"></script>
</head>

<body>

	<!--Header-->
    <?php includeHeader(); ?>
    <div class="col-10 header">
        <div class="title center"><span class="clickable">
            Fantasy Draft Setup
            <img style="width: .5em; padding-bottom: .25em" src="<?php getHelpImage() ?>" alt="help">
        </span></div>
        <div id="instructions" style="display: none">
            More specific instructions coming...
        </div>
    </div>

    <!--Main-->
    <div class="col-10 main">
        <div class="col-10 navBar" style="padding: 0 10%; margin-bottom: 2em">
            <button id="general" name="setup" class="col-2h navButton inverseTab center">General</button>
            <button id="league"  name="setup" class="col-2h navButton inverseTab center">League</button>
            <button id="scoring" name="setup" class="col-2h navButton inverseTab center">Scoring</button>
            <button id="teams"   name="setup" class="col-2h navButton inverseTab center">Teams</button>
        </div>

        <?php include("html/setup/general.php"); ?>
       	<?php include("html/setup/league.php"); ?>
       	<?php include("html/setup/scoring.php"); ?>
       	<?php include("html/setup/teams.php"); ?>

        <div class="col-10 center">
            <button id="next" class="button" style="width: 6em" onclick="displayNextTab( 'setup' )">Next</button>
            <button id="next" class="button" style="width: 6em; display: none" onclick="finishSetup()">Finish</button>
        </div>
    </div>

</body>
<script>
    $(document).ready( function(){ hideAllTabs(); } );

    setTabCallbackToDisplay( "setup" );

    function finishSetup()
    {
        $.post(
            "utility/controller.php",
            {
                action: 	"storeDraftSettings",
                settings:	JSON.stringify( getSettings() )
            },
            function ( response ) {
                window.location.href = "https://football.religionandstory.com/draft.php?memberId=" + response;
            }
        );
    }
</script>
<?php includeModals(); ?>
</html>