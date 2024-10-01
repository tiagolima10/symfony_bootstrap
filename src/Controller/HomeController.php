<?php 

namespace App\Controller;

use App\Service\NewsService;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    #[Route('/', name:'app_home')]
    public function home(LoggerInterface $logger, NewsService $service): Response
    {
        $logger->info('Acessou a home');

        $logger->info('Array criada');

        $pageTitle = "Sistema de Notícias";

        $logger->info('Título definido');

        return $this->render("home.html.twig", [
            'categories'=> $service->getCategoryList(),
            'pageTitle' => $pageTitle,
        ]);
    }

    #[Route('/categoria/{slug}', name:'app_category')]
    public function category(string $slug=null, NewsService $service): Response
    {
        $pageTitle = $slug;
        return $this->render("category.html.twig", [
            'pageTitle' => $pageTitle,
            'categories'=> $service->getCategoryList(),
            'news' => $service->getNewsList(),
        ]);
    }

    #[Route('/news/{id}')]
    public function newsDetail(int $id=null, HttpClientInterface $httpClient){
        $response = $httpClient->request('GET', 'http://localhost:8000/api/news/'.$id);
    }

}