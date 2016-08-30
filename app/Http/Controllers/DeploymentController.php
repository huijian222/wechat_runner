<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DeploymentController extends Controller
{
    public function hook(){
        $token = 'justatest';
        $cmd = "  cd /var/www/test &&git pull &&echo 123";
        $json = json_decode(file_get_contents('php://input') , true);
/*        if(empty($json['token']) || $json['token'] !== $token){
            exit('error request');
        }*/
        shell_exec($cmd);
    }
}
