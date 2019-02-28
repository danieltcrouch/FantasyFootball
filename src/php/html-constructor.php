<?php
include_once( "utility.php" );

function constructInputSections( $fileName )
{
    echo "<div style='display: flex; flex-wrap: wrap; justify-content: center'>\n\n";
    echo "<div style='flex-grow: 1; margin: 1em .5em'>";

    $isNewTable = true;
    foreach ( file("resources/$fileName.txt") as $index => $line )
    {
        if ( empty( trim( $line ) ) && $index !== 0 )
        {
            echo "</table>";
            echo "</div>\n\n\n";
            echo "<div style='flex-grow: 1; margin: 1em .5em'>";
            $isNewTable = true;
        }
        else
        {
            $isNewTable = constructInputs( $isNewTable, $line );
        }
    }

    if ( !$isNewTable )
    {
        echo "</table></div>\n\n";
    }
    echo "</div>";
}

function constructInputSection( $fileName )
{
    $isNewTable = true;
    foreach ( file("resources/$fileName.txt") as $index => $line )
    {
        $isNewTable = constructInputs( $isNewTable, $line );
    }

    if ( !$isNewTable )
    {
        echo "</table>\n\n";
    }
}

function constructInputs( $isNewTable, $line )
{
    $line = trim( $line );
    $lineArray = explode( "|", $line );
    if ( is_array( $lineArray ) && count( $lineArray ) > 1 )
    {
        if ( $isNewTable )
        {
            echo "<table style=\"text-align: right; vertical-align: center; width: 100%\">
                  <tr><td width=\"10%\"></td><td></td></tr>\n";
            $isNewTable = false;
        }

        array_walk( $lineArray, function( &$item ) { $item = trim( $item ); } );
        if ( $lineArray[2] === "number" )
        {
            echo "<tr><td><label for=\"$lineArray[0]\" class=\"label\">$lineArray[1]: </label></td><td><input  id=\"$lineArray[0]\" type=\"$lineArray[2]\" class=\"input\" style=\"margin: 0\" /></td></tr>\n";
        }
        elseif ( $lineArray[2] === "text" )
        {
            echo "<tr><td><label for=\"$lineArray[0]\" class=\"label\">$lineArray[1]: </label></td><td><input  id=\"$lineArray[0]\" type=\"$lineArray[2]\" class=\"input\" style=\"margin: 0\" placeholder=\"$lineArray[3]\" /></td></tr>\n";
        }
        elseif ( $lineArray[2] === "checkbox" )
        {
            echo "<tr><td colspan=\"2\" style=\"text-align: left\"><input  id=\"$lineArray[0]\" type=\"$lineArray[2]\" style=\"margin: 0 .5em\" /><label for=\"$lineArray[0]\">$lineArray[1]</label></td></tr>\n";
        }
    }
    else
    {
        if ( $line === "HR" )
        {
            echo "</table><hr/>\n\n";
            $isNewTable = true;
        }
        elseif ( $line )
        {
            echo "<span class=\"label\">$line</span>\n";
        }
    }

    return $isNewTable;
}

function generateTables( $tableSettings, $sectionMax = 3 )
{
    $positionTitles = array_keys( $tableSettings['positions'] );

    echo "<div style='display: flex; flex-wrap: wrap; justify-content: center'>\n";
   	for ( $teamIndex = 0; $teamIndex < $tableSettings['teamCount']; $teamIndex++ )
   	{
   		echo "<div><table id='player_$teamIndex' class='teamTable'>\n";
   		echo "   <tr><th id='player_$teamIndex" . "_header'>" . $tableSettings['teamNames'][$teamIndex] . "</th></tr>\n";

   		for ( $positionIndex = 0; $positionIndex < count( $positionTitles ); $positionIndex++ )
        {
            $positionCount = $tableSettings['positions'][$positionTitles[$positionIndex]];
            for ( $positionCountIndex = 0; $positionCountIndex < $positionCount; $positionCountIndex++ )
            {
                echo "   <tr><td id='player_$teamIndex" . "_cell_$positionTitles[$positionIndex]$positionCountIndex' class='empty'> " . strtoupper( $positionTitles[$positionIndex] ) . " </td></tr>\n";
            }
        }
   		echo "</table></div>\n";
   	}
    echo "</div>\n\n";
}

?>