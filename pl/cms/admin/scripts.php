<?php if (($page->pageId == 25) or ($page->pageId == 26)){ //Wersja prosta ?>
<script language="javascript" type="text/javascript" src="../js/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	language : "pl",
	mode : "textareas",
	theme : "simple"
});
</script>
<? } ?>
<?php if (($page->pageId == 19) or ($page->pageId == 20)){ //Wersja word ?>
<!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="../js/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode : "exact",
		elements : "context_m",
		//elements : "elm1,elm2",
		//mode : "textareas",
		theme : "advanced",
		language : "pl",
		plugins : "table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,contextmenu,paste,directionality,fullscreen",
		theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,separator,forecolor,backcolor",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "emotions,iespell,flash,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_path_location : "bottom",
		content_css : "../css/textarea.css",
	    plugin_insertdate_dateFormat : "%Y-%m-%d",
	    plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
		//external_link_list_url : "example_data/example_link_list.js",
		//external_image_list_url : "example_data/example_image_list.js",
		flash_external_list_url : "example_data/example_flash_list.js",
		file_browser_callback : "mcFileManager.filebrowserCallBack",
		paste_auto_cleanup_on_paste : true,
		paste_convert_headers_to_strong : true
	});
	tinyMCE.init({
		language : "pl",
		mode : "exact",
		elements : "introduction_m",
		theme : "simple"
	});
</script>
<!-- /tinyMCE -->
<? } ?>
<?php if (($page->pageId == 6) or ($page->pageId == 7)){ //Wersja word ?>
<!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="../js/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	mode : "exact",
	elements : "tem_comment",
	theme : "simple"
});	
</script>
<!-- /tinyMCE -->
<? } ?>