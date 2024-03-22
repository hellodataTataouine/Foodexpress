<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $messages=Messages::latest()->get();
        return view('admin.messages.index',compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //dd($request->all());
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'subject'=>'required',
            'message'=>'required',
            
        ]);
        $data=[
            'name'=> $request->name,
            'phone_number'=>$request->phone_number,
            'email'=>$request->email,
            'msg'=>$request->message,
        ];
        //dd($data);
        $subject=$request->subject;
        $mail=Mail::send('send_message',$data,function($message) use ($subject,$data) {
            $message->subject($subject)
                ->to(env('foodexpress_email'));
            });
        $msg_db=Messages::create($request->all());
        if($mail&&$msg_db){
            //return Session::flash('msg', "Message envoyer avec succée !");
            return 'Votre Message envoyer avec succée';
        }else{
            //return Session::flash('msg', "Erreur !");
            return 'Essayer plus tard ! ';
        }
        
        
        //return redirect()->action([FrontendController::class,'index'])->with('msg','Message envoyer avec succée !') ;
        //return redirect()->route('foodexpress');
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Messages $messages)
    {
        //
        $msg= Messages::find($messages->id);
        return view('admin.messages.index',compact('msg'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Messages $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Messages $messages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Messages $messages)
    {
        //
    }
}
