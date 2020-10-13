$(document).ready( function () {

    $(document).on("click", ".btn-delete-update", function() {
        var result = confirm('정말 삭제하시겠습니까? 해당 글에 작성된 모든 데이터가 삭제됩니다.');
        if(result) {
            location.replace('/pages/updateDelete/' + $(this).attr('id')); 
        }
    });

    $(document).on("click", ".btn-add-update", function(){
        var result = confirm('글을 추가하시겠습니까?');
        if(result) {
            location.replace('/pages/updateAdd'); 
        }
    })
});