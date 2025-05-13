<header class="sticky top-0 px-16 py-8 bg-gray-900">
    <nav class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="/" class="no-underline text-white">로고</a>
            <nav class="flex gap-4">
                <a href="/" class="text-gray-500 hover:text-white">로드맵</a>
                <a href="/" class="text-gray-500 hover:text-white">게시판</a>
            </nav>
        </div>
        <?php
        $nickname = "qwer";    /* 테스트용 */
        
        if ($isItLogin == true) { ?>
            <div class="flex items-center justify-end gap-4 h-8">
                <a href="/login" class="text-white">로그인</a>
                <a href="/signup" class="h-full">
                    <div class="flex items-center justify-center h-full px-4 bg-linear-to-br from-violet-700 to-blue-700 rounded-xl text-center text-white">회원가입</div>
                </a>
            </div>
        <?php } else { ?>
            <div class="flex items-center justify-end gap-4 h-8">
                <a href="/profile" class="h-full">
                    <div class="flex items-center justify-center h-full px-4 bg-linear-to-br from-violet-700 to-blue-700 rounded-xl text-center text-white">
                        <i class="fa-solid fa-circle-user text-white"></i>
                        <?php if (isset($nickname)) { ?>
                        <span class="ml-1.5 -mt-0.5"><?php echo strtoupper($nickname); ?></span>
                        <?php }; ?>
                    </div>
                </a>
                <a href="/logout" class="text-gray-500 hover:text-white">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </div>
        <?php }; ?>
    </nav>
</header>