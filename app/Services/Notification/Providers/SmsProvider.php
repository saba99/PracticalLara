<?php  


namespace App\Services\Notification\Providers;

use App\Services\Notification\Exception\UserDoesNotHavePhoneNumber;
use App\User;
use GuzzleHttp\Client;
//use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

use App\Services\Notification\Providers\Contracts\Provider;

class SmsProvider implements Provider{


    private $user;

    private $text;


    // public function send(User $user, String $text)
    // {



    //     $client = new Client();

    //     $data =

    //         // 'op'=>'send',
    //         // 'message'->$text,
    //         // 'to'=>[$user->phone_number],
    //         // config('services.sms.auth')
    //         array_merge(config('services.sms.auth'), [

    //             'op' => 'send',
    //             'message' => $text,
    //             'to' => [$user->phone_number],

    //         ]);


    //     //dd($data);
    //     //    $option=[

    //     //     'json'=>$data
    //     //    ];

    //     $response = $client->post(config('services.sms.uri'), $this->prepareDataForSms($user, $text));

    //     echo $response->getBody();
    // }

    // private function prepareDataForSms(User $user, String $text)
    // {

    //     $data =

    //         array_merge(config('services.sms.auth'), [

    //             'op' => 'send',
    //             'message' => $text,
    //             'to' => [$user->phone_number],

    //         ]);


    //     //dd($data);
    //     return  [

    //         'json' => $data
    //     ];
    // }
    public function __construct(User $user,String $text)
    {
         
        $this->user=$user;

        $this->text=$text;

    }

    public function send()
    {

     $this->havePhoneNumber();

        $client = new Client();

        $data =

            // 'op'=>'send',
            // 'message'->$text,
            // 'to'=>[$user->phone_number],
            // config('services.sms.auth')
            array_merge(config('services.sms.auth'), [

                'op' => 'send',
                'message' => $this->text,
                'to' => [$this->user->phone_number],

            ]);


        //dd($data);
        //    $option=[

        //     'json'=>$data
        //    ];

        $response = $client->post(config('services.sms.uri'), $this->prepareDataForSms($this->user, $this->text));

        echo $response->getBody();
    }

    private function prepareDataForSms()
    {

        $data =

            array_merge(config('services.sms.auth'), [

                'op' => 'send',
                'message' => $this->text,
                'to' => [$this->user->phone_number],

            ]);


      //dd($data);
        return  [

            'json' => $data
        ];
    }

    private function havePhoneNumber(){

        if (is_null($this->user->phone_number)) {


            // throw new \Exception("user does not have phone number");

            throw new UserDoesNotHavePhoneNumber("user does not have phone number");
        }

    }
}