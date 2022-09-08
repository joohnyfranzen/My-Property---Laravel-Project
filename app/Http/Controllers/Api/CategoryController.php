<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->paginate('10');

        return response()->json($categories, 200);
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();

        try{


            $category = $this->category->create($data);
            return response()->json([
                'data' => [
                    'msg' => 'Category registered !!!'
                ]
            ], 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage(), 401]);
        }
    }

    public function show($id)
    {
        try{

            $category = $this->category->findOrFail($id);

            return response()->json([
                'data' => [
                    'msg' => $category
                ]
            ], 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage(), 401]);
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = $request->all();

        try{

            $category = $this->category->findOrFail($id);
            $category->update($data);
            return response()->json([
                'data' => [
                    'msg' => 'Category atualized !!!'
                ]
            ], 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage(), 401]);
        }
    }

    public function destroy($id)
    {
        try{

            $category = $this->category->findOrFail($id);
            $category->delete();
            return response()->json([
                'data' => [
                    'msg' => 'Category removed !!!'
                ]
            ], 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage(), 401]);
        }
    }
}
