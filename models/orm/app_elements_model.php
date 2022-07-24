<?php
/**
 * Model for app_elements
 * 
 * Generated by BlackPHP
 */

class app_elements_model
{
	use ORM;

	/** @var int $element_id ID de la tabla */
	private $element_id;

	/** @var string $element_key Clave del elemento */
	private $element_key;

	/** @var string $element_name Nombre del elemento */
	private $element_name;

	/** @var string $element_gender M: Masculino, F: Femenino */
	private $element_gender;

	/** @var string $element_number S: Singular, P: Plural */
	private $element_number;

	/** @var int $unique_element Es un elemento único */
	private $unique_element;

	/** @var int $module_id ID del módulo */
	private $module_id;

	/** @var string $method_name Nombre del método para ver detalle */
	private $method_name;


	/** @var string $_table_name Nombre de la tabla */
	private static $_table_name = "app_elements";

	/** @var string $_primary_key Llave primaria */
	private static $_primary_key = "element_id";

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
		$this->unique_element = 0;
	}

	public function getElement_id()
	{
		return $this->element_id;
	}

	public function setElement_id($value)
	{
		$this->element_id = $value === null ? null : (int)$value;
	}

	public function getElement_key()
	{
		return $this->element_key;
	}

	public function setElement_key($value)
	{
		$this->element_key = $value === null ? null : (string)$value;
	}

	public function getElement_name()
	{
		return $this->element_name;
	}

	public function setElement_name($value)
	{
		$this->element_name = $value === null ? null : (string)$value;
	}

	public function getElement_gender()
	{
		return $this->element_gender;
	}

	public function setElement_gender($value)
	{
		$this->element_gender = $value === null ? null : (string)$value;
	}

	public function getElement_number()
	{
		return $this->element_number;
	}

	public function setElement_number($value)
	{
		$this->element_number = $value === null ? null : (string)$value;
	}

	public function getUnique_element()
	{
		return $this->unique_element;
	}

	public function setUnique_element($value)
	{
		$this->unique_element = $value === null ? null : (int)$value;
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

	public function user_logs()
	{
		user_logs_model::flush();
		return user_logs_model::where("element_id", $this->element_id);
	}
}
?>