// REQUESTS - VIEW

function type_changed1()
{
        fp_type_changed('1-atributos', '1-', '1-product_type_id');
}

function display_results(params) {
    for(index in params)
    {
        result = params[index];
        var result_att = document.createElement("p");
        jQuery.each(result.attributes[index], function(i, val) {
         result_att.innerHTML = result_att.innerHTML + ' ' +val; 
         });
         var result_div =  document.createElement("div");
         result_div.id="result" + index;
         result_div.className = "row striped";
         document.body.appendChild(result_div);
         var result_id = document.createElement("h4");
         result_id.innerHTML = result.id;
         document.getElementById("result" + index).appendChild(result_id);
         var result_manufacturer = document.createElement("h4");
         result_manufacturer.innerHTML = result.manufacturer_id;
         document.getElementById("result"+index).appendChild(result_manufacturer);
         document.getElementById("result"+index).appendChild(result_att);
    }
}

function search1()
{
    var search = new Array();
    var category = $('#1-category_id').val();
    var product_type = $('#1-product_type_id').val();
    var attributes = fp_construct_array_for_attribute_values('1-atributos');
    
    search[0] = category;
    search[1] = product_type;
    search[2] = attributes;

    $.ajax({
            url: 'http://localhost:8080/multiproveedores/Products/search_by_attributes',
            type: 'POST',
            contentType: 'application/json',
            async: false,
            data: JSON.stringify(search),
            success : function(data) {
                results_div = $('#search_result');

                $('#search_result').empty();
                $('#search_result').append(data);
                display_results(JSON.parse(data));
            },
            
            error : function(a,b,data)
            {
                    alert("Error =)\n");
            }                        
    });
}


function update_suppliers_search_form_values()
{
    var d =  document.getElementById("search_products");
    var s = d.getElementsByTagName("select");
    var products = new Array();
    for (i = 0; i < s.length; i++)
    {
        var p_id = s[i].id;
        var options = s[i].options;
        var value  = options[options.selectedIndex].value;
        if(value != '0')
        {
            products.push([p_id, value]);
        }
    }

    $('#products_for_suppliers').val(JSON.stringify(products));
}