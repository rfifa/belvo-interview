<?php $__env->startSection('content'); ?>
    <script type="text/javascript">

        var userfrmBlock;
        var userfrmData;

        function prepare() {
            userfrmBlock= document.getElementById('form_id');
            userfrmData = userfrmBlock.getElementsByTagName('input');
        }

        function select_all(name, value) {
            for (i = 0; i < userfrmData.length; i++) {
                var regex = new RegExp(name, "i");
                if (regex.test(userfrmData[i].getAttribute('name'))) {
                    if (value == '1') {
                        userfrmData[i].checked = true;
                    } else {
                        userfrmData[i].checked = false;
                    }
                }
            }
        }

        if (window.addEventListener) {
            window.addEventListener("load", prepare, false);
        } else if (window.attachEvent) {
            window.attachEvent("onload", prepare)
        } else if (document.getElementById) {
            window.onload = prepare;
        }
    </script>
	<h1>All Shipments</h1>
	<hr>
	<h3>Shipments não integrados</h3>
    <?php if(count($nonIntegratedShipments)): ?>
	<div class="col-8">

		<table class="table">
		<thead class="thead-dark">
		<tr>
		  <th scope="col">Pedido</th>
          <th scope="col">Shopify</th>
		  <th scope="col">Tracking Key</th>
		  <th scope="col">Barcode</th>
		  <th scope="col">Recipient Name</th>
		  <th scope="col">Rua</th>
		  <th scope="col">Num</th>
		  <th scope="col">Complemento</th>
		  <th scope="col">Bairro</th>
		  <th scope="col">Cidade</th>
		  <th scope="col">UF</th>
		  <th scope="col">CEP</th>
		  <th scope="col">Integração</th>
		  <th scope="col">Integração no arquivo</th>
		  <th scope="col">Erro</th>
		  <th scope="col"></th>
		</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $nonIntegratedShipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
				  <th scope="row"><?php echo e($shipment->pedido); ?></th>
                  <th scope="row"><?php echo e($shipment->pedido_shopify); ?></th>
				  <th scope="row"><?php echo e($shipment->tracking_key); ?></th>
				  <th scope="row"><?php echo e($shipment->barcode); ?></th>
				  <td><?php echo e($shipment->recipient_name); ?></td>
				  <td><?php echo e($shipment->address_street); ?></td>
				  <td><?php echo e($shipment->address_number); ?></td>
				  <td><?php echo e($shipment->address_complement); ?></td>
				  <td><?php echo e($shipment->vicinity); ?></td>
				  <td><?php echo e($shipment->city); ?></td>
				  <td><?php echo e($shipment->state); ?></td>
				  <td><?php echo e($shipment->zip_code); ?></td>
				  <td><?php echo e($shipment->last_integrated_at); ?></td>
				  <td><?php echo e($shipment->last_integrated_in_file); ?></td>
				  <td><?php echo e($shipment->error); ?></td>
				  <td>
				  	<a href="<?php echo e(url("shipments/$shipment->id")); ?>">
				  		<!--button class="btn btn-dark">Visualizar</button-->
                        Ver detalhes
				  	</a>
				  </td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
		</table>
        <?php else: ?>
            <div class="col-8">
                Não existe pacotes pendentes de integração!
            </div>
        <?php endif; ?>

	</div>
    <hr>
	<h3>Shipments integrados</h3>
    <form action="<?php echo e(route('shipments.search.post')); ?>" method="POST" enctype="multipart/form-data" id="form_id2">
        <?php echo csrf_field(); ?>
        <div class="col-12">
            <div class="col-8">
                Buscar Pacotes Integrados (Por Nome ou códigos): <?php echo Form::text('search-field'); ?> <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>
    <br>
	<div class="col-8">
        <form action="<?php echo e(route('shipments.reintegrate.post')); ?>" method="POST" enctype="multipart/form-data" id="form_id">
            <?php echo csrf_field(); ?>
            <table class="table">
            <thead class="thead-dark">
            <tr>
              <th scope="col">Pedido</th>
              <th scope="col">Shopify</th>
              <th scope="col">Tracking Key</th>
              <th scope="col">Barcode</th>
              <th scope="col">Recipient Name</th>
              <th scope="col">Rua</th>
              <th scope="col">Num</th>
              <th scope="col">Complemento</th>
              <th scope="col">Bairro</th>
              <th scope="col">Cidade</th>
              <th scope="col">UF</th>
              <th scope="col">CEP</th>
              <th scope="col">Status</th>
              <th scope="col">Integração</th>
              <th scope="col">Integração no arquivo</th>
              <th scope="col">Erro</th>
              <th scope="col"> <?php echo Form::button('Selecionar Todos',['class' => 'btn btn-secondary','onClick'=>'select_all("status", "1")']); ?></th>
              <th scope="col"><button type="submit" class="btn btn-primary">Reintegrar Selecionados</button></th>
            </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $integratedShipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <th scope="row"><?php echo e($shipment->pedido); ?></th>
                      <th scope="row"><?php echo e($shipment->pedido_shopify); ?></th>
                      <th scope="row"><?php echo e($shipment->tracking_key); ?></th>
                      <th scope="row"><?php echo e($shipment->barcode); ?></th>
                      <td><?php echo e($shipment->recipient_name); ?></td>
                      <td><?php echo e($shipment->address_street); ?></td>
                      <td><?php echo e($shipment->address_number); ?></td>
                      <td><?php echo e($shipment->address_complement); ?></td>
                      <td><?php echo e($shipment->vicinity); ?></td>
                      <td><?php echo e($shipment->city); ?></td>
                      <td><?php echo e($shipment->state); ?></td>
                      <td><?php echo e($shipment->zip_code); ?></td>
                      <th scope="row">
                      <?php if(count($shipment->relStatus) > 0): ?>
                          <?php echo e($shipment->relStatus->sortByDesc('status_date')->first()->status_message); ?> em <?php echo e($shipment->relStatus->sortByDesc('status_date')->first()->status_date); ?>

                      <?php endif; ?>
                      </th>
                      <td><?php echo e($shipment->last_integrated_at); ?></td>
                      <td><?php echo e($shipment->last_integrated_in_file); ?></td>
                      <td><?php echo e($shipment->error); ?></td>
                      <td>
                          <?php echo Form::checkbox("status[]", $shipment->id, null,['id' => $shipment->id, 'class' => 'form-check-input', 'style' => 'margin-left: 40px']); ?>

                      </td>
                      <td>
                        <a href="<?php echo e(url("shipments/$shipment->id")); ?>">
                            Ver detalhes
                            <!--button class="btn btn-dark">Visualizar</button-->
                        </a>
                      </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            </table>
            <?php echo e($integratedShipments->links()); ?>

        </form>
	</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\travelist\resources\views/shipments.blade.php ENDPATH**/ ?>