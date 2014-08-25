<?php

// no direct access
defined('_JEXEC') or die('Restricted access.');

if (version_compare(JPlatform::RELEASE, '12', 'ge'))
{
	class JToolbarButtonImport extends JToolbarButton
	{
		// since   3.0
		var $_name = 'Import';

		function fetchButton($type='Import', $name = '', $text1 = '', $text2 = '', $task = 'import', $list = true, $hideMenu = false )
		{
			$i18n_text	= JText::_($text1);
			
			$doAction = 'index.php?option=com_tsj&amp;task='.$task;
			$doTask	= $this->_getCommand($name, $task, $list);

			$class	= $this->fetchIconClass($name);

			JFactory::getDocument()->addStyleDeclaration('div#toolbar div#toolbar-'.$name.' button.btn i.icon-'.$name.'-import::before {color: #2F96B4;content: "g";}');
			JFactory::getDocument()->addStyleDeclaration('div#toolbar div#toolbar-'.$name.' button.btn i.icon-'.$name.'-open::before {color: #2F96B4;content: "r";}');
			
			$html = "";
			$html .= "<form name=\"".$name."Form\" method=\"post\" enctype=\"multipart/form-data\" action=\"$doAction\" style=\"float:left\">\n";
			$html .= "<input type=\"file\" name=\"file_upload\" />\n";

			$html .= JHTML::_('form.token');
			$html .= "</form> \n";

			$i18n_text	= JText::_($text2);
			$class	= $this->fetchIconClass($name.'-import');
			$html .= "<button onclick=\"$doTask\" class=\"" . $btnClass . "\">\n";
			$html .= "<i class=\"$class $iconWhite\">\n";
			$html .= "</i>\n";
			$html .= "$i18n_text\n";
			$html .= "</button>\n";

			return $html;
		}

		/**
		 * Get the JavaScript command for the button
		 *
		 * @access	private
		 * @param	string	$name	The task name as seen by the user
		 * @param	string	$task	The task used by the application
		 * @param	???		$list
		 * @param	boolean	$hide
		 * @return	string	JavaScript command string
		 * @ since   3.0
		 */
		private function _getCommand($name, $task, $hide)
		{
			$todo		= JString::strtolower(JText::_($name));
			$message	= JText::sprintf('COM_TSJIMPORTER_BUTTON_PLEASE_SELECT_A_FILE_TO', $todo);
			$message	= addslashes($message);
			$hidecode	= $hide ? 'hideMainMenu();' : '';
			
			//return "javascript:if((document.".$name."Form.file_upload.value=='') && (document.".$name."Form.remote_file.value=='')){alert('$message');}else{ document.".$name."Form.submit()}";		
			
			/*$todo		= JString::strtolower(JText::_($name));
			$message	= JText::sprintf('COM_TSJIMPORTER_BUTTON_PLEASE_SELECT_A_FILE_TO', $todo);
			$message	= addslashes($message);
			//$hidecode	= $hide ? 'hideMainMenu();' : '';
*/

			return "javascript:if((document.".$name."Form.file_upload.value=='') && (document.".$name."Form.local_file.value=='')){alert('$message');}else{ $hidecode document.".$name."Form.submit()}";
		}

		/**
		 * Get the button CSS Id
		 *
		 * @access	public
		 * @return	string	Button CSS Id
		 * @ since   3.0
		 */
		public function fetchId($type = 'Import', $name = '', $text = '', $task = '', $list = true, $hideMenu = false)
		{
			return $this->_parent->getName() . '-' . $name;
		}
	}
}
else{

	class JButtonImport extends JButton
	{
		/**
		 * Button type
		 *
		 * @access	public
		 * @var		string
		 */
		var $_name = 'Import';

		function fetchButton($type='Import', $name = '', $text = '', $task = 'import', $list = true, $hideMenu = false )
		{
			$i18n_text	= JText::_($text);
			$class	= $this->fetchIconClass($name);
			$doAction = 'index.php?option=com_tsj&amp;task='.$task;
			$doTask	= $this->_getCommand($text, $task, $hideMenu);

			$html = "";
			$html .= "<form name=\"".$text."Form\" method=\"post\" enctype=\"multipart/form-data\" action=\"$doAction\" style=\"float:left\">\n";
			$html .= "<input type=\"file\" name=\"file_upload\">&nbsp;<br/><br/>\n";
			$path		= JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'files';
			if (JFolder::exists($path))
			{
				$files = JFolder::files($path,'\.csv$',true,true);
				if (is_array($files) && (count($files) > 0))
				{
					$filenames = str_replace($path.DIRECTORY_SEPARATOR, '', $files);
					$options = array ();
					$options[] = JHTML::_('select.option', '', '- '.JText::_('Select a file').' -');
					foreach ($filenames as $file)
					$options[] = JHTML::_('select.option', $file, $file);
					$html .= JHTML::_('select.genericlist',  $options, 'local_file', 'class="inputbox"', 'value', 'text', '', 'local_file');
				}
			}
			$html .= JHTML::_('form.token');
			$html .= "</form>\n";
			$html .= "<a href=\"#\" onclick=\"$doTask\" class=\"toolbar\">\n";
			$html .= "<span class=\"$class\" title=\"$i18n_text\">\n";
			$html .= "</span>\n";
			$html .= "$i18n_text\n";
			$html .= "</a>\n";

			return $html;
		}

		/**
		 * Get the JavaScript command for the button
		 *
		 * @access	private
		 * @param	string	$name	The task name as seen by the user
		 * @param	string	$task	The task used by the application
		 * @param	???		$list
		 * @param	boolean	$hide
		 * @return	string	JavaScript command string
		 * @since	1.5
		 */
		private function _getCommand($name, $task, $hide)
		{
			$todo		= JString::strtolower(JText::_($name));
			$message	= JText::sprintf('COM_TSJIMPORTER_BUTTON_PLEASE_SELECT_A_FILE_TO', $todo);
			$message	= addslashes($message);
			$hidecode	= $hide ? 'hideMainMenu();' : '';

			return "javascript:if((document.".$name."Form.file_upload.value=='') && (document.".$name."Form.local_file.value=='')){alert('$message');}else{ $hidecode document.".$name."Form.submit()}";
		}

		/**
		 * Get the name of the toolbar.
		 *
		 * @return	string
		 * @since	1.5
		 */
		private function _getToolbarName()
		{
			return $this->_parent->getName();
		}

		/**
		 * Get the button CSS Id
		 *
		 * @access	public
		 * @return	string	Button CSS Id
		 * @since	1.5
		 */
		public function fetchId($type='Import', $name = '', $text = '', $task = '', $list = true, $hideMenu = false)
		{
			return $this->_getToolbarName().'-'.$name;
		}
	}
}
?>