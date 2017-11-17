<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use App\Inbox;
use App\FilterKeywords;
use App\FilterGroups;
use App\FilterGroupKeywords;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use FunctionHelper;
use Illuminate\Support\Facades\DB;
use PhpImap\Mailbox;

class RestController extends Controller {

    public function __construct() {
        $this->data = Request::json()->all();

//        $this->action_table_arr = array(
//            'add_filter_keyword' => 'FilterKeywords'
//        );
//        
//        $this->action_rule_arr = array(
//            'add_filter_keyword' => array('keyword.required')
//        );
    }

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
            'imap_ssl' => 'required|numeric',
            'imap_port' => 'required|numeric',
            'smtp_server' => 'required',
            'smtp_ssl' => 'required|numeric',
            'smtp_tls' => 'required|numeric',
            'smtp_auth' => 'required|numeric',
            'smtp_port_ssl' => 'required|numeric',
            'smtp_port_tls' => 'required|numeric',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'user_id' => 'required',
        ];

//        $validator = Validator::make(Input::all(), $rules, $messages);
        $validator = Validator::make($data, $rules, $messages);
        $error = array();
        if ($validator->fails()) {
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
        if (!empty($records->count() > 0)) {
            return response()->json(array('success' => true, 'data' => $records), 200);
        } else {
            return response()->json(array('success' => false, 'message' => 'Record not found'), 400);
        }
    }

    public function view($ID = '') {
        $rec = Inbox::where(array('_id' => $ID))->get();
        return response()->json(array('success' => true, 'data' => $rec), 200);
    }

    public function get_rule_view($view = '') {
        //        $html = view('partial._subject_options', compact('stats'))->render();
        $html = view('partial.' . $view)->render();
        return response()->json(array('success' => true, 'html' => $html), 200);
    }

    public function keyword() {
//        print_r(FunctionHelper::get_rec('filter_keywords',array('matching_field'=>'keyword','value'=>'test1')));
//        die;

        $message = '';

        //validation
        $rules = [
            'action' => 'required'
        ];
        $messages = [
            'action.required' => 'Action variable missing.',
        ];

        if ($this->data['action'] == 'add') {
            $rules['keyword'] = 'required|unique:filter_keywords';
            $rules['search_in'] = 'required';

            $messages['keyword.required'] = 'Please Enter keyword';
            $messages['search_in.required'] = 'Please choose Search In option.';
        }

        $status = 0;
        $validator = Validator::make($this->data, $rules, $messages);
        $error = array();
        if ($validator->fails()) {
            $error = $validator->getMessageBag()->toArray();
            return response()->json(array('success' => false, 'message' => $error), 200);
        } else {
            if ($this->data['action'] == 'add' || $this->data['action'] == 'update') {
                
                    $post[] = array(
                        'keyword' => $this->data['keyword'],
                        'search_in' => implode(',', $this->data['search_in']),
                    );
//                    print_r($post);die;
                    
//                foreach ($this->data['search_in'] as $val) {
//                    $post[] = array(
//                        'keyword' => $this->data['keyword'],
//                        'search_in' => strtoupper($val),
//                    );
//                }
            }

            switch (strtolower($this->data['action'])) {
                case 'add':
//                    $status = FilterKeywords::insert($post);
                    $message = "Keyword Added";
                    break;
                case 'update':
                    $status = FilterKeywords::where(array('keyword' => $this->data['keyword']))->delete();
                    $message = "Keyword Updated";
                    break;
                case 'list':
                    $list = FilterKeywords::all();
                    return response()->json(array('success' => true, 'data' => $list), 200);
                    break;
                case 'delete':
                    //check the keyword exit or not
                    if (FunctionHelper::get_rec('filter_keywords', array('matching_field' => 'keyword', 'value' => $this->data['keyword']))->count() == 0) {
                        return response()->json(array('success' => false, 'message' => 'Keyword not exist'), 200);
                    } else {

                        $status = FilterKeywords::where(array('keyword' => $this->data['keyword']))->delete();
                        $message = "Keyword Deleted";
                        return response()->json(array('success' => true, 'message' => $message), 200);
                    }
                    break;
            }

            //insert record
            $status = FilterKeywords::insert($post);
            if ($status) {
                return response()->json(array('success' => true, 'message' => $message), 200);
            } else {
                return response()->json(array('Something went wrong plese try again!'), 400);
            }
        }
    }

    public function keyword_group() {
//        print_r(FunctionHelper::get_rec('filter_keywords',array('matching_field'=>'keyword','value'=>'test1')));
//        die;

        $message = '';

        //validation
        $rules = [
            'action' => 'required'
        ];
        $messages = [
            'action.required' => 'Action variable missing.',
        ];

        if ($this->data['action'] == 'add') {
            $rules['name'] = 'required|unique:filter_groups';
            $rules['keyword'] = 'required';

            $messages['name.required'] = 'Please Enter name.';
            $messages['keyword.required'] = 'Please Select Keywords';
        }
        if ($this->data['action'] == 'update' || $this->data['action'] == 'delete') {
            $rules['group_id'] = 'required';
            $messages['group_id.required'] = 'Please Select Group.';
        }



        $status = 0;
        $validator = Validator::make($this->data, $rules, $messages);
        $error = array();
        if ($validator->fails()) {
            $error = $validator->getMessageBag()->toArray();
            return response()->json(array('success' => false, 'message' => $error), 200);
        } else {
            if (strtolower($this->data['action']) == 'add' || strtolower($this->data['action']) == 'update') {
                $post['name'] = $this->data['name'];
            }
//            DB::beginTransaction();
            try {
                switch (strtolower($this->data['action'])) {
                    case 'add':
//                    $status = FilterKeywords::insert($post);
                        $message = "Group Created";
                        break;
                    case 'update':
                        //delete keywords
                        if (FunctionHelper::get_rec('filter_groups', array('matching_field' => '_id', 'value' => $this->data['group_id']))->count() == 0) {
                            return response()->json(array('success' => false, 'message' => 'Group not exist'), 200);
                        } else {
                            $deleteGroup_key = FilterGroupKeywords::where(array('group_id' => $this->data['group_id']))->delete();
                            $deleteGroup = FilterGroups::where(array('_id' => $this->data['group_id']))->delete();

                            $message = "Group Updated";
                        }
                        break;
                    case 'list':

                        $list = FilterGroups::raw(function($collection) {
                                    return $collection->aggregate(
                                                    [
                                                            [
                                                            '$lookup' => [
                                                                'as' => 'keywords',
                                                                'from' => 'filter_group_keywords',
                                                                'foreignField' => 'group_id',
                                                                'localField' => '_id'
                                                            ]
                                                        ]
                                                    ]
                                    );
                                });


                        return response()->json(array('success' => true, 'data' => $list), 200);
                        break;
                    case 'delete':

                        if (FunctionHelper::get_rec('filter_groups', array('matching_field' => '_id', 'value' => $this->data['group_id']))->count() == 0) {
                            return response()->json(array('success' => false, 'message' => 'Group not exist'), 200);
                        } else {
                            //delete keywords
                            $deleteGroup_key = FilterGroupKeywords::where(array('group_id' => $this->data['group_id']))->delete();
                            $deleteGroup = FilterGroups::where(array('_id' => $this->data['group_id']))->delete();

                            if ($deleteGroup) {
                                $message = "Group Deleted";
                                return response()->json(array('success' => true, 'message' => $message), 200);
                            } else {
                                return response()->json(array('Something went wrong plese try again!'), 400);
                            }
                        }
                        break;
                }

                //insert record
                $status = FilterGroups::insertGetId($post);
                if ($status) {

                    //insert the group keywords

                    foreach ($this->data['keyword'] as $key) {
                        $post_array[] = [
                            'group_id' => $status,
                            'keyword_id' => $key,
                            'created_at' => date('Y-m-d H:i:s'),
                        ];
                    }

                    $insert_status = FilterGroupKeywords::insert($post_array);

                    if ($insert_status) {

                        //commit the transaction if all fine
//                        DB::commit();

                        return response()->json(array('success' => true, 'message' => $message), 200);
                    } else {
                        return response()->json(array('Something went wrong plese try again!'), 400);

                        //Rollback the transactions if fail 
//                        DB::rollback();
                    }
                } else {
                    return response()->json(array('Something went wrong plese try again!'), 400);
                    //Rollback the transactions if fail
//                    DB::rollback();
                }
            } catch (Exception $e) {
                //failed logic here
//                DB::rollback();
                throw $e;
            }
        }
    }

    public function search_emails() {
//        print_r($this->data);
//        die;
        // 4. argument is the directory into which attachments are to be saved:




        $rules = [
            'filter_email' => 'required',
        ];
        $messages = [
            'filter_email.required' => 'Please Select Email Account',
        ];

//        $validator = Validator::make(Input::all(), $rules, $messages);
        $validator = Validator::make($this->data, $rules, $messages);
        $error = array();
        if ($validator->fails()) {
            $error = $validator->getMessageBag()->toArray();

//            return response()->json(array('success' => false, 'message' => json_decode($error)), 200);
            return response()->json(array('success' => false, 'message' => $error), 200);
        } else {
            $search_criteria = '';
            //creating the criteria
//        if(isset($this->data['']))
            //get the email details

            $account = Inbox::where(array('_id' => $this->data['filter_email']))->first();
            if ($account->count() == 0) {
                return response()->json(array('success' => false, 'message' => 'Email account not found'), 404);
            } else {
                $mailbox = $this->ImapInit($account->imap_server, $account->imap_port, ($account->imap_ssl == 1) ? 'ssl' : '', $account->email, decrypt($account->password));

                //created search criteria for filters

                if (!empty($this->data['filter_keyword'])) {
                    $keyword = FilterKeywords::where(array('_id' => $this->data['filter_keyword']))->first();
                    $explode = explode(',', $keyword->search_in);
                    $suffixed_array = preg_filter('/$/', ' "'.$keyword->keyword.'"', $explode);
                    
                    $search_criteria = implode(' ', $suffixed_array);
                    
                }
                
                //created search criteria for filter group

//                if (!empty($this->data['filter_group'])) {
//                    $keyword = FilterGroups::where(array('_id' => $this->data['filter_group']))->first();
//                    $explode = explode(',', $keyword->search_in);
//                    $suffixed_array = preg_filter('/$/', ' "'.$keyword->keyword.'"', $explode);
//                    
//                    $search_criteria = implode(' ', $suffixed_array);
//                    
//                }

                // Read all messaged into an array:
//                $mailsIds = $mailbox->searchMailbox('FROM "support@team.mailparser.io"');
                $mailsIds = $mailbox->searchMailbox($search_criteria);
                if (!$mailsIds) {
                    return response()->json(array('success' => false, 'message' => 'Mailbox is empty'), 404);
                } else {
                    // Get the first message and save its attachment(s) to disk:
                    $mail[] = $mailbox->getMail($mailsIds[0]);

                    return response()->json(array('success' => true, 'data' => $mail), 200);

                    echo "\n\nAttachments:\n";
                    print_r($mail->getAttachments());
                }
            }
        }
    }

    public function ImapInit($host, $port, $encr = 'ssl', $username, $password) {
        $mailbox = new Mailbox('{' . $host . ':' . $port . '/imap/' . $encr . '}INBOX', $username, $password, __DIR__);
        return $mailbox;
    }

}
