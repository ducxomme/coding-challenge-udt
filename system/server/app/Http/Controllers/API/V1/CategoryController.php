<?php
declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API\V1
 */
final class CategoryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        $categories = Category::all();

        $result = [];

        foreach ($categories as $category) {
            $result[] = [
                'id' => $category['id'],
                'name' => $category['name'],
            ];
        }

        return new JsonResponse( [
            'data' => $result,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function get(Request $request): JsonResponse
    {
        $category = Category::find((int) $request->route('id'));

        $result = [];

        if (!is_null($category)) {
            $result = [
                'id' => $category->id,
                'name' => $category->name,
            ];
        }

        return new JsonResponse( [
            'data' => $result,
        ]);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function create(Request $request): void
    {
        /*
        {
          "data": {
            "name": "XXX",
          }
        }
        */
        $requestBody = $request->get('data');

        $category = new Category();
        $category->name = $requestBody['name'];

        $category->save();
    }

    /**
     * @param Request $request
     * @return void
     */
    public function update(Request $request): void
    {
        $requestBody = $request->get('data');

        $category = Category::find((int) $request->route('id'));

        if (is_null($category)) {
            throw new Exception('Invalid parameter');
        }

        $category->name = $requestBody['name'];

        $category->update();
    }

    /**
     * @param Request $request
     * @return void
     */
    public function delete(Request $request): void
    {
        Category::where('id', (int) $request->route('id'))->delete();
    }
}
