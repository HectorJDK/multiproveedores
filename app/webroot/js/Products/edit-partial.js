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



$(document).ready(function()
{
    var product = JSON.parse($('#product').val());
    var Attribute = product.Attribute;
    Attribute.forEach(function(att)
        {
            var formatted_att = new Object();
            formatted_att.Attributes = new Object();
            formatted_att.Attributes.data_type_id = att.data_type_id;
            formatted_att.Attributes.name = att.name;
            formatted_att.Attributes.id = att.id;

            var relation = att.AttributesProduct;
            var id = "data[Product][Attribute][" + relation.id + "]";
            var input = fp_inputWithIdNameAndValueForAttribute(id, id, relation.value, formatted_att);
            var label = $("<label for='" + id + "'>" + att.name + "</i></a>");
            $('#attributes').append(label);
            $('#attributes').append(input);
        }
    );
});