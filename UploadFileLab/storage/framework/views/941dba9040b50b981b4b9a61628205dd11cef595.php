<?php echo $__env->make('Admin/Template/main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startSection('title'); ?>
<div>
	<?php if(Auth::User()): ?>

	<h1 class="flow-text" style="text-align: center;">Ultimos archivos publicados</h1>
	<div style="height: 59%;">
		<div style="margin-top: 50px" class="row">
			<div style="text-align: center" class="col s12 center">
				<div class="collection">



					<?php $__currentLoopData = $notify; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notify): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($notify->is_public == "yes"): ?>

					<?php if($notify->folder_hash != "106a6c241b8797f52e1e77317b96a201"): ?>
					<h4 class="center flow-text">Han compartido un archivo publico <?php echo e($notify['name']); ?></h4>
					<a href='http://localhost:8000/storage/files/<?php echo e($notify['user_id']); ?>/<?php echo e($notify['name']); ?>'>Ver archivo</a>
					<?php else: ?>
					<h4 class="center flow-text">Han compartido un archivo publico <?php echo e($notify['name']); ?></h4>
					<a href='http://localhost:8000/storage/files/<?php echo e($notify['user_id']); ?>/<?php echo e($notify['name']); ?>'>Ver archivo</a>
					<?php endif; ?>

					<?php endif; ?>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


				</div>
			</div>
		</div>
	</div>


	<?php echo $__env->make('Admin.template.parts.toogleuser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php else: ?>

	<h1 class="flow-text" style="text-align: center;">Debe registrarse para descargar archivos</h1>

	<?php endif; ?>
</div>
<?php echo $__env->make('Admin/Template/Parts/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>