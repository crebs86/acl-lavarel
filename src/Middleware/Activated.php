<?php

namespace Crebs86\Acl\Middleware;

use Crebs86\Acl\Controllers\ControlPanel\Setting;
use Closure;

class Activated
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
        $settings = new Setting();
        if ($settings->checkIfIsActive() == false && $settings->getDBSettings(['ac_account'])->cantDo()):
            return redirect($settings->getRedirectUrl())
                ->with($settings->msg());
        endif;

        return $next($request);
    }
}
