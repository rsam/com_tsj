<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * Empty Controller
 */
class TSJControllerTSJ extends JControllerForm
{
	public $my_var4;
	 
	/**
	 * Конструктор
	 */
	function __construct($config=array())
	{
		// Задаем вид для списка
		$this->view_list = 'tsjs';
		parent::__construct($config);
	}
}