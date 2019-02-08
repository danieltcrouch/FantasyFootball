<div id="general" class="col-10 tab setupTab center" style="display: none">
	<div class="center" style="font-size: 1.5em">Draft Type</div>
    <br/>

	<div class="center" style="margin-bottom: 1em">
		<button id="standard"  name="draftType" class="button inverseButton" style="width: 6em; margin: .25em;">Standard</button>
		<button id="auction"   name="draftType" class="button inverseButton" style="width: 6em; margin: .25em;">Auction</button>
	</div>
    <button id="auctionSettings" class="button" style="display: none; margin-bottom: 1em">Auction Settings</button>

	<div>
		<label for="season" class="label">Season: </label><span id="season">Current Season</span>
	</div>
	<div>
		<label for="positions" class="label">Positions: </label><span id="positions">IDP not included</span>
	</div>
	<div>
		<label for="adp" class="label">ADP Source: </label><span id="adp">Auto-calculated</span>
	</div>
</div>

<script>
    setRadioCallback( "draftType", function ( draftType )
    {
        if ( draftType === "auction" )
        {
            $("#auctionSettings").show();
            openAuctionModal();
        }
        else
        {
            $("#auctionSettings").hide();
            $("#auctionModal").hide();
        }
    } );

    $("#auctionSettings").click( function(){
        openAuctionModal();
    } );
</script>
