<?php

require_once __DIR__ . '/../core/Database.php';

header('Content-Type: application/json');

$type = $_GET['type'] ?? null;

if (!$type) {
    echo json_encode(['error' => '로드맵 타입이 지정되지 않았습니다.']);
    exit;
}

$validTypes = ['golang', 'java', 'javascript'];
if (!in_array($type, $validTypes)) {
    echo json_encode(['error' => '유효하지 않은 로드맵 타입입니다.']);
    exit;
}

try {
    $db = new Database();

    // 로드맵 데이터 가져오기
    $roadmap = $db->fetch('SELECT * FROM roadmaps WHERE type = ?', [$type]);
    if (!$roadmap) {
        echo json_encode(['error' => '로드맵 데이터를 찾을 수 없습니다.']);
        exit;
    }

    // 단계 데이터 가져오기
    $stages = $db->fetchAll('SELECT * FROM stages WHERE roadmap_id = ?', [$roadmap['id']]);
    foreach ($stages as &$stage) {
        $stage['items'] = $db->fetchAll('SELECT name FROM items WHERE stage_id = ?', [$stage['id']]);
    }

    $roadmap['stages'] = $stages;

    echo json_encode($roadmap);
} catch (Exception $e) {
    echo json_encode(['error' => '데이터 로딩 중 오류 발생: ' . $e->getMessage()]);
}
?>
