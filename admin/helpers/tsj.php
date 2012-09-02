<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * ZhYandexMap component helper.
 */
abstract class tsjHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($submenu) 
	{
		JSubMenuHelper::addEntry(JText::_('COM_TSJ_SUBMENU_WATER'), 'index.php?option=com_tsj&view=water', $submenu == 'water');
		JSubMenuHelper::addEntry(JText::_('COM_TSJ_SUBMENU_PLATEJKA'), 'index.php?option=com_tsj&view=platejka', $submenu == 'platejka');
		// set some global property
		$document = JFactory::getDocument();
		//$document->addStyleDeclaration('.icon-48-zhyandexmap {background-image: url(../media/com_zhyandexmap/images/map-48x48.png);}');
		if ($submenu == 'categories') 
		{
			$document->setTitle(JText::_('Админ панель'));
		}
	}

}
