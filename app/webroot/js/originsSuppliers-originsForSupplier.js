function removeOriginFromSupplier(origin_id)
{
    var parameters = "/".concat(origin_id).concat("/").concat(get_supplier_id());
    $.ajax({
        url: "http://localhost:8080/multiproveedores/originsSuppliers/removeOriginFromSupplier".concat(parameters),
        type: 'POST',
        contentType: 'application/json',
        async: false,
        success : function(data)
        {
            remove_relation(origin_id);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function get_supplier_id()
{
    return $('#supplier_id').val();
}

function remove_relation(origin_id)
{
    $("#o-".concat(origin_id)).remove();
}

function addOriginToSupplier()
{
    var parameters = "/".concat(get_new_origin_id()).concat("/").concat(get_supplier_id());
    $.ajax({
        url: "http://localhost:8080/multiproveedores/originsSuppliers/addOriginToSupplier".concat(parameters),
        type: 'POST',
        contentType: 'application/json',
        async: false,
        success : function(data)
        {
            location.reload();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function get_new_origin_id()
{
    return $("#".concat('new_url')).val();
}

