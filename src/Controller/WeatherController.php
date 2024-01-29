<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;


class WeatherController extends AbstractController
{
    #[Route('/weather', name: 'app_weather')]
    public function index(Request $request): Response
    {
        $apiKey = 'af60cf799fca827b33234e1f6b693e04';
        $location = $request->query->get('location', 'Nairobi');

        $client  = new Client();
        $response = $client->get("http://api.openweathermap.org/data/2.5/weather?q={$location}&appid={$apiKey}");
        $data = json_decode($response->getBody(), true);

        return $this->render('weather/index.html.twig', [
            'weather' => $data,

        ]);
    }
}
