<?php 

namespace App\Service;

use Psr\Cache\CacheItemInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NewsService
{

    // O construtor injeta as dependências necessárias: HttpClientInterface e CacheInterface
    public function __construct(
        private HttpClientInterface $httpClient,
        private CacheInterface $cache
    )
    {
        // O PHP 8 permite definir variáveis diretamente no construtor com "private" sem a necessidade de atribuições manuais
        // Isso substitui o que anteriormente era feito com: $this->httpClient = $httpClient;
        // $this->CacheInterface = $cache; foi removido pois a atribuição é feita automaticamente.
    } 

    // Função para obter a lista de categorias
    public function getCategoryList(){
        // Obtém a lista de categorias usando cache
        $categories = $this->cache->get('news_category', function (CacheItemInterface $cacheItem) {
            // Define a expiração do cache para 60 segundos
            $cacheItem->expiresAfter(60);

            // URL da API que retorna as categorias
            $url = 'https://raw.githubusercontent.com/JonasPoli/array-news/refs/heads/main/arrayCategoryNews.json';

            // Realiza uma requisição GET para a URL especificada
            $html = $this->httpClient->request('GET', $url);

            // Converte a resposta em um array associativo (Chave -> Valor)
            $news = $html->toArray();

            // Retorna os dados de categorias obtidos
            return $news;
        });

        // Retorna a lista de categorias armazenada em cache
        return $categories;
    }

    // Função para obter a lista de notícias
    public function getNewsList(){
        // Obtém a lista de notícias usando cache
        $news = $this->cache->get('news_list', function(CacheItemInterface $cacheItem) {
            // Define a expiração do cache para 60 segundos
            $cacheItem->expiresAfter(60);

            // URL da API que retorna as notícias
            $url = 'https://raw.githubusercontent.com/JonasPoli/array-news/refs/heads/main/arrayNews.json';

            // Realiza uma requisição GET para a URL especificada
            $html = $this->httpClient->request('GET', $url);

            // Converte a resposta em um array associativo
            $news = $html->toArray();

            // Retorna os dados de notícias obtidos
            return $news;
        });
        
        // Retorna a lista de notícias armazenada em cache
        return $news;
    }
}