function updateQty(input, id)
{
	info = new Array();
	info[0] = id;
	info[1] = input.value;	
	$.ajax({
		url: 'http://localhost:8080/multiproveedores/Requests/updateQuantity',
		type: 'POST',
		data: JSON.stringify(info),
		contentType: 'application/json',
		async: false,
		success : function(data)
		{			
		},
		
		error : function(a,b,data)
		{			
		}			
	});

}