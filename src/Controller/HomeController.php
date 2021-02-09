<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(HttpClientInterface $httpClient): Response
    {
        $httpClient->request('POST', 'https://jsonplaceholder.typicode.com/posts', [
            'json' => [
                'title' => 'foo',
                'body' => 'bar',
                'userId' => 1,
            ],
        ]);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/with-content", name="with_content")
     */
    public function withContent(HttpClientInterface $httpClient): Response
    {
        $response = $httpClient->request('POST', 'https://jsonplaceholder.typicode.com/posts', [
            'json' => [
                'title' => 'foo',
                'body' => 'bar',
                'userId' => 1,
            ],
        ]);

        $response ->getContent();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
