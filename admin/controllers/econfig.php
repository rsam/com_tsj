<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined( '_JEXEC' ) or die;

/**
 * TSJ Component TSJ Model
 *
 * @package		Joomla.Administrator
 * @subpackage	com_tsj
 * @since		1.6
 */
class TSJControllerEConfig extends JControllerLegacy
{
	/**
	 * Method to save a record.
	 */
	public function save()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$app		= JFactory::getApplication();
		$model	= $this->getModel('EConfig', 'TSJModel');
		$data		= JRequest::getVar('jform', array(), 'post', 'array');

		// Validate the posted data.
		$form	= $model->getForm();
		if (!$form) {
			JError::raiseError(500, $model->getError());
			return false;
		}
		$data = $model->validate($form, $data);

		// Check for validation errors.
		if ($data === false) {
			// Get the validation messages.
			$errors	= $model->getErrors();

			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
				if ($errors[$i] instanceof Exception) {
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				} else {
					$app->enqueueMessage($errors[$i], 'warning');
				}
			}

			// Redirect back to the main list.
			//$this->setRedirect(JRoute::_('index.php?option=com_tsj&view=econfig', false));
			return false;
		}

		// Attempt to save the data.
		if (!$model->save($data))
		{
			// Redirect back to the main list.
			$this->setMessage(JText::sprintf('JERROR_SAVE_FAILED', $model->getError()), 'warning');
			//$this->setRedirect(JRoute::_('index.php?option=com_tsj&view=econfig', false));
			return false;
		}

		// Redirect to the list screen.
		$this->setMessage(JText::_('COM_MESSAGES_CONFIG_SAVED'));
		//$this->setRedirect(JRoute::_('index.php?option=com_tsj&view=econfig', false));

		return true;
	}
}
