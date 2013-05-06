
<?php
echo " <div id=\"latestMovies\"><h3>Movies</h3><table>"; 
		 $i = 0;
		 foreach($latestMovies as $movie) {
			if($movie['Rating']['rating'] && $i < 50){ //satte limit her fordi de første 6 radene i arrayet var tomme.
				$link = '<a href="' . Router::url('/movies/') . $movie['Movie']['id'] . '">' . $movie['Movie']['title'] . '</a>';
				$data = array($link); 
				echo "<tr><td>" . implode('</td><td>', $data) . "</td></tr>";
				$i++;
			}
		}
echo "</table></div>";
