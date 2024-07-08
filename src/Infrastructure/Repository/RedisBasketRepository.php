<?php

namespace App\Infrastructure\Repository;

use App\Model\CustomerBasket;
use App\Model\BasketRepository;
use Predis\Client;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class RedisBasketRepository implements BasketRepository
{
    private Client $database;
    private SerializerInterface $serializer;
    private LoggerInterface $logger;

    public function __construct(Client $database, SerializerInterface $serializer, LoggerInterface $logger)
    {
        $this->database = $database;
        $this->serializer = $serializer;
        $this->logger = $logger;
    }

    public function getBasket(string $customerId): ?CustomerBasket
    {
        $data = $this->database->get($customerId);

        if (!$data) {
            return null;
        }

        return $this->serializer->deserialize($data, CustomerBasket::class, 'json');
    }

    public function updateBasket(CustomerBasket $basket): ?CustomerBasket
    {

        $created = $this->database->set($basket->getBuyerId(), $this->serializer->serialize($basket, 'json'));

        if (!$created) {
            $this->logger->info("Problem occur persisting the item.");
            return null;
        }

        $this->logger->info("Basket item persisted succesfully.");

        return $this->getBasket($basket->getBuyerId());
    }

    public function deleteBasket(string $id): bool
    {
        return $this->database->del($id) > 0;
    }
}
