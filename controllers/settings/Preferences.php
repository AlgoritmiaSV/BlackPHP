<?php
trait Preferences
{
	/**
	 * Preferencias del sistema
	 * 
	 * Muestra un formulario para cambiar datos opcionales en el sistema
	 * 
	 * @return void
	 */
	public function Preferences()
	{
		$this->session_required("html", $this->module);
		$this->view->data["title"] = _("Preferences");
		$this->view->standard_form();
		$this->view->data["nav"] = $this->view->render("main/nav", true);
		$this->view->data["config_modules"] = Array();
		foreach($this->view->data["modules"] as $key => $module)
		{
			$switches = entityOptionsModel::join("app_options", "option_id")->where("module_id", $module["module_id"])->where("option_type", 1)->getAllArray();
			$fields = entityOptionsModel::join("app_options", "option_id")->where("module_id", $module["module_id"])->where("option_type", 2)->getAllArray();
			if(count($switches) > 0 || count($fields) > 0)
			{
				$this->view->data["switches"] = $switches;
				$this->view->data["fields"] = $fields;
				$this->view->data["config_modules"][] = Array(
					"module_name" => $module["module_name"],
					"preferences" => $this->view->render("settings/preference_item", true)
				);
			}
		}
		$this->view->data["content"] = $this->view->render("settings/preferences", true);
		$this->view->render('main');
	}

	/**
	 * Guardar preferencias
	 * 
	 * Guarda las preferencias del usuario con los datros recibidos del formulario de preferencias.
	 * 
	 * @return void
	 */
	public function save_preferences()
	{
		$this->session_required("json");
		$data = $_POST;
		$data["success"] = false;
		entityOptionsModel::where("option_id IN (SELECT option_id FROM app_options WHERE option_type = 1)")->update(Array("option_value" => 0));
		foreach($_POST as $key => $value)
		{
			$option = appOptionsModel::where("option_key", $key)->get();
			$entity_option = $option->entityOptions()->get();
			$entity_option->setOptionValue($value);
			$entity_option->save();
		}

		$option_list = entityOptionsModel::select("option_key", "option_value")->join("app_options", "option_id")->where("option_type", 1)->getAll();
		$options = Array();
		foreach($option_list as $item)
		{
			$options[$item["option_key"]] = $item["option_value"];
		}
		Session::set("options", $options);

		$data["success"] = true;
		$data["title"] = _("Success");
		$data["message"] = _("Changes have been saved");
		$data["theme"] = "green";
		$data["no_reset"] = true;
		$this->json($data);
	}
}
?>