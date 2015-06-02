<?php

function load_tiny_mce($textarea_ID)
{
	$output = '<script type="text/javascript" src="'.base_url().'assets/plugins/jquery_tiny_mce/jquery.tinymce.js"></script>';
	$output .= '
	<script type="text/javascript">
	$(function() {
	    $("textarea.tinymce").tinymce({
	        // Location of TinyMCE script
	        script_url: "'.base_url().'assets/plugins/jquery_tiny_mce/tiny_mce.js",

	        // General options
	        mode: "specific_textareas",
	        editor_selector: "mceEditor",
	        relative_urls: false,
	        remove_script_host: false,
	        document_base_url: "'.base_url().'",
	        theme: "advanced",
	        skin: "cirkuit",
	        plugins: "pdw,safari,pagebreak,style,table,advimage,advlink,emotions,inlinepopups,preview,media,contextmenu,paste,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,wordcount",
	        // Theme options
	        theme_advanced_buttons1: "bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,blockquote,bullist,numlist,formatselect,kitchensink",
	        theme_advanced_buttons2: "pastetext,pasteword,forecolor,charmap,sub,sup,outdent,indent,undo,redo,link,unlink,anchor,preview,fullscreen,help",
	        theme_advanced_buttons3: "tablecontrols,hr,media,nonbreaking,pagebreak",
	        theme_advanced_toolbar_location: "top",
	        theme_advanced_toolbar_align: "left",
	        theme_advanced_statusbar_location: "bottom",
	        theme_advanced_resizing: true,
	        theme_advanced_resize_horizontal: false,
	        pdw_toggle_on: true,
	        pdw_toggle_toolbars: "2,3",

	        // Content CSS
	        content_css: "'. base_url().'assets/plugins/jquery_tiny_mce/css/content.css",

	        setup: function(ed) {
	            // Add a custom button
	            ed.addButton("kitchensink", {
	                title: "Show toolbar",
	                image: "'. base_url().'assets/plugins/images/famfamfam/cog.png",
	                onclick: function() {
	                    var thisEditor = tinyMCE.getInstanceById("'.$textarea_ID.'");
	                    thisEditor.execCommand("mcePDWToggleToolbars");
	                }
	            });
	        }
	    });
	});
	</script>
	';
	return $output;
}

function crop_image($image, $filename,$ext,$filepath, $width, $height='')
{
	$ci =& get_instance();

	$image_size = getimagesize($image);
	$image_width = $image_size['0'];
	$image_height = $image_size['1'];
	
	if ($height ==''):
		$height = $width;
	endif;

	$new_image_name = $filename.'_'.$width.'x'.$height.$ext;

	$config['image_library'] = 'gd2';
	$config['source_image'] = $image;
	$config['new_image'] = '.'.$filepath.$new_image_name;
	$config['maintain_ratio'] = FALSE;
	if($image_width > $image_height):
		$config['height'] = $image_height;
		$config['width'] = $image_height;
	elseif($image_width < $image_height):
		$config['height'] = $image_width;
		$config['width'] = $image_width;
	else:
		$config['height'] = $image_width;
		$config['width'] = $image_width;
	endif;

	if($image_width > $image_height):
		$config['x_axis'] = (10/100)*$image_width;
		$config['y_axis'] = '0';
	elseif($image_width < $image_height):
		$config['x_axis'] = '0';
		$config['y_axis'] = (10/100)*$image_height;
	else:
		$config['x_axis'] = (10/100)*$image_width;
		$config['y_axis'] = '0';
	endif;
	$ci->image_lib->initialize($config);
	$ci->image_lib->crop();

	$ci->image_lib->clear();

	$config2['image_library'] = 'gd2';
	$config2['source_image'] = $config['new_image'];
	$config2['maintain_ratio'] = false;
	$config2['height'] = $height;
	$config2['width'] = $width;

	$ci->image_lib->initialize($config2);
	$ci->image_lib->resize();

	return $new_image_name;
}



