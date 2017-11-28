@include('Admin/Template/main')

@section('title')
<div>
	@if(Auth::User())

	<h1 class="flow-text" style="text-align: center;">Ultimos archivos publicados</h1>
	<div style="height: 59%;">
		<div style="margin-top: 50px" class="row">
			<div style="text-align: center" class="col s12 center">
				<div class="collection">

					@foreach ($notify as $notify)

					@if($notify->is_public == "yes")

					@foreach($notify->folders()->get() as $rec)

					<h4 class="center flow-text">Han compartido un archivo publico {{$notify['name']}}</h4>
					<a href='http://localhost:8000/storage/files/{{$notify->user_id}}/{{$rec->name}}/{{$notify->name}}'>Ver archivo</a>

					@endforeach

					@endif

					@endforeach

				</div>
			</div>
		</div>
	</div>


	@include('Admin.template.parts.toogleuser')

	@else

	<h1 class="flow-text" style="text-align: center;">Debe registrarse para descargar archivos</h1>

	@endif
</div>
@include('Admin/Template/Parts/footer')