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

//    public function add_user() {
////        $user = User::all();
//
//        if (Request::isMethod('post')) {
//            $name = Input::get('name');
//            $email = Input::get('email');
//            $phone = Input::get('phone');
//
//            if (User::insert(array('name' => $name, 'email' => $email, 'phone' => $phone))) {
//
//                return redirect('list_users');
//            } else {
//                echo 'error';
//            }
//        }
//        return view('add_user', array());
//    }
//
//    public function list_users() {
//        $user_list = User::all();
//
//        return view('list_users', array('users' => $user_list));
//    }
//
//    public function edit_user($id = '') {
//        $user = User::find($id);
//
//        return view('edit_user', ['user' => $user]);
//    }
//
//    public function update_user() {
//        $name = Input::get('name');
//        $email = Input::get('email');
//        $phone = Input::get('phone');
//        $id = Input::get('id');
//        $user = User::find($id);
//
//        $user->name = $name;
//        $user->email = $email;
//        $user->phone = $phone;
//
//        if ($user->update()) {
//            return redirect('list_users');
//        } else {
//            return redirect('edit_user/' . $id);
//        }
//    }
//
//    public function delete_user($id) {
//        $user = User::find($id);
//
//        if (!empty($user)) {
//            $user->delete();
//        }
//        return redirect('list_users');
//    }
}
