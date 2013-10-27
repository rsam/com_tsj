<?php

defined('_JEXEC') or die;

/**
 * TSJ component helper.
 *
 * @package    Joomla.Administrator
 * @subpackage com_tsj
 * @since      2.5
 */
class TSJsHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string   The name of the active view.
	 * @return  void
	 * @since   2.5
	 */
	public static function addSubmenu($vName)
	{
		JSubMenuHelper::addEntry(
		JText::_('COM_TSJS_SUBMENU_MAIN'),
         'index.php?option=com_tsj&view=tsjs&layout=main',
		$vName == 'main'
		);

		JSubMenuHelper::addEntry(
		JText::_('COM_TSJS_SUBMENU_CITY'),
         'index.php?option=com_tsj&view=tsjs&layout=city',
		$vName == 'city'
		);

		JSubMenuHelper::addEntry(
		JText::_('COM_TSJS_SUBMENU_STREET'),
         'index.php?option=com_tsj&view=tsjs&layout=street',
		$vName == 'street'
		);

		JSubMenuHelper::addEntry(
		JText::_('COM_TSJS_SUBMENU_ADDRESS'),
         'index.php?option=com_tsj&view=tsjs&layout=address',
		$vName == 'address'
		);

		JSubMenuHelper::addEntry(
		JText::_('COM_TSJS_SUBMENU_ACCOUNT'),
         'index.php?option=com_tsj&view=tsjs&layout=account',
		$vName == 'account'
		);
	}
	 
}