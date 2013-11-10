// PRODUCT - FORM
//returns input for a given attribute
function fp_inputFor(prefix, attribute)
{
	data_type_id 	= attribute.Attributes.data_type_id;
	name			= attribute.Attributes.name;
	attribute_id 	= attribute.Attributes.id;

	input = $('<input>').attr({
				id: prefix + attribute_id, 
				name: name,
				attribute_id: attribute_id,
				class: 'input'
			});

	if(	data_type_id == 1 || 	//Entero
		data_type_id == 2 || 	//Decimal
		data_type_id == 3)		//Texto
	{
		//nada por ahora
	}
	if(	data_type_id == 4)	//Fecha
	{
		input.datepicker();
	}

	return input;
}

//returns an array describing the inputs' values
function fp_construct_array_for_attribute_values(form_id)
{
	attributes = $('#'+ form_id +' .input');

	attributes_array = new Array();
	for(i = 0; i < attributes.length; i++)
	{
		attribute = new Object();
		attributes_splited = attributes[i].id.split("-");

		attribute.attribute_id = attributes_splited[attributes_splited.length-1];
		attribute.value = attributes[i].value;
		attributes_array.push(attribute);
	}
	return attributes_array;
}

//Cambia los inputs de la forma dada
function fp_change_attributes_form(form_id, prefix, attributes)
{
	newInputs = new Array();

	attributesForm = $('#' + form_id);
	
	//remove previous inputs
	$('#' + form_id + ' .legend').remove();
	$('#' + form_id + ' .input').remove();
	
	attributes.forEach(function(attribute)
	{
		$('<legend>').attr('class', 'legend').html(attribute.Attributes.name).appendTo(attributesForm);
		fp_inputFor(prefix, attribute).appendTo(attributesForm);
	});
}

//whenever a type selector changes, reload the attributes' form/section inputs.
function fp_type_changed(form_id, prefix, type_input_id)
{
	type_id = $('#' + type_input_id).val();
	$.ajax({
		url: 'http://localhost:8080/multiproveedores/attributeServices/attributes_for_type_id/' + type_id,
		type: 'GET',
		contentType: 'application/json',
		async: false,
		success : function(data) {	
			fp_change_attributes_form(form_id, prefix, JSON.parse(data));
		},
		error : function(a,b,data) {
			alert("Error =)\n");
		}			
	});
}

