<?php

namespace App\Http\Controllers\app;
use Illuminate\Support\Facades\DB;
// use App\Model\Test;
use App\Model\Gloab;
use function GuzzleHttp\json_decode;

class index extends Base
{
    public function __construct ()
    {
        parent::__construct();
    }

    public function getCate() {
        $temp = DB::table('ads')->where('id', '<>', 0)->first();
        $courses = DB::table('courses')
                        ->join('teachers as t', 'courses.teacher_id', '=', 't.id')
                        ->select('courses.pic', 'courses.id', 'courses.title', 'courses.likes',
                         'courses.click',  't.name as teacher')
                        ->where('courses.sm', 0)
                        ->orderBy('click', 'desc')
                        ->get();
        $active = [];
        foreach (json_decode($temp->contents) as $k => $v) {
            $active[$k] = [
                'id' => $v->id,
                'img'=> config('app.cdn').$v->img_url,
                'index'=> $v->index,
                'urlKind'=> $v->urlKind
            ];
        };
        foreach ($courses as $k => $v) {
            $courses[$k]->pic = config('app.cdn').$v->pic;
        };
        $r = [
            'active'  => [],
            'ads'     => $active,
            'cate'    => DB::table('category')->select('id', 'name')->get(),
            'course'  => $courses,
            'dtime'   => $temp->dtime,
            'lottery' => 0
        ];
        return outJSON(1, $r, 'hello world user!', 10);
    }
}
