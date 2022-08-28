<?php $__env->startSection('content'); ?>
	<h1>Shipment Detalhe</h1>
	<hr>

	<div class="col-8">
		<b>Pedido:</b> <?php echo e($shipment->pedido); ?> <br>
        <b>Pedido Tiny:</b>  <?php echo e($shipment->pedido_tiny); ?> <br>
        <b>Tracking Key:</b>  <?php echo e($shipment->tracking_key); ?> <br>
        <b>Barcode:</b>  <?php echo e($shipment->barcode); ?> <br>
        <b>Nome:</b>  <?php echo e($shipment->recipient_name); ?> <br>
        <b>Email:</b>  <?php echo e($shipment->recipient_email); ?> <br>
        <b>Telefone:</b>  <?php echo e($shipment->recipient_phone_number); ?> <br>
        <b>CPF/CNPJ:</b>  <?php echo e($shipment->recipient_cpf_cnpj); ?> <br>
        <b>Inscrição Estadual:</b>  <?php echo e($shipment->recipient_inscricao_estadual); ?> <br>
        <b>Rua:</b>  <?php echo e($shipment->address_street); ?> <br>
        <b>Número:</b>  <?php echo e($shipment->address_number); ?> <br>
        <b>Complemento:</b>  <?php echo e($shipment->address_complement); ?> <br>
        <b>Bairro:</b>  <?php echo e($shipment->vicinity); ?> <br>
        <b>Cidade:</b>  <?php echo e($shipment->city); ?> <br>
        <b>UF:</b>  <?php echo e($shipment->state); ?> <br>
        <b>CEP:</b>  <?php echo e($shipment->zip_code); ?> <br>
        <b>Chave NFe:</b>  <?php echo e($shipment->nf_key); ?> <br>
        <b>Série NFe:</b>  <?php echo e($shipment->nf_series); ?> <br>
        <b>Número NFe:</b>  <?php echo e($shipment->nf_number); ?> <br>
        <b>Volume:</b>  <?php echo e($shipment->nf_volume_number); ?> <br>
        <b>Total de Volumes:</b>  <?php echo e($shipment->nf_total_volumes); ?> <br>
        <b>Valor Total:</b>  <?php echo e($shipment->nf_total_value); ?> <br>
        <b>Peso:</b>  <?php echo e($shipment->package_weight_g); ?> <br>
        <b>Comprimento:</b>  <?php echo e($shipment->package_length_cm); ?> <br>
        <b>Largura:</b>  <?php echo e($shipment->package_width_cm); ?> <br>
        <b>Altura:</b>  <?php echo e($shipment->package_height_cm); ?> <br>
        <b>Delivery Mode:</b>  <?php echo e($shipment->delivery_mode); ?> <br>
        <b>CNPJ Sender:</b>  <?php echo e($shipment->cnpj_sender); ?> <br>
        <b>Brand Name:</b>  <?php echo e($shipment->brand_name); ?> <br>
        <b>Tracking Key integrado em:</b>  <?php echo e($shipment->last_tracking_key_returned_at); ?> <br>
        <b>Integrado em:</b>  <?php echo e($shipment->last_integrated_at); ?> <br>
        <b>Integrado no arquivo:</b>  <?php echo e($shipment->last_integrated_in_file); ?> <br>
        <b>Erro:</b>  <?php echo e($shipment->error); ?> <br>
        <b>Fulfillment:</b>  <?php echo e($shipment->fulfillment_id); ?> <br>
        <br>
	</div>

	<?php if(count($status) > 0): ?>
	<h3>Status</h3>
	<div class="col-8">
		<table class="table">
		<thead class="thead-dark">
		<tr>
		  <th scope="col">Código</th>
		  <th scope="col">Status</th>
		  <th scope="col">Data</th>
		  <th scope="col">Integração no Tiny</th>
		  <th scope="col">Erro</th>
		  <th scope="col"></th>
		</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
				  <th scope="row"><?php echo e($stat->status_code); ?></th>
				  <td><?php echo e($stat->status_message); ?></td>
				  <td><?php echo e($stat->status_date); ?></td>
				  <td><?php echo e($stat->last_integrated_at); ?></td>
				  <td><?php echo e($stat->error); ?></td>
				  <td>

				  </td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
		</table>
	</div>
	<?php endif; ?>
	<div class="col-8">
		<a href="<?php echo e(url("shipments")); ?>">
	  		<button class="btn btn-dark">Voltar</button>
	  	</a>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\belvo-interview\resources\views/show.blade.php ENDPATH**/ ?>