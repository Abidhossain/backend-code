<?php

namespace App\Repository\Interfaces;

interface ProductInterface
{
    public function getAll();

    public function getById($id);

    public function save();

    public function update($model);

    public function delete($id);

}
