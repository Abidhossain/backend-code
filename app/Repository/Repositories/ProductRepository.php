<?php

namespace App\Repository\Repositories;

use App\Models\Product\Product;
use App\Repository\Interfaces\ProductInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;

class ProductRepository implements ProductInterface
{
    public $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function getAll()
    {
        return $this->model
            ->when(request()->get('category_id'), function (Builder $builder) {
                $builder->where('category_id', request()->get('category_id'));
            })
            ->when(request()->get('short_by'), function (Builder $builder) {
                $builder->orderBy('price', request()->get('short_by'));
            })
            ->get();
    }

    public function getById($id)
    {
        return $this->model->with('category:id,name')->find($id);
    }

    public function save()
    {
        $product = new $this->model();
        $product->name = request()->get('name');
        $product->price = request()->get('price');
        $product->description = request()->get('description');
        $product->category_id = request()->get('category_id');
        $product->save();
        if (request()->hasFile('image')) {
           $path =  $this->storeFile(request()->file('image'),'products');
            $product->image = $path;
            $product->save();
           return $path;
        }
        return $this;
    }

    public function storeFile(UploadedFile $file, $folder = 'image')
    {
        $name = Str::random(40) . "." . $file->getClientOriginalExtension();
        $file->storeAs("public/{$folder}", $name);

        return Storage::url($folder . '/' . $name);
    }

    public function update($model)
    {
        if (request()->hasFile('image')) {
            $path =  $this->storeFile(request()->file('image'),'products');
            $model->image = $path;
            $model->save();
            return $path;
        }

        $model->update([
            'name' => request()->get('name'),
            'price' => request()->get('price'),
            'description' => request()->get('description'),
            'category_id' => request()->get('category_id'),
        ]);


        return $this;
    }

    public function delete($id)
    {
        $product = $this->model->where('id',$id)->first(); 
        $product->delete();
        return $this;
    }

}
