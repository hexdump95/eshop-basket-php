<?php

namespace App\Infrastructure\Repository;

use App\Model\CustomerBasket;
use App\Model\BasketRepository;
use Predis\Client;
use Symfony\Component\Serializer\SerializerInterface;

class RedisBasketRepository implements BasketRepository
{
    private Client $database;
    private SerializerInterface $serializer;

    public function __construct(Client $database, SerializerInterface $serializer)
    {
        $this->database = $database;
        $this->serializer = $serializer;
    }

    public function getBasket(string $customerId): ?CustomerBasket
    {
        $data = $this->database->get($customerId);

        if (!$data) {
            return null;
        }

        return $this->serializer->deserialize($data, CustomerBasket::class, 'json');
    }
}
