<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

?>
<?php foreach($this->cityitems as $i => $cityitem): ?>
<tr class="row<?php echo $i % 2; ?>">
	<td><?php echo $cityitem->city_id ; ?>
	</td>
	<td><?php echo JHtml::_('grid.id', $i, $cityitem->city_id); ?>
	</td>
	<td><?php //if ($cityitem->checked_out) : ?> <?php //echo JHtml::_('jgrid.checkedout', $i, $cityitem->editor, $cityitem->checked_out_time, 'city.', $canCheckin); ?>
	<?php //endif; ?> <a
		href="<?php echo JRoute::_('index.php?option=com_tsj&task=city.edit&layout=city&city_id='.(int) $cityitem->city_id); /*JRoute::_('index.php?option=com_tsj&task=city.edit&id='.(int) $cityitem->city_id);*/ ?>">
		<?php echo $this->escape($cityitem->city); ?> </a>
	</td>
</tr>
		<?php endforeach; ?>