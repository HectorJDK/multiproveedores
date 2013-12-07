function enviar_cotizacion(request_id, supplier_id)
{
    var description = document.getElementById("description-"+supplier_id).value; 

    $.ajax({
        url: 'http://localhost:8080/multiproveedores/requests/quoteForType',
        type: 'POST',
        contentType: 'application/json',
        async: false,
        data: JSON.stringify(new Array(request_id, supplier_id, description)),
        success : function(data)
        {            
            alert('Se creó la cotización con éxito.');
        },
        error: function (xhr, ajaxOptions, thrownError)
        {
            var message = JSON.parse(xhr.responseText);
            alert(message);

        }
    });
     $('#modal-'+supplier_id).modal('hide'); 
}