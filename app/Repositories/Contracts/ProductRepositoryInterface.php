<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function getAllProducts();
    public function getProductbyId(int $id);
    public function createProduct(array $product);
    public function updateProduct(int $id, array $product);
    public function deleteProduct(int $id);
}
