$(document).ready( function () {
    $('.ch').click(function(){
        var a = 0;
        for (var i = 1; i <= 12; i++) {
            if($('#ch' + i).prop('checked')) {
                a += parseInt($('#ch' + i).val())
            }
        }
        $('#num').text(a);
    });
});