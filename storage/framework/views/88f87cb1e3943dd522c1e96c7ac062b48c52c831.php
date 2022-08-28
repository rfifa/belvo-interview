<?php $__env->startSection('content'); ?>

    <script src="https://cdn.belvo.io/belvo-widget-1-stable.js" async></script>

    <script type="text/javascript">

       function successCallbackFunction(link, institution) {
          var user_id =  <?php echo e(Auth::user()->id); ?>;
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
	<h1>Home</h1>
	<hr>
	<h3>Shipments não integrados</h3>
   <div id="belvo"></div>
  <div class="col-8">
        <button class="btn btn-dark" onclick="startBelvoWidget()">Add Bank Account</button>
  </div>
  
	<div class="col-8">


	</div>
    <hr>
	

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\belvo-interview\resources\views/shipments.blade.php ENDPATH**/ ?>