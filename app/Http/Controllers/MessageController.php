<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Transaction};

class MessageController extends Controller
{
    public function index($transno, $str){
        switch ($str){
            case 'success':
                $trans = Transaction::where('trans_no',$transno)->first();
                if($trans){
                    return view('message.success',['transno' => $transno]);
                }else{
                    abort(404);
                }
                break;
            case 'error':
                break;
            case 'warning':
                break;
        }
    }
}
