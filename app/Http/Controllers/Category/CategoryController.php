<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Repository\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    public $repository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }

    public function index(){
        return $this->repository->getAll();
    }
}
