<?php
/**
 * Model for user_modules
 * 
 * Generated by BlackPHP
 */

class user_modules_model
{
	use ORM;

	/** @var int $umodule_id ID de la tabla */
	private $umodule_id;

	/** @var int $module_id ID del módulo */
	private $module_id;

	/** @var int $user_id ID del usuario */
	private $user_id;

	/** @var int $access_type Tipo de acceso al módulo */
	private $access_type;

	/** @var int $creation_user - */
	private $creation_user;

	/** @var string $creation_time - */
	private $creation_time;

	/** @var int $edition_user - */
	private $edition_user;

	/** @var string $edition_time - */
	private $edition_time;

	/** @var int $status - */
	private $status;


	/** @var string $_table_name Nombre de la tabla */
	private static $_table_name = "user_modules";

	/** @var string $_table_type Tipo de tabla */
	private static $_table_type = "BASE_TABLE";

	/** @var string $_primary_key Llave primaria */
	private static $_primary_key = "umodule_id";

	/** @var bool $_timestamps La tabla usa marcas de tiempo para la inserción y edición de datos */
	private static $_timestamps = true;

	/** @var bool $_soft_delete La tabla soporta borrado suave */
	private static $_soft_delete = true;

	/**
	 * Constructor de la clase
	 * 
	 * Se inicializan las propiedades de la clase.
	 * @param bool $default Determina si se utilizan, o no, los valores por defecto
	 * definidos en la base de datos.
	 **/
	public function __construct($default = true)
	{
		if($default)
		{
			$this->status = 1;
		}
	}

	public function getUmodule_id()
	{
		return $this->umodule_id;
	}

	public function setUmodule_id($value)
	{
		$this->umodule_id = $value === null ? null : (int)$value;
	}

	public function getModule_id()
	{
		return $this->module_id;
	}

	public function setModule_id($value)
	{
		$this->module_id = $value === null ? null : (int)$value;
	}

	public function getUser_id()
	{
		return $this->user_id;
	}

	public function setUser_id($value)
	{
		$this->user_id = $value === null ? null : (int)$value;
	}

	public function getAccess_type()
	{
		return $this->access_type;
	}

	public function setAccess_type($value)
	{
		$this->access_type = $value === null ? null : (int)$value;
	}

	public function getCreation_user()
	{
		return $this->creation_user;
	}

	public function setCreation_user($value)
	{
		$this->creation_user = $value === null ? null : (int)$value;
	}

	public function getCreation_time()
	{
		return $this->creation_time;
	}

	public function setCreation_time($value)
	{
		$this->creation_time = $value === null ? null : (string)$value;
	}

	public function getEdition_user()
	{
		return $this->edition_user;
	}

	public function setEdition_user($value)
	{
		$this->edition_user = $value === null ? null : (int)$value;
	}

	public function getEdition_time()
	{
		return $this->edition_time;
	}

	public function setEdition_time($value)
	{
		$this->edition_time = $value === null ? null : (string)$value;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function setStatus($value)
	{
		$this->status = $value === null ? null : (int)$value;
	}
}
?>
