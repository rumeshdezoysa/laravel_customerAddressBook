<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Address;
use App\Models\Contact;

class CustomerController extends Controller
{
     public function getCustomers()
    {
        $customers = Customer::all();
        return $customers;
    }
    public function get_customer($id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
        
    }
    public function save_customer(Request $request)
    {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->nic = $request->nic;

        if($customer->save()){
            
            $customer_add = new Address();
            $customer_add->cus_id = $customer->id;
            $customer_add->address = $request->address;
            $customer_add->save();

            return response()->json(['status'=>true,'message'=>'Customer Added Successfully']);
        }else{
            
            return response()->json(['status'=>false,'message'=>'There is some error.Please try again']);
        }
    }

    public function update_customer(Request $request,$id)
    {
        $customer = Customer::where('id',$id)->first();
        $customer->name = $request->name;
        $customer->nic = $request->nic;

        if($customer->save()){
            
            return response()->json(['status'=>true,'message'=>'Customer Updated Successfully']);
        }else{
            
            return response()->json(['status'=>false,'message'=>'There is some error.Please try again']);
        }
    }


    public function delete_customer($id)
    {
        $customer = Customer::find($id);
        if($customer->delete()){
            return response()->json(['status'=>true,'message'=>'Customer Deleted Successfully']);
        }else{
            return response()->json(['status'=>false,'message'=>'Something went wrong']);
        }

    
    }

    public function searchCustomer(Request $request)
    {
        $keyword = $request->get('keyword');
        $customers = Customer::where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('nic', 'LIKE', '%' . $keyword . '%')
            ->limit(5)->get();

        return response()->json($customers);
    }
}
