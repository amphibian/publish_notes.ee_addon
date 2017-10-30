$(document).ready(function()
{
	$('.publish-notes-field').each(function()
	{
		var fieldset = $(this).parents('fieldset');
		var field_control = $(this).parents('.field-control');
		$(this).insertBefore(fieldset);
		$(fieldset, field_control).remove();
		$(this).show();
	});
});