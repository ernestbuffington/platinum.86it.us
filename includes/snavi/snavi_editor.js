        // initialisation
		editAreaLoader.init({
			id: "snavi_config"	// id of the textarea to transform		
			,start_highlight: true	// if start with highlight
			,allow_resize: "both"
			,font_size: "8"
			,allow_toggle: true
			,word_wrap: true
			,language: "en"
			,syntax: "php"	
			,syntax_selection_allow: "css,html,js,php,xml,sql"
			,plugins: "charmap"
			,charmap_default: "arrows"
			,show_line_colors: true
			,replace_tab_by_spaces: 4
			,min_height: 350
			,toolbar: "charmap, |, search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"

		});
		
		editAreaLoader.init({
			id: "snavi_menu"	// id of the textarea to transform		
			,start_highlight: true	// if start with highlight
			,allow_resize: "both"
			,font_size: "8"
			,allow_toggle: true
			,word_wrap: true
			,language: "en"
			,syntax: "php"	
			,syntax_selection_allow: "css,html,js,php,xml,sql,basic"
			,plugins: "charmap"
			,charmap_default: "arrows"
			,show_line_colors: true
			,replace_tab_by_spaces: 4
			,min_height: 350
			,toolbar: "charmap, |, search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"

		});	
		
		editAreaLoader.init({
			id: "snavi_news"	// id of the textarea to transform		
			,start_highlight: true	// if start with highlight
			,allow_resize: "both"
			,font_size: "8"
			,allow_toggle: true
			,word_wrap: true
			,language: "en"
			,syntax: "html"	
			,syntax_selection_allow: "css,html,js,php,xml,sql,basic"
			,plugins: "charmap"
			,charmap_default: "arrows"
			,show_line_colors: true
			,replace_tab_by_spaces: 4
			,min_height: 350
			,toolbar: "charmap, |, search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"

		});
		
		editAreaLoader.init({
			id: "snavi_css"	// id of the textarea to transform		
			,start_highlight: true	// if start with highlight
			,allow_resize: "both"
			,font_size: "8"
			,allow_toggle: true
			,word_wrap: true
			,language: "en"
			,syntax: "css"	
			,syntax_selection_allow: "css,html,js,php,xml,sql,basic"
			,plugins: "charmap"
			,charmap_default: "arrows"
			,show_line_colors: true
			,replace_tab_by_spaces: 4
			,min_height: 350
			,toolbar: "charmap, |, search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"

		});		

		function toogle_editable(id)
		{
			editAreaLoader.execCommand(id, 'set_editable', !editAreaLoader.execCommand(id, 'is_editable'));
		}