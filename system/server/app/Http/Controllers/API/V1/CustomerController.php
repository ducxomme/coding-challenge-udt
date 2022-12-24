<?php
declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function get(Request $request): JsonResponse
    {
        $customer = Customer::find((int) $request->route('id'));

        $result = [];

        if (!is_null($customer)) {
            $result = [
                'id' => $customer->id,
                'name' => $customer->name,
                'gender' => $customer->gender,
                'address' => $customer->address,
                'phoneNumber' => $customer->phone_number,
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
            "gender": 1, // 1: Male, 2: Female, 0: Other
            "address": "Address",
            "phoneNumber": "0989999888"
          }
        }
        */
        $requestBody = $request->get('data');

        $customer = new Customer;
        $customer->name = $requestBody['name'];
        $customer->gender = $requestBody['gender'];
        $customer->address = $requestBody['address'];
        $customer->phone_number = $requestBody['phoneNumber'];

        $customer->save();
    }

    /**
     * @param Request $request
     * @return void
     */
    public function update(Request $request): void
    {
        $requestBody = $request->get('data');

        $customer = Customer::find((int) $request->route('id'));

        if (is_null($customer)) {
            throw new Exception('Invalid parameter');
        }

        $customer->name = $requestBody['name'];
        $customer->gender = $requestBody['gender'];
        $customer->address = $requestBody['address'];
        $customer->phone_number = $requestBody['phoneNumber'];

        $customer->update();
    }

    /**
     * @param Request $request
     * @return void
     */
    public function delete(Request $request): void
    {
        Customer::where('id', (int) $request->route('id'))->delete();
    }
}
