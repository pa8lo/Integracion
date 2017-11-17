<link rel="stylesheet" href="<?php echo e(asset('plugins/dropzone/css/dropzone.css')); ?>">
<script src="<?php echo e(asset('plugins/dropzone/js/dropzone.js')); ?>"></script>

<?php echo $__env->make('Admin/Template/main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if(Auth::User()): ?>

<?php if(Auth::User()->type == "admin"): ?>

<?php $__env->startSection('title'); ?><table>
				<thead>
					<tr>
						<th></th>
						<th>Nombre</th>
						<th>id del propietario</th>
						<th>Ultima Modificacion</th>
					</tr>
				</thead>

				<tbody>
					<?php $__currentLoopData = $record; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>


						

						<td><i class="material-icons">insert_drive_file</i></td>
						<td><?php echo e($role['name']); ?></td>
						<td><?php echo e($role['user_id']); ?></td>
						<td><?php echo e($role['updated_at']); ?></td>
						<td>


							<a href="#modal1-<?php echo e($role->id); ?>" class="waves-effect waves-light btn modal-trigger" ><i class="material-icons">settings</i></a>

							<div id="modal1-<?php echo e($role->id); ?>" class="modal bottom-sheet">
								<div class="modal-content">
									<h4 style="text-align: center;">Modificar archivo</h4>
									<ul class="collection">
										<li class="collection-item">
											<section style="height: 100px">
												<?php echo Form::open(['route' => ['files.update', $role, $role->id],  'method' => 'PUT']); ?>


												<input type="hidden" value="<?php echo e($role->id); ?>" name="id">
												<input type="hidden" value="<?php echo e($role->name); ?>" name="oldname">

												<label style="margin-left: 40%;">Modificar nombre de archivo</label>
												<input style="width: 70%" type="text" name="name" class="validate" value="<?php echo e($role->name); ?>">

												<button style="position: relative; top: -120px; left: 65%" class="btn-floating blue" id="alinea_boton" type="submit">
													<i class="material-icons">edit</i>
												</button>

												<?php echo Form::close(); ?>

											</section>
										</li>
										<li class="collection-item avatar">
											<label style="margin-left: 41%;">Borrar archivo</label>

											<br>
											<a href="<?php echo e(route('files.destroy', $role->id)); ?>" onclick="return confirm('Sure?')" class="modal-trigger open-edit"><i style="margin-left: 92%; margin-top: -10px" class="material-icons circle red">delete</i></a>
											<span style="margin-left: -54px" class="title">Titulo: <?php echo e($role->name); ?></span>
											<p style="margin-left: -54px">Propietario: <?php echo e(Auth::user()->name); ?>

											</p>

										</li>

										<li class="collection-item avatar">
											<label style="margin-left: 40.5%;">Link de descarga</label>
											<i style="margin-left: 92%; margin-top: 27px" class="material-icons circle green">link</i>
											<input style="width: 73%; margin-left: -50px;" disabled value="http://localhost:8000/storage/files/<?php echo e(Auth::user()->id); ?>/<?php echo e($role->name); ?>" type="text" class="validate">
										</li>


										<li class="collection-item avatar">
										<section style="height: 130px">
											<label style="margin-left: 40.5%;">Mover archivo a carpeta</label>
											<?php if($role->is_folder != "yes"): ?>
											<?php echo Form::open(['route' => ['files.update', $role, $role->id],  'method' => 'PUT']); ?>

											
											<?php $__currentLoopData = Auth::user()->records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($rec->is_folder != "no"): ?>
												
												<select>
												<option value="" disabled selected>Mover a</option>
												<option value="<?php echo e($role->id); ?>" required=""><?php echo e($rec->name); ?></option>
												<input type="hidden" value="<?php echo e($role->id); ?>" name="file_id">
												<input type="hidden" value="<?php echo e($rec->folder_hash); ?>" name="hash_folder">
												<input type="hidden" value="<?php echo e($rec->name); ?>" name="name_folder">
												<input type="hidden" value="<?php echo e($role->name); ?>" name="name_file">
												</select>
												
											<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

											<button class="btn-floating grey" style="margin-left: 44%" type="submit"><i  class="material-icons">redo</i></button>
												<?php echo Form::close(); ?>

											<?php endif; ?>
											</section>
										</li>
										<br>
										<li class="collection-item avatar">
											<label style="margin-left: 40.5%;">Descargar archivo</label>
											<a style="width: 30%; margin-left: 30%; margin-top: 1.5%" href="http://localhost:8000/storage/files/<?php echo e(Auth::user()->id); ?>/<?php echo e($role->name); ?>" class="waves-effect waves-light btn modal-trigger" ><i  class="material-icons">cloud_download</i></a>
										</li>
									</ul>
								</div>
							</div>
						</td>
						
						
						
						
						
						
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>

				

			</table>
		</div>
		<div class="col s12 m4 l2"></div>
	</div>
</div>




	
		
	</div>


	<script type="text/javascript">
		$(document).ready(function() {
			$('select').material_select();
		});
	</script>

	<?php echo $__env->make('Admin.template.parts.toogleuser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php else: ?>

	<h1 class="flow-text" style="text-align: center;">Privilegios insuficientes</h1>

	<?php endif; ?>


	<?php endif; ?>

	<?php echo $__env->make('Admin/Template/Parts/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>