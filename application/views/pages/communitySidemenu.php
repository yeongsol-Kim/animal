<div class="side-menu">
    <div class="user-info">
        <?php if ($isLoggedIn): ?>
        <div class="user-info-header">
            <div class="user-header">
                <div class="user-profile"><img src="<?=base_url();?>css/img/community/user.png" style="width: 53px;"></div>
            </div>
            <div class="user-contents">
                <div class="user-name"></div>
                <div class="user-name">일반 회원</div>
            </div>
        </div>
        <div class="user-info-footer">
            <div class="row">
                <div class="user-button col-4">
                    <a href="?userid=<?=$_SESSION['user']?>">
                        <div class="button">
                            내 활동
                        </div>
                    </a>
                </div>
                <div class="user-button col-4">
                    <div class="button">
                        스크랩
                    </div>
                </div>
                <div class="user-button col-4">
                    <a href="/pages/communityPostEdit" class="">
                    <div class="button">
                        글 쓰기
                    </div>
                    </a>
                </div>
            </div>
        </div>
        <?php else: ?>
            <a href="/pages/login"><div class="button">로그인</div></a>
        <?php endif; ?>
    </div>
    <div class="category-list">
        <div class="category-header">카테고리</div>
            <a href="/pages/community"><div class="category-item">전체</div></a>
        <?php foreach($categories as $category): ?>
            <a href="/pages/community/<?=$category->id?>"><div class="category-item"><?=$category->name?></div></a>
        <?php endforeach; ?>
    </div>
</div>