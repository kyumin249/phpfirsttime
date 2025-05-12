<?php

class Router {
    private $routes = [];

    // GET 요청 등록
    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    // POST 요청 등록 (필요 시 추가)
    public function post($uri, $action) {
        $this->routes['POST'][$uri] = $action;
    }

    // 라우터 실행
    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // 환경에 맞게 URI 조정 (프로젝트 경로 제거)
        $uri = str_replace('/php-workspace2/phpfirstproject/public', '', $uri);

        // 요청된 URI에 해당하는 액션 찾기
        $action = $this->routes[$method][$uri] ?? null;

        if ($action) {
            // 컨트롤러와 메서드 분리
            [$controller, $method] = explode('@', $action);

            // 컨트롤러 파일 경로
            $controllerPath = __DIR__ . '/../app/controllers/' . $controller . '.php';

            if (file_exists($controllerPath)) {
                require_once $controllerPath;

                // 네임스페이스를 포함한 컨트롤러 클래스 이름
                $controllerClass = "App\\Controllers\\{$controller}";

                // 컨트롤러 인스턴스 생성 및 메서드 호출
                $controllerInstance = new $controllerClass;
                if (method_exists($controllerInstance, $method)) {
                    call_user_func([$controllerInstance, $method]);
                } else {
                    http_response_code(500);
                    echo "500 Internal Server Error: 메서드를 찾을 수 없습니다.";
                }
            } else {
                http_response_code(500);
                echo "500 Internal Server Error: 컨트롤러 파일을 찾을 수 없습니다.";
            }
        } else {
            http_response_code(404);
            echo "404 Not Found: 요청된 페이지를 찾을 수 없습니다.";
        }
    }
}
?>