<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LivraisonRestaurant;

use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{
   public function showContactForm(Request $request)
{
    $subdomain = $request->getHost();
    $subdomain = preg_replace('/:\d+$/', '', $subdomain);
 $client = Client::where('url_platform', $subdomain)->firstOrFail();
	   		$livraisons = LivraisonRestaurant::where('restaurant_id', $client->id)->get();

	    $cart = session()->get('cart', []);
	   
	   $user = User::findOrFail($client->user_id);
	   $host = request()->getHost();
        $subdomain = explode('.', $host)[0];
	       
	   
    return view('client.contact', compact('subdomain','client', 'cart', 'user', 'livraisons'));
}

public function submitContactForm(Request $request, $subdomain)
{
	 $subdomain = $request->getHost();
    $subdomain = preg_replace('/:\d+$/', '', $subdomain);
	
    $restaurantId = Client::where('url_platform', $subdomain)->firstOrFail()->id;
    $user = User::findOrFail(Client::where('url_platform', $subdomain)->firstOrFail()->user_id);
    $email = $user->email;
	$subject = 'Formulaire de Contact';
	$currentDateTime = now()->format('d/m/Y H:i:s');
	dd($email);
	
	//$testEmail = 'firas.saafi96@gmail.com';




    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
        'message' => 'required|string',
    ]);

 
  //  Mail::to('admin@email.com')->send(new ContactFormMail($validatedData));
	  Mail::send('contact_email', ['data' => $validatedData, 'currentDateTime' => $currentDateTime], 
				 function ($message) use ($subject, $email) {
            $message->subject($subject)->to($email);
		   	

});
	


    // Store data in a database
	
	
    // $contact = new Contact;
    // $contact->name = $validatedData['name'];
    // $contact->email = $validatedData['email'];
    // $contact->phone = $validatedData['phone'];
    // $contact->message = $validatedData['message'];
    // $contact->save();
$host = request()->getHost();
        $subdomain = explode('.', $host)[0];
    return redirect()->back()->with('success', 'Votre message a été envoyé avec succès.');
}

}
