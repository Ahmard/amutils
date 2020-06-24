<?php
namespace App\Utils\News;

use App\Struct\Abstracts\NewsAbstract;
use Queliwrap\Client;

class BBCHausa extends NewsAbstract
{
    //protected string $websiteUrl = 'https://bbc.com/hausa';
    protected string $websiteUrl = 'http://localhost:8080/amutils/storage/temp/bbchausa.html';
    
    protected array $newsList = array();
    
    protected $error = null;
    
    
    public function fetch() : object
    {
        $client = Client::get($this->websiteUrl);
        
        $client->success(function($ql){
            $ql->find("li")->each(function($li){
                //Link and text
                $a = $li->find('h3')->find('a');
                $text = trim($a->text());
                $href = $this->makeUrl(trim($a->attr('href')));
                //Summary
                $summary = $li->find('p')->text();
                //Time
                $time = $li->find('time')->text();
                
                if($text){
                    $this->newsList[] = [
                        'href' => $href,
                        'text' => $text,
                        'summary' => $summary,
                        'time' => $time
                    ];
                }
            });
        });
        
        $client->error(function($err){
            $this->error = $err;
        });
        
        return $this;
    }
    
}