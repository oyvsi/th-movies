<?php $user = $this->Session->read('Auth.User');
	if ($user) { echo "
	<ul>

		<li id='homepage'>Home
		</li>
		<li id='moviepage'>Movies
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
		</ul>"; }?>
		