<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $api_key = $request->api_key;
        $company = Company::where('api_key', $api_key)->first();
        if (!$company) {
            return response()->json([
                'message' => 'Invalid API key',
            ], 401);
        }
        return $next($request);
    }
}
