<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    //

    public function index(){

        $countries = Country::latest()->get();
        return view('admin.country',compact('countries'));
    }

    public function store(Request $request){
        
        $request->validate([
            'country' => 'required'
        ]);

        // try{
            $data = $request->only('country');
            Country::create($data);
            return back()->with("success", "Successfully Country Created!");
        // }catch(\Exception $e){
        //     Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
        //     return redirect()->route('error');
        // }
        
    }

    public function destroy(int $id){

        $country = Country::findOrFail($id);
        
        // if($country->hasProduct()){
        //     return redirect()->route('admin.country')->with('success', 'This Country Has Product. You Cannot delete!');
        // }

        $country->delete();
        return redirect()->route('admin.country')->with('success', 'Successfully Country Deleted!');
    }







}
