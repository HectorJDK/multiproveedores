// PRODUCT - ADD
function type_changed()
{
	fp_type_changed('atributos', '', 'type_id');
}

$(function(){
    $('form').submit(function()
    {
    	attributes_array = fp_construct_array_for_attribute_values('atributos');
    	$("#attributes_values").val(JSON.stringify(attributes_array));
    });
});