<?php

require_once __DIR__ . '/../core/Router.php';

// 라우터 인스턴스 생성
$router = new Router();

// 라우트 정의
$router->get('/', 'HomeController@index'); // 홈 페이지
$router->get('/home', 'HomeController@home'); // home.html 제공
$router->get('/visualize', 'VisualizeController@visualize'); // visualize.html 제공
$router->get('/api/roadmap', 'RoadmapController@getRoadmap'); // 로드맵 API


// 라우터 실행
$router->run();

