<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{
    //


    public function index(Request $request, ?int $id = null)
    {
        $editfeedback = null;
        if ($id != null) {
            $editfeedback = Feedback::findOrFail($id);
        }
        
        $search = $request->input('search', null);
        if ($search) {
            $allfeedback = Feedback::where('note', 'like', '%' . $search . '%')->orderBy('id', 'desc')->get();
        } else {
            $allfeedback = Feedback::orderBy('id', 'desc')->get();
        }
        // return response()->json($allfeedback);
        return view("admin.feedback", compact("editfeedback", "allfeedback"));
    }

    public function store(Request $request, ?int $id = null)
    {
        $validaterules = [
            "name" => "required",
            'note' => 'required',
            'img' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,webp,svg']
        ];
        $request->validate($validaterules);
        $data = $request->only(['name','note']);

        if ($id != null) {
            try{
                $feedback = Feedback::findOrFail($id);
                //remove old Image While Give New Image
                if ($request->hasFile('img') && $feedback->img != null) {
                    Storage::delete($feedback->img);
                }
                //Store new Image
                if ($request->hasFile('img')) {
                        $path = $request->file('img')->store('feedbackUser');
                        $data['img'] = $path;
                }
                Feedback::where('id', '=', $id)->update($data);
                return redirect()->route('admin.feedback', ['page' => $request->query('page'), 'search' => $request->query('search')])->with('success', "Successfully updated Feedback");
                
            }catch(\Exception $e){
                Log::error("Error is comeing from SlideController Storage method");
                return redirect()->route('error');

            }
            
        }

        try{
            if ($request->hasFile('img')) {
                    $path = $request->file('img')->store('feedbackUser');
                    $data['img'] = $path;
            }
            Feedback::create($data);
            return back()->with("success", "Successfully created Feedback");

        }catch(\Exception $e){
                Log::error("Error is commin from SlideController Storage method message :".$e->getMessage());
                return redirect()->route('error');

        }
        
    }

    public function destroy(int $id)
    {

        $feedback = Feedback::findOrFail($id);
        if ($feedback->img != null) {
            Storage::delete($feedback->img);
        }
        $feedback->delete();
        return redirect()->route('admin.feedback')->with('success', 'Successfully Deleted Feedback');

    }

}
