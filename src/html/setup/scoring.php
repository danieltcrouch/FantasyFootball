<div id="scoring" class="col-10 tab setupTab center">
	<div class="center" style="font-size: 1.5em">Scoring</div>

	<fieldset style="text-align: left">
		<legend>Passing</legend>
		<label for="passAttempts">Pass Attempts: </label>		<input type="number" id="passAttempts" />
		<label for="passComp">Pass Completions: </label>		<input type="number" id="passComp" />
		<label for="passIncomp">Pass Incompletions: </label>	<input type="number" id="passIncomp" />
		<hr/>
		<label for="passYds">Passing Yds (Pts/Yds): </label>	<input type="text" id="passYds" placeholder="1/25"/>
		<label for="passTds">Pass TDs: </label>					<input type="number" id="passTds" />
		<label for="passTd40">40 Yd Pass Td: </label>			<input type="number" id="passTd40" />
		<hr/>
		<label for="passIntercept">Interceptions: </label>		<input type="number" id="passIntercept" />
		<hr/>
		<label for="passBonus300">300 Yd Pass Bonus: </label>	<input type="number" id="passBonus300" />
		<label for="passBonus350">350 Yd Pass Bonus: </label>	<input type="number" id="passBonus350" />
		<label for="passBonus400">400 Yd Pass Bonus: </label>	<input type="number" id="passBonus400" />
	</fieldset>
	<br />
	<fieldset style="text-align: left">
		<legend>Rushing</legend>
		<input type="checkbox" id="rushDsp" /><label for="rushDsp"> Different Scoring by Position</label>
		<hr/>
		<label for="rushYds">Rushing Yds (Pts/Yds): </label>	<input type="text" id="rushYds" placeholder="1/10"/>
		<label for="rushAttempts">Rushing Attempts: </label>	<input type="number" id="rushAttempts" /><br/>
		<label for="rushTds">Rushing TDs: </label>				<input type="number" id="rushTds" />
		<label for="rushTd40">40 Yd Rush TD: </label>			<input type="number" id="rushTd40" />
		<hr/>
		<label for="rushConv">2Pt Conversions: </label>			<input type="number" id="rushConv" />
		<hr/>
		<label for="rushSacks">Sacks: </label>					<input type="number" id="rushSacks" />
		<hr/>
		<label for="rushBonus300">300 Yd Pass Bonus: </label>	<input type="number" id="rushBonus300" />
		<label for="rushBonus350">350 Yd Pass Bonus: </label>	<input type="number" id="rushBonus350" />
		<label for="rushBonus400">400 Yd Pass Bonus: </label>	<input type="number" id="rushBonus400" />
	</fieldset>
	<br />
	<fieldset style="text-align: left">
		<legend>Receiving</legend>
		<input type="checkbox" id="receiveDsp" /><label for="receiveDsp"> Different Scoring by Position</label>
		<hr/>
		<label for="receiveYds">Receiving Yds (Pts/Yds): </label>	<input type="text" id="receiveYds" placeholder="1/10"/>
		<label for="receiveComp">Receptions: </label>				<input type="number" id="receiveComp" /><br/>
		<label for="receiveTds">Receiving TDs: </label>				<input type="number" id="receiveTds" />
		<label for="receiveTd40">40 Yd Receiving TD: </label>		<input type="number" id="receiveTd40" />
		<hr/>
		<label for="receiveBonus300">300 Yd Receiving Bonus: </label>	<input type="number" id="receiveBonus300" />
		<label for="receiveBonus350">350 Yd Receiving Bonus: </label>	<input type="number" id="receiveBonus350" />
		<label for="receiveBonus400">400 Yd Receiving Bonus: </label>	<input type="number" id="receiveBonus400" />
	</fieldset>
	<br />
	<fieldset style="text-align: left">
		<legend>Fumbles</legend>
		<input type="checkbox" id="fumbleDsp" /><label for="fumbleDsp"> Different Scoring by Position</label>
		<hr/>
		<label for="fumbles">Fumbles Lost: </label><input type="number" id="fumbles" />
	</fieldset>
	<br />
	<fieldset style="text-align: left">
		<legend>Kicking</legend>
		<label for="kickEx">Extra Pts: </label>	<input type="number" id="kickEx" />
		<hr/>
		<label for="kickFg19">Field Goals 0-19 Yds: </label>	<input type="number" id="kickFg19" />
		<label for="kickFg29">Field Goals 20-29 Yds: </label>	<input type="number" id="kickFg29" /><br/>
		<label for="kickFg39">Field Goals 30-39 Yds: </label>	<input type="number" id="kickFg39" />
		<label for="kickFg49">Field Goals 40-49 Yds: </label>	<input type="number" id="kickFg49" />
		<label for="kickFg50">Field Goals 50+ Yds: </label>		<input type="number" id="kickFg50" />
		<hr/>
		<label for="kickFgMiss">Missed Field Goals: </label>	<input type="number" id="kickFgMiss" />
	</fieldset>
	<br />
	<fieldset style="text-align: left">
		<legend>Returns</legend>
		<input type="checkbox" id="returnDsp" /><label for="returnDsp"> Different Scoring by Position</label>
		<hr/>
		<label for="returnYds">Return Yds (Pts/Yds): </label>	<input type="text" id="returnYds" placeholder="1/10"/>
		<label for="returnTds">Return TDs: </label>				<input type="number" id="returnTds" />
	</fieldset>
	<br />
	<fieldset style="text-align: left">
		<legend>IDP Scoring</legend>
		<input type="checkbox" id="idpDsp" /><label for="idpDsp"> Different Scoring by Position</label>
		<hr/>
		<label for="idpTackleSolo">Solo Tackle: </label>		<input type="number" id="idpTackleSolo" />
		<label for="idpTackleAssist">Assisted Tackle: </label>	<input type="number" id="idpTackleAssist" />
		<label for="idpSack">Sacks: </label>					<input type="number" id="idpSack" />
		<hr/>
		<label for="idpForced">Forced Fumble: </label>			<input type="number" id="idpForced" />
		<label for="idpRecovered">Recovered Fumble: </label>	<input type="number" id="idpRecovered" />
		<hr/>
		<label for="idpIntercept">Interceptions: </label>		<input type="number" id="idpIntercept" />
		<label for="idpDeflect">Pass Deflection: </label>		<input type="number" id="idpDeflect" />
		<hr/>
		<label for="idpTds">TDs: </label>						<input type="number" id="idpTds" />
		<label for="idpSafety">Safety: </label>					<input type="number" id="idpSafety" />
	</fieldset>
	<br />
	<fieldset style="text-align: left">
		<legend>Team Defense</legend>
		<label for="defSack">Sacks: </label>					<input type="number" id="defSack" />
		<label for="defRecovered">Recovered Fumble: </label>	<input type="number" id="defRecovered" />
		<label for="defIntercept">Interceptions: </label>		<input type="number" id="defIntercept" />
		<hr/>
		<label for="defTds">TDs: </label>						<input type="number" id="defTds" />
		<label for="defSafety">Safety: </label>					<input type="number" id="defSafety" />
		<hr/>
		<label for="defBlock">Blocked Kicks: </label>			<input type="number" id="defBlock" />
		<hr/>
		<label for="defYds">Return Yds (Pts/Yds): </label>		<input type="text" id="defYds" placeholder="1/10"/>
	</fieldset>
	<br />
	<div class="inputSection">
		<label for="vor">VOR Baseline: </label><span id="vor">Determined by scoring input</span>
	</div>
</div>