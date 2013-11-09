$(document).ready(function()
{
	attributes = new Array();
	$('#attributes').val(JSON.stringify(attributes));
});

function handle_delete(attribute_name)
{
	for(i = 0; i < attributes.length; i++)
	{
		if(attributes[i].name == attribute_name)
		{
			attributes = attributes.splice(i+1, 1);
			break;
		}
	}

	$("#".concat(attribute_name)).remove();
}

function se_llaman_igual(atributo, nombre)
{
	return atributo
}

function validar_atributo(attribute_name, attribute_type)
{
	exists_previous_attribute_with_same_name =
		attributes.filter(function(attribute){return attribute.name == attribute_name;}).length > 0;
	if(exists_previous_attribute_with_same_name)
	{
		alert("Ya existe un atributo llamado " + attribute_name);
		return false;
	}

	if(attribute_type == '')
	{
		alert("Necesita especificar un tipo para el atributo.");
		return false;
	}

	return true;
}

function add_attribute()
{
	attribute_name = $('#attribute_name').val();
	attribute_type = $('#attribute_type').val();

	if(!validar_atributo(attribute_name, attribute_type)) return;

	row = $('<tr id=\'' + attribute_name + '\' >');

	row.append($('<td>').html(attribute_name));
	row.append($('<td>').html(attribute_type));
	row.append(crear_button_row(attribute_name));
	
	$('#attributes_table').append(row);

	attribute = new Object();
	attribute.name = attribute_name;
	attribute.data_type_id = attribute_type;

	attributes.push(attribute);
	$('#attributes').val(JSON.stringify(attributes));
}

function crear_button_row(attribute_name)
{
	remove_button = $('<button type=\"button\">Borrar</button>');
	remove_button.click(function(){
		handle_delete(attribute_name);
	});
	return $('<td>').html(remove_button);
}