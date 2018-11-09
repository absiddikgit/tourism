<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin\Package\Package;

class PackageDeactive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $packages = Package::where('status',1)->get();
        $now = date_create(date('Y-m-d'));
        if ($packages->count()) {
            foreach ($packages as $p) {
                $p_deadline = date_create($p->booking_deadline);
                if (date_diff($now,$p_deadline)->format('%R%a')<0) {
                    $p->status = 0;
                    $p->save();
                }
            }
        }
        return $next($request);
    }
}
