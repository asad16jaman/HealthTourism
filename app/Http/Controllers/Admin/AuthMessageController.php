<?php

namespace App\Http\Controllers\Admin;

use App\Models\Authmessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AuthMessageController extends Controller
{
    //

    public function index(){
        $ch= Authmessage::first();
        return view("admin.authmsg", compact(['ch']));
    }

    public function store(Request $request){

        $request->validate([
            'name'=> 'required',
            
        ]);
        
         $data = $request->only(['name','speech']);
         $ch = Authmessage::first();
        if ($ch) {
            //user edit section is hare
            try{
                if ($request->hasFile('img')) {
                    //delete if user already have profile picture...
                    if ($ch->img != null) {
                        Storage::delete($ch->img);
                    }
                    $path = $request->file('img')->store('chairman');
                    $data['img'] = $path;
                }
                Authmessage::where('id', '=', $ch->id)->update($data);
                // 
                return redirect()->route('admin.ch-message')->with("success", "Successfully Author Message");
            }catch(\Exception $e){
                Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
                return redirect()->route('error');
            }
        }


      
        try{
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('chairman');
                $data['img'] = $path;
            }
            Authmessage::create($data);
            return back()->with("success", "Successfully added Chairman Message");
        }catch(\Exception $e){
            Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
            return redirect()->route('error');
        }

    }
}
