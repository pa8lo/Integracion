  <script src="<?php echo e(asset('plugins/jquery/jquery-3.2.1.js')); ?>"></script>
  <script src="<?php echo e(asset('plugins/materialize/js/materialize.js')); ?>"></script>
  <link rel="stylesheet" href="../css/nav.css">

<nav>
  <div class="nav-wrapper grey lighten-1">
  <a href="#!" class="brand-logo" id="logo_de_pag">
      
    </a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">
    <?php if(Auth::User()): ?>
    
     <li><a href="<?php echo e(route('files.index')); ?>"><i class="material-icons">cloud_queue</i></h2></a></li>
      <?php if(Auth::User()->type == "admin"): ?>
      <li><a href="<?php echo e(route('users.index')); ?>">Usuarios</a></li>
      
      <li><a href="/filesadmin">Todos los archivos</a></li>
      <?php endif; ?>
    <?php endif; ?>
      <?php if(auth()->guard()->guest()): ?>
      <li><a class="modal-trigger flow-text" style="font-size: 100%;" href="#login">
       Login
      </a></li>
      <li><a class="modal-trigger flow-text" style="font-size: 100%;" href="#registro">
        Registrar
      </a></li>
      <?php else: ?>
    <?php endif; ?>
    </ul>
    <ul class="side-nav" id="mobile-demo">
      <li><a href="sass.html">Sass</a></li>
      <li><a href="badges.html">Components</a></li>
      <li><a href="collapsible.html">Javascript</a></li>
      <li><a href="mobile.html">Mobile</a></li>
    </ul>
  </div>
</nav>
</div>

<!-- VER ESTO!!!! -->




<div id="registro" class="modal">
  <div class="modal-content">
    <h4 id="modelId" class="center-align flow-text">Registrarse</h4>

    <section id="section_create">

      <?php echo Form::open(['route' => ['register'],  'method' => 'POST', 'files' => true]); ?>


      <?php echo e(csrf_field()); ?>


      <div style="margin-top: -1.0%">

       <div class="row">
        <div class="input-field col s10">
          <i style="margin-top: 0.7%" class="material-icons prefix">account_circle</i>
          <input id="name" type="text" class="validate" name="name" value="<?php echo e(old('name')); ?>" required autofocus>
          <label for="icon_prefix">Nombre Completo</label>

          <?php if($errors->has('name')): ?>
          <span class="help-block">
            <strong><?php echo e($errors->first('name')); ?></strong>
          </span>
          <?php endif; ?>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s10">
          <i style="margin-top: 0.7%" class="material-icons prefix">email</i>
          <input id="email" type="email" class="validate" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
          <label for="icon_prefix">Email</label>

          <?php if($errors->has('email')): ?>
          <span class="help-block">
            <strong><?php echo e($errors->first('email')); ?></strong>
          </span>
          <?php endif; ?>
        </div>
      </div>


<div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix">https</i>
          <input id="password" type="password" class="validate" name="password" required autofocus>
          <label for="icon_prefix">Clave</label>
          <?php if($errors->has('password')): ?>
          <span class="help-block">
            <strong><?php echo e($errors->first('password')); ?></strong>
          </span>
          <?php endif; ?>
        </div>
        <div class="input-field col s6">
          <input id="password-confirm" type="password" class="validate" name="password_confirmation" required autofocus>
          <label for="icon_prefix">Confirmar Clave</label>
        </div>
      </div>
    </form>
  </div>

  <div class="row">
        <div class="input-field col s10">
          <input id="avatar" type="file" class="validate" name="avatar" accept="image/*" autofocus>
        </div>
            <?php if($errors->has('avatar')): ?>
              <span class="help-block">
                  <strong><?php echo e($errors->first('avatar')); ?></strong>
              </span>
          <?php endif; ?>
      </div>

      <div class="center-align">
          <button type="submit" class="waves-light btn">
            Registrarse
          </button>
      </div>

</div>

      <?php echo Form::close(); ?>


    </section>

  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close btn-flat">Cerrar</a>
  </div>
</div>


<!-- LOGIN -->

<div id="login" class="modal">
  <div class="modal-content">
    <h4 id="modelId" class="center-align flow-text">Ingresar</h4>

    <section id="section_create">

    <?php echo Form::open(['route' => ['login'], 'method' => 'POST']); ?>



      <?php echo e(csrf_field()); ?>


<div style="margin-left: 9%; margin-top: -4%">
      <div class="row">
        <div class="input-field col s10">
          <i style="margin-top: 0.7%" class="material-icons prefix">email</i>
          <input id="email" type="email" class="validate" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
          <label for="icon_prefix">Email</label>

          <?php if($errors->has('email')): ?>
          <span class="help-block">
            <strong><?php echo e($errors->first('email')); ?></strong>
          </span>
          <?php endif; ?>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s10">
        <i style="margin-top: 0.7%" class="material-icons prefix">https</i>
          <input id="password" type="password" class="validate" name="password" required>
           <label for="password">Password</label>

          <?php if($errors->has('password')): ?>
          <span class="help-block">
            <strong><?php echo e($errors->first('password')); ?></strong>
          </span>
          <?php endif; ?>
        </div>
      </div>

 </div>     
          <div class="center-align">
            <label>
              <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?> class="filled-in" id="filled-in-box" checked="checked" />
              <label for="filled-in-box">Remember Me</label>
            </label>
          </div>

          <br>

      <div style="position: relative; left: 5%">
          <button type="submit" class="waves-light btn">
            Login
          </button>
      </div>

      <br>

      <div style="position: relative; margin-left: 70%; bottom: 54px">
          <a class="waves-effect waves-light" href="<?php echo e(route('password.request')); ?>">
            Forgot Your Password?
          </a>
      </div>


      <?php echo Form::close(); ?>



    </section>

  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close btn-flat">Cerrar</a>
  </div>
</div>


<script type="text/javascript">

  $(document).ready(function(){
    $('.modal').modal();
  });

</script>