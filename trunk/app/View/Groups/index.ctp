
<?php //echo $this->Html->Link('Top 100 movies', '/movies/top')

	//ensures that the Request tab only is visible for admins
	$user = $this->Session->read('Auth.User');
	$tabs = array("links" => array(
		0 => array("divId" => "groups3", "header" => "All Groups"),
		1 => array("divId" => "groups1", "header" => "My groups")));

	if($user['role'] === 'admin')  { 
		array_push($tabs['links'], array("divId" => "groups2", "header" => "Requests")); 
	}

	$this->startIfEmpty('sideTabs');
	echo $this->element('sideTabs', $tabs);
$this->end();
?>

<div id="groupsInfo"></div>		 
