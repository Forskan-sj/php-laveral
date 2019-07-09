<?php

namespace App\Model;


class Gloab
{
    private $config;
    private function __construct ($config)
    {
        $this ->config = $config;
    }
    private function __clone ()
    {
    }

    static public function fotTest($str)
    {
        # code...
        return 'test for globl222222e'.$str;
    }
}
