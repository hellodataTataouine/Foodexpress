<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use App\Models\User;
use Auth;
use File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
            $restaurant = $user->restaurant;
            $metadata = Seo::whereclient_id($restaurant->id)->first();
        }
        //dd($metadata);
        return view('restaurant.metadata.index',compact('metadata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $userId = Auth::id();
        $user = User::find($userId);
        $metadata= new Seo ;
        $request->validate([
            'title'=> 'required',
            'description'=> 'required',
            'keywords'=>'required',
            'robots' => 'required',
            'follow_links'=> 'required',
            'content_type'=> 'required',
            'language' => 'required',
        ]);
        if ($user) {
            $restaurant = $user->restaurant;
            $metadata->client_id = $restaurant->id;
            $metadata->title = $request->input('title');
            $metadata->description =  $request->input('description');
            $metadata->keywords = $request->input('keywords');
            $metadata->robots = $request->input('robots');
            $metadata->follow_links = $request->input('follow_links');
            $metadata->content_type = $request->input('content_type');
            $metadata->language = $request->input('language');
            $metadata->image = null;
            if($request->hasfile('image')){
                
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $file->move('uploads/seo/', $filename);
                $metadata->image = $filename;
            }
            
            $metadata->save();

        }
        return redirect()->route('restaurant.seo.index')->with('success', ' Seo creé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seo $seo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $metadata = Seo::findOrFail($id);
        //dd ($metadata);
        return view('restaurant.metadata.update',compact('metadata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        
        $userId = Auth::id();
        $user = User::find($userId);
        $request->validate([
            'title'=> 'required',
            'description'=> 'required',
            'keywords'=>'required',
            'robots' => 'required',
            'follow_links'=> 'required',
            'content_type'=> 'required',
            'language' => 'required',
        ]);
        if ($user) {
            $restaurant = $user->restaurant;
            $metadata = Seo::findOrFail($id);
            $metadata->client_id = $restaurant->id;
            $metadata->title = $request->input('title');
            $metadata->description =  $request->input('description');
            $metadata->keywords = $request->input('keywords');
            $metadata->robots = $request->input('robots');
            $metadata->follow_links = $request->input('follow_links');
            $metadata->content_type = $request->input('content_type');
            $metadata->language = $request->input('language');
            if($request->hasfile('image')){
                $destination = 'uploads/seo/'.$metadata->image;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $file->move('uploads/seo/', $filename);
                $metadata->image = $filename;
            }
            
            $metadata->save();
            return redirect()->route('restaurant.seo.index')->with('success', ' Seo modifiée avec succès');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
