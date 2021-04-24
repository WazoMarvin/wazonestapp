<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\ContactInfo;
use App\EmailAlert;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Snowfire\Beautymail\Beautymail;


Route::group(['middleware' => 'mylogs'],function () {

Route::get('/', function () {
    return view('contact_form');
});
Route::get('/admin', function () {
    return redirect('/login');
});
Route::group(['middleware' => 'auth'],function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/boots-watch','HomeController@bootsWatch');
    Route::get('/users','UserController@index');
    Route::post('/store-user','UserController@storeUser')->name('store-user');
    Route::get('/download-pdf','HomeController@download');
});
Auth::routes();
Route::get('/about/marvin','HomeController@about')->name('about-marvin');
Route::post('/save-contact','HomeController@saveContact');

});



Route::get('/test-sending',function(){
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
        // EmailAlert::create([
        //     'fileName'=>$fileName
        // ]);
});