<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    #[Route('api/news/{id}')]
    public function getNews(string $id=null): Response
    {
        // TODO - Criar uma Query real
        $news = [
            'id'=> $id,
            'titulo'=> 'São Paulo x Botafogo, o duelo pela libertadores que vale o ano do time paulista. Quem passa? Veja Escalações e Prévias',
            'categoria'=> 'Esportes',
            'data'=> '2024-09-25',
            'imagem'=> 'https://exemplo.com/imagem/spfcxbot.jpg',
        ];
        return new JsonResponse($news);
    }
}

?>