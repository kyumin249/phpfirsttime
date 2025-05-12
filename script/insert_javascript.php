<?php

require_once __DIR__ . '/../core/Database.php';

$jsonFile = __DIR__ . '/../data/javascript.json';
$jsonData = json_decode(file_get_contents($jsonFile), true);

if (!$jsonData) {
    die('Invalid JSON file.');
}

$db = new Database();

try {
    $db->query('START TRANSACTION');

    $roadmapTitle = $jsonData['title'];
    $roadmapType = 'javascript';

    $db->query('INSERT INTO roadmaps (type, title) VALUES (?, ?)', [$roadmapType, $roadmapTitle]);
    $roadmapId = $db->query('SELECT LAST_INSERT_ID()')->fetchColumn();

    foreach ($jsonData['stages'] as $stage) {
        $stageTitle = $stage['title'];

        $db->query('INSERT INTO stages (roadmap_id, title) VALUES (?, ?)', [$roadmapId, $stageTitle]);
        $stageId = $db->query('SELECT LAST_INSERT_ID()')->fetchColumn();

        foreach ($stage['items'] as $item) {
            $db->query('INSERT INTO items (stage_id, name) VALUES (?, ?)', [$stageId, $item]);
        }
    }

    $db->query('COMMIT');
    echo "✅ Javascript 로드맵 데이터가 성공적으로 삽입되었습니다.";
} catch (Exception $e) {
    $db->query('ROLLBACK');
    die('Error inserting data: ' . $e->getMessage());
}
?>