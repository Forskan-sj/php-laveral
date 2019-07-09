<?php

namespace App\Http\Controllers\app;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use App\Model\Test;
use App\Model\Gloab;
class User extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getInfo() {
        //echo json_encode(['211']);
        $r = [
            'data1'=> 'sdf',
            'data2' => [1,2,1,3],
            'data3'=> ['data1' => 'test', 'data2'=>false]
        ];
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
