<?php
/**
 * Model for app_methods
 * 
 * Generated by BlackPHP
 */

class app_methods_model
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


	/** @var string $_table_name Nombre de la tabla */
	private static $_table_name = "app_methods";

	/** @var string $_primary_key Llave primaria */
	private static $_primary_key = "method_id";

	/** @var bool $_timestamps La tabla usa marcas de tiempo para la inserción y edición de datos */
	private static $_timestamps = false;

	/** @var bool $_soft_delete La tabla soporta borrado suave */
	private static $_soft_delete = true;

	/**
	 * Constructor de la clase
	 * 
	 * Se inicializan las propiedades con los valores de los campos default
	 * de la base de datos
	 **/
	public function __construct()
	{
		$this->status = 1;
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

	public function entity_methods()
	{
		entity_methods_model::flush();
		return entity_methods_model::where("method_id", $this->method_id);
	}

	public function user_methods()
	{
		user_methods_model::flush();
		return user_methods_model::where("method_id", $this->method_id);
	}
}
?>
