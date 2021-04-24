<?php

namespace App\Console;

use App\Console\Commands\SendEmail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\ContactInfo;
use App\EmailAlert;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Snowfire\Beautymail\Beautymail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        SendEmail::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        // $schedule->command("send:email")->timezone('Africa/Kampala')->withoutOverlapping()->everyFiveMinutes();

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

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
