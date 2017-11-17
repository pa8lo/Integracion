<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="<?php echo e(asset('plugins/dropzone/css/dropzone.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('plugins/materialize/css/materialize.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('plugins/icons/icons.css')); ?>">
</head>
<body>

	<br>

	<div class="row text-flow">
		<div class="col s12 m4 l2"></div>
		<div class="col s12 m4 l8">

		<form class="dropzone" method="POST" action="<?php echo e(route('subirFoto')); ?>" enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?>

		<input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
				<div class="fallback">
				<input name="file" type="file" multiple />
				</div>
			</form>

		</div>
		<div class="col s12 m4 l2"></div>
		
	</div>
</div>



<script src="<?php echo e(asset('plugins/dropzone/js/dropzone.min.js')); ?>"></script>
</body>
</html>