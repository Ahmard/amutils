<?php
use App\Utils\News;

require('vendor/autoload.php');

$site = $_GET['site'] ?? 'bbchausa';

$newsList = News::$site()->fetch()->getAll();

header('Content-Type: application/json');

echo json_encode($newsList);