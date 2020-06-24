<?php
namespace App\Utils\News;

use App\Struct\Abstracts\NewsAbstract;
use Queliwrap\Client;

class RFIHausa extends NewsAbstract
{
    //protected string $websiteUrl = 'https://bbc.com/hausa';
    protected string $websiteUrl = 'http://localhost:8080/amutils/storage/temp/rfihausa.html';
    
    protected array $newsList = array();
    
    protected $error = null;
    
    
    public function fetch() : object
    {
        $client = Client::get($this->websiteUrl);
        
        $client->success(function($ql){
            $ql->find('.m-item-list-article')->each(function($div){
                $this->newsList[] = [
                    'text' => $div->find('p:eq(0)')->text(),
                    'href' => $this->makeUrl($div->find('a:eq(0)')->attr('href'))
                ];
            });
        });
        
        $client->error(function($err){
            $this->error = $err;
        });
        
        return $this;
    }
    
}
