<?php

namespace Laramin\Utility;

use Closure;

class UtilityMiddleware{

    public function handle($request, Closure $next)
    {
        if (!Helpmate::sysPass()) {
            return redirect()->route(VugiChugi::acRouter());
        }
        return $next($request);
    }
}
