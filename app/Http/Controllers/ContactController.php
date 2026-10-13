<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Tintnaingwin\EmailChecker\Facades\EmailChecker;
use Validator;

class ContactController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if($lang = $request->input('locale')){
            app()->setLocale($lang);
        }
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            ], [
            'full_name.required' => __('messages.full_name_required'),
            'email.required' => __('messages.email_required'),
            'email.email' => __('messages.email_valid'),
            'subject.required' => __('messages.subject_required'),
            'message.required' => __('messages.message_required'),
        ]);

        // verification de la validité de l'adresse email de l'utilisateur
        if(env('APP_ENV') != 'local'){
            $validator->after(function($validator) use($request){
                if (! EmailChecker::check($request->input('email'))) {
                    $validator->errors()->add('email', __('messages.email_invalid'));
                }
            });
        }
        $validatedData = $validator->validate();
        $user = User::first();

        if ($user && $user->email) {
            Mail::to($user->email)->send(new ContactMail($validatedData));
        }

        $user->notify(new \App\Notifications\ContactNotification($validatedData));

        return response()->json([
            'success' => 1,
            'message' => "Email sent to the admin successfully"
        ]);
    }
}