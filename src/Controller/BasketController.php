<?php

namespace App\Controller;

use App\Model\BasketRepository;
use App\Model\CustomerBasket;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/v1/basket')]
class BasketController extends AbstractController
{
    private BasketRepository $repository;
    private SerializerInterface $serializer;

    public function __construct(BasketRepository    $repository,
                                SerializerInterface $serializer,
    )
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
    }

    #[Route('/{id}', name: 'basket_by_id', methods: ['GET'])]
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

}
