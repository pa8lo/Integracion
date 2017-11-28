@section('title')
Archivos
@endsection

@include('Admin/Template/main')


<h1 class="flow-text" style="text-align: center;">Archivos compartidos</h1>
<div style="margin-top: 50px" class="row">
	<div class="col s12 m4 l2"></div>
	<div class="col s12 m4 l8">
		<div class="collection">


			@if(Auth::user()->sharedTo()->count() == 0)
			<h2 class="flow-text center">No tienes archivos compartidos por el momento</h2>
			@else
			@foreach(Auth::user()->sharedTo()->get() as $rec)
			@foreach($rec->folders()->get() as $fol)

			<h4 class="flow-text center">Te han compartido el archivo {{$rec->name}}</h4>
			<a class="waves-effect waves-light validate" disabled href="http://localhost:8000/storage/files/{{$fol->user_id}}/{{$fol->name}}/{{$rec->name}}" type="text">Descargar</a>

			@endforeach
			@endforeach
			@endif
		</div>
	</div>
	<div class="col s12 m4 l2"></div>
</div>


</section>

@include('Admin.template.parts.toogleuser')

@include('Admin/Template/Parts/footer')