<div class="login-page">
    <div class="login-frame">
        <form method="post" accept-charset="utf-8" action="">
            <input class="login-input form-control" type="text" name="userid" maxlength="30" placeholder="아이디">
            <?php echo form_error('userid'); ?>
            <input class="login-input form-control" type="password" name="password" maxlength="16" placeholder="비밀번호">
            <?php echo form_error('password'); ?>
            <input class="login-input form-control btn btn-primary" type="submit" value="로그인">
        </form>
        <a class="" href="/pages/register">회원가입</a> | <a class="" href="#">아이디 찾기</a> | <a class="" href="#">비밀번호 찾기</a>
    </div>
</div>
