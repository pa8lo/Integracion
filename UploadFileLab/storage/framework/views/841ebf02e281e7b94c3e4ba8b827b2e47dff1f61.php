<?php echo $__env->make('Admin/Template/main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startSection('title'); ?>


<div style="margin-top: 50px" class="row">
	<div class="col s12 m4 l2"></div>
	<div style="text-align: center" class="col s12 m4 l8">
		<table>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Propietario</th>
					<th>Ultima Modificacion</th>
				</tr>
			</thead>

			<tbody>
				<?php $__currentLoopData = $archivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $files): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($files['name']); ?></td>
					<td>Yo</td>
					<td><?php echo e($files['updated_at']); ?></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
	<div class="col s12 m4 l2"></div>
</div>

<?php if(Auth::User()): ?>

<?php echo $__env->make('Admin.template.parts.toogleuser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php endif; ?>

<a href="<?php echo e(route('files.create')); ?>">Añadir archivo</a>

<?php echo $__env->make('Admin/Template/Parts/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>