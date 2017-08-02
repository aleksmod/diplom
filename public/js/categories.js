function updateStart(category_id) {
    var parent = $('#parent_' + category_id).text();
    var name = $('#name_' + category_id).text();
    var slug = $('#slug_' + category_id).text();


    var html_parent = "<input type='text' id='new_parent_" + category_id + "' class='form-control' name='parent_id' style='width: 70px' value='" + parent + "'>";
    var html_name =  "<input type='text' id='new_name_" + category_id + "' class='form-control' name='name' style='width: 200px' value='" + name + "'>";
    var html_slug =  "<input type='text' id='new_slug_" + category_id + "' class='form-control' name='slug' style='width: 200px' value='" + slug + "'>";

    $('#parent_' + category_id).html(html_parent);
     $('#name_' + category_id).html(html_name);
     $('#slug_' + category_id).html(html_slug);
    $('#update_' + category_id).html('<button class="btn btn-success" onclick="endUpdate(' + category_id + ')">Submit</button>')
}

function endUpdate(category_id) {
    var parent = $('#new_parent_' + category_id).val();
    var name = $('#new_name_' + category_id).val();
    var slug = $('#new_slug_' + category_id).val();

    console.log(slug);

    $.ajax({
        url: "categoryUpdate",
        type: "POST",
        data: {
            id: category_id,
            parent_id: parent,
            name: name,
            slug: slug,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result){
            console.log(result);
        }
    });

    $('#parent_' + category_id).html(parent);
    $('#name_' + category_id).html(name);
    $('#slug_' + category_id).html(slug);
    $('#update_' + category_id).html('<button class="btn btn-warning" onclick="updateStart(' + category_id + ')">Update</button>')

}

function newCategory() {

    var name = $('#input_name').val().trim();
    var parent_id = $('#input_parent_id').val().trim();
    var slug = $('#input_slug').val().trim();

    $.ajax({
        url: "addCategory",
        method: "POST",
        data: {
            name:name,
            name:parent_id,
            name:slug,
            _token: $('meta[name="csrf-token"]').attr('content')

        },

        success: function(result){
            var html =
                '<tr id="row_' + result.id + '">' +
                '<td>' + result.id + '</td>' +
                '<td id="parent_' + result.id + '">' + parent_id + '</td>' +
                '<td id="name_' + result.id + '">' + name + '</td>' +
                '<td id="slug_' + result.id + '">' + slug + '</td>' +
                '<td id="update_' + result.id + '"><button class="btn btn-warning" onclick="updateStart(' + result.id + ')">Update</button></td>' +
                '<td id="remove_' + result.id + '"><button class="btn btn-danger" onclick="categoryRemove(' + result.id + ')">Delete</button></td>' +
                '</tr>';
            $('#row_holder').append(html);

        }
    });
}

function categoryRemove(category_id) {
    $.ajax({
        url: "categoryRemove",
         method: "POST",
        data: {
            id: category_id,
            _token: $('meta[name="csrf-token"]').attr('content')

        },
        success: function(){
            $('#row_' + category_id).remove('#row_' + category_id);
        }
    });
}











