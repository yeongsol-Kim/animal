<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="side-menu col-lg-3">
            <ul class="list">
                <li class="list-header" style="border-bottom: 1px solid #cccccc;">업데이트 버전</li>
                <?php foreach($updates as $update): ?>
                    <?php if(!empty($_SESSION['permission']) && $_SESSION['permission'] == 1): ?>
                        <i id="<?=$update->id?>"  class="fa fa-times btn-delete-update" style="font-size: 12px;"></i>
                    <?php endif; ?>
                    <li class="list-item<?php if($update->id == $post) { echo " list-active"; $thisversion = $update->version; $thisdate = substr($update->date, 0, 10); } ?>"><a href="/pages/update/<?=$update->id?>"><?=str_replace("-", ".", substr($update->date, 0, 10))?> - v<?=$update->version?></a></li>
                    
                <?php endforeach; ?>
                <?php if(!empty($_SESSION['permission']) && $_SESSION['permission'] == 1): ?>
                    <input type="button" class="btn btn-primary btn-add-update" value="+">
                <?php endif; ?>

            </ul>
        </div>
        <div class="col-lg-9">
            <div class="update-title">
                <?php $date = explode('-', $thisdate); echo $date[0];?>년 <?=$date[1];?>월 <?=$date[2];?>일 업데이트 - v<?=$thisversion;?>
            </div>
            <?php foreach($notes as $note): ?>
            <div class="update-box">
                <div class="update-title">
                    <?=html_escape($note->title)?>
                </div>
                <div style="white-space:pre;" class="update-contents" ><?=html_escape($note->contents)?></div>
            </div>
            <?php endforeach; ?>
            <?php if(!empty($_SESSION['permission']) && $_SESSION['permission'] == 1): ?>
                <a href="/pages/updateEdit/<?=$post?>" class="btn btn-primary float-right">수정</a>
            <?php endif; ?>
        </div>
    </div>
</div>