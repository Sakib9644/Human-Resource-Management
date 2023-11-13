<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Repositories\ModelRepositories\ProductRepository;
use App\Repositories\RepositoryInterface;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
class ProductController extends Controller
{
    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        
        try {
            $data = [

                ['id' => 1,
                    'name' => 'name',],
                ['id' => 2,
                    'name' => 'name2',],
                ['id' => 3,
                    'name' => 'name3',]

            ];

            if ($data != null) {
                return response()->json([
                    'status' => 'ok',
                    'message' => 'Data fetched successfully',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => 'ok',
                    'message' => "No data accessed",
                    'data' => $data
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error occurred while accessing data',
                'error' => $e->getMessage(),
            ], 500); // HTTP status code 500 for internal server error
        }
        // check if data accessed properly

    }

    public function store(StoreProductRequest $request)
    {
        try {
            // Validate and prepare the data
            $validatedData = $request->validated(); // Uses the StorePostRequest for validation
            $post = new Product();
            //dd($validatedData);
            $post->title = $validatedData['title'];

            // Save the data to the database
            $post->save();

            return response()->json([
                'message' => 'Post saved successfully',
                'data' => $post,
            ], 201); // HTTP status code 201 for resource creation
        } catch (QueryException $ex) {
            // Handle database-related errors
            return response()->json([
                'message' => 'Error saving post',
                'error' => $ex->getMessage(),
            ], 500); // HTTP status code 500 for internal server error
        }
    }
}
