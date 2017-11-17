<?php $__env->startSection('title'); ?>
Archivos
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin/Template/main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<h1 class="flow-text" style="text-align: center;">Archivos compartidos</h1>
<div style="margin-top: 50px" class="row">
	<div class="col s12 m4 l2"></div>
	<div class="col s12 m4 l8">
		<div class="collection">

			<?php if(Auth::user()->notifications()->count() == 0): ?>
			<h2 class="flow-text center">No tienes archivos compartidos por el momento</h2>
			<?php else: ?>
			<?php $__currentLoopData = Auth::user()->notifications->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if(Auth::user()->id == $rec->user_id): ?>
			<h4 class="flow-text center">Te han compartido el archivo <?php echo e($rec->record_name); ?></h4>
			<a style="" disabled href="http://localhost:8000/storage/files/<?php echo e($rec->author_id); ?>/<?php echo e($rec->record_name); ?>" type="text" class="validate"><?php echo e($rec->name); ?>descargar</a>
			<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="col s12 m4 l2"></div>
</div>


</section>

<?php echo $__env->make('Admin.template.parts.toogleuser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('Admin/Template/Parts/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>