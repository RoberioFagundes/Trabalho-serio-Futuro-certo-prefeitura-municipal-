<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BloquearFeriado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $data = Carbon::parse($request->input('data'));

        if (Feriado::where('data', $data->format('Y-m-d'))->exists()) {
            return redirect()->back()->withErrors('Não é possível agendar em feriado.');
        }

        return $next($request);
    }
}
