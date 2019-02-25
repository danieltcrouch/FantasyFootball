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
		<select id="userIndex" class="select"></select>
	</div>

	<div id="teamNames">
		<span class="label">Team Names</span>
	</div>
</div>

<script>
var MAX_TEAMS = 12;
$(document).ready(function () {
    createOptions();
	updateTeams();
});

function createOptions()
{
    var options = document.getElementById("teamCount").options;
    MAX_TEAMS = options[options.length - 1].value; //double-check

    var indexSelect = document.getElementById("userIndex");
    var nameContainer = document.getElementById("teamNames");
    for ( var i = 0; i < MAX_TEAMS; i++ )
    {
        var option = document.createElement("option");
        option.text = i + 1 + "";
        indexSelect.add( option );

        addTeam( nameContainer, i + 1 );
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

function updateTeams()
{
    var indexSelect = document.getElementById("userIndex");
    for ( var i = 0; i < MAX_TEAMS; i++ )
    {
        if ( i < getTeamCount() )
        {
            $( indexSelect.options[i] ).show();
            $( "#t" + (i+1) ).show();
        }
        else
        {
            $( indexSelect.options[i] ).hide();
            $( "#t" + (i+1) ).hide();
            $( "#t" + (i+1) ).val( "" );
        }
    }
}
</script>
