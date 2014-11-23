<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

/**
 * Main Controller
 */
class TSJControllerTSJs extends JControllerAdmin
{
	/**
	 * @var pointer to global object database
	 */
	private $db;

	private function encrypt($data,  $key,  $cipher,  $mode)
	{
		return $data;
		$iv = mcrypt_create_iv(mcrypt_get_iv_size($cipher, $mode), MCRYPT_RAND);
		return base64_encode( mcrypt_encrypt ($cipher,$key,$data,$mode,$iv)	);
	}

	private function decrypt($data,  $key,  $cipher, $mode)
	{
		return $data;
		return mcrypt_decrypt ($cipher,
		substr(md5($key),0,mcrypt_get_key_size($cipher,  $mode)), base64_decode($data) , $mode,
		substr(md5($key),O,mcrypt_get_block_size($cipher,  $mode)) ) ;
	}

	/**
	 * Proxy for getModel.
	 * @since	2.5
	 */
    public function getModel($name = 'TSJs', $prefix = 'TSJModel', $config = array('ignore_request' => true))
	{
        //JFactory::getApplication()->enqueueMessage('Debug: TSJControllerTSJs::getModel');
		$model = parent::getModel($name, $prefix, $config);
        //JFactory::getApplication()->enqueueMessage('Debug: TSJControllerTSJs::getModel model='.$model);
		return $model;
	}

	function import()
	{

		// Check for request forgeries
		JRequest::checkToken() or jexit('Invalid Token');

		$app =JFactory::getApplication('administrator');
		$msg='';
		$this->db =JFactory::getDBO();
		if (!$this->db->connected()) {
			echo "Нет соединения с сервером баз данных. Повторите запрос позже";
			jexit();
		}

		//$date = JFactory::getDate();
		//$now = $date->toMYSQL();
		$params = JComponentHelper::getParams('com_tsj');

		//libxml_use_internal_errors(true);

		//Retrieve file details from uploaded file, sent from upload form:
		$file = JRequest::getVar('file_upload', null, 'files', 'array');
		if ($file['name'])
		{
			$local = false;
			$filename = $file['tmp_name'];
		}
		else
		{
			$local = true;
			$filename = JPATH_COMPONENT_ADMINISTRATOR.'/'.'files'.'/'.JRequest::getVar('local_file', null);
		}

		//$row = 1;
		if (($handle = fopen($filename, "r")) !== FALSE) {

			// Проверка формата файла, включая заголовок.
			// Строки csv файла должны быть в формате:
			//"№_лицевого_счета";"Город";"Улица";"№_дома";"№_квартиры";"ФИО",площадь(.);"Телефон";№_категории;password;email
			// Кодировка UTF-8
			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
				$num = count($data);
				//echo "<p> $num полей в строке $row: <br /></p>\n";
				//$row++;
				//for ($c=0; $c < $num; $c++) {
				//   echo $data[$c] . "<br />\n";
				//}

				if( $num != 12 ) {
					echo "Не верный формат CSV файла. Не правильное количество столбцов.\n";
					echo "Формат CSV файла должен быть UTF-8 :\"№_лицевого_счета\";\"Город\";\"Улица\";\"№_дома\";\"№_квартиры\";\"ФИО\";площадь(.);\"Телефон\";Категория;\"Лиценция\";\"Password\";\"EMail\"\n";
                    //account_num;city;street;house;office;fio;sq;tel;cat;lic;password;email
					fclose($handle);
					return false;
				}
			}
				
			fseek($handle, 0);
			// Пишем в базу.
			$city_id = 0;
			$street_id = 0;
			$address_id = 0;

			$data = fgetcsv( $handle, 1000, ";" ); // Первая строка заголовка пропускается
			while ( ( $data = fgetcsv( $handle, 1000, ";" ) ) !== FALSE ) {
				$num = count($data);

				// Ищем Город в таблице городов. Если не нашли, то добавляем город в таблицу городов.
				// Запоминаем ID города.
				$sql = " SELECT *
                  	FROM #__tsj_city
                  	WHERE #__tsj_city.city = '" . trim($data[1]) . "';";

				$this->db->setQuery( $sql );
				$row = $this->db->loadResult();

				if (!$result = $this->db->query()) {
					//echo $this->db->stderr();
					fclose($handle);
					return false;
				}

				if (empty($row)) {
					// Добавить
					$sql = " INSERT INTO #__tsj_city
								(city)
                  		VALUES ('$data[1]');";

					$this->db->setQuery( $sql );

					if (!$result = $this->db->query()) {
						//echo $this->db->stderr();
						fclose($handle);
						return false;
					}
					else $city_id = $this->db->insertid();
				}
				else {
					$city_id = $row;
				}

				// Ищем Улица в таблице улиц. Если не нашли, то добавляем улицу в таблицу улиц.
				// Запоминаем ID улицы.
				$sql = " SELECT *
                  	FROM #__tsj_street
                  	WHERE #__tsj_street.street = '" . trim($data[2]) . "';";

				$this->db->setQuery( $sql );
				$row = $this->db->loadResult();

				if (!$result = $this->db->query()) {
					//echo $this->db->stderr();
					fclose($handle);
					return false;
				}

				if (empty($row)) {
					// Добавить
					$sql = " INSERT INTO #__tsj_street
								(street)
                  		VALUES ('$data[2]');";

					$this->db->setQuery( $sql );

					if (!$result = $this->db->query()) {
						//echo $this->db->stderr();
						fclose($handle);
						return false;
					}
					else $street_id = $this->db->insertid();
				}
				else {
					$street_id = $row;
				}

				// Ищем в таблице Адреса запись с ID города, улицы и №_дома и №_квартиры.
				// Если записи нет, то добавляем в таблицу Адреса.
				// Запоминаем ID адреса
				$sql = " SELECT *
                  	FROM #__tsj_address t1
                  	WHERE  t1.city_id = '" . $city_id . "' 
                  		AND t1.street_id = '" . $street_id . "' 
                  		AND t1.house = '" . trim($data[3]) . "' 
                  		AND t1.office = '" . trim($data[4]) . "';";

				$this->db->setQuery( $sql );
				$row = $this->db->loadResult();

				if (!$result = $this->db->query()) {
					//echo $this->db->stderr();
					fclose($handle);
					return false;
				}

				if (empty($row)) {
					// Добавить
					$sql = " INSERT INTO #__tsj_address
								(city_id, street_id, house, office)
                  		VALUES ('$city_id','$street_id','$data[3]','$data[4]');";

					$this->db->setQuery( $sql );

					if (!$result = $this->db->query()) {
						//echo $this->db->stderr();
						fclose($handle);
						return false;
					}
					else $address_id = $this->db->insertid();
				}
				else {
					$address_id = $row;
				}

				// Если в таблице users есть запись с username == account_num, то записываем в поле users.name ФИО
				// Если в таблице users нет записи с username == account_num, то создаем запись в users.name
				// Запоминаем user_id
				$sql = " SELECT *
                  	FROM #__users t1
                  	WHERE  t1.username = '" . trim($data[0]) . "';";

				$this->db->setQuery( $sql );
				$row = $this->db->loadResult();

				if (!$result = $this->db->query()) {
					//echo $this->db->stderr();
					fclose($handle);
					return false;
				}
				if (!empty($row)) {
					$user_id = $row;
				}
				else {
					echo "Для записи с лицевым счетом ". trim($data[0]) . " не создан пользователь с таким же логином.<br>";
					//continue;
						
					// Это регулярное выражение оставит только латиницу, цифры _ и -
					//$user_id = preg_replace('/[^a-zA-Z0-9\-_]/', '',$data[0]);
						
					// Это регулярное выражение удалит: пробелы и <>"'%;()&
					$user_id = preg_replace('/[ <>\"\'%;()]+/i', '', $data[0]);
                    $password = preg_replace('/[ <>\"\'%;()]+/i', '', $data[10]);
                    if(empty($data[11])) $email = $user_id . '@test.ru';
                    else $email = $data[11];
                    
                    
					// проверка на размер логина. Должен быть более 2х символов
					if(strlen($user_id) < 2) {
						echo "Ошибка. Логин должен быть не менее 2х символов.<br><br>";
						continue;
					}
						
					// Добавляем пользователя
					//echo "login = ".$user_id. "<br>";
					$currentdate = JFactory::getDate();
					echo "Пользователь добавлен автоматически ". $currentdate .".<br><br>";
						
                    if(!empty($data[10])){
                        // Если пароль указан
                        $sql = " INSERT INTO #__users
                                    (name, username, email, password, block, sendEmail, registerDate)
                            VALUES ('$data[5]','$user_id','" . $email . "','" . md5($password) . "','0','1','$currentdate');";
                    }
                    else{
                        $sql = " INSERT INTO #__users
                                    (name, username, email, password, block, sendEmail, registerDate)
                            VALUES ('$data[5]','$user_id','" . $email . "','" . md5($user_id) . "','0','1','$currentdate');";                    
                    }

					$this->db->setQuery( $sql );

					if (!$result = $this->db->query()) {
						echo $this->db->stderr();
						fclose($handle);
						return false;
					}
					$user_id = $this->db->insertid();
				}

				// Ищем в таблице Лицевые_счета номер лицевого счета.
				// Если записи с лицевым счетом нет, то добавляем запись в таблицу Лицевые_счета. И добавляем площадь и номер телефона.
				// Если запись с лицевым счетом есть, то обновляем остальные данные в таблице (считая что данные изменились).
				$sql = " SELECT *
                  	FROM #__tsj_account t1
                  	WHERE  t1.account_num = '" . trim($data[0]) . "';";

				$this->db->setQuery( $sql );
				$row = $this->db->loadResult();

				if (!$result = $this->db->query()) {
					//echo $this->db->stderr();
					fclose($handle);
					return false;
				}

				// Тут должно быть кодирование телефона чтобы его нельзя было посмотреть в прямую из базы.
				//$cipher = "MCRYPT_CAST_256";
				//$mode = "MCRYPT_MODE_ECB";
				//$key = "thg43hgfhd45";
				//echo $this->encrypt($data[7], $key,  $cipher, $mode);
				//$user_id = 258;

				if (empty($row)) {
					// Добавить
					$sql = " INSERT INTO #__tsj_account
								(user_id, address_id, account_num, sq, tel, cat, lic)
                  		VALUES ('$user_id','$address_id','$data[0]','$data[6]','$data[7]','$data[8]','$data[9]');";

					$this->db->setQuery( $sql );

					if (!$result = $this->db->query()) {
						echo $this->db->stderr();
						fclose($handle);
						return false;
					}
				}
				else {
					$sql = " UPDATE #__tsj_account
                  		SET   address_id='$address_id',
                        		sq='$data[6]', tel='$data[7]',
                        		cat='$data[8]', lic='$data[9]'
                  		WHERE account_num='$data[0]'";
						
					$this->db->setQuery( $sql );

					if (!$result = $this->db->query()) {
						//echo $this->db->stderr();
						fclose($handle);
						return false;
					}
				}

			}

			echo JText::_('COM_TSJ_IMPORT_FINISH');
			fclose($handle);
		}
		//$this->setRedirect('index.php?option=com_tsj');
	}

	public function setinnodb()
	{
		// Get the data from the form POST
		//$data = JRequest::getVar('submit', array(), 'post', 'array');
		if( isset($_POST['submit']))
		{
			$db = JFactory::getDBO();
			if (!$db->connected()) {
				echo "Нет соединения с сервером баз данных. Повторите запрос позже";
				jexit();
			}
			// Check for request forgeries.
			//JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
			 
			//$query = $db->getQuery(true);
			$query="ALTER TABLE `#__users` ENGINE=INNODB;";
			$db->setQuery($query);
			$result = $db->query();
		}

	}
	
	public function setconfig()
	{
		// Проверка токена

		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Инициализация переменных
		//$app    = JFactory::getApplication();
		$model  = $this->getModel('tsjs');

		// Получение данных формы configForm (configForm.xml) POST
		$data['water'] = JRequest::getVar('water', '2', 'post', 'integer');
		$data['gaz'] = JRequest::getVar('gaz', '2', 'post', 'integer');
		$data['electro'] = JRequest::getVar('electro', '2', 'post', 'integer');

		// Сохраним данные из формы в базе данных через метод модели setDataOfConfig
		$upditem        = $model->setDataOfConfig($data);

	}

}