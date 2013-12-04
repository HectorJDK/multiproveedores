function delete_equivalency_between_equivalent_and_original(original_id)
{
    var data =
    {
        original_id: original_id,
        equivalent_id: get_equivalent_id()
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

function get_equivalent_id()
{
    return $('#equivalent_id').val();
}

function add_this_as_equivalent_of_product()
{
    var data =
    {
        original_manufacturer_id: $('#new_original_manufacturer_id').val(),
        equivalent_manufacturer_id: $('#equivalent_manufacturer_id').val()
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