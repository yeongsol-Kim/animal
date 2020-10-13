<html>
<head>
    <meta charset="utf-8">
    <title><?=$title?></title>
    <link rel="stylesheet" href="/css/bootstrap-4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/css.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e5493a7e89.js" crossorigin="anonymous"></script>
</head>
<body>

<header style="">
    <div class="upbar bg-dark">
        <div class="language">
            <a href="#"><span class="fa fa-globe-asia"></span> 한국어 <span class="fa fa-caret-down"></span></a>
        </div>
    </div>
    <div class="container">
        <img class="home-logo" src="/css/img/bg/logo.png">
    </div>
    <nav class="navbar navbar-expand-lg" style="background-color: #333333;">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="menu">
                    <a class="" href="#">
                        <li class="menu-link">
                            홈
                        </li>
                    </a>
                    <a class="" href="/pages/table">
                        <li class="menu-link">
                            생물도감
                        </li>
                    </a>
                    <a class="" href="/pages/update">
                        <li class="menu-link">
                            업데이트
                        </li>
                    </a>
                    <a class="" href="/pages/community">
                        <li class="menu-link">
                            커뮤니티
                        </li>
                    </a>
                    <?php if (!$isLoggedIn): ?>
                        <a class="" href="/pages/login">
                            <li class="menu-link">
                                로그인
                            </li>
                        </a>
                    <?php else: ?>
                        <a class="" href="/pages/logout">
                        <li class="menu-link">
                            로그아웃
                        </li>
                    </a>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>