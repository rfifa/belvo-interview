<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ModelLink;

class ConnectWidgetController extends Controller
{
    public function getAccessToken() {
    	
    	$response = Http::post(env('BELVO_API_BASE_URL') . "/api/token/", [
                'id' => env('BELVO_API_ID'),
                'password' => env('BELVO_API_PASSWORD'),
                'scopes' => "read_institutions,write_links,read_links"
            ]);

    	return $response->json();
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addLink(Request $request)
    {
    	$dataForm = $request->except('_token');
		$now = new DateTime("NOW");
        $now->setTimezone(new \DateTimeZone("America/Sao_Paulo"));
		ModelLink::create([
            'user_id' => $dataForm["user_id"],
            'link' => $dataForm["link"],
            'institution' => $dataForm["institution"]
        ]);

        return $this->refreshPage();
    }
}
