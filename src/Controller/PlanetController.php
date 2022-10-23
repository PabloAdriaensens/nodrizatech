<?php

namespace App\Controller;

use App\Entity\Planet;
use App\Factory\JsonResponseFactory;
use App\Service\JsonPlaceholderApi;
use App\Service\PlanetsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanetController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @var JsonResponseFactory
     */
    private JsonResponseFactory $jsonResponseFactory;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->jsonResponseFactory = new JsonResponseFactory();
    }

    /**
     * @Route("/planets/{id}", name="app_planets", methods={"GET"})
     */
    public function index($id): JsonResponse
    {
        $client = new JsonPlaceholderApi();
        $route = JsonPlaceholderApi::URL_PARAMETER;

        $response = $client->getByParameters($route.$id);

        $planet = (new PlanetsService())->getPlanets($response, (int)$id);

        if (empty($planet)) {
            return $this->jsonResponseFactory->error('Invalid syntax for this request was provided.', 401);
        }

        return $this->jsonResponseFactory->success($planet);
    }

    /**
     * @Route("/planet", name="post_api_post", methods={"POST"})
     */
    public function post(Request $request): Response
    {
        $planet = new Planet();

        $parameter = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        if (!array_key_exists('id', $parameter)) {
            return $this->jsonResponseFactory->error('No id found for the planet', 404);
        }

        $id = $this->em->getRepository(Planet::class)->find($parameter['id']);

        if ($id === null) {
            $planetStructure = $planet->jsonSerialize();
            $validPlanet = (new PlanetsService())->validatePlanet($planetStructure, $parameter);

            if (!empty($validPlanet)) {
                return $this->jsonResponseFactory->error($validPlanet[0], 400);
            }

            $planet->setId($parameter['id']);
            $planet->setName($parameter['name']);
            $planet->setOrbitalPeriod($parameter['orbital_period'] ?? 0);
            $planet->setRotationPeriod($parameter['rotation_period'] ?? 0);
            $planet->setDiameter($parameter['diameter'] ?? 0);

            $this->em->persist($planet);
            $this->em->flush();

            $insertedPlanet = $planet->jsonSerialize();

            return $this->jsonResponseFactory->success($insertedPlanet);
        }

        return $this->jsonResponseFactory->error('This id planet already exists, try with another one', 401);
    }
}
