<?php

namespace App\Controllers;

class HomeController {
    public function index() {
        echo '<h1>Welcome to Developer Roadmap</h1>';
    }

    public function about() {
        echo '<h1>About Developer Roadmap</h1><p>이 프로젝트는 개발자 로드맵을 제공하기 위해 만들어졌습니다.</p>';
    }

    public function home() {
        // home.html 파일을 읽어서 출력
        $filePath = __DIR__ . '/../../public/home.html';
        if (file_exists($filePath)) {
            echo file_get_contents($filePath);
        } else {
            http_response_code(404);
            echo '<h1>404 Not Found</h1><p>home.html 파일을 찾을 수 없습니다.</p>';
        }
    }
}