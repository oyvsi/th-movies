<?php if(isset($noContent)) { 
		echo "My goodness, no movies rated? Use the search bar or visit " . $this->Html->Link('the Movies gallery', '/movies/'); 
	  } else { 
		 echo " <div id=\"ratedMovies\"><table>"; 
		 foreach($ratedMovies as $movie) {
			$link = '<a href="' . Router::url('/movies/') . $movie['Movie']['id'] . '">' . $movie['Movie']['title'] . '</a>';
			$data = array($link, $movie['Rating']['rating']); 
			echo "<tr><td>" . implode('</td><td>', $data) . "</td></tr>";
		}
		echo "</table></div>";
		} 
?>

