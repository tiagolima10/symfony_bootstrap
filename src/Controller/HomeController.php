<?php 

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    #[Route('/', name:'app_home')]
    public function home(LoggerInterface $logger, HttpClientInterface $httpClient): Response
    {
        $logger->info('Acessou a home');

        $logger->info('Array criada');

        $pageTitle = "Sistema de Notícias";

        $logger->info('Título definido');

        return $this->render("home.html.twig", [
            'categories'=> $this->getCategoryList($httpClient),
            'pageTitle' => $pageTitle,
        ]);
    }

    #[Route('/categoria/{slug}', name:'app_category')]
    public function category(string $slug=null, HttpClientInterface $httpClient): Response
    {
        $pageTitle = $slug;
        return $this->render("category.html.twig", [
            'pageTitle' => $pageTitle,
            'categories'=> $this->getCategoryList($httpClient),
            'news' => $this->getNewsList($httpClient),
        ]);
    }

    public function getCategoryList(HttpClientInterface $httpClient){
        $url = 'https://raw.githubusercontent.com/JonasPoli/array-news/refs/heads/main/arrayCategoryNews.json';
        $html = $httpClient->request('GET', $url);
        $news = $html->toArray();

        return $news;
    }

    public function getNewsList(HttpClientInterface $httpClient){
        $url = 'https://raw.githubusercontent.com/JonasPoli/array-news/refs/heads/main/arrayNews.json';
        $html = $httpClient->request('GET', $url);
        $news = $html->toArray();

        return $news;
    }

    #[Route('/news/{id}')]
    public function newsDetail(int $id=null, HttpClientInterface $httpClient){
        $response = $httpClient->request('GET', 'http://localhost:8000/api/news/'.$id);
    }

}