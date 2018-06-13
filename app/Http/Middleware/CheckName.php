<?php

namespace App\Http\Middleware;

use App\Http\Requests\Request;
use Closure;

class CheckName {

    /**
     * @param         $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $reponse = $this->process($next($request));
        return $reponse;
    }

    /**
     * @param $param
     *
     * @return mixed
     */
    private function process($param) {
        return $param;
    }

}
