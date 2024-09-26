<?php 

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    #[Route('/', name:'app_home')]
    public function home(LoggerInterface $logger): Response
    {
        $logger->info('Acessou a home');

        $categories = [
            ['title' => 'Mundo',  'text'=> 'Notícias sobre o Mundo'],
            ['title' => 'Brasil',  'text'=> 'Notícias sobre o Brasil'],
            ['title' => 'Tecnologia',  'text'=> 'Notícias sobre Tecnologia'],
            ['title' => 'Design',  'text'=> 'Notícias sobre o Mundo'],
            ['title' => 'Cultura',  'text'=> 'Notícias sobre Cultura'],
            ['title' => 'Negócios',  'text'=> 'Notícias sobre Negócios'],
            ['title' => 'Esportes',  'text'=> 'Notícias sobre Esportes'],
            ['title' => 'Opinião',  'text'=> 'Notícias sobre Opinião'],
            ['title' => 'Ciência',  'text'=> 'Notícias sobre o Ciência'],
            ['title' => 'Saúde',  'text'=> 'Notícias sobre Saúde'],
            ['title' => 'Estilo de vida',  'text'=> 'Notícias sobre Estilo de vida'],
            ['title' => 'Viagens',  'text'=> 'Notícias sobre Viagens'],
        ];

        $logger->info('Array criada');

        $pageTitle = "Sistema de Notícias";

        $logger->info('Título definido');

        return $this->render("home/home.html.twig", [
            'categories'=> $categories,
            'pageTitle' => $pageTitle,
        ]);
    }

    #[Route('/categoria/{slug}', name:'app_category')]
    public function category(string $slug=null): Response
    {
        $categories = [
            ['title' => 'Mundo',  'text'=> 'Notícias sobre o Mundo'],
            ['title' => 'Brasil',  'text'=> 'Notícias sobre o Brasil'],
            ['title' => 'Tecnologia',  'text'=> 'Notícias sobre Tecnologia'],
            ['title' => 'Design',  'text'=> 'Notícias sobre o Mundo'],
            ['title' => 'Cultura',  'text'=> 'Notícias sobre Cultura'],
            ['title' => 'Negócios',  'text'=> 'Notícias sobre Negócios'],
            ['title' => 'Política',  'text'=> 'Notícias sobre Política'],
            ['title' => 'Opinião',  'text'=> 'Notícias sobre Opinião'],
            ['title' => 'Ciência',  'text'=> 'Notícias sobre o Ciência'],
            ['title' => 'Saúde',  'text'=> 'Notícias sobre Saúde'],
            ['title' => 'Estilo de vida',  'text'=> 'Notícias sobre Estilo de vida'],
            ['title' => 'Viagens',  'text'=> 'Notícias sobre Viagens'],
        ];

        $pageTitle = $slug;
        return $this->render("home/category.html.twig", [
            'categories'=> $categories,
            'pageTitle' => $pageTitle,
        ]);
    }

    #[Route('/news/{id}')]
    public function newsDetail(int $id=null, HttpClientInterface $httpClient){
        $response = $httpClient->request('GET', 'http://localhost:8000/api/news/'.$id);
    }
}

?>