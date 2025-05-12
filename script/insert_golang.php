<?php


require_once __DIR__ . '/../core/Database.php';

$jsonFile = __DIR__ . '/../data/golang.json';
if (!file_exists($jsonFile)) {
    die('JSON 파일을 찾을 수 없습니다.');
}

$jsonData = json_decode(file_get_contents($jsonFile), true);
if (!$jsonData) {
    die('JSON 파일을 읽는 데 실패했습니다.');
}

try {
    $db = new Database(); // Database 클래스 인스턴스 생성
    $pdo = $db->getPdo(); // PDO 객체 가져오기

    $pdo->beginTransaction();

    // 로드맵 삽입
    $roadmapTitle = $jsonData['title'];
    $roadmapType = 'golang';

    $stmtRoadmap = $pdo->prepare('INSERT INTO roadmaps (type, title) VALUES (?, ?)');
    $stmtRoadmap->execute([$roadmapType, $roadmapTitle]);
    $roadmapId = $pdo->lastInsertId();

    // 각 단계 삽입
    $stmtStage = $pdo->prepare('INSERT INTO stages (roadmap_id, title) VALUES (?, ?)');
    $stmtItem = $pdo->prepare('INSERT INTO items (stage_id, name) VALUES (?, ?)');

    foreach ($jsonData['stages'] as $stage) {
        $stmtStage->execute([$roadmapId, $stage['title']]);
        $stageId = $pdo->lastInsertId();

        foreach ($stage['items'] as $item) {
            $stmtItem->execute([$stageId, $item]);
        }
    }

    $pdo->commit();
    echo "✅ Golang 로드맵 데이터가 성공적으로 삽입되었습니다.";

} catch (Exception $e) {
    if (isset($pdo)) {
        $pdo->rollBack();
    }
    die('❌ 데이터 삽입 중 오류 발생: ' . htmlspecialchars($e->getMessage()));
}
