$(document).ready(function()
{
	$('.publish-notes-field').each(function()
	{
		var col_group = $(this).parents('fieldset.col-group');
		var setting_field = $(this).parents('.setting-field');
		var setting_text = $(setting_field).siblings('.setting-txt');
		$(setting_text).hide();
		$(setting_field).removeClass('w-8').addClass('w-16');
		$(col_group).addClass('publish-notes-col-group');		
		$(this).show();
	});
});