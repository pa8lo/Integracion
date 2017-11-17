<?php $__env->startSection('title'); ?>
    Crear Usuario
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin/Template/main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<h3 style="text-align: center; margin-top: 50px">Registro de Usuario</h3>

<section id="section_create">

<?php echo $__env->make('Admin/Template/Parts/errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

	<?php echo Form::open (['route' => 'users.store', 'method' => 'POST', 'files' => true]); ?> <!-- Creo un formulario y le asigno la ruta que eliga, para saber cual es la ruta todo depende de lo que vaya a hacer, tirar comando php artisan route:list para saber mis rutas y de querer hacerlo por POST fijarme la ruta -->
	<?php echo $__env->make('Admin/Template/Parts/form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!--<?php echo Form::submit('Registrar', ['class'=>'btn waves-effect waves-light', 'id'=>'alinea_boton']); ?> -->

	<?php echo Form::close(); ?>

	
</section>

<?php echo $__env->make('Admin/Template/Parts/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>