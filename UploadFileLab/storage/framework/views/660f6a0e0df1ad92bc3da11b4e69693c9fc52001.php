<?php echo $__env->make('Admin/Template/main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startSection('title'); ?>

<section>

<table class="responsive-table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Email</th>
			<th>Tipo</th>
			<th>Espacio Disponible</th>
			<th>Estado</th>
		</tr>
	</thead>

	<tbody>
		<?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><?php echo e($users['id']); ?></td>
			<td><?php echo e($users['name']); ?></td>
			<td><?php echo e($users['email']); ?></td>
			<td><?php echo e($users['type']); ?></td>
			<td><?php echo e($users['space']); ?></td>
			<td>
				<?php if($users['status'] == "active"): ?>
					<a  class="btn-floating green"><i class="material-icons">thumb_up</i></a>
				<?php else: ?>
					<a class="btn-floating red"><i class="material-icons">thumb_down</i></a>
				<?php endif; ?>
			</td>

			<td>


				<a href="#modal1-<?php echo e($users->id); ?>" class="btn-floating waves-effect waves-light modal-trigger open-edit"><i class="material-icons">edit</i></a>


					<!-- MODAL -->


					<div id="modal1-<?php echo e($users->id); ?>" class="modal">
						<div class="modal-content">
							<h4 id="modelId">Modificar al usuario <?php echo e($users->name); ?> </h4>

							<section id="section_create">

							<?php echo Form::open(['route' => ['users.update', $users, $users->id],  'method' => 'PUT']); ?>

								
								<input type="hidden" value="<?php echo e($users->id); ?>" name="id">

								<label>Modificar estado</label>
								<?php if($users->status == 'active'): ?>
								<select class="browser-default" name="status">
									<option value="<?php echo e($users->status); ?>" disabled selected>Seleccione una opcion</option>
									<option value="denied">Bloquear</option>
								</select>
								<?php else: ?>
								<label>Modificar estado</label>
								<select class="browser-default" name="status">
									<option value="<?php echo e($users->status); ?>" disabled selected>Seleccione una opcion</option>
									<option value="active">Activar</option>
								</select>
								<?php endif; ?>

								<br>

								<label>Modificar permisos</label>
								<?php if($users->type == 'member'): ?>
								<select class="browser-default" name="type">
									<option value="<?php echo e($users->type); ?>" disabled selected>Seleccione una opcion</option>
									<option value="admin" name="type">Administrador</option>
								</select>
								<?php else: ?>
								<select class="browser-default" name="type">
									<option value="<?php echo e($users->type); ?>" disabled selected>Seleccione una opcion</option>
									<option value="member" name="type">Miembro</option>
								</select>
								<?php endif; ?>

								<br>

								<label>Modificar espacio</label>
								<input type="text" value="<?php echo e($users->space); ?>" name="space" class="validate">
								
								<!-- <a href=" <?php echo e(route('users.show', $users->id)); ?> " class="btn waves-effect waves-light"><i class="material-icons right">send</i>Enviar</a>
								<?php echo e(Form::submit('enviar')); ?>-->

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

					<!-- BOTON DE CONFIRMACION -->

				<a href="<?php echo e(route('users.destroy', $users->id)); ?>" onclick="return confirm('Sure?')" class="btn-floating waves-effect waves-light modal-trigger open-edit"><i class="material-icons">delete</i></a> 
			</td>
		</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>

 
<script type="text/javascript">

	/*document.querySelectorAll(".open-edit").forEach((button)=>{
		button.addEventListener("click",()=>{
			const id = button.getAttribute("data-model-id")
			document.getElementById('modelId').innerText =  "Modificar ID: " + id;
		})
	});*/

$(document).ready(function(){
    	$('.modal').modal();
});
    
</script>

<ul class="pagination">
<?php echo $usuarios->render(); ?>

</ul>

<a href="<?php echo e(route('users.create')); ?>">Añadir Usuarios</a>

</section>

<?php echo $__env->make('Admin/Template/Parts/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>