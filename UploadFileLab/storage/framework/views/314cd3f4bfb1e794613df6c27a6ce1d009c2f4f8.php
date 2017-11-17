<?php echo $__env->make('Admin/Template/main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startSection('title'); ?>
<div style="height: 59%">
	<div style="margin-top: 50px" class="row">
		<div class="col s12 m4 l2"></div>
		<div style="text-align: center" class="col s12 m4 l8">
			<table>
			
				<?php if( $datos->firstfile == 0): ?>
				<h2 class="flow-text">No existen archivos para mostrar, sube tu primer archivo</h2>
				<a href="<?php echo e(route('files.create')); ?>"><img style="position: relative; height: 50%; width: 50%;  top: 20px" src="https://images.vexels.com/media/users/3/130461/isolated/preview/79b672a5a4e47ce457553d171935ca7f-c-rculo-icono-de-la-carpeta-by-vexels.png"></a>
				<?php elseif($datos->records != []): ?>
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Propietario</th>
						<th>Ultima Modificacion</th>
					</tr>
				</thead>

				<tbody>
					<?php $__currentLoopData = $datos->records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

					<tr>
						<td><?php echo e($role['name']); ?></td>
						<td>Yo</td>
						<td><?php echo e($role['updated_at']); ?></td>
						<td>
							<a href="#modal1-<?php echo e($role->id); ?>" class="btn-floating waves-effect waves-light modal-trigger open-edit"><i class="material-icons">edit</i></a>

							<div id="modal1-<?php echo e($role->id); ?>" class="modal">
								<div class="modal-content">

									<h4 style="text-align: center" id="modelId">Modificar archivo <?php echo e($role->name); ?> </h4>

									<section id="section_create">

										<?php echo Form::open(['route' => ['files.update', $role, $role->id],  'method' => 'PUT']); ?>


										<input type="hidden" value="<?php echo e($role->id); ?>" name="id">

										<label>Modificar nombre de archivo</label>
										<input type="text" name="name" class="validate" value="<?php echo e($role->name); ?>">

										<button class="btn waves-effect waves-light" id="alinea_boton" type="submit">Modificar
											<i class="material-icons right">send</i>
										</button>

										<?php echo Form::close(); ?>


									</section>

								</div>

								<div class="modal-footer">
									<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
								</div>
							</div>

							<a href="<?php echo e(route('files.destroy', $role->id)); ?>" onclick="return confirm('Sure?')" class="btn-floating waves-effect waves-light modal-trigger open-edit"><i class="material-icons">delete</i></a> 
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				</tbody>

				<?php endif; ?>

			</table>
		</div>
		<div class="col s12 m4 l2"></div>
	</div>
</div>
<?php if(Auth::User()): ?>

<?php echo $__env->make('Admin.template.parts.toogleuser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php endif; ?>

<a href="<?php echo e(route('files.create')); ?>">Añadir archivo</a>

<?php echo $__env->make('Admin/Template/Parts/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>