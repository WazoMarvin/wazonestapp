<?php

namespace App\Http\Controllers;

use App\ContactInfo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function about(){
        return view('marvin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $contactInfo = ContactInfo::paginate(5);
        return view('home',[
            'contactInfo'=>$contactInfo
        ]);
    }


    public function bootsWatch(){
        return view('boots_view');
    }

    public function saveContact(){
        $this->validate(request(), [
            'name' => 'required',
            'dob' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        ContactInfo::create([
            'name' => request('name'),
            'dob' => request('dob'),
            'phone' => request('phone'),
            'email' => request('email'),
        ]);
        return redirect()->back()->with("success","Record Saved Successfully");
    }

    public function download(){
        $contactInfo = ContactInfo::all();
        $data =[
            'contactInfo'=>$contactInfo,
            'heading'=>"Client's List"
        ];;
        $pdf = PDF::loadView('includes.pdf', $data);
        // $fileName = 'CustomersReport_'.time().'.pdf';
        // $pdf->save(storage_path('export/'.$fileName));
        return $pdf->download('CustomersList.pdf');
    }
}
