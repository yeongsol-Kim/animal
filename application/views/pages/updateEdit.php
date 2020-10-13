<div class="container" style="margin-top: 30px;">
    <form id="form" method="post" accept-charset="utf-8" action="">
        <div class="row">
            <div class="side-menu col-lg-3">
                <ul class="list">
                    <li class="list-header">업데이트 버전</li>
                    <?php foreach($updates as $update): ?>
                        <li class="list-item<?php if($update->id == $post) { echo " list-active"; } ?>"><?=substr($update->date, 0, 10)?> - v<?=$update->version?></li>    
                    <?php endforeach; ?>
                </ul>
            </div>
            <div id="update" class="col-lg-9" style="text-align: center;">
                <input type="date" name="date" class="form-control" value="<?=substr($thisUpdate[0]->date, 0, 10)?>">
                <input type="text" name="version" class="form-control" value="<?=$thisUpdate[0]->version?>" placeholder="버전 (1.0.0)">
                <?php foreach($notes as $note): ?>
                <div class="update-box">
                    <a class="btn btn-danger btn-delete" id="<?=$note->id;?>"><i style="color:white;" class="fa fa-trash"></i></a>
                    <input type="text" placeholder="제목" name="title[]" class="update-title update-title-input" value="<?=html_escape($note->title)?>">
                    <textarea name="contents[]" class="update-contents update-contents-input"><?=html_escape($note->contents)?></textarea>
                </div>
                <input type="hidden" name="id[]" value="<?=$note->id;?>">
                <?php endforeach; ?>
                <input id="add" type="button" class="btn btn-primary btn-add-update" value="+">
                <input type="submit" class="float-right" value="확인">
            </div>
        </div>
    </form>
</div>