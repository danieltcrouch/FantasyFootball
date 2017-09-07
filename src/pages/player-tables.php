<?php
	echo "\r\n";
	for ($i = 1; $i <= $teamCount; $i++)
	{
		echo "<table id='player_" . $i . "' style='width: 60%; margin: 0 auto;'>\r\n";
		echo "   <tr>\r\n";
		echo "      <th id='player_" . $i . "_header'>" . $teamNames[$i] . "</th>\r\n";
		echo "   </tr>\r\n";
		for ($j = 1; $j <= $playerCount; $j++)
		{
			echo "   <tr>\r\n";
			echo "      <td id='player_" . $i . "_cell" . $j . "'>--</td>\r\n";
			echo "   </tr>\r\n";
		}
		echo "</table>\r\n<br/>";
	} 
?>