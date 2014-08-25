<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// import Joomla view library
//jimport('joomla.application.component.view');
JLoader::register('TSJsHelper', JPATH_COMPONENT.'/helpers/tsjs.php');
jimport('joomla.html.html.tabs');

/**
 * View to edit messages user configuration.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_tsj
 * @since		1.6
 */
class TSJViewWConfig extends JViewAbstract
{
	protected $form;
	protected $item;
	protected $state;
	protected $component;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		// Bind the record to the form.
		$this->form->bind($this->item);

		parent::display($tpl);
	}
}
