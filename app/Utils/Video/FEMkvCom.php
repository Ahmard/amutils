<?php
namespace App\Utils\Video;

use ConfigMan\Config;
use Queliwrap\Client;

class FEMkvCom
{
    protected $request;
    
    public $error;
    
    protected $url;
    
    protected $episodes = array();
    
    public static function __callStatic($method, $args)
    {
        $method = "_{$method}";
        return (new static())->$method(...$args);
    }
    
    
    public function _from($url)
    {
       // $url = 'http://localhost:8080/doliex/temp/1588608336.html';
        $this->url = $url;
        $this->request = Client::get($url);
        $this->request->otherwise(function($error){
            $this->error = $error->getError();
        });
        
        return $this;
    }
    
    
    public function episodes()
    {
        if($this->error == null){
            $this->request->then(function($ql){
                $lists = $ql->find('#content')
                    ->find('ol')->eq(0)
                    ->find('li')
                    ->each(function($li){
                        $a = $li->find('a');
                        if($a->is('a')){
                            $this->episodes[] = [
                                'name' => explode(' – ', $li->text())[0],
                                'href' => $a->attr('href'),
                                'links' => $this->getEpisodeLinks($a->attr('href'))
                            ];
                        }
                    });
            
            });
        }
        
        return $this;
    }
    
    
    public function getEpisodeLinks($href)
    {
        //$href = 'http://localhost:8080/doliex/temp/1588609163.html';
        $request = Client::get($href);
        $this->request->then(function($ql){
            $this->links = array();
            
            $nodes = $ql->find('p > a')
                ->each(function($node){
                    $this->links[] = [
                        'name' => $node->text(),
                        'href' => $node->attr('href')
                    ];
                });
            
            return $this->links;
        });
    }
    
    
    public function get()
    {
        return $this->episodes;
    }
    
    
    public function save($folder)
    {
        $html = '<ol>';
        foreach ($this->episodes as $episode) {
            $html .= '<li>'.$episode['name'].'</li>';
            $html .= '<ul>';
            foreach ($episode['links'] as $link) {
                $html .= '<li><a href="'.$link['href'].'" target="_blank">'.$link['name'].'</a></li>';
            }
            $html .= '</ul>';
        }
        $html .= '</ol>';
        
        if($folder[strlen($folder) - 1] != DIRECTORY_SEPARATOR){
            $folder .= DIRECTORY_SEPARATOR;
        }
        file_put_contents($folder.$this->getFileName(), $html);
    }
    
    
    public function getFileName()
    {
        return explode('/', $this->url)[3] . '.html';
    }
}