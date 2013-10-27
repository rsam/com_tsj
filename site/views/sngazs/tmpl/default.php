<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>

<table class="SNgazTable">
	<thead>
	<?php
	// Header
	echo $this->loadTemplate('head');
	?>
	</thead>
	<tbody>
	<?php
	// Основной блок
	echo $this->loadTemplate('prebody');
	echo $this->loadTemplate('body');
	?>
	</tbody>
	<tfoot>
	<?php
	// Footer
	echo $this->loadTemplate('foot');
	?>
	</tfoot>
</table>
