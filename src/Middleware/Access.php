<?php

namespace Crebs86\Acl\Middleware;

use Crebs86\Acl\Controllers\ControlPanel\Setting;
use Closure;

class Access
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
        if($settings->checkIfIsVerified() == false && $settings->getDBSettings(['validate_mail'])->cantDo()):
            return redirect(url($settings->getRedirectUrl()))
                ->with($settings->msg(['error'=>__('crebs::cp-messages.no_have_access')]));
        endif;
        return $next($request);
    }
}
