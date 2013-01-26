<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

?>
<?php foreach($this->addressitems as $i => $addressitem):
	//$ordering = ( $listOrder == 'ordering' );?>
   <tr class="row<?php echo $i % 2; ?>">
      <td>
         <?php echo $addressitem->address_id; ?>
      </td>
      <td>
         <?php echo JHtml::_('grid.id', $i, $addressitem->address_id); ?>
      </td>
      <td>
      	<a href="<?php echo JRoute::_('index.php?option=com_tsj&task=address.edit&layout=edit&address_id='.(int) $addressitem->address_id); ?>">
         <?php echo $addressitem->city; ?></a>
      </td>
      <td>
      	<a href="<?php echo JRoute::_('index.php?option=com_tsj&task=address.edit&layout=edit&address_id='.(int) $addressitem->address_id); ?>">
         <?php echo $addressitem->street; ?></a>
      </td>
      <td>
         <?php //echo $addressitems->house; ?>
         <a href="<?php echo JRoute::_('index.php?option=com_tsj&task=address.edit&layout=edit&address_id='.(int) $addressitem->address_id); ?>">
         <?php echo $this->escape($addressitem->house); ?></a>
      </td>
      <td>
         <?php //echo $addressitems->office; ?>
          <a href="<?php echo JRoute::_('index.php?option=com_tsj&task=address.edit&layout=edit&address_id='.(int) $addressitem->address_id); ?>">
         <?php echo $this->escape($addressitem->office); ?></a>
      </td>
   </tr>
<?php endforeach; ?>