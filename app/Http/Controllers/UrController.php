<?php

namespace App\Http\Controllers;

use \Input;
use \Validator;
use \Session;
use \DB;
use \Response;

class UrController extends Controller
{

    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * 受測者-首頁
     *
     *
     */
    public function Index()
    {
        $data = array();

        return view('user.index', $data);
    }

}
