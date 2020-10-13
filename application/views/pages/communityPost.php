<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-3" style="padding: 0px;">
            <?php $this->load->view('/pages/communitySidemenu.php'); ?>
        </div>
        <div class="col-md-9">
            <div class="post-box">
                <div class="post-header">
                    <div class="post-title"><?=$post[0]->title?></div>
                    <div class="post-info">
                        <div class="post-info-contents">
                            <span class="post-info-item"><?=$categoryName;?></span> 
                            <span class="post-info-item non-first"> <?=$post[0]->datetime?></span>
                            <span class="post-info-item non-first"><?=$userName?></span>
                        </div>
                        <div class="post-info-contents float-right"><!--조회--> 댓글 <?=$commentCount;?><!--추천--></div>
                    </div>
                </div>
                <div class="post-contents">
                    <?=$post[0]->contents?>
                </div>
                <div class="post-footer">
                    <a href="/pages/communityPostRecommand/<?=$post[0]->id?>/1">
                        <div class="recommand good">
                            <div class="button<?php if($userRecommand == 1) { echo ' button-blue'; } ?>">추천 <?=$recommand['up']?></div>
                        </div>
                    </a>
                    <a href="/pages/communityPostRecommand/<?=$post[0]->id?>/0">
                        <div class="recommand bad">
                            <div class="button<?php if($userRecommand == 0) { echo ' button-blue'; } ?>">비추 <?=$recommand['down']?></div>
                        </div>
                    </a>
                </div>
                <?php if($this->Pages_model->isLoggedIn()):
                if ($this->Pages_model->getCommunityPost($post[0]->id)[0]->user == $_SESSION['user'] || $_SESSION == 1): ?>
                <div class="post-option">
                    <a href="/pages/communityPostEdit/<?=$post[0]->id?>">
                        <div class="post-option-button">
                            <div class="button">글 수정</div>
                        </div>
                    </a>
                    <div id ="delete" class="post-option-button">
                        <div id="<?=$post[0]->id?>" class="button">글 삭제</div>
                    </div>
                </div>
                <?php endif;
                endif; ?>
            </div>
            <div class="post-box">
                <?php if (!empty($comments)):
                 foreach ($comments as $comment): ?>
                    <div class="comment">
                        <div class="comment-profile">
                            <div class="profile-picture" style="border: 1px solid #CCCCCC; width:50px; height: 50px;">
                                <img src="<?=base_url();?>css/img/community/user.png" style="width: 48px"/>
                            </div>
                        </div>
                        <div class="comment-main">
                            <div class="comment-header">
                                <span class="comment-name"><?=$users[$comment->user][0]->name;?></span> <span class="comment-time">4시간 전</span>
                            </div>
                            <div class="comment-contents">
                                <?=$comment->contents;?>
                            </div>
                            <div class="comment-footer">
                                좋아요 싫어요 답글
                            </div>
                        </div>
                    </div>
                <?php endforeach;
                    else: ?>
                    <div class="comment">
                        작성된 댓글이 없습니다.
                    </div>
                <?php endif;?>
                <div class="comment" style="margin-bottom: 30px;">
                    <form action="/pages/commentAdd/<?=$post[0]->id?>" method="post">
                        <textarea id="comment" name="comment[contents]" required></textarea>
                        <div class="">
                            <input type="submit" class="btn btn-primary" style="margin-top: 8px; float: right" value="작성">
                        </div>
                        <input type="hidden" name="comment[user]" value="<?php if (!empty($_SESSION['user'])) { echo $_SESSION['user'];}?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>