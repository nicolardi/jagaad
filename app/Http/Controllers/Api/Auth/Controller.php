<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Middleware\Userid;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

/**
 * Extend this controller if the API is subjected to JWT authentication
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        if (!App::runningUnitTests()) {
            $this->middleware('auth:api', ['except' => ['login']]);
            // Inject user_id in the JSON request if it is not running tests
            $this->middleware(Userid::class);
        }
    }
}
