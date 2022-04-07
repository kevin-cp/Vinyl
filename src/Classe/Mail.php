<?php 

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail {

    private $api_key = '285c42c977d6a06b0cd076f51f4b8f85';
    private $api_key_secret = '4aa6eabebaff66cdb4e3d0168655200c';

    public function send($to_email, $to_name, $subject, $content){

        $mj = new Client($this->api_key, $this->api_key_secret, true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "mariebouvard@outlook.com",
                        'Name' => "Vinyl"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'Subject' => $subject,
                    'TemplateID' => 3335662,
                    'TemplateLanguage' => true,
                    "Variables" => [
                        "content" => "$content"
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }

}