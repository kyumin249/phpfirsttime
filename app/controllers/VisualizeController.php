<?php

namespace App\Controllers;

class VisualizeController {
    public function visualize() {
        // visualize.html 파일을 읽어서 출력
        $filePath = __DIR__ . '/../../public/visualize.html';
        if (file_exists($filePath)) {
            echo file_get_contents($filePath);
        } else {
            http_response_code(404);
            echo '<h1>404 Not Found</h1><p>visualize.html 파일을 찾을 수 없습니다.</p>';
        }
    }
}