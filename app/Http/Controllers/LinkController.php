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

class LinkController extends Controller
{
    private $objModelLink;

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
        return $this->refreshPage();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function refreshPage()
    {
        $links = ModelLink::where('user_id', Auth::user()->id)->get();

        $response = Http::withHeaders([
                'Authorization' => 'Basic '. base64_encode(env('BELVO_API_ID').":".env('BELVO_API_PASSWORD')),
                'Content-Type' => 'application/json'
        ])->get(env('BELVO_API_BASE_URL') . "/api/institutions/?page_size=100"); // tracking_key
        $institutions = $response->json()["results"];

        foreach ($links as $link) {
            foreach ($institutions as $institution) {
                if($institution["name"] == $link->institution){
                    $response = Http::withHeaders([
                            'Authorization' => 'Basic '. base64_encode(env('BELVO_API_ID').":".env('BELVO_API_PASSWORD')),
                            'Content-Type' => 'application/json'
                    ])->get(env('BELVO_API_BASE_URL') . "/api/links/".$link->link); // tracking_key
                    $link_api = $response->json();
                    
                    $link->access_mode = $link_api["access_mode"];
                    $link->status = $link_api["status"];
                    $link->full_institution = $institution["display_name"];
                    $link->icon = $institution["icon_logo"];
                }
            }
        }

        return view('links',  ['links' => $links]);
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
        //$shipment = $this->objShipment->find($id);
        //$status = $shipment->relStatus;
        return view('show', compact('shipment', 'status'));
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
