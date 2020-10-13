$(document).ready(function() {
    $('#delete').on('click', function(){
        var del = confirm('글을 삭제하시겠습니까?');
        if(del) {
            var postId = $(this).children('.button').attr('id');
            location.replace('/pages/communityPostDelete/' + postId);
        }
    });

    $('#comment').summernote({
        placeholder: "댓글 작성",
        lineHeights: 0.2,
        toolbar: [
            
        ]
    });
});