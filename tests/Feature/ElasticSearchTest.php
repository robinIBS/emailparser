<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Log;

class ElasticSearchTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSearch() {

        $client = ClientBuilder::create()->build();
        echo 'in';
        $wild_card[] = [
            'wildcard' => [
                'Messages.Sender' => [
                    'value' => strtolower('ebay')
                ]
            ],
        ];


        $params = [
            'index' => 'data_search',
            'type' => 'data',
            'body' => [
                'query' => [
//                    'wildcard' => $wild_card
                    'bool' => [
                        'must' => [
                            $wild_card
                        ]
                    ]
                ]
            ]
        ];
        $response = $client->search($params);
        echo '<pre>';
        print_r($response);
        die;
    }

}
