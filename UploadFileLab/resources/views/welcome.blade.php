 <link rel="stylesheet" href="{{ asset('plugins/materialize/css/materialize.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/icons/icons.css') }}">
  <script src="{{ asset('plugins/jquery/jquery-3.2.1.js') }}"></script>
  <script src="{{ asset('plugins/materialize/js/materialize.js') }}"></script>

@include('layouts.nav')

@section('title'){{-- Section se usa para rellenar aquello que fue marcado con Yield --}}
    Inicio de mi pagina
@endsection

@section('contenido')

@endsection


@if(Auth::User() && Auth::User()->status != "denied")

@include('Admin.template.parts.toogleuser')

@endif


@if ($errors->any() && $errors->has('email') || $errors->has('name') || $errors->has('password'))
  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
    <h4 id="modelId" class="center-align flow-text">No se ha podido completar el registro verifique los siguentes errores</h4>
      @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
      @endforeach
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#modal1').modal('open');
    });
  </script>
@endif


<section>

     <div class="parallax-container">

      <div style="margin-top: 170px;" class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text text-lighten-2">Upload File Lab</h1>
        <div class="row center">
          <h5 class="header col s12 light">The personal cloud you've always wanted</h5>
        </div>
        <div class="row center">
          <a href="{{ route('files.index') }}" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Suba Archivos</a>
        </div>
        <br><br>

      </div>
      </div>

    <div class="parallax"><img src="{{  asset('image/first.jpg') }}"></div>
  </div>
  <div class="section white">
    <div class="row container">



<div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Maxima velocidad de carga</h5>

            <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">group</i></h2>
            <h5 class="center">Comparta sus archivos</h5>

            <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Sin limite de espacio</h5>

            <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
          </div>
        </div>
      </div>


      <h2 class="header">Parallax</h2>
      <p class="grey-text text-darken-3 lighten-3">Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.</p>
    </div>
  </div>
  <div class="parallax-container">
    <div class="parallax"><img src="{{  asset('image/second.jpg') }}"></div>
  </div>
</section>

@include('admin.template.parts.footer')

<script type="text/javascript">
    
  // Initialize collapse button
  $(".button-collapse").sideNav();
  // Initialize collapsible (uncomment the line below if you use the dropdown variation)
  //$('.collapsible').collapsible();


  $(document).ready(function(){
      $('.parallax').parallax();
    });


</script>