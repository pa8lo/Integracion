<?php echo $__env->make('Admin/Template/main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startSection('title'); ?>
<div style="height: 63%">
<?php if(Auth::User()): ?>

<h1 class="flow-text" style="text-align: center;">Todos los archivos</h1>
<div style="height: 59%">
	<div style="margin-top: 50px; margin-left: 350px" class="row">
		<div style="text-align: center" class="col s12 m4 l8">
				<div class="collection">

				

					<?php $__currentLoopData = $dato; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

					<a href="http://localhost:8000/storage/files/<?php echo e($datos["name"]); ?>" class="collection-item"><span style="left: 30px"><?php echo e($datos["name"]); ?></span></a>
        			
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