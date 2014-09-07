<?php

defined('_JEXEC') or die;

/**
 * TSJ component helper.
 *
 * @package    Joomla.Administrator
 * @subpackage com_tsj
 * @since      2.5
 */
// import joomla controller library
if (version_compare(JPlatform::RELEASE, '12', '<'))
{
	jimport('joomla.application.component.controller');
	jimport('joomla.application.component.view');
	
	if (!class_exists('JHelperAbstract'))
	{
		abstract class JHelperAbstract {}
	}
}
else
{
	if (!class_exists('JHelperAbstract'))
	{
		abstract class JHelperAbstract extends JHelperContent {}
	}
}

class TSJsHelper extends JHelperAbstract
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string   The name of the active view.
	 * @return  void
	 * @since   2.5
	 */
	public static $extension = 'com_tsjs';	 
	
	public static function getActions($extension, $categoryId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_content';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
		}

		return $result;
	}	
	
	public static function addSubmenu($vName='tsjs')
	{
	
		if (version_compare(JPlatform::RELEASE, '12', '<'))
		{
			JSubMenuHelper::addEntry(
			JText::_('COM_TSJS_SUBMENU_MAIN'),
			 'index.php?option=com_tsj&view=tsjs&layout=tsjs',
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
		else{
			JHtmlSidebar::addEntry(
			JText::_('COM_TSJS_SUBMENU_MAIN'),
			 'index.php?option=com_tsj&view=tsjs&layout=tsjs',
			$vName == 'main'
			);

			JHtmlSidebar::addEntry(
			JText::_('COM_TSJS_SUBMENU_CITY'),
			 'index.php?option=com_tsj&view=tsjs&layout=city',
			$vName == 'city'
			);

			JHtmlSidebar::addEntry(
			JText::_('COM_TSJS_SUBMENU_STREET'),
			 'index.php?option=com_tsj&view=tsjs&layout=street',
			$vName == 'street'
			);

			JHtmlSidebar::addEntry(
			JText::_('COM_TSJS_SUBMENU_ADDRESS'),
			 'index.php?option=com_tsj&view=tsjs&layout=address',
			$vName == 'address'
			);

			JHtmlSidebar::addEntry(
			JText::_('COM_TSJS_SUBMENU_ACCOUNT'),
			 'index.php?option=com_tsj&view=tsjs&layout=account',
			$vName == 'account'
			);
		}

	}
	 
}