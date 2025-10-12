<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    //
    public function index(){
        $datas = Faq::all();
        return view("admin.faq",compact(["datas"]));
    }
    public function store(Request $request){
        $request->validate([
            'question' => 'required',
            'answer'=> 'required',
        ]);
        $data = $request->only(['question', 'answer']);

        try{
            Faq::create($data);
            return redirect()->back()->with('success','Successfully FAQ created!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e);
        }
    }
    public function destroy($id){
        try{
            Faq::find($id)->delete();
            return redirect()->back()->with('success', "Successfully FAQ Deleted!");
        }catch(\Exception $e){
            return redirect()->back()->with('error', "There is some problem");
        }
    }

}
