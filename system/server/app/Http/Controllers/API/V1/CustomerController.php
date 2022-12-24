<?php
declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CustomerController
 * @package App\Http\Controllers\API\V1
 */
final class CustomerController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        $customers = Customer::all();

        $result = [];

        foreach ($customers as $customer) {
            $result[] = [
                'id' => $customer['id'],
                'name' => $customer['name'],
                'gender' => $customer['gender'],
                'address' => $customer['address'],
                'phoneNumber' => $customer['phone_number'],
            ];
        }

        return new JsonResponse( [
            'data' => $result,
        ]);
    }

    public function get(Request $request): JsonResponse
    {

    }
}
