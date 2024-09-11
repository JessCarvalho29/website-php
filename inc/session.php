<?php
  session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict',
  ]);
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
