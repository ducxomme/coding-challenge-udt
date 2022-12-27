<?php
declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use App\Models\UserAuthentication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class LoginController
 * @package App\Http\Controllers\API\V1
 */
final class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $requestBody = $request->get('data');

        $user = UserAuthentication::where('user_id', '=', (int)$requestBody['userId'])->first();

        if (empty($user) || base64_encode($requestBody['password']) !== $user->password) {
            return new JsonResponse([
                'data' => 'Login failed',
            ], 400);
        }

        $userToken = AccessToken::where('user_id', '=', $user->user_id)->first();
        if (empty($userToken)) {
            $userToken = new AccessToken;
            $userToken->user_id = $user->user_id;
            $userToken->token = md5(uniqid((string)$user->user_id, true));
            $userToken->expired_at = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . "+4hours"));

            $userToken->save();
        } else {
            if ($userToken->expired_at < date('Y-m-d H:i:s')) {
                $userToken->token = md5(uniqid((string)$user->user_id, true));
                $userToken->expired_at = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . "+4hours"));
                $userToken = $userToken->save();
            }
        }

        return new JsonResponse([
            'data' => [
                'token' => $userToken->token,
            ],
        ]);
    }
}
