function enviar_cotizacion(request_id, supplier_id, product_id)
{
    $.ajax({
        url: 'http://localhost:8080/multiproveedores/requests/quoteForProduct',
        type: 'POST',
        contentType: 'application/json',
        async: false,
        data: JSON.stringify(new Array(request_id, supplier_id, product_id)),
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