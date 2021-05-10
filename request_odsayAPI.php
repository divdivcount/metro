<?php

  $departure_station = array(
    'apiKey' => 'TZYw9wdykk0/zkQcoi3NneOKk52BOQvMmmOPDezQjIU',
    'stationName' => $_POST["departure_station"],
    'CID' => '1000',
    'stationClass' => '2',
  );

  $arrival_station = array(
    'apiKey' => 'TZYw9wdykk0/zkQcoi3NneOKk52BOQvMmmOPDezQjIU',
    'stationName' => $_POST["arrival_station"],
    'CID' => '1000',
    'stationClass' => '2',
  );


  // 출발역 정보 검색
  $url = "https://api.odsay.com/v1/api/searchStation" . "?" , http_build_query($departure_station, '', );

  $ch = curl_init();                                 //curl 초기화
  curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //원격 서버의 인증서가 유효한지 검사 안함

  $dep_response = curl_exec($ch);
  curl_close($ch);

  //도착역 정보
  $url = "https://api.odsay.com/v1/api/searchStation" . "?" , http_build_query($arrival_station, '', );

  $ch = curl_init();                                 //curl 초기화
  curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //원격 서버의 인증서가 유효한지 검사 안함

  $arr_response = curl_exec($ch);
  curl_close($ch);



  $subwayPath = array(
    'apiKey' => 'TZYw9wdykk0/zkQcoi3NneOKk52BOQvMmmOPDezQjIU',
    'CID' => '1000',
    'SID' => $dep_response->result->staion->stationID,
    'EID' => $arr_response->stationID,
    'Sopt' => '1'
  );

  $url = "https://api.odsay.com/v1/api/subwayPath" . "?" , http_build_query($subwayPath, '', );

  $ch = curl_init();                                 //curl 초기화
  curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //원격 서버의 인증서가 유효한지 검사 안함

  $subwqy_response = curl_exec($ch);
  curl_close($ch);
?>
