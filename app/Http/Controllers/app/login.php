<?php

namespace App\Http\Controllers\app;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

use App\Model\Test;
class login extends BaseController
// class login extends Base
{
    // private function __construct ()
    // {
    //     parent::__construct ();
    // }

    public function checkUser() {
        // var_dump($requst->input('needID'));
        // $p = input('post');
        // dd($p);
        $test = DB::table('users');
        $r = $test->where('needID', request('needID'))->first();
        $r->token = 'asdfasdfasdfasdfaf';
        Cache::put($r->token, $r, 100000);
        // var_dump(Cache::get('token'));
        // $r = $test->where('needID', $requst->input('needID'))->first();
        return outJSON(1, $r, 'hello world user!', 10);
    }

    private function ss() {
        return Gloab::fotTest('abdcsdfjsd');
    }

    public function setInfo() {

        $aaa = $this->ss();
        var_dump($aaa);
        // $test = new Test();
        // $r = $test->where('id', '<>', 0)->get();
        // // $r = $test->
		// echo '<pre>';
		// var_dump($r);
		// dd($r);
        // // +
        // // $test->storeData(['ceshi1'=>222222222222222, 'cs2'=>'牛掰']);
        // // - destroyData(软删除)
        // $test->forceDeleteData(['id'=>2]); // 强制彻底删除
        // // 改
        // // $r = $test->updateData(['id'=>1],['ceshi1'=>11111111111, 'cs2'=>'错了错了']);
        // return outJSON(1, null, 'hello world!', 10);
    }
}
