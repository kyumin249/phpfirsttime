<?php

namespace App\Controllers;

require_once __DIR__ . '/../../core/Database.php';

class RoadmapController
{
    public function getRoadmap()
    {
        $type = $_GET['type'] ?? 'golang';
        $valid_types = ['golang', 'java', 'javascript'];

        // 유효성 검증
        if (!in_array($type, $valid_types)) {
            http_response_code(400);
            echo json_encode(['error' => '유효하지 않은 타입입니다']);
            return;
        }

        $db = new \Database();

        // 데이터베이스에서 로드맵 가져오기
        $roadmap = $db->fetch('SELECT * FROM roadmaps WHERE type = ?', [$type]);
        if (!$roadmap) {
            http_response_code(404);
            echo json_encode(['error' => '로드맵을 찾을 수 없습니다']);
            return;
        }

        // 단계 가져오기
        $stages = $db->fetchAll('SELECT * FROM stages WHERE roadmap_id = ?', [$roadmap['id']]);
        foreach ($stages as &$stage) {
            $stage['items'] = $db->fetchAll('SELECT name FROM items WHERE stage_id = ?', [$stage['id']]);
        }

        $roadmap['stages'] = $stages;

        // JSON 응답
        header('Content-Type: application/json');
        echo json_encode($roadmap);
    }
}
?>