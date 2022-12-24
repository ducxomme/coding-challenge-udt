<?php
declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

/**
 * Class ProductController
 * @package App\Http\Controllers\API\V1
 */
final class ProductController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        $sql = <<<SQL
SELECT
    p.*,
    a.name as agency_name,
    c.name as category_name
FROM
    products p 
        INNER JOIN agency a ON p.agency_id = a.id
        INNER JOIN categories c ON p.category_id = c.id;
SQL;

        $results = DB::select($sql);

        $result = [];

        foreach ($results as $product) {
            $result[] = [
                'id' => $product->id,
                'name' => $product->name,
                'unitPrice' => $product->unit_price,
                'agencyName' => $product->agency_name,
                'categoryName' => $product->category_name
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
        $sql = <<<SQL
SELECT
    p.*,
    a.name as agency_name,
    c.name as category_name
FROM
    products p 
        INNER JOIN agency a ON p.agency_id = a.id
        INNER JOIN categories c ON p.category_id = c.id
WHERE
    p.id = ?;
SQL;
        $product = DB::selectOne($sql, [(int)$request->route('id')]);

        $result = [];
        if (!is_null($product)) {
            $result = [
                'id' => $product->id,
                'name' => $product->name,
                'unitPrice' => $product->unit_price,
                'agencyName' => $product->agency_name,
                'categoryName' => $product->category_name
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
            "unitPrice": 10.99,
            "agencyId": 1,
            "categoryId": 1
          }
        }
        */
        $requestBody = $request->get('data');

        $product = new Product;
        $product->name = $requestBody['name'];
        $product->unit_price = $requestBody['unitPrice'];
        $product->agency_id = $requestBody['agencyId'];
        $product->category_id = $requestBody['categoryId'];

        $product->save();
    }

    /**
     * @param Request $request
     * @return void
     */
    public function update(Request $request): void
    {
        $requestBody = $request->get('data');

        $product = Product::find((int) $request->route('id'));

        if (is_null($product)) {
            throw new Exception('Invalid parameter');
        }

        $product->name = $requestBody['name'];
        $product->unit_price = $requestBody['unitPrice'];
        $product->agency_id = $requestBody['agencyId'];
        $product->category_id = $requestBody['categoryId'];

        $product->update();
    }

    /**
     * @param Request $request
     * @return void
     */
    public function delete(Request $request): void
    {
        Product::where('id', (int) $request->route('id'))->delete();
    }
}
