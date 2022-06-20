<?php
$returnCode = $_GET["code"]; // 서버로 부터 토큰을 발급받을 수 있는 코드를 받아옵니다
$restAPIKey = "fd8a555ed7deb0580382fff0f0319be2"; // REST API KEY
$callbacURI = urlencode("http://localhost:85/login/oauth.php"); // Call Back URL
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

//사용자 정보 요청
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

echo "<br><br> userId : ".$userId;
echo "<br> nickname : ".$userName;
?>