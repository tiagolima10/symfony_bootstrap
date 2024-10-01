<?php 

namespace App\Controller;

// Importação das classes necessárias para o funcionamento do controller
use App\Service\NewsService; // Serviço que será utilizado para obter informações de notícias
// use Psr\Log\LoggerInterface; // Interface para o sistema de logging (log de eventos e mensagens)
use Symfony\Component\HttpFoundation\Response; // Classe que representa a resposta HTTP
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Classe base para os controladores no Symfony
// use Symfony\Component\HttpFoundation\Request; // Classe para lidar com as requisições HTTP
use Symfony\Component\Routing\Annotation\Route; // Usada para definir rotas via anotações
use Symfony\Contracts\HttpClient\HttpClientInterface; // Interface para realizar requisições HTTP externas

class HomeController extends AbstractController
{
    // Rota para a página home
    #[Route('/', name:'app_home')]
    public function home(NewsService $service): Response
    {
        $pageTitle = "Sistema de Notícias";

        // Renderizando o template 'home.html.twig' e passando um array de dados:
        return $this->render("home.html.twig", [
            'categories'=> $service->getCategoryList(), // lista de categorias obtida através do serviço NewsService
            'pageTitle' => $pageTitle, // Título da página
        ]);
    }

    // Definição de uma rota para visualizar uma categoria, com um parâmetro dinâmico 'slug'
    #[Route('/categoria/{slug}', name:'app_category')]
    public function category(string $slug=null, NewsService $service): Response
    {
        $pageTitle = $slug;

        // Renderizando o template 'category.html.twig' com os dados:
        // 'categories' -> lista de categorias obtida através do serviço NewsService
        // 'news' -> lista de notícias obtida através do serviço NewsService
        return $this->render("category.html.twig", [
            'pageTitle' => $pageTitle,
            'categories'=> $service->getCategoryList(),
            'news' => $service->getNewsList(),
        ]);
    }

    // Definição de uma rota para visualizar os detalhes de uma notícia, passando um 'id' como parâmetro
    #[Route('/news/{id}')]
    public function newsDetail(int $id=null, HttpClientInterface $httpClient){
        $response = $httpClient->request('GET', 'http://localhost:8000/api/news/'.$id);
    }

}