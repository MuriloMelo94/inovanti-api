<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAllProducts(): Collection
    {
        return $this->product->all();
    }

    public function getProductbyId(string $id): ?Product
    {
        return $this->product->find($id);
    }

    public function createProduct(array $data): Product
    {
        return $this->product->create($data);
    }

    public function updateProduct(string $id, array $data): ?Product
    {
        $product = $this->product->find($id);

        if (!$product) {
            return null;
        }

        $product->update($data);

        return $product;
    }

    public function deleteProduct(string $id): bool
    {
        return $this->product->find($id)->delete();
    }
}
