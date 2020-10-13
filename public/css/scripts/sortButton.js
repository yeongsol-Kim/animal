$(document).ready( function () {

    var searchTime = null;
    var searchName = null;
    var searchMonth = null;

    // 물고기 곤충 탭 전환
    $(".tab").click(function() {
        $(".tab").removeClass("tab-active");
        $(this).addClass("tab-active");
        var thisTab = $(this).attr('id');
        $(".tabs").hide();
        $(".tab-" + thisTab).show();
        search();
    })
    
    $(".btn-month").click(function() {
        searchMonth = $(this).val().toLowerCase();
        search();
    });

    
    // 생물 이름으로 검색
    $("#search").on("keyup", function() {
        searchName = $(this).val().toLowerCase();
        search();
    });

    // 생물 출현 시간으로 검색
    $("#search-time").on("propertychange change", function() {
        searchTime = Number($(this).val().substring(0, 2));
        search();
    });
    
    // 생물 출현 시간 초기화
    $("#btn-reset-time").on("click", function() {
        searchTime = null;
        $("#search-time").val("");
        search();
    });

    function search() {
        $(".table-ill tbody tr").show();

        if(searchMonth != null) {
            if (searchMonth != 'all') {
                $(".table-ill tbody tr").filter(function() {
                    $(this).toggle($(this).find('.month-' + searchMonth).hasClass('month-active'));
                });
            }
        }


        if(searchTime != null) {
            $(".table-ill tbody tr").filter(function() {
                if ($(this).children(".td-time").text() == "하루종일") {
                    $(this).show();
                } else {
                    if ($(this).is(":visible")) {
                        var time = $(this).children(".td-time").text().split("~");
                        time[0] = Number(time[0]);
                        time[1] = Number(time[1]);
                    
                        if(time[0] < time[1]) {
                            $(this).toggle((searchTime >= time[0] && searchTime < time[1]));
                        } else {
                            $(this).toggle((searchTime >= time[0] || searchTime < time[1]));
                        }
                    }
                }
            });
        }

        if(searchName != null) {
            $(".table-ill tbody tr").filter(function() {
                if ($(this).is(":visible")) {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchName) > -1);
                }
            });
        }
    }

    //실시간 버튼 
    $("#btn-realtime").on("click", function() {
        var now = new Date();
        var minute = now.getMinutes();
        var hour = now.getHours();
        if (minute < 10) { minute = "0" + minute; }
        if (hour < 10) { hour = "0" + hour; }
        $("#search-time").val(hour + ":" + minute);
        $("#btn-month-" + (now.getMonth() + 1)).trigger("click");
        $("#search-time").trigger("change");
    });

    // 물고기 테이블 데이터테이블 설정
    $('#fish-table').DataTable({
        lengthChange: false,
        searching: false,
        info: false,
        paging: false,
        responsive: true,
        columnDefs: [
			{ targets: 6 , render: $.fn.dataTable.render.number( ',' , '.' , 0 , '' , '벨'  ) }]
    });

    // 곤충 테이블 데이터테이블 설정
    $('#insect-table').DataTable({
        lengthChange: false,
        searching: false,
        info: false,
        paging: false,
        responsive: true,
        columnDefs: [
			{ targets: 5 , render: $.fn.dataTable.render.number( ',' , '.' , 0 , '' , '벨'  ) }]
    });

    // 해산물 테이블 데이터테이블 설정
    $('#seaCreature-table').DataTable({
        lengthChange: false,
        searching: false,
        info: false,
        autoWidth: true,
        paging: false,
        responsive: true,
        columnDefs: [
            { targets: 5 , render: $.fn.dataTable.render.number( ',' , '.' , 0 , '' , '벨'  ) }
        ]
    });

    // 테이블 정렬
    $('th').click(function(){
        if($(this).hasClass("sorting_asc")) {
            $('.th-sort').children('span').attr('class', 'fa fa-sort')
            $(this).children('span').attr('class', 'fa fa-sort-down')
        } else {
            $('.th-sort').children('span').attr('class', 'fa fa-sort')
            $(this).children('span').attr('class', 'fa fa-sort-up')
        }
    })



    $('th').click(function(){
        if($(this).hasClass("sorting_asc")) {
            $('.th-sort').children('span').attr('class', 'fa fa-sort')
            $(this).children('span').attr('class', 'fa fa-sort-down')
        } else {
            $('.th-sort').children('span').attr('class', 'fa fa-sort')
            $(this).children('span').attr('class', 'fa fa-sort-up')
        }
    })

  });