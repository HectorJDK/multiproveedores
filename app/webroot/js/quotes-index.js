function getManufacturerIdFromQuote(quote_id)
{
    //la m es de manufacturer_id
    var id = "#m-".concat(quote_id);
    return $(id).val();
}

function getPriceFromQuote(quote_id)
{
    //la m es de manufacturer_id
    var id = "#p-".concat(quote_id);
    return $(id).val();
}

function replace_quote(quote_id, new_quote)
{
    var div_quote_id = "#q-".concat(quote_id);
    var div_quote = $(div_quote_id);
    div_quote.replaceWith(new_quote);
}

function setProductToQuote(quote_id, keyQ)
{
    var data = {
        quote_id: quote_id,
        manufacturer_id: getManufacturerIdFromQuote(quote_id),
        price: getPriceFromQuote(quote_id),
        keyQ: keyQ,
    };
    $.ajax({
        url: 'http://localhost:8080/multiproveedores/quotes/setProductToQuote',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        async: false,
        success : function(data)
        {
            replace_quote(quote_id, data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}