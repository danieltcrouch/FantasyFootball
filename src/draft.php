<?php include("$_SERVER[DOCUMENT_ROOT]/php/startup.php"); ?>
<?php
include_once( "utility.php" );
validateMemberId( $_SESSION['memberId'] );
?>
<!DOCTYPE html>
<html>
<head>
    <?php includeHeadInfo(); ?>
    <script src="javascript/draft.js"></script>
    <!-- AutoComplete -->
   	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>

	<!--Header-->
    <?php includeHeader(); ?>
    <div class="col-10 header">
        <div class="title center"><span class="clickable">
            Draft Center
            <img style="width: .5em; padding-bottom: .25em" src="<?php getHelpImage() ?>" alt="help">
        </span></div>
        <div id="instructions" style="display: none">
            ...
        </div>
    </div>

    <!--Main-->
    <div class="col-10 main">
        <div>
       		<label for="draftType" class="label">Draft Type: </label><span id="draftType">Standard</span>
       	</div>
        <div>
            <label for="round" class="label">Round: </label><span id="round">1</span>,
            <label for="pick"  class="label">Pick: </label><span id="pick">1</span>
       	</div>

        <div id="standardDisplay">
            <div>
                <label for="team" class="label">Active Team: </label><span id="team">You</span>
            </div>
            <button onclick="displayInfo()">Other Info</button><br/>
            <button onclick="fillOptimalPlayer()">Optimal Player</button><br/>

            <div>
                <label for="optimalPlayer" class="label">Optimal Player: </label><span id="optimalPlayer">--</span>
            </div>

            <div>
                <input id="player" type="text" placeholder="Player Name"/>
            </div>
            <button style="margin-top: 2em" onclick="submitPlayerPick()">Submit</button>
        </div>
        <div id="auctionDisplay" style="display: none">
            <div>
                <label for="money" class="label">User Assets: </label>$<span id="money">0</span>
            </div>
            This draft type is still under construction.
        </div>

        <?php
        include_once( 'php/html-constructor.php' );
        //todo - generateTables( $settings['teams']['count'], $settings['league'], $teamNames );
        ?>
    </div>

</body>
<script>
    loadSettings( "<?php echo $_GET['memberId']; ?>" );
</script>
<?php include("html/info-modal.html"); ?>
<?php includeModals(); ?>
</html>