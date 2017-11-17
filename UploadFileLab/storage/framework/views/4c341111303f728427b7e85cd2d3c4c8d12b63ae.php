 <link rel="stylesheet" href="<?php echo e(asset('plugins/materialize/css/materialize.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/icons/icons.css')); ?>">
  <script src="<?php echo e(asset('plugins/jquery/jquery-3.2.1.js')); ?>"></script>
  <script src="<?php echo e(asset('plugins/materialize/js/materialize.js')); ?>"></script>

<?php echo $__env->make('Admin.template.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startSection('title'); ?>
    Inicio de mi pagina
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>

<?php $__env->stopSection(); ?>


<?php if(Auth::User()): ?>
<div class="fixed-action-btn horizontal click-to-toggle">
    <a  href="#" data-activates="slide-out" class="button-collapse btn-floating btn-large red ">
      <i class="material-icons">menu</i>
    </a>
    </div>
    <ul id="slide-out" class="side-nav">
    <li><div class="user-view">
      <div class="background">
        <img src="images/office.jpg">
      </div>
      <a href="#!user"><img class="circle" src="storage/<?php echo e(Auth::user()->avatar); ?>"></a>
      <a href="#!name"><span class="black-text name"><?php echo e(Auth::user()->name); ?></span></a>
      <a href="#!email"><span class="black-text email"><?php echo e(Auth::user()->email); ?></span></a>
    </div></li>
    <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
    <li><a href="#!">Second Link</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Subheader</a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
    <li>
            <a href="<?php echo e(route('logout')); ?>"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <span>Logout</span>
          </a>
          <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo e(csrf_field()); ?>

          </form>
        </li>
  </ul>


<?php endif; ?>

<section>
    <div class="parallax-container">

      <div style="margin-top: 170px;" class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text text-lighten-2">Parallax Template</h1>
        <div class="row center">
          <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
        </div>
        <div class="row center">
          <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Get Started</a>
        </div>
        <br><br>

      </div>
      </div>

    <div class="parallax"><img src="<?php echo e(asset('image/first.jpeg')); ?>"></div>
  </div>
  <div class="section white">
    <div class="row container">



<div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Speeds up development</h5>

            <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">group</i></h2>
            <h5 class="center">User Experience Focused</h5>

            <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Easy to work with</h5>

            <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
          </div>
        </div>
      </div>


      <h2 class="header">Parallax</h2>
      <p class="grey-text text-darken-3 lighten-3">Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.</p>
    </div>
  </div>
  <div class="parallax-container">
    <div class="parallax"><img src="<?php echo e(asset('image/second.jpg')); ?>"></div>
  </div>

</section>

<?php echo $__env->make('admin.template.parts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
    
  // Initialize collapse button
  $(".button-collapse").sideNav();
  // Initialize collapsible (uncomment the line below if you use the dropdown variation)
  //$('.collapsible').collapsible();


  $(document).ready(function(){
      $('.parallax').parallax();
    });


</script>