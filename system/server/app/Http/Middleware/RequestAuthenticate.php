<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\AccessToken;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RequestAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse|JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $requestedToken = $request->header('Authorization');

        $sql = <<<SQL
SELECT
    b.token,
    b.expired_at,
    r.id as role_id
FROM
    user_authentications a 
        left join access_tokens b ON a.user_id = b.user_id
        left join roles r ON r.id = a.role_id
WHERE
    b.token = ?;
SQL;
        $userToken = \DB::selectOne($sql, [$requestedToken]);

        if (empty($userToken) || $userToken->expired_at < date('Y-m-d H:i:s')) {
            return new JsonResponse([
                'message' => 'Unauthenticated',
            ], 401);
        }

        $request->merge([
            'role_id' => $userToken->role_id,
        ]);

        return $next($request);
    }
}
