<?php

namespace App\Model;

interface BasketRepository
{
    public function getBasket(string $customerId): ?CustomerBasket;
}
