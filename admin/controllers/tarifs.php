<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

/**
 * Tarifs Controller
 */
class TSJControllerTarifs extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 * @since	2.5
	 */   
    public function getModel($name = 'Tarifs', $prefix = 'TSJModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}    
}