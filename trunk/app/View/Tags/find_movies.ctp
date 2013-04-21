<h4>Movies tagged with <?php echo $tag ?></h4>

<?php if(isset($movies)): ?>
   <div id="movieList"><table>
	<?php foreach($movies as $movie): ?>
			<?php
         $link = '<a href="' . Router::url('/movies/') . $movie['movie_id'] . '">' . $movie['Movie']['title'] . '</a>';
         echo "<tr><td>$link</td></tr>";
     		?> 

	<?php endforeach; ?>
   </table></div>
<?php endif; ?>
