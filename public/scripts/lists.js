/*
#	Lists viewer
#	By: Edwin Fajardo
#	Date-time: 2020-06-18 13:17
*/
$( function()
{
	/* Data viewer */
	$(".data_viewer").each(function() {
		load_table($(this).attr("id"));
	});

	function load_table(table_id)
	{
		var _table = $("#" + table_id);
		var _template = _table.find(".template").clone().removeClass("template").prop("outerHTML");
		$.ajax({
			method: "POST",
			url: url.module + "/" + table_id + "_loader/",
			data: url,
			dataType: "json"
		})
		.done(function(data) {
			if(data.content != null)
			{
				$.each(data.content, function(index, value) {
					tr = _template;
					$.each(value, function(e_index, e_value) {
						tr = tr.replace(new RegExp("{{" + e_index + "}}", 'g'), e_value);
					});
					$("#" + table_id + " tbody").append(tr);
				});
				$("#" + table_id + " tbody tr").click(function() {
					if($(this).data("href"))
					{
						location.href = $(this).data("href") + "/" + $(this).data("id") + "/"
					}
				});
				if(data.foot)
				{
					$.each(data.foot, function(index, value) {
						tr = $("#" + table_id + " tfoot").html();
						tr = tr.replace(new RegExp("{{" + index + "}}", 'g'), value);
						$("#" + table_id + " tfoot").html(tr);
					});
				}
			}
			if(data.found_rows != null)
			{
				current_page = 0;
				if(url.options.pagina == null)
				{
					current_page = data.found_rows > 0 ? 1 : 0;
				}
				else
				{
					current_page = url.options.pagina;
				}
				$('.pagination').jqPagination({
					paged: function(page) {
						url.options["pagina"] = page;
						goto_url();
					},
					max_page: Math.ceil(data.found_rows / 100),
					current_page: current_page,
					page_string: "{current_page} / {max_page}"
				});
			}
			_table.show();
			if(!_table.data("type"))
			{
				_table.floatThead({
					'scrollContainer': true
				});
			}
		})
		.fail(function() {
			$("div.loading_error").show();
		})
		.always(function() {
			$("div.loading_data").hide();
		});
	}
	/* Content loader */
	$(".content_loader").each(function() {
		load_content($(this).attr("id"));
	});

	function load_content(div_id)
	{
		var _div = $("#" + div_id);
		module = url.module || "index";
		$.ajax({
			method: "POST",
			url: module + "/" + div_id + "_loader/",
			data: url,
			dataType: "html"
		})
		.done(function(data) {
			_div.html(data);
			$(".menu_item").click(function() {
				$(this).css({
					"opacity":"0.1",
					"transform":"scale(2)"
				});
			});
			$("#main_content").has(".details_content").addClass("details_main_content");
			$(".close_details").click(function(e) {
				e.preventDefault();
				$(".details_content").css({
					"opacity":"0.1",
					"transform":"scale(0.1)"
				});
				history.back();
			});
			$(".link_button").click(function() {
				location.href = $(this).data("href");
			});
			_div.find(".print_button").click(function() {
				rand = Math.floor(Math.random() * 100000);
				print_header = null;
				if($(".print_header").length)
				{
					print_header = $(".print_header").html();
				}
				print_footer = null;
				if($(".print_footer").length)
				{
					print_footer = $(".print_footer").html();
				}
				$($(this).data("print")).printThis({
					'loadCSS': $(this).data("css") || "",
					'header': print_header,
					'footer': print_footer
				});
			});
			$(".open_dialog_button").click(function() {
				$("#" + $(this).data("dialog")).dialog("open");
			});
			if($(".delete_button").length)
			{
				$(".delete_button").click(delete_button_click);
			}
			//Show data viewer
			_div.find(".data_viewer").show();

			/* Link row */
			$(".link_row").click(function() {
				location.href = $(this).data("href");
			});
		})
		.fail(function() {
			$("div.loading_error").show();
		})
		.always(function() {
			$("div.loading_data").hide();
		});
	}

	$(".data_search").keyup(function() {
		string_value = $(this).val();
		$(".data_viewer tbody tr").not(".template").each(function() {
			found = false;
			$(this).find("td").each(function() {
				if($(this).text().toUpperCase().indexOf(string_value.toUpperCase()) >= 0)
				{
					found = true;
				}
			});
			if(found)
			{
				$(this).show();
			}
			else
			{
				$(this).hide();
			}
		});
	});

	/* Filter loader */
	filter_content = [];
	$(".data_filter").each(function() {
		if($(this).is("select"))
		{
			load_filter($(this).attr("id"));
		}
		else
		{
			$(this).change(function(){
				if($(this).is(".date_input"))
				{
					$(this).data("value", $(this).val());
					$(this).val($.datepicker.formatDate("yy-mm-dd", $(this).datepicker("getDate")));
				}
				url.options[$(this).data("identifier")] = $(this).val();
				goto_url();
			});
		}
	});

	function load_filter(selector_id)
	{
		action_module = url.module || "index";
		var _selector = $("#" + selector_id);
		if(_selector.data("module") != null)
		{
			action_module = _selector.data("module");
		}
		$.ajax({
			method: "POST",
			url: action_module + "/" + selector_id + "_loader/",
			data: url,
			dataType: "json"
		})
		.done(function(json_data) {
			if(json_data.results)
			{
				var select_params = {
					data: json_data.results,
					dropdownAutoWidth: true,
					placeholder: _selector.data("placeholder") || "",
					width: _selector.data("width") || "resolve"
				}
				if(_selector.data("search") == "true" || _selector.data("default") == "none")
				{
					item = $(document.createElement("option"));
					item.appendTo(_selector);
				}
				if(_selector.data("search") != "true")
				{
					select_params.minimumResultsForSearch = Infinity;
				}
				_selector.select2(select_params);
				if(_selector.data("value") != null)
				{
					_selector.val(_selector.data("value"));
					_selector.trigger('change.select2');
				}
				if(_selector.data("identifier"))
				{
					if(url.options[_selector.data("identifier")])
					{
						_selector.val(url.options[_selector.data("identifier")]);
						_selector.trigger('change.select2');
					}
					_selector.change(function(){
						url.options[_selector.data("identifier")] = _selector.val();
						goto_url();
					});
				}
			}
		})
		.fail(function() {
			_selector.hide();
		})
		.always(function() {
		});
	}

	/* Go To URL */
	function goto_url()
	{
		if(url.method == null)
		{
			url.method = "listar";
		}
		href = url.module + "/" + url.method + "/";
		$.each(url.options, function(key, value) {
			if(value != null && value != 0)
			{
				href += key + "/" + value + "/";
			}
		});
		
		location.href = href;
	}

	/* Print button */
	$(".print_button").click(function() {
		/* Destroy floatThead to avoid conficts with printThis */
		$($(this).data("print")).floatThead('destroy');
		rand = Math.floor(Math.random() * 100000);
		print_header = null;
		if($(".print_header").length)
		{
			print_header = $(".print_header").html();
		}
		print_footer = null;
		if($(".print_footer").length)
		{
			print_footer = $(".print_footer").html();
		}
		$($(this).data("print")).printThis({
			'loadCSS': 'public/styles/print_list.css?r=' + rand,
			'header': print_header,
			'footer': print_footer
		});
	});
});
