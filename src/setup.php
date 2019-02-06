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

        <?php include("html/setup/general.html"); ?>
       	<?php include("html/setup/league.html"); ?>
       	<?php include("html/setup/scoring.html"); ?>
       	<?php include("html/setup/teams.html"); ?>
    </div>

</body>
<script>
    $(document).ready( function(){ hideAllTabs(); } );
    setTabCallbackToDisplay( "setup" );
</script>
<?php includeModals(); ?>
</html>