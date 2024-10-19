<?php

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function getAllProducts(): Collection;
    public function getProductbyId(string $id): ?Product;
    public function createProduct(array $product): Product;
    public function updateProduct(string $id, array $product): ?Product;
    public function deleteProduct(string $id): bool;
}
