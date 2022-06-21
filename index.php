<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>로그인</title>
    <link rel="stylesheet" type="text/css" href="./login/resources/css/index.css"/>
</head>
<body>
    <main id="main-holder">
        <h1 id="login-header">로그인</h1>
        <form id="login-form">
            <input type="image" src="./login/resources/images/kakao_login_large_narrow.png" onclick="kakaoLogin(); return false;">
        </form>
    </main>
<?php
$REST_API_KEY = "fd8a555ed7deb0580382fff0f0319be2";
$REDIRECT_URI = "http://localhost:85/login/callback.php";
$LOGIN_REQUEST_URL = "https://kauth.kakao.com/oauth/authorize?client_id=".$REST_API_KEY."&redirect_uri=".$REDIRECT_URI."&response_type=code";
?>
<script>
    function kakaoLogin() {
        location.href =  '<?php echo $LOGIN_REQUEST_URL ?>';
    }
</script>
</body>
</html>