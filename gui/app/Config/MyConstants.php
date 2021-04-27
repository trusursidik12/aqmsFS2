<?php
// session_start();

$supportLang = ['en', 'id'];
if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $acceptLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $language = in_array($acceptLang, $supportLang) ? $acceptLang : 'en';
} else {
    $language = 'en';
}

define('WEB_LANG', isset($_SESSION['web_lang']) ? $_SESSION['web_lang'] : $language);
