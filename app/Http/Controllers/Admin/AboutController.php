<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    //

    public function index(){
        $about = About::first();
        return view("admin.about", compact(['about']));
    }

    public function store(Request $request){

        $request->validate([
            'title'=> 'required',
            'about'=> ['required', 'regex:/^(?!<p><br><\/p>$).*/'],
            // 'video' => [
            //             'required',
            //             'regex:/^(https?:\/\/)?(www\.)?(youtube\.com\/(watch\?v=|embed\/)|youtu\.be\/)[A-Za-z0-9_-]{11}([?&=\w]*)?$/'
            //         ],
        ]);
        
         $data = $request->only(['title','video','about']);
         $about = About::first();
        if ($about) {
            //user edit section is hare
            try{
                if ($request->hasFile('picture')) {
                    //delete if user already have profile picture...
                    if ($about->picture != null) {
                        Storage::delete($about->picture);
                    }
                    $path = $request->file('picture')->store('about');
                    $data['picture'] = $path;
                }
                About::where('id', '=', $about->id)->update($data);
                // 
                return redirect()->route('admin.about')->with("success", "Successfully Edited About");
            }catch(Exception $e){
                Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
                return redirect()->route('error');
            }
        }


      
        try{
            if ($request->hasFile('picture')) {
                $path = $request->file('picture')->store('about');
                $data['picture'] = $path;
            }
            About::create($data);
            return back()->with("success", "Successfully added the About");
        }catch(Exception $e){
            Log::error("this message is from : ".__CLASS__."Line is : ".__LINE__." messages is ".$e->getMessage());
            return redirect()->route('error');
        }

    }

}
