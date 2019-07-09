<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Model\Test;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function test() {
        //echo json_encode(['211']);
        $r = [
            'data1'=> 'sdf',
            'data2' => [1,2,1,3],
            'data3'=> ['data1' => 'test', 'data2'=>false]
        ];
        return outJSON(1, $r, 'hello world!', 10);
    }

    public function test2() {
        // $test = new Test();
        // $r = $test->where('id', '<>', 0)->get();
        // $r = $test->
		// echo '<pre>';
		// var_dump($r);
		// dd($r);
        // +
        $temp = [
            'username' => 'ceshi12',
            'nickname' => '陈怀兴4',
            'password' => 'nicai',
            'status' => 0
        ];
        $test = DB::table('admin');
        // $r = $test->where('username', $temp['username'])->first();
        // $r = $test->where('username', $temp['username'])->first();
        $r = $test->pluck('username', 'nickname');
        dd($r);
        // dd($r->id);
        // if ($r) {
        //     $r = $test->updateData(['id'=>$r['id']], $temp);
        // } else {
        //     $test->storeData($temp);
        // }
        // - destroyData(软删除)
        // $test->forceDeleteData(['id'=>2]); // 强制彻底删除
        // 改
        // $r = $test->updateData(['id'=>1],['ceshi1'=>11111111111, 'cs2'=>'错了错了']);
        return outJSON(1, $r, 'hello world!', 10);
    }
}
