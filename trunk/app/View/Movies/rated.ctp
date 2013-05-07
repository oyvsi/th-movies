

<?php if(isset($noContent)) { 
		echo "My goodness, no movies rated? Use the search bar or visit " . $this->Html->Link('the Movies gallery', '/movies/'); 
	  } else { 
		 echo " <h3>All rated movies</h3><table>"; 
		 foreach($ratedMovies as $movie) {
			$link = '<a href="' . Router::url('/movies/movie/') . $movie['Movie']['id'] . '">' . $movie['Movie']['title'] . '</a>';
			$data = array($link, $movie['Rating']['rating']); 
			echo "<tr><td>" . implode('</td><td>', $data) . "</td></tr>";
		}
		echo "</table>";
		} 
?>

