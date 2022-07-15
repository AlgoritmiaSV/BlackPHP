<?php
/**
 * Model for users
 * 
 * Generated by BlackPHP
 */

class users_model
{
	use ORM;

	/** @var int $user_id ID de la tabla */
	private $user_id;

	/** @var int $entity_id ID de la empresa */
	private $entity_id;

	/** @var string $user_name Nombre completo del usuario */
	private $user_name;

	/** @var string $nickname Usuario para inicio de sesión */
	private $nickname;

	/** @var string $email Correo electrónico */
	private $email;

	/** @var string $password Contraseña */
	private $password;

	/** @var int $theme_id Tema de visualización del usuario */
	private $theme_id;

	/** @var string $locale Idioma del usuario */
	private $locale;

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
	private static $_table_name = "users";

	/** @var string $_primary_key Llave primaria */
	private static $_primary_key = "user_id";

	/** @var bool $_timestamps La tabla usa marcas de tiempo para la inserción y edición de datos */
	private static $_timestamps = true;

	/** @var bool $_soft_delete La tabla soporta borrado suave */
	private static $_soft_delete = true;


	public function getUser_id()
	{
		return $this->user_id;
	}

	public function setUser_id($value)
	{
		$this->user_id = (int)$value;
	}

	public function getEntity_id()
	{
		return $this->entity_id;
	}

	public function setEntity_id($value)
	{
		$this->entity_id = (int)$value;
	}

	public function getUser_name()
	{
		return $this->user_name;
	}

	public function setUser_name($value)
	{
		$this->user_name = (string)$value;
	}

	public function getNickname()
	{
		return $this->nickname;
	}

	public function setNickname($value)
	{
		$this->nickname = (string)$value;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($value)
	{
		$this->email = (string)$value;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($value)
	{
		$this->password = (string)$value;
	}

	public function getTheme_id()
	{
		return $this->theme_id;
	}

	public function setTheme_id($value)
	{
		$this->theme_id = (int)$value;
	}

	public function getLocale()
	{
		return $this->locale;
	}

	public function setLocale($value)
	{
		$this->locale = (string)$value;
	}

	public function getCreation_user()
	{
		return $this->creation_user;
	}

	public function setCreation_user($value)
	{
		$this->creation_user = (int)$value;
	}

	public function getCreation_time()
	{
		return $this->creation_time;
	}

	public function setCreation_time($value)
	{
		$this->creation_time = (string)$value;
	}

	public function getEdition_user()
	{
		return $this->edition_user;
	}

	public function setEdition_user($value)
	{
		$this->edition_user = (int)$value;
	}

	public function getEdition_time()
	{
		return $this->edition_time;
	}

	public function setEdition_time($value)
	{
		$this->edition_time = (string)$value;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function setStatus($value)
	{
		$this->status = (int)$value;
	}

	public function user_logs()
	{
		user_logs::flush();
		return user_logs::where("user_id", $this->user_id);
	}

	public function user_methods()
	{
		user_methods::flush();
		return user_methods::where("user_id", $this->user_id);
	}

	public function user_modules()
	{
		user_modules::flush();
		return user_modules::where("user_id", $this->user_id);
	}

	public function user_recovery()
	{
		user_recovery::flush();
		return user_recovery::where("user_id", $this->user_id);
	}

	public function user_sessions()
	{
		user_sessions::flush();
		return user_sessions::where("user_id", $this->user_id);
	}
}
?>
