function ensure_that_supplier_supplies_type(type_name)
{
    var data = {
        supplier_id: get_supplier_id(),
        type_name: get_new_type_name()
    };
    $.ajax({
        url: 'http://localhost:8080/multiproveedores/suppliersTypes/ensure_that_supplier_supplies_type',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
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

function remove_type_from_supplier(type_id)
{
    var data = {
        type_id: type_id,
        supplier_id: get_supplier_id()
    };
    $.ajax({
        url: 'http://localhost:8080/multiproveedores/suppliersTypes/remove_type_from_supplier',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        async: false,
        success : function(data)
        {
            remove_relation(type_id);
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

function remove_relation(type_id)
{
    $("#t-".concat(type_id)).remove();
}

function get_new_type_name()
{
    return $("#".concat('new_type_name')).val();
}

