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

class TransactionController extends Controller
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
        $now = new DateTime("NOW");
        $now->setTimezone(new \DateTimeZone("America/Sao_Paulo"));
        $dpto = date_format($now, "Y-m-d");
        $dpfrom = date_format(date_sub($now,date_interval_create_from_date_string("90 days")), "Y-m-d");
        
        return $this->mountPage($id, $dpfrom, $dpto);
    }

    private function mountPage($id, $dpfrom, $dpto){
        $response = Http::withHeaders([
                'Authorization' => 'Basic '. base64_encode(env('BELVO_API_ID').":".env('BELVO_API_PASSWORD')),
                'Content-Type' => 'application/json'
        ])->get(env('BELVO_API_BASE_URL') . "/api/accounts/".$id); // tracking_key
        $account = $response->json();
        
        $body = [
                    'link' => $account["link"],
                    'date_from' => $dpfrom,
                    'date_to' => $dpto,
                    'account'=> $id,
                    'save_data' => true
                ];

        $response = Http::withHeaders([
                'Authorization' => 'Basic '. base64_encode(env('BELVO_API_ID').":".env('BELVO_API_PASSWORD')),
                'Content-Type' => 'application/json'
        ])->post(env('BELVO_API_BASE_URL') . "/api/transactions/", $body); // tracking_key
        $transactions = $response->json();

        $error = "";

        if($response->status() != 201){

            foreach ($transactions as $transaction) {
                $error .= "\n".$transaction["message"];
            }
        }
        
        return view('transactions', ['account' => $account, 'transactions' => $transactions, 'error' => $error, 'dpfrom' => $dpfrom , 'dpto' => $dpto]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $filter = $request->except('_token');
        //dd($filter["dpfrom"]);
        //$dpfrom = substr($filter["dpfrom"],6)."-".substr($filter["dpfrom"],3,2)."-".substr($filter["dpfrom"],0,2);
        //$dpto = substr($filter["dpto"],6)."-".substr($filter["dpto"],3,2)."-".substr($filter["dpto"],0,2);

        return $this->mountPage($filter["id"], $filter["dpfrom"], $filter["dpto"]);
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
