// PRODUCT - ADD
function type_changed()
{
	fp_type_changed('atributos', '', 'type_id');
}

$(function(){
    $('form').submit(function()
    {
    	attributes_array = construct_array_for_attribute_values(form_id);
    	$("#atributos").val(JSON.stringify(attributes_array));
    });
});