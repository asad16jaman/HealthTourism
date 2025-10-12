<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Country;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    //
    public function index(){

            $allclient= Hospital::with('country')->orderBy('id','desc')->get();
            $countries = Country::all();
        
        return view("admin.hospital",compact(['allclient','countries']));
    }
    public function store(Request $request){
        $validationRules = [
            'img'=> "required|image|mimes:jpeg,jpg,png,gif,webp,svg|max:2048",
        ] ;
        $request->validate($validationRules);
        try{
            $data = $request->only(['country_id']) ;
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('countryLogo');
                $data['img'] = $path;
            }
            Hospital::create($data);
            return back()->with("success", "Successfully Client Created!");
            
        }catch (\Exception $e){
            Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
            return redirect()->route('error');
        }



    }
    public function destroy(int $id){
        try{
            $data = Hospital::findOrFail($id);
            //unlink image from directory....
            if($data->img && Storage::exists($data->img)){
                 Storage::delete($data->img);
            }
            $data->delete();
            return redirect()->route('admin.client')->with('success', 'Successfully Client Deleted!');

        }catch (\Exception $e){
            Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
            return redirect()->route('error');
        }

    }






}
