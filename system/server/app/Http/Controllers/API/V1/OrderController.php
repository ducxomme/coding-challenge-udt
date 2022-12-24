<?php
declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

/**
 * Class OrderController
 * @package App\Http\Controllers\API\V1
 */
final class OrderController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        $orders = Order::all();

        $result = [];

        foreach ($orders as $order) {
            $orderDetail = $this->getOrderDetail($order['id']);

            $result[] = [
                'id' => $order['id'],
                'customerId' => $order['customer_id'],
                'orderDate' => $order['order_date'],
                'products' => $orderDetail,
            ];
        }

        return new JsonResponse( [
            'data' => $result,
        ]);
    }

    /**
     * @param int $id
     * @return array
     */
    private function getOrderDetail(int $id): array
    {
        $sql = <<<SQL
SELECT
    o.*,
    p.name,
    p.unit_price
FROM
    order_details o 
        INNER JOIN products p ON o.product_id = p.id
WHERE
    o.order_id = ?;
SQL;
        $records = \DB::select($sql, [$id]);

        $result = [];
        foreach ($records as $record) {
            $result[] = [
                'name' => $record->name,
                'unitPrice' => $record->unit_price,
                'quantity' => $record->quantity,
            ];
        }

        return $result;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function get(Request $request): JsonResponse
    {
        $order = Order::find((int) $request->route('id'));

        $result = [];

        if (!is_null($order)) {
            $orderDetail = $this->getOrderDetail($order['id']);

            $result = [
                'id' => $order['id'],
                'customerId' => $order['customer_id'],
                'orderDate' => $order['order_date'],
                'products' => $orderDetail,
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
            "customerId": 1,
            "orderDate": "20220-12-30",
            "products": [
                {
                    "productId": 1,
                    "quantity": 2
                },
                {
                    "productId": 1,
                    "quantity": 2
                 }
            ]
          }
        }
        */
        $requestBody = $request->get('data');

        $order = new Order();
        $order->customer_id = $requestBody['customerId'];
        $order->order_date = date('Y-m-d H:i:s',strtotime($requestBody['orderDate']));

        $order->save();

        foreach ($requestBody['products'] as $product) {
            $orderDetail = new OrderDetail();

            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $product['productId'];
            $orderDetail->quantity = $product['quantity'];

            $orderDetail->save();
        }
    }

    /**
     * @param Request $request
     * @return void
     */
    public function update(Request $request): void
    {
        $requestBody = $request->get('data');

        $order = Order::find((int) $request->route('id'));

        if (is_null($order)) {
            throw new Exception('Invalid parameter');
        }

        $order->order_date = date('Y-m-d H:i:s',strtotime($requestBody['orderDate']));

        $order->update();
    }

    /**
     * @param Request $request
     * @return void
     */
    public function delete(Request $request): void
    {
        Order::where('id', (int) $request->route('id'))->delete();
    }
}
