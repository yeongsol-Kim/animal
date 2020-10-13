<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-3" style="padding: 10px;">
            <?php $this->load->view('/pages/communitySidemenu.php'); ?>
        </div>
        <div class="col-md-9" style="padding: 10px;">
            <div class="board-header">
                <?php if(!empty($category)) {
                    echo $categoryName[$category];
                } else {
                    echo "전체 글";
                } ?>
            </div>
            <div class="board">
                <?php foreach($postList as $post): ?>
                    <div class="post-list">
                        <div class="post-list-vote">
                            <span class="post-list-no"><?=$post->id?></span>
                        </div>
                        <div class="post-list-contents">
                            <a href="/pages/communityPost/<?=$post->id?>"><div class="post-list-title"><?=$post->title?> <span style="color: #669666; font-size: 15px;">[<?=$commentCount[$post->id];?>]</span></div></a>
                            <div class="post-list-info">
                                <div class="post-list-contents-category"><?=$categoryName[$post->category];?></div>
                                <div class="post-list-contents-date"><?=$post->datetime?></div>
                                <div class="post-list-contents-userid"><?=$username[$post->user];?></div>
                            </div>
                        </div>
                        <div class="post-list-thumb">
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="" style="text-align: center;">
                <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </div>
</div>