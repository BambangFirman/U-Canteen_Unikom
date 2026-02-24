<?php

namespace App\Service;

interface MenuService
{
    public function save(array $menuData): bool;
}
