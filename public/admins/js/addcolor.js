$(document).ready(function () {
    var max_fields = 10; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button ID
    var wrapperSize=$(".input_size_wrap"); 
    var add_size_button = $(".add_size_button");
    var x = 1; //initlal text box count
    var y = 1;
    $(add_button).click(function (e) {
        //on add input button click
        e.preventDefault();
        if (x < max_fields) {
            //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div class="form-row">' +
                    '<div class="form-group col-md-4">' +
                    '<input type="text" class="form-control" name="name_color[]" placeholder="Nhập màu sản phẩm">' +
                    "</div>" +
                    '<div class="form-group col-md-6">' +
                    '<input type="file" class="form-control-file" name="image_color_path[]">' +
                    "</div>" +
                    '<div class="form-group col-md-2">' +
                    '<a href="javascript;:" class="btn btn-danger remove_field">Remove</a>' +
                    "</div>" +
                    "</div>"
            ); //add input box
        }
    });
    $(add_size_button).click(function (e) {
        //on add input button click
        e.preventDefault();
        if (y < max_fields) {

            y++; //text box increment
            $(wrapperSize).append(
                '<div class="form-row">'+
                '<div class="form-group col-md-4">' +
                '<input type="text" class="form-control" name="name_size[]" placeholder="Nhập size sản phẩm">' +
                "</div>" +
                '<div class="form-group col-md-2">' +
                '<a href="javascript;:"class="btn btn-danger remove_field">Remove</a>' +
                "</div>" +
                "</div>"
                
            ); 
        }
    });
    $(wrapper).on("click", ".remove_field", function (e) {
        //user click on remove text
        e.preventDefault();
        $(this).parent().parent().remove();
        x--;
    });
    $(wrapperSize).on("click", ".remove_field", function (e) {
        //user click on remove text
        e.preventDefault();
        $(this).parent().parent().remove();
        y--;
    });
});
