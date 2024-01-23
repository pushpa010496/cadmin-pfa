<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Company extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comapny:period';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = ' Send mail Expired company list to ompl';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         $data = [
            'name'=>'nagraj',
            'email'=>'nagaraj@ochre-media.com'
            
            ];
        /*Admin mail*/
        Mail::send('emails.client', $data, function($message) use ($data) {
        $message->to('nagaraj@ochre-media.com');
        //$message->to('venkatasiva@ochre-media.com');
        // $message->cc(['naveen@ochre-media.com','sumit@ochre-media.com']);
        $message->subject($data['email'].'| Scheduling test');
        });
         $this->info('Mail has been send successfully');
 
    }
}
