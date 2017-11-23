<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\DB;

class ElasticSearchController extends Controller {

    public function __construct() {
        $this->client = ClientBuilder::create()->build();
    }

//    public function elasticCreate() {
//        $msg_id = $timestamp = '';
//
//        $records = DB::collection('EbayNotifications')->where(array('NotificationEventName' => 'MyMessageseBayMessage'))->take(10)->get()->toArray();
////        echo '<pre>';
////        print_r($records);die;
//
//        foreach ($records as $val) {
//
//            $params['body'][] = [
//                'index' => [
//                    '_index' => 'data_search',
//                    '_type' => 'data'
//                ],
//            ];
//
////            
////            unset($val['RawData']['Messages']['Message']['Text']);
////            unset($val['RawData']['Messages']['Message']['Content']);
//            $params['body'][] = [
//                'NotificationEventName' => $val['NotificationEventName'],
//                'RecipientUserID' => $val['RecipientUserID'],
//                'Messages' => $val['RawData']['Messages']['Message']
//            ];
//            $msg_id = $val['_id'];
//            $timestamp = $val['Timestamp'];
//        }
////        echo $msg_id.'</br>';die; 
////        echo $timestamp;die;
//        //record the last record message ID stored
//
//        $insert = DB::collection('last_message_ids')->insert(array('msg_id' => $msg_id, 'timestamp' => $timestamp));
//
////        echo '<pre>';
////        print_r(json_encode($params));
////        die;
//        $response = $this->client->bulk($params);
//        echo '<pre>';
//        print_r(json_encode($response));
//        die;
//    }

    public function elasticSearch() {
        $client = ClientBuilder::create()->build();

        $params = [
            'index' => 'data_search',
            'type' => 'data',
            'body' => [
                'query' => [
//                    'wildcard' => ['dept_name' => 'c*s']
//                    'regexp' => ['sender' => 'gevor.*']
                    'wildcard' => ['Messages.ExternalMessageID' => strtolower('1624275843015')]
//                    'nested' => ['path' => 'Messages', 'query' => [
//                            'wildcard' => ['Messages.Sender' =>['value'=>'gevor*']]
//                        ]
//                    ],
                ]
            ]
        ];
//        echo '<pre>';
//        print_r(json_encode($params));die;
//        $response = $client->search($params);
        $response = $client->search($params);
        echo '<pre>';
        print_r($response);
        die;
    }

    public function deleteDocument() {
        $params = [
            'index' => 'data_search',
            'type' => 'data',
//            'id' => 'my_id'
            'body' => [
                'query' => [
                    'match_all' => (object) []
                ]
            ]
        ];

        // Delete doc at /my_index/my_type/my_id
        $response = $this->client->deleteByQuery($params);
        echo '<pre>';
        print_r($response);
        die;
    }

    public function elasticSearchAll() {
        $client = ClientBuilder::create()->build();

        $params = [
            'index' => 'data_search',
            'type' => 'data',
            'body' => [
                'query' => [
                    'match_all' => (object) []
                ]
            ]
        ];
//        $response = $client->search($params);
        $response = $client->search($params);
        echo '<pre>';
//        print_r(json_encode($response));
        print_r($response);
        die;
    }

}
