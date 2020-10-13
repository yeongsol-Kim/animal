<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-3" style="padding: 0px;">
            <?php $this->load->view('/pages/communitySidemenu.php'); ?>
        </div>
        <div class="col-md-9">
            <form action="" method="post" accept-charset="utf-8" >
                <div class="post-edit">
                    <div class="post-header">
                        글 쓰기
                    </div>
                    <select name="board[category]" class="form-control" style="margin-bottom: 10px; width: 150px;" required>
                        <option value="" hidden>카테고리</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?=$category->id?>"<?php if(!empty($postData) && $postData[0]->category == $category->id) { echo ' selected="selected"'; } ?>><?=$category->name?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" name="board[title]" class="form-control" value="<?php if(!empty($postData)) { echo $postData[0]->title; } ?>" placeholder="제목" style="margin-bottom: 10px;" required>
                    <textarea id="contents" class="form-control" name="board[contents]" required><?php if(!empty($postData)) { echo $postData[0]->contents; } ?></textarea>
                </div>

                <input type="submit" class="btn btn-primary float-right" value="작성완료">
            </form>
        </div>
    </div>
</div>