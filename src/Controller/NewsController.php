<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Classe base para controladores no Symfony
use Symfony\Component\HttpFoundation\JsonResponse; // Classe para enviar respostas no formato JSON
use Symfony\Component\HttpFoundation\Response; // Classe que representa a resposta HTTP
use Symfony\Component\Routing\Annotation\Route; // Usada para definir rotas via anotações

class NewsController extends AbstractController
{
    // Definição de uma rota para a API de notícias com o método HTTP GET
    // A rota '/api/news/{id}' recebe um ID dinâmico da notícia
    #[Route('/api/news/{id}', name:'app_new', methods:['GET'])]
    public function getNew(string $id=null): Response
    {
        // TODO - Implementar uma consulta real ao banco de dados para buscar a notícia pelo ID

        // Definindo um array com dados simulados da notícia (substituir isso com dados reais no futuro)
        $news = [
            'id'=> $id, // ID da notícia, passado como parâmetro na URL
            'titulo'=> 'São Paulo x Botafogo, o duelo pela libertadores que vale o ano do time paulista. Quem passa? Veja Escalações e Prévias', // Título da notícia
            'categoria'=> 'Esportes', // Categoria da notícia
            'data'=> '2024-09-25', // Data da notícia
            'imagem'=> 'https://exemplo.com/imagem/spfcxbot.jpg', // URL de uma imagem relacionada à notícia
        ];
        // Retornando os dados da notícia no formato JSON
        // Symfony fornece uma função helper `json()` para facilitar o retorno de respostas JSON
        return $this->json($news);
    }
}

?>