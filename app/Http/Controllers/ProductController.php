<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): AnonymousResourceCollection
    {
        $products = $this->productService->getAllProducts();

        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request): ProductResource | JsonResponse
    {
        try {
            $product = $this->productService->createProduct($request->validated());

            return new ProductResource($product);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json(['message' => __('message.server_error')], 500);
        }
    }

    public function show($id): ProductResource | JsonResponse
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            return response()->json(['message' => __('message.product_not_found')], 404);
        }

        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, $id): JsonResponse
    {
        $response = $this->productService->updateProduct($id, $request->validated());

        if (!$response) {
            return response()->json(['message' => __('message.product_not_found')], 404);
        }

        return response()->json([
            'message' => __('message.product_updated'),
            'product' => new ProductResource($response),
        ], 200);
    }

    public function delete($id): JsonResponse
    {
        $response = $this->productService->deleteProduct($id);

        if (!$response) {
            return response()->json(['message' => __('message.product_not_found')], 404);
        }

        return response()->json(['message' => __('message.product_deleted')], 200);
    }
}
