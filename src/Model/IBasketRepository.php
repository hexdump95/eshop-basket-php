<?php

namespace App\Model;

interface IBasketRepository
{
    public function getBasket(string $customerId): ?CustomerBasket;
}