<?php

function constructInputs( $fileName )
{
    $isNewTable = true;
    foreach ( file("resources/$fileName.txt") as $index => $line )
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
                echo "<tr><td><label for=\"$line[0]\" class=\"label\">$line[1]: </label></td><td><input  id=\"qb\" type=\"$line[2]\" class=\"input\" style=\"margin: 0\" /></td></tr>\n";
            }
            elseif ( $line[2] === "text" )
            {
                echo "<tr><td><label for=\"$line[0]\" class=\"label\">$line[1]: </label></td><td><input  id=\"qb\" type=\"$line[2]\" class=\"input\" style=\"margin: 0\" placeholder=\"$line[3]\" /></td></tr>\n";
            }
            elseif ( $line[2] === "checkbox" )
            {
                echo "<tr><td colspan=\"2\" style=\"text-align: left\"><input  id=\"qb\" type=\"$line[2]\" style=\"margin: 0 .5em\" /><label for=\"$line[0]\">$line[1]</label></td></tr>\n";
            }
        }
        else
        {
            $line = trim( implode( $line ) );
            if ( $line == "HR" )
            {
                echo "</table><hr/>\n\n";
            }
            elseif ( isset($line) )
            {
                if ( !$isNewTable )
                {
                    echo "</table>";
                    echo "<br/><br/>\n\n";
                }
                echo "<span class=\"label\">$line</span>";
                $usesFields = true;
            }
            $isNewTable = true;
        }
    }

    if ( !$isNewTable )
    {
        echo "</table>\n\n";
    }
}

?>