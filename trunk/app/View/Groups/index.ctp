
<?php //echo $this->Html->Link('Top 100 movies', '/movies/top')

	//ensures that the Request tab only is visible for admins
	$user = $this->Session->read('Auth.User');
	if($user['role'] === 'admin')  {
		$tabs = array("links" => array(
			0 => array("divId" => "groups1", "header" => "My Groups"), 
			1 => array("divId" => "groups2", "header" => "Requests")));
	} else {
		$tabs = array("links" => array(
			0 => array("divId" => "groups1", "header" => "My Groups")));
	}

	$this->startIfEmpty('sideTabs');
	echo $this->element('sideTabs', $tabs);
$this->end();
?>

<div id="groupsInfo"></div>		 
