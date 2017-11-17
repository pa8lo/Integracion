<?php if(count($errors) > 0): ?>

<ul class="collapsible" style="margin-left: 120px; margin-top: -100px; margin-bottom: 60px;" data-collapsible="accordion">
	<li>
		<div class="collapsible-header">
			<i class="material-icons">error</i>
			An Error Ocurred, Click Me to show more details!
		</div>
		<div class="collapsible-body">

			<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<p><?php echo e($error); ?></p>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		</div>
	</li>
</ul>

<?php endif; ?>