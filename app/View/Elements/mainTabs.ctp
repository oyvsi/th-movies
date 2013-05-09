<?php $user = $this->Session->read('Auth.User');
	if ($user) { echo "
	<ul>

		<li id='homepage'>TH-movies
		</li>

		<li id='userpage'>Profile
		</li>
		<li id='grouppage'>Groups
		</li>
		<li id='aboutpage'>About
		</li> 
		<li id='logoutpage'>Log out
		</li>";
		echo "
	</ul>";

	} else { echo "
		<ul>
			<li id='loginpage'>Login
			</li>
			<li id='registerpage'>Register
			</li>
		</ul>"; }
	
		//	<li id='moviepage'>Movies</li>  var movies-side
		?>
		