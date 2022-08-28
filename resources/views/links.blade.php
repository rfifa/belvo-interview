@extends('layouts.app')

@section('content')

    <script src="https://cdn.belvo.io/belvo-widget-1-stable.js" async></script>

    <script type="text/javascript">

       function successCallbackFunction(link, institution) {
          var user_id =  {{ Auth::user()->id }};
          var rawResponse = fetch('/add-link', {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({"link": link, "institution": institution, "user_id": user_id})
          })
          .then(response => response.json()) 
          .then(json => console.log(json))
          .catch(err => console.log(err));

          alert("Conta adicionada com sucesso!");
          window.location.reload();
      }

      function onExitCallbackFunction(data) {
        
      }

      function onEventCallbackFunction(data) {
          // Do something with the event data.
      }

      // Function to call your server-side to generate the access_token and retrieve the your access token
      function getAccessToken () { 
        // Make sure to change /get-access-token to point to your server-side.
        return fetch('/get-access-token', { method: 'GET' }) 
          .then(response => response.json())
          .then((data) => data.access)
          .catch(error => console.error('Error:', error))
      }

      function openBelvoWidget(accessToken) {
          belvoSDK.createWidget(accessToken, {

              // Add your startup configuration here.
              callback: (link, institution) => successCallbackFunction(link, institution),

          }).build();
      }
      function startBelvoWidget(){
          getAccessToken().then(openBelvoWidget) // Once the access token is retrieved, the widget is started.
      }
    </script>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h1 class="h2">Your Links</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-dark" onclick="startBelvoWidget()">Add New Link</button>
              </div>
              
            </div>
          </div>

   <div id="belvo"></div>
        @if (count($links))
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Institution</th>
                  <th>Access Mode</th>
                  <th>Status</th>
                  <th>Created</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($links as $link)
                <tr>
                  <td><img src="{{ $link->icon}}" style="max-width: 50px; margin-right: 20px;">{{ $link->full_institution}}</td>
                  <td>{{ $link->access_mode}}</td>
                  <td>{{ $link->status}}</td>
                  <td>{{ $link->created_at}}</td>
                  <td>
                    <a href="{{url("accounts/$link->link")}}">
                        <button class="btn btn-primary">Details</button>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @else
            <div class="col-8">
                <b>No links found yet! </b>
                Why don't you take the opportunity and link a institution to your account using the <a href="javascript:startBelvoWidget()">Belvo Widget</a>? :)
            </div>
        @endif
        </main>
	
	<div class="col-8">


	</div>
    <hr>
	

@endsection
