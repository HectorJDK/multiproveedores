function enviar_cotizacion(request_id, product_id, supplier_id)
{
    $.ajax({
        url: 'http://localhost:8080/multiproveedores/requests/quoteForType',
        type: 'POST',
        contentType: 'application/json',
        async: false,
        data: JSON.stringify(new Array(request_id, supplier_id)),
        success : function(data)
        {
            alert('Se creó la cotización con éxito.');
        },
        error : function(a,b,data)
        {
            alert("Error al crear la cotización.\n");
        }
    });
}