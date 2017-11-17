<?php $__env->startSection('title'); ?>
    Subir archivo
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin/Template/main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<h3 style="text-align: center; margin-top: 50px">Registro de Usuario</h3>

<section id="section_create">

<?php echo $__env->make('Admin/Template/Parts/errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<form method="POST" action="<?php echo e(route('files.store')); ?>" accept-charset="UTF-8" enctype="multipart/form-data">

  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

  <div class="form-group">
    <label class="col-md-4 control-label">Nuevo Archivo</label>
    <div class="col-md-6">
      <input type="file" class="form-control" name="file" >
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-6 col-md-offset-4">
      <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
  </div>
</form>
	
</section>

<?php echo $__env->make('Admin/Template/Parts/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>