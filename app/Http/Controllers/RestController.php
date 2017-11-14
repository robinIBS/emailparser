<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use App\Inbox;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class RestController extends Controller {

    /**
     * Function for creating inbox
     */
    public function add_inbox() {
        

        $data = Request::json()->all();
//        echo '<pre>';
//        print_r($data);die;
//        echo json_encode($insert);die;

        $messages = array(
            'imap_server.required' => 'Please Enter the IMAP Server',
            'imap_ssl.required' => 'Please choose IMAP SSL preference.',
            'imap_port.required' => 'Please Enter IMAP Port.',
            'smtp_server.required' => 'Please Enter SMTP Server.',
            'smtp_ssl.required' => 'Please Choose SMTP SSL preference.',
            'smtp_tls.required' => 'Please Choose SMTP TLS preference.',
            'smtp_auth.required' => 'Please Choose SMTP authentication preference.',
            'smtp_port_ssl.required' => 'Please Enter SMTP SSL Port.',
            'smtp_port_tls.required' => 'Please Enter SMTP TLS Port',
            'email.required' => 'Please Enter Email',
            'name.required' => 'Please Enter Name',
            'password.required' => 'Please Enter Password',
            'user_id.required' => 'User ID is mandatory',
        );
        $rules = [
            'imap_server' => 'required',
            'imap_ssl' => 'required',
            'imap_port' => 'required',
            'smtp_server' => 'required',
            'smtp_ssl' => 'required',
            'smtp_tls' => 'required',
            'smtp_auth' => 'required',
            'smtp_port_ssl' => 'required',
            'smtp_port_tls' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'user_id' => 'required',
        ];

//        $validator = Validator::make(Input::all(), $rules, $messages);
        $validator = Validator::make($data, $rules, $messages);
        $error = array();
        if ($validator->fails()) {
            
//            echo '<pre>';print_r($validator->messages()->getMessages());die;
//            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
//
//                foreach ($messages AS $message) {
//                    $error[] = array($field_name => $message);
//                }
//            }

//            $error = $validator->errors();
            $error = $validator->getMessageBag()->toArray();

//            return response()->json(array('success' => false, 'message' => json_decode($error)), 200);
            return response()->json(array('success' => false, 'message' => $error), 200);
        } else {

            $insert = array(
                'imap_server' => $data['imap_server'],
                'imap_ssl' => $data['imap_ssl'],
                'imap_port' => $data['imap_port'],
                'smtp_server' => $data['smtp_server'],
                'smtp_ssl' => $data['smtp_ssl'],
                'smtp_tls' => $data['smtp_tls'],
                'smtp_auth' => $data['smtp_auth'],
                'smtp_port_ssl' => $data['smtp_port_ssl'],
                'smtp_port_tls' => $data['smtp_port_tls'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => encrypt($data['password']),
                'user_id' => $data['user_id'],
            );

            if (Inbox::insert($insert)) {
                return response()->json(array('success' => true, 'message' => 'Inbox created'), 200);
            } else {
                return response()->json(array('Something went wrong plese try again!'), 400);
            }
        }
    }

    public function list_inbox($user_id = '') {
        $records = Inbox::where(array('user_id' => $user_id))->get();
        if (!empty($records->count()>0)) {
            return response()->json(array('success' => true, 'data' => $records), 200);
        } else {
            return response()->json(array('success' => false, 'message' => 'Record not found'), 400);
        }
    }

}
