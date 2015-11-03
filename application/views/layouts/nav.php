<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
          <a class="brand" href="/rechum"><img src="<?php echo base_url();?>/assets/images/logo.png" alt=""></a>
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       <ul class="nav navbar-nav navbar-right">
        <li class="<?php echo active_link('empleados'); ?>"><a href="<?php echo base_url();?>empleados">Empleados</a></li>
        <li class="<?php echo active_link('captura'); ?>"><a href="<?php echo base_url();?>captura">Capturar Incidencias</a></li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
             Reportes <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <li><a href="<?=base_url()?>reportes/por_empleado"> Por Empleado</a></li>
            
            
            <li><a href="<?=base_url()?>reportes/general"> Por Quincena</a></li>
            
            <li><a href="<?=base_url()?>reportes/general"> Por Rango de fechas</a></li>
          </ul>
        </li>    
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
             <?=$nombre_de_usuario->nombres?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <li><a href="<?=base_url()?>admin"><i class="fa fa-cog"></i> Administrador</a></li>
            
            <li role="separator" class="divider"></li>
            <li><a href="<?=base_url()?>auth/logout"><i class="fa fa-sign-out"></i> Salir</a></li>
          </ul>
        </li>       
      </ul>
      

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



