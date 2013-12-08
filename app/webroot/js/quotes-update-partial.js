function updatePrice(input, id, supplier_id, product_id)
{   
    info = new Array();
    info[0] = id;
    info[1] = input.value;
    info[2] = supplier_id;
    info[3] = product_id;
    $.ajax({
        url: 'http://localhost:8080/multiproveedores/Quotes/updatePrice',
        type: 'POST',
        data: JSON.stringify(info),
        contentType: 'application/json',
        async: false,
        success : function(data)
        {
            alert("Precio actualizado");
        },
        
        error : function(a,b,data)
        {           
            alert("Error en la actualización. Intente nuevamente");
        }           
    });
}
