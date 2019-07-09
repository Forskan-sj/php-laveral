<?php

function outJSON($status, $data, $message, $total) {
    // $r['status'] = $status;
    $r = ['status'=> $status, 'datas' => $data, 'message' => $message, 'total' => $total];
    return response()->json($r);
}
