<?php
// https://m.blog.naver.com/PostView.naver?isHttpsRedirect=true&blogId=hello_sail&logNo=221641882034

//kakao_login.php
$restAPIKey = "fd8a555ed7deb0580382fff0f0319be2"; //본인의 REST API KEY를 입력해주세요
$callbacURI = urlencode("http://localhost:85/login/oauth.php");
$kakaoLoginUrl = "https://kauth.kakao.com/oauth/authorize?client_id=".$restAPIKey."&redirect_uri=".$callbacURI."&response_type=code";

?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
</head>

<body>
<a href="<?= $kakaoLoginUrl ?>">
    카카오톡으로 로그인
</a>
</body>