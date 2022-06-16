<?php
/**
 * Clase View
 * 
 * El presente fichero contiene la clase View, que se encarga de renderizar las vistas e imprimirlas.
 * Incorporado desde 2017-09-12 14:00
 * 
 * Para crear las vistas, se hace uso de plantillas previamente escritas en HTML. En el documento HTML
 * se hace una búsqueda de los patrones siguientes:
 * 1) {{ variable }}: Una variable entre llaves dobles es sustituida por un velor del arreglo $data 
 * con la clave especificada.
 * 2) [[ variable ]]: Una variable entre corchetes dobles es sustituída por un array asociativo de 
 * datos, cuya clave está definida por cada {{ clave }} entre corchetes contenida entre [[ variable ]] y [[/ variable ]]
 * 3) &lt;!-- variable --&gt; Conjunto de etiquetas HTML &lt;!-- /variable --&gt;: Este conjunto de etiquetas HTML será omitido si en el arreglo $restrict existe la clave.
 * 4) _(Palabra): La palabra contenida se busca en los archivos de idioma con gettext.
 */

class View
{
	/**
	 * @var array $data Array asociativo con datos del controlador que se van a imprimir en la plantilla.
	 */
	public $data;

	/**
	 * @var array $restrict Array asociativo con datos del controlador que se van a omitir en la plantilla.
	 */
	public $restrict;

	/**
	 * Constructor de la clase.
	 * 
	 * Se inicializan los arreglos $data y $restrict.
	 */
	function __construct()
	{
		$this->restrict = Array();
		$this->data = Array();
	}

	/**
	 * render
	 * 
	 * Método que se encarga de renderizar la plantilla, y devolver un HTML con la vista que incluye los valores especificados en el arreglo $data
	 * 
	 * @param string $name Nombre del fichero HTML la vista
	 * @param bool $return Si es verdadero, el método retorna el HTML en vez de imprimirlo.
	 * 
	 * @return string|void Vista renderizada o void.
	 */
	public function render($name, $return = false)
	{
		$filename = 'views/' . $name . '.html';
		if (!file_exists($filename)) {
			return "Error loading template file ($filename).";
		}
		$template = file_get_contents($filename);

		/* \1: Temporary value for the new line character to avoid problems with preg_replace */
		$template = str_replace("\r\n", "\1", $template);
		$template = str_replace("\n", "\1", $template);

		foreach ($this->data as $key => $value)
		{
			if(!is_array($value))
			{
				$tagToReplace = "{{ $key }}";
				$template = str_replace($tagToReplace, $value, $template);
			}
			else
			{
				$first = true;
				$text = "";
				$array_key = "[[ $key ]]";
				$begin = strpos($template, $array_key);
				if($begin == false)
				{
					continue;
				}
				$begin += strlen($array_key);
				$end = strpos($template, "[[/ $key ]]");
				$sub = substr($template, $begin, $end - $begin);
				foreach($value as $item_key => $item_value)
				{
					$line = $sub;
					foreach($item_value as $cell_key=>$cell_value)
					{
						$tagToReplace = "{{ $cell_key }}";
						$line = str_replace($tagToReplace, $cell_value, $line);
					}
					$text .= $line;
				}
				$template = preg_replace("/\[\[ $key \]\].*\[\[\/ $key \]\]/", $text, $template);
			}
		}

		# Hide parts of HTML
		foreach($this->restrict as $restrict)
		{
			$template = str_replace("<!-- $restrict -->", "\r\n<!-- $restrict -->", $template);
			$template = preg_replace("/<!-- $restrict -->.*\<!-- \/$restrict -->/", "", $template);
		}

		#Translate
		$all_matches = Array();
		if (preg_match_all("/_\(([^\)]+)\)/i", $template, $all_matches)) {
			if(!empty($all_matches[1]))
			{
				$matches = $all_matches[1];
				for($i = 0; $i < count($matches); $i++)
				{
					$template = str_replace("_($matches[$i])", _($matches[$i]), $template);
				}
			}
		}
		$template = str_replace("_()", "", $template);

		# Remove the unused vars
		$template = preg_replace("/\[\[ [a-z0-9_]* \]\].*\[\[\/ [a-z0-9_]* \]\]/", "", $template);
		$template = preg_replace("/\{\{ [a-z0-9_]* \}\}/", "", $template);

		# Restore the newline character
		$template = str_replace("\1", "\r\n", $template);

		# Return rendered as string or print to output
		if($return)
		{
			return $template;
		}
		else
		{
			echo $template;
		}
	}

	/**
	 * Add
	 * 
	 * Agrega hojas de estilo css o script js, evaluando previamente la existencia de los ficheros en
	 * el tema de la sesión y añadiendo una marca de tiempo de modificación, para evitar la
	 * desactualización por caché del navegador.
	 * 
	 * @param string $type Tipo de archivo a agregar (scripts o styles)
	 * @param string $extension Extensión del archivo (css o js)
	 * @param array $files Conjunto de archivos a agregar
	 * 
	 * @return void
	 */
	public function add($type, $extension, $files)
	{
		foreach($files as $file)
		{
			$filename = "public/themes/" . Session::get("theme_url") . "/" . $file;
			if(!file_exists($filename))
			{
				$filename = "public/" . $file;
			}
			if(file_exists($filename))
			{
				$time = filemtime($filename);
				$this->data[$type][] = Array("$extension" => $filename . "?t=" . $time);
			}
		}
	}

	/**
	 * Standard methods BlackPHP
	 * @version 1.0.0
	 * Default lists, forms, details, menu and errors
	 */

	public function standard_list()
	{
		$this->add("styles", "css", Array(
			'external/css/jquery-ui.min.css',
			'external/css/jAlert.css',
			'external/css/jqpagination.css',
			'external/css/select2.css',
			'styles/main.css',
			'styles/lists.css',
			'styles/loading.css',
			'styles/forms.css',
			'styles/print_area.css',
			'styles/dialogs.css',
			'styles/currencies.css'
		));
		$this->add("scripts", "js", Array(
			'external/js/jquery-3.2.1.min.js',
			'external/js/jquery-ui.min.js',
			'external/js/jAlert.min.js',
			'external/js/jquery.jqpagination.min.js',
			'external/js/select2.min.js',
			'external/js/printThis.js',
			'external/js/jquery.floatThead.min.js',
			'scripts/bpscript.min.js'
		));
	}

	public function standard_form()
	{
		$this->add("styles", "css", Array(
			'external/css/jquery-ui.min.css',
			'external/css/jAlert.css',
			'external/css/select2.css',
			'external/css/image-uploader.min.css',
			'external/css/imagereader.css',
			'styles/main.css',
			'styles/loading.css',
			'styles/forms.css',
			'styles/dialogs.css',
			'styles/print_area.css',
			"styles/currencies.css",
			'styles/tree.css'
		));
		$this->add("scripts", "js", Array(
			'external/js/jquery-3.2.1.min.js',
			'external/js/jquery-ui.min.js',
			'external/js/jAlert.min.js',
			'external/js/select2.min.js',
			'external/js/image-uploader.js',
			'external/js/jquery.imagereader-1.1.0.min.js',
			'scripts/bpscript.min.js'
		));
	}

	public function standard_details()
	{
		$this->add("styles", "css", Array(
			'external/css/jquery-ui.min.css',
			'external/css/jAlert.css',
			'external/css/select2.css',
			'styles/main.css',
			'styles/loading.css',
			'styles/forms.css',
			'styles/dialogs.css',
			'styles/print_area.css',
			'styles/details.css',
			"styles/currencies.css"
		));
		$this->add("scripts", "js", Array(
			'external/js/jquery-3.2.1.min.js',
			'external/js/jquery-ui.min.js',
			'external/js/jAlert.min.js',
			'external/js/select2.min.js',
			'external/js/printThis.js',
			'scripts/bpscript.min.js'
		));
	}

	public function standard_menu()
	{
		$this->add("styles", "css", Array(
			'external/css/jquery-ui.min.css',
			'external/css/jAlert.css',
			'external/css/select2.css',
			'styles/main.css',
			'styles/forms.css',
			'styles/loading.css',
			'styles/menu.css'
		));
		$this->add("scripts", "js", Array(
			'external/js/jquery-3.2.1.min.js',
			'external/js/jquery-ui.min.js',
			'external/js/jAlert.min.js',
			'external/js/select2.min.js',
			'scripts/bpscript.min.js'
		));
	}

	public function standard_error()
	{
		$this->add("styles", "css", Array(
			'external/css/jquery-ui.min.css',
			'external/css/jAlert.css',
			'external/css/select2.css',
			'styles/main.css'
		));
		$this->add("scripts", "js", Array(
			'external/js/jquery-3.2.1.min.js',
			'external/js/jquery-ui.min.js',
			'external/js/jAlert.min.js',
			'external/js/select2.min.js',
			'scripts/bpscript.min.js'
		));
	}
}
?>
