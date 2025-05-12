<?php
    
    $type = $_GET['type'] ?? 'golang';
    $path = __DIR__ . "/../../data/{$type}.json";
    
    if (!file_exists($path)) {
        http_response_code(404);
        echo json_encode(['error' => '로드맵 JSON 파일이 없습니다']);
        exit;
    }
    
    header('Content-Type: application/json');
    echo file_get_contents($path);
?>    