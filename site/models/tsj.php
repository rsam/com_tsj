<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 
/**
 * HelloWorld Model
 */
class tsjModeltsj extends JModelItem
{
	/**
	 * @var string msg
	 */
	protected $msg;
 
	/**
	 * Get the message
	 * @return string The message to be displayed to the user
	 */
	public function getMsg() 
	{
		if (!isset($this->msg)) 
		{
			$this->msg = 'Привет МИР! Говорит модель :)';
		}
		return $this->msg;
	}
}