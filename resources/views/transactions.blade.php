@extends('layouts.app')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h1 class="h2">Account Details</h1>
            
          </div>
    
          <div class="row gutters-sm">
            
            <div class="col-md-6">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$account["name"]}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Category</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$account["category"]}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Type</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$account["type"]}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Agency</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$account["agency"]}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Number</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$account["number"]}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Public Identification:</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$account["public_identification_name"]}}: {{$account["public_identification_value"]}}
                    </div>
                  </div>
                </div>
              </div>
            </div> 
            <div class="col-md-5">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Balance Type</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$account["balance_type"]}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Currency</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$account["currency"]}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"><b>Current Balance</b></h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <b>{{$account["balance"]["current"]}}</b>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"><b>Available Balance</b></h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <b>{{$account["balance"]["available"]}}</b>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>   
          </div>
        <form action="{{ route('transactions.filter.post') }}" method="POST" enctype="multipart/form-data" id="form_id2">
        @csrf
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h1 class="h2">Transactions</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <input type="hidden" id="id" name="id" value="{{$account["id"]}}">
               From: &nbsp; &nbsp; {!! Form::input('date', 'dpfrom', $dpfrom, ['id' => 
'dpfrom','class' => 'datepicker']) !!}&nbsp;&nbsp;
               to: &nbsp;&nbsp; {!! Form::input('date', 'dpto', $dpto, ['id' => 
'dpto','class' => 'datepicker']) !!}&nbsp;&nbsp;

           
               <button class="btn btn-primary">Filter</button>&nbsp;
             
            </div>
          </div>
          </form>
          @if ($error == "")
             @if (count($transactions))
              <div class="table-responsive">
                <table class="table table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Reference</th>
                      <th>Category</th>
                      <th>Type</th>
                      <th>Description</th>
                      <th>Currency</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                      <td>{{ $transaction["reference"] }}</td>
                      <td>{{ $transaction["category"] }}</td>
                      <td>{{ $transaction["type"] }}</td>
                      <td>{{ $transaction["description"] }}</td>
                      <td>{{ $transaction["currency"] }}</td>
                      <td>{{ $transaction["amount"] }}</td>
                      <td>{{ $transaction["status"] }}</td>
                      <td>{{ $transaction["value_date"] }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
                <div class="col-8">
                    <b>No transactions found yet! </b>
                </div>
            @endif
          @else
            <div class="col-8" style="margin-bottom: 30px;">
                   <br>
                    <b>{{ $error }} </b>
                    <br>
                </div>
            @endif
          <div class="col-8" style="margin-bottom: 30px;">
            <a href='{{url("accounts/$account[link]")}}'>
               <button class="btn btn-dark">Voltar</button>
            </a>
          </div>
    </main>
	
	
    <hr>
	
 
@endsection
