<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach($this->items as $i => $item): ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo $item->tarif_id; ?>
		</td>
		<td>
			<?php echo JHtml::_('grid.id', $i, $item->tarif_id); ?>
		</td>
		<td>
			<a href="<?php echo JRoute::_('index.php?option=com_tsj&view=tarif&layout=edit&tarif_id='.(int) $item->tarif_id);?>">
         	<?php echo $this->escape($item->tarif_name_short); ?></a>
		</td>
		<td>
			<a href="<?php echo JRoute::_('index.php?option=com_tsj&view=tarif&layout=edit&tarif_id='.(int) $item->tarif_id);?>">
         	<?php echo $this->escape($item->tarif_name); ?></a>
		</td>
		<td>
			<a href="<?php echo JRoute::_('index.php?option=com_tsj&view=tarif&layout=edit&tarif_id='.(int) $item->tarif_id);?>">
         	<?php echo $this->escape($item->tarif); ?></a>
		</td>
		<td>
			<a href="<?php echo JRoute::_('index.php?option=com_tsj&view=tarif&layout=edit&tarif_id='.(int) $item->tarif_id);?>">
         	<?php echo $this->escape($item->tarif_1); ?></a>
		</td>
		<td>
			<a href="<?php echo JRoute::_('index.php?option=com_tsj&view=tarif&layout=edit&tarif_id='.(int) $item->tarif_id);?>">
         	<?php echo $this->escape($item->tarif_2); ?></a>
		</td>
	</tr>
<?php endforeach; ?>