<?php
/**
 * Model for available_methods
 * 
 * Generated by BlackPHP
 */

class available_methods_model
{
	use ORM;

	/** @var int $method_id ID de la tabla */
	private $method_id;

	/** @var int $module_id ID del módulo */
	private $module_id;

	/** @var string $method_name Nombre del método */
	private $method_name;

	/** @var string $method_url URL del método (Nombre de la función PHP) */
	private $method_url;

	/** @var string $method_icon Ícono del método en el menú */
	private $method_icon;

	/** @var string $method_description Descripción del método */
	private $method_description;

	/** @var int $default_order Orden por defecto */
	private $default_order;

	/** @var int $status Estado 0:inactivo, 1:activo */
	private $status;

	/** @var int $method_order Orden en el que aoparecerá el método en el menú */
	private $method_order;

	/** @var int $id ID de la tabla */
	private $id;

	/** @var string $label Nombre del método */
	private $label;

	/** @var int $entity_id ID de la empresa */
	private $entity_id;

	/** @var int $user_id ID del usuario */
	private $user_id;


	/** @var string $_table_name Nombre de la tabla */
	private static $_table_name = "available_methods";

	/** @var string $_table_type Tipo de tabla */
	private static $_table_type = "VIEW";

	/** @var string $_primary_key Llave primaria */
	private static $_primary_key = "";

	/** @var bool $_timestamps La tabla usa marcas de tiempo para la inserción y edición de datos */
	private static $_timestamps = false;

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
			$this->method_id = 0;
			$this->status = 1;
			$this->method_order = 1;
			$this->id = 0;
		}
	}

	public function getMethod_id()
	{
		return $this->method_id;
	}

	public function setMethod_id($value)
	{
		$this->method_id = $value === null ? null : (int)$value;
	}

	public function getModule_id()
	{
		return $this->module_id;
	}

	public function setModule_id($value)
	{
		$this->module_id = $value === null ? null : (int)$value;
	}

	public function getMethod_name()
	{
		return $this->method_name;
	}

	public function setMethod_name($value)
	{
		$this->method_name = $value === null ? null : (string)$value;
	}

	public function getMethod_url()
	{
		return $this->method_url;
	}

	public function setMethod_url($value)
	{
		$this->method_url = $value === null ? null : (string)$value;
	}

	public function getMethod_icon()
	{
		return $this->method_icon;
	}

	public function setMethod_icon($value)
	{
		$this->method_icon = $value === null ? null : (string)$value;
	}

	public function getMethod_description()
	{
		return $this->method_description;
	}

	public function setMethod_description($value)
	{
		$this->method_description = $value === null ? null : (string)$value;
	}

	public function getDefault_order()
	{
		return $this->default_order;
	}

	public function setDefault_order($value)
	{
		$this->default_order = $value === null ? null : (int)$value;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function setStatus($value)
	{
		$this->status = $value === null ? null : (int)$value;
	}

	public function getMethod_order()
	{
		return $this->method_order;
	}

	public function setMethod_order($value)
	{
		$this->method_order = $value === null ? null : (int)$value;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($value)
	{
		$this->id = $value === null ? null : (int)$value;
	}

	public function getLabel()
	{
		return $this->label;
	}

	public function setLabel($value)
	{
		$this->label = $value === null ? null : (string)$value;
	}

	public function getEntity_id()
	{
		return $this->entity_id;
	}

	public function setEntity_id($value)
	{
		$this->entity_id = $value === null ? null : (int)$value;
	}

	public function getUser_id()
	{
		return $this->user_id;
	}

	public function setUser_id($value)
	{
		$this->user_id = $value === null ? null : (int)$value;
	}
}
?>
