<?php

namespace App\Console\Commands;

use App\ContactInfo;
use App\EmailAlert;
use App\User;
use Illuminate\Console\Command;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use Snowfire\Beautymail\Beautymail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $lastEmail = EmailAlert::orderBy('created_at','desc')->first();
        if ($lastEmail == null) {
            $lastEmailSent = "1900-03-09 12:15:00";
        }else{
            $lastEmailSent = $lastEmail->created_at;
        }
        $contactInfo = ContactInfo::where('created_at','>',$lastEmailSent)->get();
        if ($contactInfo->count()==0) {
            exit();
        }
        $data =[
            'contactInfo'=>$contactInfo,
            'heading'=> "New Registered Clients"
        ];
        $pdf = PDF::loadView('includes.pdf', $data);
        $fileName = 'CustomersReport_'.time().'.pdf';
        $pdf->save(public_path('img/'.$fileName));

        $users = User::all();
        foreach ($users as $key => $user) {
            $data = [
                'admin'=>$user->name,
                'email'=>$user->email,
                'count'=>$contactInfo->count()
            ];
            $beautymail = app()->make(Beautymail::class);
            $beautymail->send('emails.mail', $data, function($message) use($user,$fileName)
            {
                $message
                    ->from('nonreply@jubileeapp.com')
                    ->to($user->email, $user->name)
                    ->subject('New Customers Update')
                    ->attach(public_path("img/".$fileName), [
                        'as' => 'NewCustomers.pdf',
                        'mime' => 'application/pdf',
                   ]);
                    
                    
            });    
        }
        EmailAlert::create([
            'fileName'=>$fileName
        ]);
    }
}



