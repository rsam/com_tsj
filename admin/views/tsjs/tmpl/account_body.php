<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
jimport( 'joomla.html.html.grid' );
?>

<?php foreach($this->accountitems as $i => $accountitem): ?>
   <tr class="row<?php echo $i % 2; ?>">
      <td>
         <?php echo $accountitem->account_id ; ?>
      </td>
      <td>
         <?php echo JHtml::_('grid.id', $i, $accountitem->account_id); ?>
      </td>
      <td>
         <a href="<?php echo JRoute::_('index.php?option=com_tsj&task=account.edit&layout=edit&account_id='.(int) $accountitem->account_id); ?>">
         <?php echo $this->escape($accountitem->account_num); ?></a>
      </td>
      <td>
         <a href="<?php echo JRoute::_('index.php?option=com_tsj&task=account.edit&layout=edit&account_id='.(int) $accountitem->account_id); ?>">
         <?php echo $this->escape($accountitem->city); ?></a>
      </td>
      <td>
         <a href="<?php echo JRoute::_('index.php?option=com_tsj&task=account.edit&layout=edit&account_id='.(int) $accountitem->account_id); ?>">
         <?php echo $this->escape($accountitem->street); ?></a>
      </td>
      <td>
         <a href="<?php echo JRoute::_('index.php?option=com_tsj&task=account.edit&layout=edit&account_id='.(int) $accountitem->account_id); ?>">
         <?php echo $this->escape($accountitem->house); ?></a>
      </td>
      <td>
         <a href="<?php echo JRoute::_('index.php?option=com_tsj&task=account.edit&layout=edit&account_id='.(int) $accountitem->account_id); ?>">
         <?php echo $this->escape($accountitem->office); ?></a>
      </td>
      <td>
         <a href="<?php echo JRoute::_('index.php?option=com_tsj&task=account.edit&layout=edit&account_id='.(int) $accountitem->account_id); ?>">
         <?php echo $this->escape($accountitem->name); ?></a>
      </td>
      <td>
         <a href="<?php echo JRoute::_('index.php?option=com_tsj&task=account.edit&layout=edit&account_id='.(int) $accountitem->account_id); ?>">
         <?php echo $this->escape($accountitem->tel); ?></a>
      </td>
      <td>
         <a href="<?php echo JRoute::_('index.php?option=com_tsj&task=account.edit&layout=edit&account_id='.(int) $accountitem->account_id); ?>">
         <?php echo $this->escape($accountitem->sq); ?></a>
      </td>
      <td>
         <a href="<?php echo JRoute::_('index.php?option=com_tsj&task=account.edit&layout=edit&account_id='.(int) $accountitem->account_id); ?>">
         <?php echo $this->escape($accountitem->cat); ?></a>
      </td>
      <td>
         <?php
            if($accountitem->lic == '0'){
         ?>
            <input type="checkbox" name="licf" disabled />
         <?php
            } else {
         ?>
            <input type="checkbox" name="licf" checked disabled/>
         <?php
            }
         ?>
      </td>
   </tr>
<?php endforeach; ?>
