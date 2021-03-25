$(document).ready(function()
{
	$('.publish-notes-field').each(function()
	{
		var fieldset = $(this).parents('fieldset').first();
		$(this).insertBefore(fieldset);
		$(fieldset).remove();
		$(this).show();
	});
});