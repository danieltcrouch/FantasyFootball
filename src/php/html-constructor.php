<?php
include_once( "utility.php" );

function constructInputSections( $fileName, $sectionMax = 2 )
{
    $colSize = intdiv( 10, $sectionMax );
    echo "<div class='col-10'>\n";
    echo "<div class='col-$colSize' style='margin-bottom: 2em'>\n";

    $sectionCount = 0;
    $isNewTable = true;
    foreach ( file("resources/$fileName.txt") as $index => $line )
    {
        if ( empty( trim( $line ) ) && $index !== 0 )
        {
            echo "</table>";
            echo "</div>\n\n\n";
            if ( $sectionCount + 1 === $sectionMax )
            {
                echo "</div>\n\n\n";
                echo "<div class='col-10'>\n";
                $sectionCount = -1;
            }
            echo "<div class='col-$colSize' style='margin-bottom: 2em'>\n";
            $isNewTable = true;
            $sectionCount++;
        }
        else
        {
            $isNewTable = constructInputs( $isNewTable, $line, 20 );
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

function constructInputs( $isNewTable, $line, $minWidth = null )
{
    $line = trim( $line );
    $lineArray = explode( "|", $line );
    if ( is_array( $lineArray ) && count( $lineArray ) > 1 )
    {
        if ( $isNewTable )
        {
            $width = $minWidth ?? 10;
            echo "<table style=\"text-align: right; vertical-align: center; width: 100%\">
                  <tr><td width=\"$width%\"></td><td></td></tr>\n";
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