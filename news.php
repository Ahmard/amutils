<?php
use Uticlass\News;

require('vendor/autoload.php');

$site = $_GET['site'] ?? null;
if($site && $site != 'all'){
    $newsList = News::$site()->fetch()->getAll();
}else{
    $newsList = News::allSites()->fetch();
}

header('Content-Type: application/json');

echo json_encode($newsList);