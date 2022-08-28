<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\ModelLink;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    public function __construct()
    {
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('links');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $body = [
                    'link' => $id,
                    'save_data' => true
                ];

        $response = Http::withHeaders([
                'Authorization' => 'Basic '. base64_encode(env('BELVO_API_ID').":".env('BELVO_API_PASSWORD')),
                'Content-Type' => 'application/json'
        ])->post(env('BELVO_API_BASE_URL') . "/api/owners/", $body); // tracking_key
        $owner = $response->json()[0];

        $response = Http::withHeaders([
                'Authorization' => 'Basic '. base64_encode(env('BELVO_API_ID').":".env('BELVO_API_PASSWORD')),
                'Content-Type' => 'application/json'
        ])->get(env('BELVO_API_BASE_URL') . "/api/links/".$id); // tracking_key
        $link = $response->json();
        

        $response = Http::withHeaders([
                'Authorization' => 'Basic '. base64_encode(env('BELVO_API_ID').":".env('BELVO_API_PASSWORD')),
                'Content-Type' => 'application/json'
        ])->post(env('BELVO_API_BASE_URL') . "/api/accounts/", $body); // tracking_key
        $accounts = $response->json();
        
        //dd($accounts);
        return view('accounts', ['owner' => $owner, 'link' => $link, 'accounts' => $accounts]);
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
