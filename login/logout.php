<?php

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://kapi.kakao.com/v1/user/unlink');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, 'Content-Type: application/x-www-form-urlencoded;charset=utf-8');
       // curl_setopt($ch, CURLOPT_HTTPHEADER, 'Authorization: Bearer'.$accessToken);

?>