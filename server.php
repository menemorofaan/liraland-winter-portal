<?php

/**
 * Winter CMS - Secure Dev Server Router
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// БЕЗОПАСНОСТЬ: Наглухо блокируем доступ к .env, .git, sqlite и системным файлам
if (preg_match('/(\.env|\.git|\.sqlite|\.lock|storage\/.*\.sqlite)/i', $uri)) {
    http_response_code(403);
    die('403 Forbidden: Access to sensitive files is denied.');
}

// Если это существующий публичный файл (картинка, js, css) - отдаем
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

require_once __DIR__ . '/index.php';
