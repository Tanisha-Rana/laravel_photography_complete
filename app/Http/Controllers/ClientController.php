<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;
use App\Mail\registrationmail;
use App\Mail\loginmail;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
     public function login()
    {
        return view('website.login');
    }

    public function login_auth(Request $request)
    {
        $user = Client::where('email', $request->email)->first();

        if ($user) {
        if (!Hash::check($request->password, $user->password)) {
            Alert::error('Failed', 'Wrong Password');
            return back();
        } else {

            session()->put('client_id', $user->id);
            session()->put('client_name', $user->name);
            session()->put('has_logged_in', true); 

            $data = [
                "name" => $user->name
            ];

            Mail::to($request->email)->send(new loginmail($data));

            Alert::success('Success', 'Login Success');
            return redirect('/');
        }
        } else {
        Alert::error('Failed', 'Wrong Email');
        return back();
        }
    }

     public function logout()
    {
        session()->pull('client_id');
        session()->pull('client_name');
       
        Alert::success('Success', 'Logout Success');
        return redirect('/');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website.registration');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $table=new Client;
        $table->name=$request->name;
        $table->email=$request->email;
        $table->phone=$request->phone;
        $table->password=Hash::make($request->password);
        $table->status='unblock';
        $table->save();

    
        $data = [
            "name" => $request->name
        ];

        Mail::to($request->email)->send(new registrationmail($data));
        Alert::success('Registration has been successful');
        return redirect('/login');
    }

    /**
     * Display the specified resource.
     */
    public function show(client $client)
    {
        $data=client::all();
        return view('admin.client_management', ['client_arr'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
