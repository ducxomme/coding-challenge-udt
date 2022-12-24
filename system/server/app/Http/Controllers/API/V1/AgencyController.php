<?php
declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

final class AgencyController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        $agencies = Agency::all();

        $result = [];

        foreach ($agencies as $agency) {
            $result[] = [
                'id' => $agency['id'],
                'name' => $agency['name'],
                'address' => $agency['address'],
                'phoneNumber' => $agency['phone_number'],
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
        $agency = Agency::find((int) $request->route('id'));

        $result = [];

        if (!is_null($agency)) {
            $result = [
                'id' => $agency->id,
                'name' => $agency->name,
                'address' => $agency->address,
                'phoneNumber' => $agency->phone_number,
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
            "address": "Address",
            "phoneNumber": "0989999888"
          }
        }
        */
        $requestBody = $request->get('data');

        $agency = new Agency();
        $agency->name = $requestBody['name'];
        $agency->address = $requestBody['address'];
        $agency->phone_number = $requestBody['phoneNumber'];

        $agency->save();
    }

    /**
     * @param Request $request
     * @return void
     */
    public function update(Request $request): void
    {
        $requestBody = $request->get('data');

        $agency = Agency::find((int) $request->route('id'));

        if (is_null($agency)) {
            throw new Exception('Invalid parameter');
        }

        $agency->name = $requestBody['name'];
        $agency->address = $requestBody['address'];
        $agency->phone_number = $requestBody['phoneNumber'];

        $agency->update();
    }

    /**
     * @param Request $request
     * @return void
     */
    public function delete(Request $request): void
    {
        Agency::where('id', (int) $request->route('id'))->delete();
    }
}
