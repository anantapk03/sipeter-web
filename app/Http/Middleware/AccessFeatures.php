<?php

namespace App\Http\Middleware;

use App\Models\AccessFeature;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessFeatures
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $access): Response
    {
        $userId = $request->user()->id;
        $userAccessFeatures = AccessFeature::where('idUser', $userId)
        ->with('divisi')
        ->get()
        ->pluck('divisi.namaDivisi')
        ->toArray();

        if(array_intersect($userAccessFeatures, $access)){
            return $next($request);
        }

        return redirect()->back()->with('error','Permission Denied');

    }
}
