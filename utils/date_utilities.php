<?php
/**
 * Funciones utilitarias para las fechas
 * 
 * La clase date_utilities consiste en un conjunto de funciones relativas al tiempo, tales como
 * la impresión de la fecha y hora en texto en español, y la edad en años, meses y días.
 * 
 * Fecha de creación: 2016-03-24 17:43
 * 
 * @author	Edwin Fajardo <contacto@edwinfajardo.com>
 * @copyright 2016-2022 Edwin Fajardo. All rights reserved
 */
class date_utilities
{
	/** @var array<int,string> $months Nombre de los meses.
	 * 
	 * Se incluyen en esta documentación para que el script reconozca que son palabras que se deben traducir.
	 * _("January"),
	 * _("February"),
	 * _("March"),
	 * _("April"),
	 * _("May"),
	 * _("June"),
	 * _("July"),
	 * _("August"),
	 * _("September"),
	 * _("October"),
	 * _("November"),
	 * _("December")
	*/
	public static $months = Array(
		"January",
		"February",
		"March",
		"April",
		"May",
		"June",
		"July",
		"August",
		"September",
		"October",
		"November",
		"December"
	);
	
	/**
	 * Fecha del formato ISO a texto
	 * 
	 * Convierte una fecha dada en formato ISO, tal como viene de un campo date o datetime de la base
	 * de datos, y la devuelve en texto.
	 * 
	 * @param string $sql_date La fecha en formato ISO.
	 * @param boolean $hour Si es verdadero, se incluye la hora.
	 * @param boolean $dayname Si es verdadero, se incluye el nombre del día de la semana.
	 * 
	 * @return string La fecha en texto
	 */
	public static function sql_date_to_string($sql_date, $hour = false, $dayname = false)
	{
		$time = strtotime($sql_date);
		$string = self::date_to_string($time, $dayname);
		if($hour)
		{
			$string .= " " . _("at") . " " . self::hour($sql_date);
		}
		return $string;
	}
	
	/**
	 * Fecha del formato DateTime a texto
	 * 
	 * Convierte una fecha dada en formato DateTime y la devuelve en texto.
	 * 
	 * @param DateTime $time La fecha en formato DateTime.
	 * @param boolean $dayname Si es verdadero, se incluye el nombre del día de la semana.
	 * 
	 * @return string La fecha en texto
	 */
	public static function date_to_string($time, $dayname = false)
	{
		$time_data = Array(Date("Y", $time), Date("n", $time) - 1, Date("d", $time), Date("w", $time));
		$days = Array(
			_("Sunday"),
			_("Monday"),
			_("Tuesday"),
			_("Wednesday"),
			_("Thursday"),
			_("Friday"),
			_("Saturday")
		);
		$date = "";
		if($dayname)
		{
			$date = _($days[$time_data[3]]) . ', ';
		}
		if(Session::get("lang") == "es")
		{
			$date .= $time_data[2] . ' de ' . _(self::$months[$time_data[1]]) . ' de ' . $time_data[0];
		}
		else
		{
			$date .= self::$months[$time_data[1]] . ' ' . $time_data[2] . ', ' . $time_data[0];
		}
		return $date;
	}
	
	/**
	 * Intervalo a texto
	 * 
	 * Convierte un intervalo de fechas en texto, usando, de manera inteligente el mes y el año
	 * sólo en caso de ser necesarios.
	 * 
	 * @param string $begin La fecha inicial en formato ISO.
	 * @param string $end La fecha final en formato ISO.
	 * 
	 * @return string El intervalo en texto.
	 */
	public static function interval_to_string($begin, $end)
	{
		$time_begin = strtotime($begin);
		$time_end = strtotime($end);
		$begin_data = Array(Date("Y", $time_begin), Date("n", $time_begin) - 1, Date("d", $time_begin));
		$end_data = Array(Date("Y", $time_end), Date("n", $time_end) - 1, Date("d", $time_end));
		$interval_str = "";
		if($begin_data[0] == $end_data[0])
		{
			if($begin_data[1] == $end_data[1])
			{
				$interval_str = 'del ' . $begin_data[2] . ' al ' . $end_data[2] . ' de ' . self::$months[$end_data[1]] . ' de ' . $end_data[0];
			}
			else
			{
				$interval_str = 'del ' . $begin_data[2] . ' de ' . self::$months[$begin_data[1]] . ' al ' . $end_data[2] . ' de ' . self::$months[$end_data[1]] . ' de ' . $end_data[0];
			}
		}
		else
		{
			$interval_str = 'del ' . $begin_data[2] . ' de ' . self::$months[$begin_data[1]] . ' de ' . $begin_data[0] . ' al ' . $end_data[2] . ' de ' . self::$months[$end_data[1]] . ' de ' . $end_data[0];
		}
		return $interval_str;
	}
	
	/**
	 * Hora
	 * 
	 * Devuelve la hora en formato hora:minuto (am o pm), en formato de doce horas.
	 * 
	 * @param string $date_str Fecha en formato ISO
	 * 
	 * @return string Hora
	 */
	public static function hour($date_str)
	{
		$time = strtotime($date_str);
		return Date("h:i a", $time);
	}
	
	/**
	 * Día del mes
	 * 
	 * Devuelve el día del mes (Por ejemplo: 31 de diciembre) de una fecha dada en formato ISO.
	 * 
	 * @param string $date La fecha en formato ISO
	 * 
	 * @return string El día del mes
	 */
	public static function day_of_month($date)
	{
		$time = strtotime($date);
		$time_data = Array(Date("n", $time) - 1, Date("d", $time));
		$day_of_month = $time_data[1] . ' de ' . self::$months[$time_data[0]];
		return $day_of_month;
	}

	/**
	 * Calculadora de tiempo.
	 * 
	 * Calcula el tiempo transcurrido desde una fecha especificada hasta el momento de ejecución del
	 * método. Devuelve la respuesta en años, meses, días, horas, minutos y/o segundos, de manera
	 * razonable.
	 * 
	 * @param string $time_string La fecha dada
	 * 
	 * @return string El tiempo transcurrido en la unidad que parezca razonable.
	 */
	public static function sql_date_to_ago($time_string)
	{
		$time = new DateTime($time_string);
		$ago = $time->diff(new DateTime());
		$string = "";
		if($ago->y > 0)
		{
			$string = $ago->y . " " . _("year");
			if($ago->y != 1)
			{
				$string .= "s";
			}
		}
		if($ago->m > 0 || $string != "")
		{
			if($string != "")
			{
				$string .= ", ";
			}
			$string .= $ago->m . " " . _("month");
			if($ago->m != 1)
			{
				$string .= "es";
			}
		}
		if($ago->d > 0 || $string != "")
		{
			if($string != "")
			{
				$string .= ", ";
			}
			$string .= $ago->d . " " . _("day");
			if($ago->d != 1)
			{
				$string .= "s";
			}
		}
		if($ago->h > 0 || $string != "")
		{
			if($string != "")
			{
				$string .= ", ";
			}
			$string .= $ago->h . " " . _("hour");
			if($ago->h != 1)
			{
				$string .= "s";
			}
		}
		if($ago->i > 0 || $string != "")
		{
			if($string != "")
			{
				$string .= ", ";
			}
			$string .= $ago->i . " " . _("minute");
			if($ago->i != 1)
			{
				$string .= "s";
			}
		}
		if($string != "")
		{
			$string .= " y ";
		}
		$string .= $ago->s . " " . _("second");
		if($ago->s != 1)
		{
			$string .= "s";
		}
		return $string;
	}

	/**
	 * Calculadora de edad
	 * 
	 * Calcula el tiempo transcurrido desde una fecha dada hasta el momento de ejecucion del método,
	 * y devuelve un texto con la edad en forma razonable, utilizando días y meses cuando se 
	 * considera necesario.
	 * 
	 * @param string $time_string La fecha inicial (Por ejemplo, la fecha de nacimiento)
	 * @param boolean $text La salida debe ser exclusivamente en texto
	 * 
	 * @return string La edad
	 */
	public static function sql_date_to_age($time_string, $text = false)
	{
		$time = new DateTime($time_string);
		$ago = $time->diff(new DateTime());
		$string = "";
		if($ago->y > 0)
		{
			$string = ($text ? text_utilities::number_to_text($ago->y) : $ago->y) . " año";
			if($ago->y != 1)
			{
				$string .= "s";
			}
		}
		if($ago->y < 5)
		{
			if($ago->m > 0 || $string != "")
			{
				if($string != "")
				{
					$string .= ", ";
				}
				$string .= $ago->m . " mes";
				if($ago->m != 1)
				{
					$string .= "es";
				}
			}
			if($ago->y == 0 && $ago->m < 12)
			{
				if($ago->d > 0 || $string != "")
				{
					if($string != "")
					{
						$string .= ", ";
					}
					$string .= $ago->d . " día";
					if($ago->d != 1)
					{
						$string .= "s";
					}
				}
			}
		}
		return $string;
	}

	/**
	 * Formato de fecha
	 * 
	 * Crea un objeto de la clase DateTime y devuelve la fecha en el formato solicitado.
	 * @param string $date La fecha a aplicar formato
	 * @param string $format El formato solicitado
	 * 
	 * @return string La fecha en el formato solicitado
	 */
	public static function format(&$date, $format)
	{
		if(empty($date) || $date == "0000-00-00")
		{
			$date = "";
		}
		else
		{
			$date_time = date_create($date);
			$date = date_format($date_time, $format);
		}
		return $date;
	}
}
?>
