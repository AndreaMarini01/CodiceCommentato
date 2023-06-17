<?php
namespace App\Http\Controllers;

use App\Models\Promozione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class publicController extends Controller{


    public function home(){
        return view('home');
    }

    public function info(){
        return view('info');
    }

}
