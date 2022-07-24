<?php
/**
 * Model for user_sessions
 * 
 * Generated by BlackPHP
 */

class user_sessions_model
{
	use ORM;

	/** @var int $usession_id ID de la tabla */
	private $usession_id;

	/** @var int $user_id ID del usuario */
	private $user_id;

	/** @var int $branch_id Sucursal en la que inició sesión */
	private $branch_id;

	/** @var string $ip_address Dirección IP desde donde se conecta */
	private $ip_address;

	/** @var int $browser_id Navegador que usa */
	private $browser_id;

	/** @var string $date_time Fecha y hora */
	private $date_time;


	/** @var string $_table_name Nombre de la tabla */
	private static $_table_name = "user_sessions";

	/** @var string $_primary_key Llave primaria */
	private static $_primary_key = "usession_id";

	/** @var bool $_timestamps La tabla usa marcas de tiempo para la inserción y edición de datos */
	private static $_timestamps = false;

	/** @var bool $_soft_delete La tabla soporta borrado suave */
	private static $_soft_delete = false;

	/**
	 * Constructor de la clase
	 * 
	 * Se inicializan las propiedades con los valores de los campos default
	 * de la base de datos
	 **/
	public function __construct()
	{
	}

	public function getUsession_id()
	{
		return $this->usession_id;
	}

	public function setUsession_id($value)
	{
		$this->usession_id = $value === null ? null : (int)$value;
	}

	public function getUser_id()
	{
		return $this->user_id;
	}

	public function setUser_id($value)
	{
		$this->user_id = $value === null ? null : (int)$value;
	}

	public function getBranch_id()
	{
		return $this->branch_id;
	}

	public function setBranch_id($value)
	{
		$this->branch_id = $value === null ? null : (int)$value;
	}

	public function getIp_address()
	{
		return $this->ip_address;
	}

	public function setIp_address($value)
	{
		$this->ip_address = $value === null ? null : (string)$value;
	}

	public function getBrowser_id()
	{
		return $this->browser_id;
	}

	public function setBrowser_id($value)
	{
		$this->browser_id = $value === null ? null : (int)$value;
	}

	public function getDate_time()
	{
		return $this->date_time;
	}

	public function setDate_time($value)
	{
		$this->date_time = $value === null ? null : (string)$value;
	}
}
?>