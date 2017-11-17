<!DOCTYPE html>
<html>
<head>
	<title><?php echo $__env->yieldContent('title'); ?></title> 
	<link rel="stylesheet" href="<?php echo e(asset('plugins/materialize/css/materialize.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('plugins/icons/icons.css')); ?>">
</head>
<body>

	<?php echo $__env->make('Admin/Template/Parts/nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	<script src="<?php echo e(asset('plugins/jquery/jquery-3.2.1.js')); ?>"></script>
	<script src="<?php echo e(asset('plugins/materialize/js/materialize.js')); ?>"></script>
	<script type="text/javascript">
		$( document ).ready(function(){ 
			$(".button-collapse").sideNav(); 
		}); 
	</script>

</body>
</html>