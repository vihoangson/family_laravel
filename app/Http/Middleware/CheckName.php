<?php

namespace App\Http\Middleware;

use App\Http\Requests\Request;
use Closure;

class CheckName {

    public function handle($request, Closure $next) {

        $reponse = $this->process($next($request));

        /** @var Request $request */
        var_dump($request->server());
        var_dump($request->header());
        die;

        return $reponse;
    }

    private function process($param) {

        return $param;
    }

}
