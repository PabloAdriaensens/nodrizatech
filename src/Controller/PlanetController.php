<?php

namespace App\Controller;

use App\Factory\JsonResponseFactory;
use App\Service\JsonPlaceholderApi;
use App\Service\PlanetsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PlanetController extends AbstractController
{
    /**
     * @Route("/planets/{id}", name="app_planets", methods={"GET"})
     */
    public function index($id): JsonResponse
    {
        $client = new JsonPlaceholderApi();
        $jsonResponseFactory = new JsonResponseFactory();
        $route = JsonPlaceholderApi::URL_PARAMETER;

        $response = $client->getByParameters($route.$id);

        $planet = (new PlanetsService())->getPlanets($response, (int)$id);

        if (empty($planet)) {
            return $jsonResponseFactory->error('Invalid syntax for this request was provided.', 401);
        }

        return $jsonResponseFactory->success($planet);
    }
}
