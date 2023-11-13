<?php

namespace App\Repositories\ModelRepositories;

use App\Models\Product;
use App\Models\User;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function products()
    {
        return "products";
    }
}
