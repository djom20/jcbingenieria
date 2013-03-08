<?php
/**
 * Clase Login para validar un usuario comprobando su usuario (o cédula) y contraseña
 */
class Login {
	public $Tabla='tbl_usuarios'; //nombre de la tabla usarios
	public $Campo_cedula='usr_id'; //campo que contiene los datos de los usuarios (se puede usar el email)
	public $Campo_pass='usr_pass'; //campo que contiene la contraseña
	public $Metodo_encriptacion='texto'; //método utilizado para almacenar la contrasela. Opciones: sha1, md5, o texto

	private $link; //identificador de la conexión mysql que usamos
	
	/**
	* Se establece el método  de construccion de la clase que se llamará al crear el objeto y conectamos a la base de datos
	* @return bool
	*/
	public function __construct() {
		//1 - Me conecto la base de datos utilizando los parámetros globales
		// Si puedes utilizar una clase de acceso a la base de datos tipo singleton pues creo es mejor - No se como hacerlo -
		$this->link =  mysql_connect(SERVIDOR_MYSQL, USUARIO_MYSQL, PASSWORD_MYSQL);

		if (!$this->link) {
			trigger_error('Error al conectar al servidor mysql: ' . mysql_error(),E_USER_ERROR);
		}

		// Seleccionar la base de datos activa
		$db_selected = mysql_select_db(BASE_DATOS,$this->link);
		if (!$db_selected) {
			trigger_error ('Error al conectar a la base de datos: ' . mysql_error($this->link),E_USER_ERROR);
		}
		return true;
	}
   
	//el metodo de destrucción al destruir el objeto
	public function __destruct() {
		mysql_close($this->link);
	}

	/**
	* validar a un usuario y contraseña
	* @param string $usuario
	* @param string $pass
	* @return bool
	*/
	public function login($cedula, $pass) {

		//Se pregunta si el usuario y password tienen datos en los campos
		if (empty($cedula)) return false;
		if (empty ($pass)) return false;

		/**2 - preparar la consulta SQL a ejecutar utilizando sólo el usuario y así evitar ataques de inyección SQL.
		* Me parece recomdable
		*/
		$query='SELECT '.$this->Campo_cedula.', '.$this->Campo_pass.' FROM '.$this->Tabla.' WHERE '.$this->Campo_cedula.'="'.  mysql_real_escape_string($cedula).'" LIMIT 1 '; //la tabla y el campo tambien estan definidos en los parametros globales
		$result = mysql_query($query);
		if (!$result) {
			trigger_error('Error al ejecutar la consulta SQL: ' . mysql_error($this->link),E_USER_ERROR);
		}

		//3 - extraer el registro de este usuario
		$row = mysql_fetch_assoc($result);

		if ($row) {
			//4 - Generar el hash de la contraseña encriptada para comparar o sem podría dejar como texto plano
			switch ($this->Metodo_encriptacion) {
				case 'sha1'|'SHA1':
					$hash=sha1($pass);
					break;
				case 'md5'|'MD5':
					$hash=md5($pass);
					break;
				case 'texto'|'TEXTO':
					$hash=$pass;
					break;
				default:
					trigger_error('El valor de la propiedad Metodo_encriptacion no es válido. Utiliza MD5 o SHA1 o TEXTO',E_USER_ERROR);
			}

			//5 - comprobar la contraseña
			if ($hash==$row[$this->Campo_pass]) {
				@session_start();
				$_SESSION['usr_id']=array('user'=>$row[$this->Campo_cedula]); //almaceno en memoria el usuario
				// Tal vez aqui podrías almacenar las preferencias de usuario para 
				return true; //Cédula y contraseña validadas
			} else {
				@session_start();
				unset($_SESSION['usr_id']); //destruir la session activa al fallar el login por si existia
				return false; //no coincide la contraseña
			}
		} else {
			//El usuario no existe
			return false;
		}
	}
	
	/**
	 * Veridicar si el usuario está logeado
	 * @return bool
	 */
	public function estoy_logeado () {
		@session_start(); //inicia sesion (le puse @ para evitar los mensajes de error si la session ya está iniciada)

		if (!isset($_SESSION['usr_id'])) return false; //no existe la variable $_SESSION['usr_id']. No logeado.
		if (!is_array($_SESSION['usr_id'])) return false; //la variable no es un array $_SESSION['usr_id']. No logeado.
		if (empty($_SESSION['usr_id']['user'])) return false; //no tiene almacenado el usuario en $_SESSION['usr_id']. No logeado.

		//se cumplen las condiciones anteriores, entonces es un usuario valido
		return true;

	}

	/**
	 * Vaciar la sesion con los datos del usuario valido
	 */
	public function logout() {
		@session_start(); //inicia sesion (le puse @ para evitar los mensajes de error si la session ya está iniciada)
		unset($_SESSION['USUARIO']); //eliminamos la variable con los datos de usuario;
		session_write_close(); //nos asegurmos que se guarda y cierra la sesion
		return true;
	}
}

?>