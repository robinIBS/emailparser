<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;

class EmailParserController extends Controller {

    public function create_inbox() {
        return view('inbox.create_inbox', []);
    }

    public function list_inbox() {
        return view('inbox.list_inbox', []);
    }

    public function view() {
        return view('inbox.view', ['id' => Input::get('i')]);
    }

    public function add_filter() {
        return view('parsing.add_filter', ['id' => Input::get('i')]);
    }
    public function add_filter_group() {
        return view('parsing.add_filter_group', ['id' => Input::get('i')]);
    }
    public function emails() {
        return view('parsing.emails', []);
    }
    public function notifications() {
        return view('parsing.notifications', []);
    }


}
