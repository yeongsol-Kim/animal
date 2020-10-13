<div class="login-page">
    <div class="login-frame">
        <form method="post" accept-charset="utf-8" action="">
            <input class="login-input form-control" type="text" name="userid" value="<?= set_value('userid'); ?>" maxlength="30" placeholder="아이디">
            <?php echo form_error('userid'); ?>
            <input class="login-input form-control" type="password" name="password" value="" maxlength="16" placeholder="비밀번호">
            <?php echo form_error('password'); ?>
            <input class="login-input form-control" type="password" name="password_confirm" value="" maxlength="16" placeholder="비밀번호 확인">
            <?php echo form_error('password_confirm'); ?>
            <input class="login-input form-control" type="text" name="nickname" maxlength="16" value="<?=set_value('nickname'); ?>" placeholder="닉네임">
            <?php echo form_error('nickname'); ?>
            <input class="login-input form-control btn btn-primary" type="submit" value="회원가입">
        </form>
        <a class="" href="/pages/register">회원가입</a> | <a class="" href="#">아이디 찾기</a> | <a class="" href="#">비밀번호 찾기</a>
    </div>
</div>
