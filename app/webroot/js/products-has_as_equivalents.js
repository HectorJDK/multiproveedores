function delete_equivalency_between_original_and_equivalent(equivalent_id)
{
    var data =
    {
        original_id: get_original_id(),
        equivalent_id: equivalent_id
    };
    $.ajax({
        url: 'http://localhost:8080/multiproveedores/equivalencyRelations/delete',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        async: false,
        success : function(x)
        {
            location.reload();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function get_original_id()
{
    return $('#original_id').val();
}

function add_product_as_equivalent_of_this()
{
    var data =
    {
        original_manufacturer_id: $('#original_manufacturer_id').val(),
        equivalent_manufacturer_id: $('#new_equivalent_manufacturer_id').val()
    };
    $.ajax({
        url: 'http://localhost:8080/multiproveedores/equivalencyRelations/add',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        async: false,
        success : function(x)
        {
            location.reload();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}