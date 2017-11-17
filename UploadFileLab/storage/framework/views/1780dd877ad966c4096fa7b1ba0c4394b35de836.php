<div class="fixed-action-btn horizontal click-to-toggle">
    <a  href="#" data-activates="slide-out" class="button-collapse btn-floating btn-large red ">
      <i class="material-icons">menu</i>
    </a>
    </div>
    <ul id="slide-out" class="side-nav">
    <li><div class="user-view">
      <div class="background">
      </div>
      <a style="text-align: center" href="#!user"><img style="margin-left: 30%" class="circle" src="storage/<?php echo e(Auth::user()->avatar); ?>"><span style="font-size: 20px;" class="black-text flow-text name"><?php echo e(Auth::user()->name); ?></span></a>
    </div></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Propio</a></li>
    <li><a href="<?php echo e(route('files.index')); ?>"><i class="material-icons">cloud</i>Mi Nube</a></li>
    <li><a href="<?php echo e(route('files.create')); ?>"><i class="material-icons">archive</i>Subir Archivos</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">General</a></li>
    <li><a class="waves-effect" href="<?php echo e(route('allfiles')); ?>">Todos los archivos</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Configuracion</a></li>
    <li>
            <a href="<?php echo e(route('logout')); ?>"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <span>Cerrar Sesion</span>
          </a>
          <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo e(csrf_field()); ?>

          </form>
        </li>
  </ul>