<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach($this->streetitems as $i => $streetitem): ?>
   <tr class="row<?php echo $i % 2; ?>">
      <td>
         <?php echo $streetitem->street_id ; ?>
      </td>
      <td>
         <?php echo JHtml::_('grid.id', $i, $streetitem->street_id); ?>
      </td>
      <td>
         <?php //if ($cityitem->checked_out) : ?>
            <?php //echo JHtml::_('jgrid.checkedout', $i, $cityitem->editor, $cityitem->checked_out_time, 'city.', $canCheckin); ?>
         <?php //endif; ?>
                  
         <a href="<?php echo JRoute::_('index.php?option=com_tsj&task=street.edit&layout=edit&street_id='.(int) $streetitem->street_id); ?>">
         <?php echo $this->escape($streetitem->street); ?></a>
      </td>
   </tr>
<?php endforeach; ?>