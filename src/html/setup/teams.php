<div id="teams" class="col-10 tab setupTab center">
	<div class="center" style="font-size: 1.5em">Teams</div>
	<div>
		<label for="teamCount">Number of Teams: </label>
		<select onchange="updateTeamNames()" id="teamCount">
			<option value="2">2 (for Testing)</option>
			<option value="8">8</option>
			<option value="10">10</option>
			<option value="12">12</option>
		</select>
	</div>
	<div>
		<label for="userIndex">Your Order in the Draft: </label>
		<select id="userIndex">
			<option value="1">1</option>
			<option value="2">2</option>
		</select>
	</div>
	<fieldset id="teamNames">
		<legend>Team Names</legend>
	</fieldset>
	<button onclick="startDraft()">Start Draft!</button>
</div>

<script>
$(document).ready(function () {
	updateTeamNames();
});

function updateTeamNames()
{
	var container = document.getElementById("teamNames");
	while (container.hasChildNodes())
	{
		container.removeChild( container.lastChild );
	}
	
	addLegend( container );
	for (var i = 1; i <= getTeamCount(); i++)
	{
		addTeam( container, i );
	}
}

function addLegend( container )
{
	var legend = document.createElement("legend");
	legend.innerText = "Team Names";
	container.appendChild(legend);
}

function addTeam( container, index )
{
	var div = document.createElement("div");
	div.class = "inputSection";
	
	var input = document.createElement("input");
	input.type = "text";
	input.id = "t" + index;
	input.name = "teamNames";
	input.style = "width: 200px;";
	input.pattern = "[a-zA-Z0-9!@#$%^*_|]{6,25}";
	input.placeholder = "Team " + index;
	div.appendChild(input);
	container.appendChild(div);
}
</script>