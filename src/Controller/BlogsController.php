<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogsController extends AbstractController
{
    #[Route('/blogs', name: 'app_blogs')]
    public function index(Request $request): Response
    {
        $rssFileNews = 'https://feeds.bbci.co.uk/sport/football/rss.xml';
        $rss = simplexml_load_file($rssFileNews);

        return $this->render('blogs/index.html.twig', [
            'rss' => $rss,
        ]);
    }
}
