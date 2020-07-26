<?php
namespace App\Utils\News;

use App\Utils\News;

class AllSites
{
    public function fetch()
    {
        $newsList = array();
        foreach (News::getSites() as $site => $siteClass){
            $newsList[$site] = (new $siteClass)->fetch()->getAll();
        }
        
        return $newsList;
    }
}