<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;



class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();
        $admin = Auth::user();

        return view('admin.allgallery', compact('galleries'));
    }

    public function createGallery()
    {
        return view('admin.addgallery');
    }

    public function StoreGallery(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image',
            'deskripsi' => 'required',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Gallery::create([
            'title' => $request->title,
            'image' => $imageName,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.gallery.index');
    }


    public function editGallery($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.editgallery', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'image',
            'deskripsi' => 'required',
        ]);

        $gallery = Gallery::find($id);

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $gallery->image = $imageName;
        }

        $gallery->title = $request->title;
        $gallery->save();

        return redirect()->route('admin.gallery.index');
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        unlink(public_path('images').'/'.$gallery->image);
        $gallery->delete();
        return redirect()->route('admin.gallery.index');
    }
}
