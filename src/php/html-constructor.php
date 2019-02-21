<?php
include_once( "utility.php" );

function constructInputSections( $fileName )
{
    echo "<div>";

    $isNewTable = true;
    foreach ( file("resources/$fileName.txt") as $index => $line )
    {
        if ( empty( $line ) && $index !== 0 )
        {
            echo "</table>";
            echo "</div>\n\n";
            echo "<div>";
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
    $line = explode( "|", $line );
    if ( is_array( $line ) && count( $line ) > 1 )
    {
        if ( $isNewTable )
        {
            echo "<table style=\"text-align: right; vertical-align: center; width: 100%\">
                  <tr><td width=\"10%\"></td><td></td></tr>\n";
            $isNewTable = false;
        }

        array_walk( $line, function( &$item ) { $item = trim( $item ); } );
        if ( $line[2] === "number" )
        {
            echo "<tr><td><label for=\"$line[0]\" class=\"label\">$line[1]: </label></td><td><input  id=\"$line[0]\" type=\"$line[2]\" class=\"input\" style=\"margin: 0\" /></td></tr>\n";
        }
        elseif ( $line[2] === "text" )
        {
            echo "<tr><td><label for=\"$line[0]\" class=\"label\">$line[1]: </label></td><td><input  id=\"$line[0]\" type=\"$line[2]\" class=\"input\" style=\"margin: 0\" placeholder=\"$line[3]\" /></td></tr>\n";
        }
        elseif ( $line[2] === "checkbox" )
        {
            echo "<tr><td colspan=\"2\" style=\"text-align: left\"><input  id=\"$line[0]\" type=\"$line[2]\" style=\"margin: 0 .5em\" /><label for=\"$line[0]\">$line[1]</label></td></tr>\n";
        }
    }
    else
    {
        $line = trim( implode( $line ) ) . "";
        if ( $line === "HR" )
        {
            echo "</table><hr/>\n\n";
            $isNewTable = true;
        }
        elseif ( $line )
        {
            echo "<span class=\"label\">$line</span>";
        }
    }

    return $isNewTable;
}

function generateTables( $teamCount, $leaguePositions, $teamNames )
{
    $positionTitles = array_keys( $leaguePositions );

    echo "\r\n";
   	for ( $i = 1; $i <= $teamCount; $i++ )
   	{
   		echo "<table id='player_" . $i . "'>\r\n";
   		echo "   <tr>\r\n";
   		echo "      <th id='player_" . $i . "_header'>" . $teamNames[$i] . "</th>\r\n";
   		echo "   </tr>\r\n";

   		for ( $j = 1; $j <= getPlayerCountFromPositions( $leaguePositions ); $j++ )
   		{
   			echo "   <tr>\r\n";
   			echo "      <td id='player_" . $i . "_cell" . $j . "'> " . $positionTitles[$j] . " </td>\r\n";
   			echo "   </tr>\r\n";
   		}
   		echo "</table>\r\n<br/>";
   	}
}

?>