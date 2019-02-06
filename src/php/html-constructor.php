<?php

function constructInputs()
{
    $isNewTable = true;
    foreach ( file("resources/league.txt") as $index => $line )
    {
        $line = explode( "|", $line );
        if ( count( $line ) === 1 )
        {
            if ( $line === "HR" )
            {
                echo "</table><hr/>\n";
            }
            $isNewTable = true;
        }
        else
        {
            if ( $isNewTable )
            {
                echo "<table style=\"text-align: right; vertical-align: center; width: 100%\">\n
                      <tr><td width=\"5%\"></td><td></td></tr>\n";
                $isNewTable = false;
            }

            echo "<tr><td><label for=\"$line[0]\" class=\"label\"$line[1]: </label></td><td><input  id=\"qb\" type=\"$line[2]\" class=\"input\" style=\"margin: 0\" /></td></tr>";
        }
    }
}

?>