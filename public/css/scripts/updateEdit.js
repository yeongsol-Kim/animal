$(document).ready( function () {

    // 박스 추가
    $("#add").on("click", function() {
        var html =  '<div class="update-box">' +
            '<a class="btn btn-danger btn-delete" id="0"><i style="color:white;" class="fa fa-trash"></i></a>' +
            '<input type="text" placeholder="제목" name="title[]" class="update-title update-title-input">' +
            '<textarea name="contents[]" class="update-contents update-contents-input"></textarea>' +
        '</div>' +
        '<input type="hidden" name="id[]" value="0">';
        $("#add").before(html);
    });

    // 박스 삭제
    $(document).on("click", ".btn-delete", function() {
        if($(this).attr('id') != 0) {
            
            var html = '<input name="delete[]" type="hidden" value="' + $(this).attr('id') + '">';
            $("#form").append(html);
        }
        $(this).closest(".update-box").remove();
    });

});