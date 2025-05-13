<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://kit.fontawesome.com/4bffa0e0a2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css" />
    <style>
        body {
          font-family: 'Pretendard', sans-serif;
          font-weight: 400;
        }
    </style>
</head>
<body class="flex flex-col">
    <?php include 'header.php'; ?>
    <main class="flex flex-col gap-8 bg-linear-to-b from-gray-900 to-gray-950">
        <article class="flex flex-col mx-auto px-16 max-w-256 w-full">
            <h1 class="mb-4 text-gray-400 text-xl font-black">로드맵을 한 눈에.</h1>
            <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <?php
                $langTop1 = 'php';          /* 테스트용 */
                $langTop2 = 'javascript';   /* 테스트용 */
                $langTop3 = 'python';       /* 테스트용 */
                $langTop4 = 'java';         /* 테스트용 */
                $langTop5 = 'sql';          /* 테스트용 */
                $langTop6 = 'react';        /* 테스트용 */

                for ($i = 1; ; $i++) {
                    $varName = "langTop{$i}";
                    if (!isset($$varName)) break;
                    $langTopDisplay = $$varName;
                ?>
                <il class="flex flex-col w-full bg-gray-900 border border-gray-700 rounded-xl overflow-hidden">
                    <a href="/roadmap/<?php echo $a; ?>" class="flex items-center justify-between w-full hover:bg-gray-800 p-4 text-gray-400 font-bold">
                        <?php echo strtoupper($langTopDisplay); ?>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    </div>
                    <div class="grid grid-cols-2 border-t-1 border-gray-700">
                        <a href="/roadmap/<?php echo $langTopDisplay; ?>" class="p-3 hover:bg-gray-800 text-gray-400 text-center text-sm">로드맵</a>
                        <a href="/board/<?php echo $langTopDisplay; ?>" class="p-3 hover:bg-gray-800 text-gray-400 text-center text-sm">커뮤니티</a>
                    </div>
                </il>
                <?php }; ?>
            </ul>
        </article>
        <article class="flex flex-col mx-auto px-16 max-w-256 w-full">
            <h1 class="mb-4 text-gray-400 text-xl font-black">유용한 정보도 함께.</h1>
            <ul class="grid grid-cols-1">
            <?php
            /* 데이터베이스 연결 */
            $connect = mysqli_connect("localhost", "test", "1234", "test_db");

            // 좋아요 수 기준으로 20개 게시글 가져오기 (id, title, language)
            $query = "SELECT id, title, language FROM posts ORDER BY likes DESC LIMIT 20";

            $result = mysqli_query($connect, $query);

            // 결과 출력
            if ($result && $result->num_rows > 0) { ?>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <li class="">
                        <a href="/board/<?php echo urlencode($row['language']); ?>/<?php echo $row['id']; ?>" class="flex items-center justify-between py-2 border-b border-gray-700">
                            <span class="text-gray-400"><?php echo htmlspecialchars($row['title']); ?></span>
                            <span class="text-gray-600 text-sm"><?php echo htmlspecialchars($row['language']); ?></span>
                        </a>
                    </li>
                <?php } ?>
            <?php
            } else {
                echo '<li class="text-gray-400 py-2 border-b border-gray-700">게시글이 없습니다.</li>';
            };

            // 연결 종료
            mysqli_close($connect);
            ?>
            </ul>
        </article>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>