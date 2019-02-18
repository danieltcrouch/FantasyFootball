<div id="teams" class="col-10 tab setupTab center" style="display: none">
	<div class="center" style="font-size: 1.5em; margin-bottom: 1em">Teams</div>

	<div>
		<label for="teamCount" class="label">Number of Teams: </label>
		<select id="teamCount" class="select" onchange="updateTeams()">
			<option value="2">2 (for Testing)</option>
			<option value="8">8</option>
			<option value="10">10</option>
			<option value="12">12</option>
		</select>
	</div>

	<div>
		<label for="userIndex" class="label">Your Order in the Draft: </label>
		<select id="userIndex" class="select">
			<option value="1">1</option>
			<option value="2">2</option>
		</select>
	</div>

	<div id="teamNames">
		<span class="label">Team Names</span>
	</div>
</div>

<script>
$(document).ready(function () {
	updateTeams();
});

function updateTeams()
{
	var indexSelect = document.getElementById("userIndex");
    indexSelect.options.length = 0;
    for ( i = 0; i < getTeamCount(); i++ )
    {
        var option = document.createElement("option");
        option.text = i + 1 + "";
        indexSelect.add( option );
    }

	var nameContainer = document.getElementById("teamNames");
	while (nameContainer.hasChildNodes())
	{
        nameContainer.removeChild( nameContainer.lastChild );
	}
	
    var span = document.createElement("span");
    span.innerText = "Team Names";
    span.classList.add( "label" );
    nameContainer.appendChild(span);

	for ( var i = 1; i <= getTeamCount(); i++ )
	{
		addTeam( nameContainer, i );
	}
}

function addTeam( container, index )
{
	var input = document.createElement("input");
	input.type = "text";
	input.id = "t" + index;
	input.name = "teamNames";
	input.pattern = "[a-zA-Z0-9!@#$%^*_|]{6,25}";
    input.placeholder = "Team " + index;
    input.classList.add( "input" );
    container.appendChild(input);
}
</script>
