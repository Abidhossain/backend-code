<?php

namespace App\Repository\Repositories;

use App\Models\Category\Category;
use App\Repository\Interfaces\CategoryInterface;

class CategoryRepository implements CategoryInterface
{
    public $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getAll()
    {
        return $this->model
            ->select('id','name', 'image', 'category_id')
            ->with('categories')
            ->get();
    }


}
