<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAllProducts()
    {
        return $this->product->all()->paginate(10);
    }

    public function getProductbyId(int $id)
    {
        return $this->product->find($id);
    }

    public function createProduct(array $data)
    {
        return $this->product->create($data);
    }

    public function updateProduct(int $id, array $data)
    {
        return $this->product->find($id)->update($data);
    }

    public function deleteProduct(int $id)
    {
        return $this->product->find($id)->delete();
    }
}
