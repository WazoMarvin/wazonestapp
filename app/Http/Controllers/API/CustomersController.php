<?php

namespace App\Http\Controllers\API;

use App\ContactInfo;
use App\Http\Controllers\Controller;
class CustomersController extends Controller
{   
    
    public function getCustomers (){
        $customers = ContactInfo::get();
        return response()->json($customers);
    }
 
}
