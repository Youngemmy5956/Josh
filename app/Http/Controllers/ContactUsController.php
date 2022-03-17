<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view("contact");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        {
            $data =  $this->validate($request, [
                "name" => "required|string",
                "email" => "required|string",
                "subject" => "nullable|string",
                "message" => "required|string",
            ]);

            //  Store data in database
            Contact::create($data);
            //  Send mail to admin
            Mail::send('mail', array(
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'messages' => $request->message,
            ), function ($message) use ($request) {
                $message->from($request->email);
                $message->to('emmanuelgodwin558@gmail.com', 'Admin')->subject($request->get('subject'));
            });


            return redirect()->route('index')->with('success', 'We have received your message and would like to thank you for writing to us.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
