<?php

namespace App\Http\Controllers\Admin;

use App\Models\WelcomeNode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class WellcomeController extends Controller
{
    //

    public function index()
    {
        $editItem = WelcomeNode::first();
        return view('admin.wellcomenode', compact('editItem'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'note' => 'required',
            'image_1' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,webp,svg'],
            'image_2' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,webp,svg'],
        ]);

        $wellcome = WelcomeNode::first();
        $data = $request->only(['title', 'note']);
        if ($wellcome) {
            //handle image_1
            if ($request->hasFile('image_1') && $wellcome->image_1 != null) {
                Storage::delete($wellcome->image_1);
            }
            if ($request->hasFile('image_1')) {
                    $path = $request->file('image_1')->store('wellcome');
                    $data['image_1'] = $path;
                }

            //handle image_2
            if ($request->hasFile('image_2') && $wellcome->image_2 != null) {
                Storage::delete($wellcome->image_2);
            }
            if ($request->hasFile('image_2')) {
                    $path = $request->file('image_2')->store('wellcome');
                    $data['image_2'] = $path;
                }
            $wellcome->update($data);

            return redirect()->back()->with('success',"Successfully Updated Wellcome Node");

        } else {

            if ($request->hasFile('image_1')) {
                    $path = $request->file('image_1')->store('wellcome');
                    $data['image_1'] = $path;
                }

            if ($request->hasFile('image_2')) {
                    $path = $request->file('image_2')->store('wellcome');
                    $data['image_2'] = $path;
                }
            WelcomeNode::create($data);
            return redirect()->back()->with('success','successfully Created Wellcome Node.');
        }
    }
}
