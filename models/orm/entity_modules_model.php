<?php
/**
 * Model for entity_modules
 * 
 * Generated by BlackPHP
 */

class entity_modules_model
{
	use ORM;

	/** @var int $emodule_id ID de la tabla */
	private $emodule_id;

	/** @var int $entity_id ID de la empresa */
	private $entity_id;

	/** @var int $module_id ID del módulo */
	private $module_id;

	/** @var int $module_order Ubicación del módulo en el menú */
	private $module_order;

	/** @var string $creation_time - */
	private $creation_time;

	/** @var string $edition_time - */
	private $edition_time;

	/** @var int $status - */
	private $status;


	/** @var string $_table_name Nombre de la tabla */
	private static $_table_name = "entity_modules";

	/** @var string $_table_type Tipo de tabla */
	private static $_table_type = "BASE TABLE";

	/** @var string $_primary_key Llave primaria */
	private static $_primary_key = "emodule_id";

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
			$this->module_order = 1;
			$this->status = 1;
		}
	}

	public function getEmodule_id()
	{
		return $this->emodule_id;
	}

	public function setEmodule_id($value)
	{
		$this->emodule_id = $value === null ? null : (int)$value;
	}

	public function getEntity_id()
	{
		return $this->entity_id;
	}

	public function setEntity_id($value)
	{
		$this->entity_id = $value === null ? null : (int)$value;
	}

	public function getModule_id()
	{
		return $this->module_id;
	}

	public function setModule_id($value)
	{
		$this->module_id = $value === null ? null : (int)$value;
	}

	public function getModule_order()
	{
		return $this->module_order;
	}

	public function setModule_order($value)
	{
		$this->module_order = $value === null ? null : (int)$value;
	}

	public function getCreation_time()
	{
		return $this->creation_time;
	}

	public function setCreation_time($value)
	{
		$this->creation_time = $value === null ? null : (string)$value;
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
