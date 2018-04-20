<?php 
$usuario = $_SESSION['usuario']; ?>
<!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
        <div class="sidebar-toggle-box">
          <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Abrir/Esconder Menu"></div>
        </div>
        <!--logo start-->
        <a href="<?= base_url('Admin') ?>" class="logo"><b>Congresso: Pedagogia Histórico-crítica</b></a>
        <!--logo end-->


        <div class="top-menu">
         <ul class="nav pull-right top-menu">
          <li><a class="logout" href="<?= base_url('Admin/logout') ?>">Sair</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
        <div id="sidebar"  class="nav-collapse ">
          <!-- sidebar menu start-->
          <ul class="sidebar-menu" id="nav-accordion">

           <p class="centered"><a href="<?= base_url('Admin/profile') ?>"><img src="<?= base_url('assets/img/default.jpeg') ?>" class="img-circle" width="60"></a></p>
           <h5 class="centered"><?= $usuario->nome ?></h5>



           <li class="sub-menu">
            <a href="<?= base_url('Parecerista') ?>" >
              <i class="fa fa-home"></i>
              <span>Página Inicial</span>
            </a>
          </li>

          <li class="sub-menu">
            <a href="<?= base_url('Parecerista/Pareceres') ?>" >
              <i class="fa fa-edit"></i>
              <span>Meus Pareceres</span>
            </a> 
          </li>

          <li class="sub-menu">
            <a href="<?= base_url('Admin/profile') ?>" >
              <i class="fa fa-file"></i>
              <span>Alterar Meus Dados</span>
            </a>
          </li>

          

          <li class="sub-menu">
            <a href="<?= base_url('Admin/logout') ?>" >
              <i class="fa fa-times"></i>
              <span>Sair</span>
            </a>
          </li>



        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->