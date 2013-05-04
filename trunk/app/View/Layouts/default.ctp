<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->Html->css('th-movies');
		echo $this->Html->css('jquery-ui/jquery-ui');
		echo $this->fetch('script');
		echo $this->Html->scriptBlock('var baseURL = \'' . Router::url('/') . '\';');
		echo $this->Html->script('jquery-1.9.1.min.js');
		echo $this->Html->script('jquery-ui-1.10.2/ui/jquery-ui.js');
		echo $this->Html->script('jquery.raty');
		echo $this->Html->script('thMovies.jquery');
		echo $this->Html->script('searchBar.jquery');
		echo $this->Html->script('loadDiv.jquery');
		echo $this->Html->script('js-sort/jquery.tablesorter');

		
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<?php echo $this->element('headerMenu'); ?>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="sidebar">
			<?php echo $this->fetch('sideBar'); ?>
		</div>

		<div id="footer">
			<?php echo $this->element('footer'); ?>
		</div>

	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
