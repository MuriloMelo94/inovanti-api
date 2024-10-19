<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts(): Collection
    {
        return $this->productRepository->getAllProducts();
    }

    public function getProductById(string $id): ?Product
    {
        return $this->productRepository->getProductById($id);
    }

    public function createProduct(array $product): Product
    {
        $product['uuid'] = Str::uuid();

        return $this->productRepository->createProduct($product);
    }


    public function updateProduct(string $id, array $data): ?Product
    {
        $product = $this->productRepository->getProductById($id);

        if (!$product) {
            return null;
        }

        return $this->productRepository->updateProduct($id, $data);
    }

    public function deleteProduct(string $id): bool
    {
        $product = $this->productRepository->getProductById($id);

        if (!$product) {
            return false;
        }

        return $this->productRepository->deleteProduct($id);
    }
}
