<?php 

namespace App\Service;

use Psr\Cache\CacheItemInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NewsService
{

    public function __construct(
        private HttpClientInterface $httpClient,
        private CacheInterface $cache
    )
    {
        // $this->httpClient = $httpClient;
        // $this->CacheInterface = $cache;
    } 

    public function getCategoryList(){
        $categories = $this->cache->get('news_category', function (CacheItemInterface $cacheItem) {
            $cacheItem->expiresAfter(60); //Cache expira depois de 60 segundos
            $url = 'https://raw.githubusercontent.com/JonasPoli/array-news/refs/heads/main/arrayCategoryNews.json';
            $html = $this->httpClient->request('GET', $url);
            $news = $html->toArray();

            return $news;
        });

        return $categories;
    }

    public function getNewsList(){
        $news = $this->cache->get('news_list', function(CacheItemInterface $cacheItem) {
            $cacheItem->expiresAfter(60); //Cache expira depois de 60 segundos
            $url = 'https://raw.githubusercontent.com/JonasPoli/array-news/refs/heads/main/arrayNews.json';
            $html = $this->httpClient->request('GET', $url);
            $news = $html->toArray();

            return $news;
        });
        
        return $news;
    }
}