<?php $__env->startSection('title'); ?>
  Archivos
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin/Template/main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<section id="section_create">

<?php echo $__env->make('Admin/Template/Parts/errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<form method="POST" action="<?php echo e(route('files.store')); ?>" accept-charset="UTF-8" enctype="multipart/form-data">

  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

  <input type="hidden" value="<?php echo e(Auth::user()->id); ?>" name="id">
  <input type="hidden" value="no" name="is_folder">

    <div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input type="file" class="form-control" name="file" multiple>
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="Upload one or more files">
      </div>
    </div>

    <p style="text-align: center;">
      <input type="checkbox" id="test5" name="is_public" value="yes"/>
      <label for="test5">Archivo publico?</label>
    </p>

  <div class="form-group" style="position: relative; left: 100%; top: -60px">
    <div class="col-md-6 col-md-offset-4">
      <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
  </div>
</form>
</section>

<?php echo $__env->make('Admin.template.parts.toogleuser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('Admin/Template/Parts/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>