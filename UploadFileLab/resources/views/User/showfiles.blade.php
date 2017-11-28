@include('Admin/Template/main')

@if(Auth::User() && Auth::User()->status != "denied")

@section('title')
<div>
	<div class="">
		@if(isset($nombre))
		<script type="text/javascript">
  			Materialize.toast('Ya existe un archivo con el mismo nombre en la carpeta', 7000)
		</script>
		@elseif(isset($validation))
		<script type="text/javascript">
  			Materialize.toast('No se pueden modificar archivos de otro propietario', 7000)
		</script>
		@elseif(isset($rtaFolder))
		<script type="text/javascript">
  			var $toastContent = $('<span>La carpeta se ha eliminado exitosamente</span>').add($('<button class="btn-flat toast-action">Rehacer</button>'));
  			Materialize.toast($toastContent, 10000);
		</script>
		@endif
	</div>


	<div style="margin-top: 50px" class="row">
		<div class="col s12 m4 l2"></div>
		<div style="text-align: center" class="col s12 m4 l8">
			<table>

				<ul id="tabs-swipe-demo" class="tabs" style="margin-left: 12%">
					<li class="tab col s3"><a href="#test-swipe-1"><i class="material-icons">folder</i></a></li>
					<li class="tab col s3"><a class="active" href="#test-swipe-2"><i class="material-icons">insert_drive_file</i></a></li>
					<li class="tab col s3"><a href="#test-swipe-3"><i class="material-icons">share</i></a></li>
				</ul>

				{{-- Creacion de carpeta --}}

				<div id="test-swipe-1" class="col s12 z-depth-1" style="margin-bottom: 37px;">
					<form method="POST" action="{{ route('folder.store') }}" accept-charset="UTF-8" enctype="multipart/form-data">
						{{ csrf_field() }}
						<span class="flow-text">Agrega una nueva carpeta a tu nube</span>
						<input type="text" name="folder_name" placeholder="Nombre" required="">
						<div class="form-group">
							<div class="center">
								<button type="submit" class="btn btn-primary">Crear</button>
							</div>
						</div>
					</form>
				</div>

				{{-- Subida de archivo --}}

				<div id="test-swipe-2" class="col s12 z-depth-1" style="margin-bottom: 37px;">
					<form method="POST" action="{{ route('files.store') }}" accept-charset="UTF-8" enctype="multipart/form-data">
						{{ csrf_field() }}
						<span class="flow-text">Agrega un archivo a tu nube</span>

						<div class="file-field input-field">
							<div class="btn">
								<span>File</span>
								<input type="file" class="form-control" name="file" required="">
							</div>

							<div class="file-path-wrapper">
								<input class="file-path validate" type="text" placeholder="Upload files">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4" style="padding-left: 32%">
								<input type="checkbox" id="publico" name="is_public" value="yes"/>
								<label for="publico" style="padding-right: 25%">Archivo publico?</label>
								<button type="submit" class="btn btn-primary">Subir</button>
							</div>
						</div>

					</form>
				</div>

				{{-- Compartir con usuarios --}}

				<div id="test-swipe-3" class="col s12 z-depth-1" style="margin-bottom: 34px">

					<span class="flow-text">Comparte tus archivos</span>

				{!! Form::open(['route' => ['sharedWith'], 'method' => 'POST']) !!}

						<div class="input-field">
						<input name="user_name" type="text" id="autocomplete-input" class="autocomplete">
          				<label for="autocomplete-input">Nombre de usuario</label>
          				</div>
						
						@foreach(Auth::user()->records as $rec)

						<input value="{{$rec->id}}" name="id_record" type="radio" id="{{$rec->name}}" />
      					<label for="{{$rec->name}}">{{$rec->name}}</label>

						@endforeach

						<div class="form-group">
							<div class="center">
								<button type="submit" class="btn btn-primary">Compartir</button>
							</div>
						</div>

				{!! Form::close() !!}

				</div>


				<div class="row">
					<div class="col s12"><span class="flow-text">Mis archios</span></div>
				</div>

				{{-- Muestro los archivos --}}

				@if( Auth::user()->records()->count() == 0 && Auth::user()->folders()->count() == 1)
				<h2 class="flow-text">No existen archivos para mostrar, sube tu primer archivo</h2>
				@else
				<thead>
					<tr>
						<th></th>
						<th>Nombre</th>
						<th>Propietario</th>
						<th>Ultima Modificacion</th>
					</tr>
				</thead>

				<tbody>

					@foreach(Auth::user()->folders as $folder)
					<tr>

						{{-- Modal para las carpetas --}}

						
						@if($folder->folder_hash == "8cf04a9734132302f96da8e113e80ce5")
						<h1>{{$_SERVER["REQUEST_URI"]}}</h1>
						@else
						<td><i class="material-icons">folder</i></td>
						<td><a href="/folder/{{$folder->id}}">{{ $folder->name }}</a></td>
						<td>Yo</td>
						<td>{{ $folder->updated_at }}</td>
						<td>

							
							<a href="#modalFolder-{{$folder->id}}" class="waves-effect waves-light btn modal-trigger" ><i class="material-icons">settings</i></a>

							<div id="modalFolder-{{$folder->id}}" class="modal bottom-sheet">
								<div class="modal-content">
									<h4 style="text-align: center;">Modificar Carpeta</h4>
									<ul class="collection">
										<li class="collection-item">
											<section style="height: 100px">
												{!! Form::open(['route' => ['folder.update', $folder, $folder->id],  'method' => 'PUT']) !!}

												<label style="margin-left: 40%;">Modificar nombre de carpeta</label>
												<input style="width: 70%" type="text" name="name" class="validate" value="{{ $folder->name }}">

												<button style="position: relative; top: -120px; left: 65%" class="btn-floating blue" id="alinea_boton" type="submit">
													<i class="material-icons">edit</i>
												</button>

												{!! Form::close() !!}
											</section>
										</li>
										<li class="collection-item avatar">
											<label style="margin-left: 41%;">Borrar carpeta</label>

											<br>
											<a href="{{ route('folders.destroy', $folder->id) }}" onclick="return confirm('Al borrar la carpeta se borrar su contenido, ¿Desea continuar?')" class="modal-trigger open-edit"><i style="margin-left: 92%; margin-top: -10px" class="material-icons circle red">delete</i></a>
											<span style="margin-left: -54px" class="title">Titulo: {{ $folder->name }}</span>
											<p style="margin-left: -54px">Propietario: {{Auth::user()->name}}
											</p>

										</li>


									</ul>
								</div>
							</div>
							@endif
						</td>
					</tr>
					@endforeach


					@foreach (Auth::user()->records as $record)

					@foreach($record->folders()->get() as $rec)

					@if($rec->name == "Home")
					
					<tr>
						{{-- Modal para los archivos --}}

						<td><i class="material-icons">insert_drive_file</i></td>
						<td>{{ $record['name'] }}</td>
						<td>Yo</td>
						<td>{{ $record['updated_at'] }}</td>
						<td>


							<a href="#modalRecord-{{$record->id}}" class="waves-effect waves-light btn modal-trigger" ><i class="material-icons">settings</i></a>

							<div id="modalRecord-{{$record->id}}" class="modal bottom-sheet">
								<div class="modal-content">
									<h4 style="text-align: center;">Modificar archivo</h4>
									<ul class="collection">
										<li class="collection-item">
											<section style="height: 100px">
												{!! Form::open(['route' => ['files.update', $record, $record->id],  'method' => 'PUT']) !!}
												{{ csrf_field() }}
												<input type="hidden" value="{{ $record->id }}" name="id">
												<input type="hidden" value="{{ $record->name }}" name="oldname">

												<label style="margin-left: 40%;">Modificar nombre de archivo</label>
												<input style="width: 70%" type="text" name="name" class="validate" value="{{ $record->name }}">

												<button style="position: relative; top: -120px; left: 65%" class="btn-floating blue" id="alinea_boton" type="submit">
													<i class="material-icons">edit</i>
												</button>

												{!! Form::close() !!}
											</section>
										</li>
										<li class="collection-item avatar">
											<label style="margin-left: 41%;">Borrar archivo</label>

											<br>
											<a href="{{ route('files.destroy', $record->id) }}" onclick="return confirm('Sure?')" class="modal-trigger open-edit"><i style="margin-left: 92%; margin-top: -10px" class="material-icons circle red">delete</i></a>
											<span style="margin-left: -54px" class="title">Titulo: {{ $record->name }}</span>
											<p style="margin-left: -54px">Propietario: {{Auth::user()->name}}
											</p>

										</li>

										<li class="collection-item avatar">
											<label style="margin-left: 40.5%;">Link de descarga</label>
											<i style="margin-left: 92%; margin-top: 27px" class="material-icons circle green">link</i>
											<input style="width: 73%; margin-left: -50px;" disabled value="http://localhost:8000/storage/files/{{Auth::user()->id}}/{{$record->name}}" type="text" class="validate">
										</li>


										<li class="collection-item avatar">
											<section style="height: 130px">
												<label style="margin-left: 40.5%;">Mover archivo a carpeta</label>
												{!! Form::open(['route' => ['files.update', $record, $record->id],  'method' => 'PUT']) !!}

												<select name="folder_id">
													<option disabled selected>Mover a</option>
													@foreach(Auth::user()->folders as $folder)
													@if($folder->name != "Home")
													<option value="{{$folder->id}}" required="">{{$folder->name}}</option>
													@endif
													@endforeach
												</select>

												<button class="btn-floating grey" style="margin-left: 44%" type="submit"><i  class="material-icons">redo</i></button>
												{!! Form::close() !!}
											</section>
										</li>

										<br>
										
										<li class="collection-item avatar">
											<label style="margin-left: 40.5%;">Descargar archivo</label>
											<a style="width: 30%; margin-left: 30%; margin-top: 1.5%" href="http://localhost:8000/storage/files/{{Auth::user()->id}}/{{$record->name}}" class="waves-effect waves-light btn modal-trigger" ><i  class="material-icons">cloud_download</i></a>
										</li>
									</ul>
								</div>
							</div>
						</td>

					</tr>
					@endif
					@endforeach
				</tbody>
					@endforeach


				@endif

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

	$(document).ready(function(){
    	$('.tooltipped').tooltip({delay: 50});
  	});

  	$(document).ready(function() {
        $('input.autocomplete').autocomplete({
    		data : {
    		@foreach($users as $usuarios)
    		@if($usuarios->id != Auth::user()->id)
    		"{!! $usuarios->name !!}" : null,
    		@endif
    		@endforeach
    	},
    	limit: 10,
    	minLength: 2,
  		});
  	});

</script>



@include('Admin.template.parts.toogleuser')

@else

<h1 class="flow-text" style="text-align: center;">Hubo un error al intentar verificar la cuenta</h1>

@endif

@include('Admin/Template/Parts/footer')



