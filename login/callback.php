// https://yoshikixdrum.tistory.com/285

<?php

class callback {

    private $auth_url;
    private $api_url;
    private $callback_url;
    private $cliend_id;
    private $state;
    private $client_secret;

    public function __construct($csrf_token = "") {
        $this->callback_url = "http://localhost:85/login/callback.php";
        $this->auth_url = "https://kauth.kakao.com";    // 카카오 인증서버
        $this->api_url = "https://kapi.kakao.com";      // 카카오 API 서버
        $this->cliend_id = "fd8a555ed7deb0580382fff0f0319be2";
        $this->client_secret = "ZGf4V2WXcXnllZDxkx5K3dNJk12AkJtO";  // OAuth 서버로부터 토큰을 받을 때 사용
        $this->state = $csrf_token;

    }
}

// 토큰 받기
$returnCode = $_GET["code"]; // 서버로 부터 토큰을 발급받을 수 있는 코드를 받아옵니다
$restAPIKey = "fd8a555ed7deb0580382fff0f0319be2"; // REST API KEY
$callbacURI = urlencode("http://localhost:85/login/callback.php"); // Call Back URL
//토큰
$getTokenUrl = "https://kauth.kakao.com/oauth/token?grant_type=authorization_code&client_id=".$restAPIKey."&redirect_uri=".$callbacURI."&code=".$returnCode;

$isPost = false;
$ch = curl_init();                                    //1. curl 초기화
curl_setopt($ch, CURLOPT_URL, $getTokenUrl);          //2. URL 지정
curl_setopt($ch, CURLOPT_POST, $isPost);              //3. $isPost = false; ﻿ POST 통신이 아니므로
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);       //﻿4.  true일 경우 curl_exec의 결과값을 return 하게 되어 변수에 저장 가능

$headers = array();                                   //header 배열 생성
$loginResponse = curl_exec ($ch);                     //4. $ch 실행
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); //6. ﻿연결 리소스 핸들 컬에 대한 정보 얻기
curl_close ($ch);                                     //7. Close a cURL session

// 사용자 정보 요청

$accessToken= json_decode($loginResponse)->access_token;      //Access Token만 따로 뺌
$header = "Bearer ".$accessToken; // Bearer 다음에 공백 추가
$getProfileUrl = "https://kapi.kakao.com/v2/user/me"; // 개인정보가져오는 url

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $getProfileUrl);
curl_setopt($ch, CURLOPT_POST, $isPost);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = array();
$headers[] = "Authorization: ".$header;
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$profileResponse = curl_exec ($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close ($ch);

$profileResponse = json_decode($profileResponse);
$userId = $profileResponse->id;
$userName = $profileResponse->properties->nickname;

if ($profileResponse == null || $profileResponse == "") {
    echo "<script>location.href='./loginFailed.php'</script>";
} else {
    echo "$userId 아이디를 사용하는 $userName 님이 로그인. <br>\n";
}
?>

<?php
//// 토큰 받기
//header('Content-Type: application/json; charset=utf-8');
//$code = $_GET['code'];
//
//$CLIENT_ID = 'fd8a555ed7deb0580382fff0f0319be2';
//$CLIENT_SECRET = 'ZGf4V2WXcXnllZDxkx5K3dNJk12AkJtO';
//$REDIRECT_URI  = 'http://localhost:85/login/callback.php';
//
//$params = sprintf('?grant_type=authorization_code&client_id=%s&client_secret=%s&redirect_uri=%s&code=%s', $CLIENT_ID, $CLIENT_SECRET ,$REDIRECT_URI, $code);
//$url = 'https://kauth.kakao.com/oauth/token' . $params;
//
//$s = curl_init();
//curl_setopt($s, CURLOPT_URL, $url);
//curl_setopt($s, CURLOPT_POST, false);
//curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
//
//$result = curl_exec($s);
//$status_code = curl_getinfo($s, CURLINFO_HTTP_CODE);
//curl_close($s);
//
//echo '[status] ' . $status_code;
//echo "<br/>\n";
//echo '발급 받은 토큰 정보';
//echo "<br/>\n";
//print_r($result);
//
//// 사용자 정보 가져오기
//$api_url = 'https://kapi.kakao.com/v1/user/me';
//$access_token = json_decode($result)->access_token;
//
//echo "액세스 토큰 = " + $access_token;
//
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $api_url);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
//$response = curl_exec($ch);
//
//$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//curl_close($ch);
//
//echo 'http code: ' . $http_code . "\n";
//
//if (!$response) {
//    echo 'no response';
//    exit;
//}
//
//echo "<br/>\n";
//echo '사용자 정보';
//echo "<br/>\n";
//print_r($response);
//
//?>