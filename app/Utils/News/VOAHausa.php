<?php
namespace App\Utils\News;

use Queliwrap\Client;
use App\Struct\Abstracts\NewsAbstract;

class VOAHausa extends NewsAbstract
{
    protected string $websiteUrl = 'http://localhost:8080/amutils/storage/temp/voahausa.html';
    
    protected array $newsList = array();
    
    protected $error = null;
    
    
    public function fetch() : object
    {
        $client = Client::get($this->websiteUrl);
        
        $client->success(function($ql){
            $ql->find('div.media-block__content')->each(function($li){
                //Link and text
                $a = $li->find('a');
                $text = trim($a->find('h4')->eq(0)->text());
                $href = $this->makeUrl($a->attr('href'));
                //Time
                $time = trim($li->find('span')->eq(0)->text());
                if($text && $time){
                    $this->newsList[] = [
                        'text' => $text,
                        'href' => $href,
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