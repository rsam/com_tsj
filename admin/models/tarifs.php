<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

/**
 * TSJList Model
 */
class TSJModelTarifs extends JModelList
{
	//текущая страница
	private $limitstart;
	//количество записей на странице
	private $limit;


	var $_tarif;

	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$query = $this->getDbo()->getQuery( true );
		$query->select('*')->from('#__tsj_tarif');

		return $query;
	}

	public function __construct( $config = array() )
	{
		$app = JFactory::getApplication();
		//получаем объект для обработки пользовательского ввода
		$input = $app->input;
		//Получаем текущую страницу
		$this->limitstart = $input->get( 'start', 0 );
		//Определяем количество строк выводимых на страницу
		$this->limit = $app->getUserStateFromRequest( 'global.list.limit', 'limit', $app->getCfg( 'list_limit' ), 'uint' );

		//Устанавливаем поля по которым будет сортировка
		if ( empty( $config['filter_fields'] ) ) {
			$config['filter_fields'] = array( 'tarif_id', 'tarif_name_short', 'tarif_name');
		}

		parent::__construct( $config );
	}

	function getItems()
	{
		// Загружаем данные, если они еще не загружены
		if (empty( $this->_tarif ))
		{
			$this->limitstart = JRequest::getVar('limitstart', 0, '', 'int');

			$query = $this->getDbo()->getQuery( true );
			$query->select('*');
			$query->from('#__tsj_tarif');

			$listOrder = $this->state->get('list.ordering','tarif_id');
			$listDirn = $this->state->get('list.direction','asc');
			$query->order($listOrder . ' ' . $listDirn);

			/*echo "lim=".$this->limit;
			echo "start=".$this->limitstart . "<br>";
			echo "orderCol=".$listOrder;
			echo "orderDirn=".$listDirn."<br>";*/
			
			// Пагинация. Возвразщаем в массив нужное количество с нужной страницы
			if($this->limit == 0)
				$this->_tarif = $this->_getList( $query );
			else
				$this->_tarif = $this->_getList( $query, $this->limitstart, $this->limit);
		}

		return $this->_tarif;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed The data for the form.
	 * @since   2.5
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_tsj.edit.tarifs.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}
		return $data;
	}

	/**
	 * Method to populate the state of the model
	 *
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState('tarif_id', 'asc');
	}
}