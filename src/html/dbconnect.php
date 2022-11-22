<?php
$dsn = 'mysql:host=mysql;dbname=posse;charset=utf8;';
$user = 'minori';
$password = 'password';

try {
  $db = new PDO($dsn, $user, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
  echo '接続失敗: ' . $e->getMessage();
  exit();
}