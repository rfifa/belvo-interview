@extends('layouts.app')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h1 class="h2">Owner</h1>
            
          </div>
    
          

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{$owner["first_name"]}} {{$owner["last_name"]}}</h4>
                      <p class="text-secondary mb-1">{{$owner["email"]}}</p>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$owner["display_name"]}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$owner["phone_number"]}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$owner["address"]}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Document</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$owner["document_id"]["document_type"]}}: {{$owner["document_id"]["document_number"]}}
                    </div>
                  </div>
                </div>
              </div>
              Link Details
            </div>  
            <div class="col-md-4 mb-3">
              
              
            </div>

            <div class="col-md-8">

              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Institution</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$link["institution"]}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Access Mode</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$link["access_mode"]}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Status</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$link["status"]}}
                    </div>
                  </div>
                </div>
              </div>
            </div> 
          </div>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h1 class="h2">Accounts</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              
              
            </div>
          </div>
             @if (count($accounts))
              <div class="table-responsive">
                <table class="table table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Category</th>
                      <th>Type</th>
                      <th>Name</th>
                      <th>Number</th>
                      <th>Created</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($accounts as $account)
                    <tr>
                      <td>{{ $account["category"] }}</td>
                      <td>{{ $account["type"] }}</td>
                      <td>{{ $account["name"] }}</td>
                      <td>{{ $account["number"] }}</td>
                      <td>{{ $account["created_at"] }}</td>
                      <td>
                        <a href='{{url("transactions/$account[id]")}}'>
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
                    <b>No accounts found yet! </b>
                </div>
            @endif
          <div class="col-8">
            <a href="{{url("links")}}">
                <button class="btn btn-dark">Voltar</button>
              </a>
          </div>
          
    </main>
	
	
	

@endsection
