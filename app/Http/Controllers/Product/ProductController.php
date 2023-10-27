<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product\Product;
use App\Repository\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $repository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->repository = $productRepository;
    }

    public function index()
    {
        return $this->repository->getAll();
    }

    public function store(ProductRequest $request)
    {
        $this->repository->save();

        return response()->json([
            'status' => true,
            'message' => 'Product added successfully'
        ]);
    }

    public function show($id)
    {
        return $this->repository->getById($id);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->repository->update($product);

        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
}
