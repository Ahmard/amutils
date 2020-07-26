<?php
namespace App\Utils\News;

class NewsFactory
{
    protected $newsData;
    
    
    public function __construct(array $newsData)
    {
        $this->newsData = $newsData;
    }
    
    
    public function populateProperties() : void
    {
        foreach ($this->newsData as $name => $value){
            $this->$name = $value;
        }
    }
}