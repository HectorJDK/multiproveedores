function remove_product_from_supplier(product_id)
{
    var data = {
        product_id: product_id,
        supplier_id: get_supplier_id()
    };
    $.ajax({
        url: 'http://localhost:8080/multiproveedores/productsSuppliers/remove_product_from_supplier',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        async: false,
        success : function(data)
        {
            remove_relation(product_id);
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

function remove_relation(product_id)
{
    $("#p-".concat(product_id)).remove();
}

function ensure_that_supplier_supplies_product()
{
    var data = {
        supplier_id: get_supplier_id(),
        product_id: get_new_manufacturer_id(),
        price: get_new_price()
    };
    $.ajax({
        url: 'http://localhost:8080/multiproveedores/productsSuppliers/ensure_that_supplier_supplies_product_by_manufacturer_id',
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

function get_new_manufacturer_id()
{
    return $("#".concat('new_manufacturer_id')).val();
}

function get_new_price()
{
    return $("#".concat('new_price')).val();
}

