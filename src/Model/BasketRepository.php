<?php

namespace App\Model;

interface BasketRepository
{
    public function getBasket(string $customerId): ?CustomerBasket;

    public function updateBasket(CustomerBasket $basket): ?CustomerBasket;

    public function deleteBasket(string $id): bool;

}
