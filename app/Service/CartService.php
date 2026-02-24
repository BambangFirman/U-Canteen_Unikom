<?php

namespace App\Service;

interface CartService
{
    public function saveOrUpdate(array $data): bool;
    public function saveToMenusCartsTable(array $data):void;

    public function delete(string $cartId): void;
}
