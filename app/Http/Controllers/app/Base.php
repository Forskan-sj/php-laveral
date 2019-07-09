<?php

namespace App\Http\Controllers\app;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
// use App\Model\Test;
use App\Model\Gloab;
class Base extends Controller
{
    public $token, $user, $user_id;
    protected function __construct ()
    {
        $request = \request();
        $this->token = $request->header('X-Token');
        $this->user = Cache::get($this->token);
        // $this->user_id = $this->user->id;
    }
}
