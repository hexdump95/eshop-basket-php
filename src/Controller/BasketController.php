<?php

namespace App\Controller;

use App\Model\BasketRepository;
use App\Model\CustomerBasket;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/v1/basket')]
class BasketController extends AbstractController
{
    private BasketRepository $repository;
    private SerializerInterface $serializer;
    private LoggerInterface $logger;

    public function __construct(BasketRepository    $repository,
                                SerializerInterface $serializer,
                                LoggerInterface     $logger,
    )
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
        $this->logger = $logger;
    }

    #[Route('/{id}', name: 'get_basket_by_id', methods: ['GET'])]
    public function getBasketById(string $id): JsonResponse
    {
        $basket = $this->repository->getBasket($id);
        if (!$basket) {
            $basket = new CustomerBasket();
            $basket->setBuyerId($id);
        }

        $jsonResponse = $this->serializer->serialize($basket, 'json');
        return new JsonResponse($jsonResponse, 200, [], true);
    }


    #[Route('', name: 'update_basket', methods: ['POST'])]
    public function updateBasket(Request $request): JsonResponse
    {
        $value = $this->serializer
            ->deserialize($request->getContent(), CustomerBasket::class, 'json');

        $response = $this->repository->updateBasket($value);

        $jsonResponse = $this->serializer->serialize($response, 'json');
        return new JsonResponse($jsonResponse, 200, [], true);
    }


    #[Route('/{id}', name: 'delete_basket_by_id', methods: ['DELETE'])]
    public function deleteBasketById(string $id): JsonResponse
    {
        $this->repository->deleteBasket($id);
        return new JsonResponse([], 200);
    }

}
