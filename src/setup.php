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
        <div class="col-8 navBar">
            <div class="col-2 navButton center" onclick="">General</div>
            <div class="col-2 navButton center" onclick="">League</div>
            <div class="col-2 navButton center" onclick="">Scoring</div>
            <div class="col-2 navButton center" onclick="">Teams</div>
        </div>

        <?php include("html/setup/general.html"); ?>
       	<?php include("html/setup/league.html"); ?>
       	<?php include("html/setup/scoring.html"); ?>
       	<?php include("html/setup/teams.html"); ?>
    </div>

</body>
<script>
    //
</script>
<?php includeModals(); ?>
</html>