 <!-- [ Sidebar Menu ] start -->

 <div class="navbar-wrapper">
     <div class="m-header">
         <a href="<?= getenv('APP_URL') ?>/" class="b-brand text-primary">
             <!-- ========   Change your logo from here   ============ -->
             <img src="<?= getenv('APP_URL') ?>/assets/images/Logo_wide.png" alt="logo image" class="logo-lg">
             <span class="badge bg-primary rounded-pill ms-2 theme-version">v2.5</span>
         </a>
     </div>

     <div class="card pc-user-card">
         <div class="card-body">
             <div class="nav-user-image">
                 <a data-bs-toggle="collapse" href="#navuserlink">
                     <img src="<?= getenv('APP_URL') ?>/assets/images/user/<?= $_SESSION['user']->avatar ?>" alt="user-image" class="user-avtar rounded-circle">
                 </a>
             </div>
             <div class="pc-user-collpsed collapse" id="navuserlink">
                 <h4 class="mb-0"><?= $_SESSION['user']->nome ?></h4>
                 <span><?= $_SESSION['user']->cargo ?></span>
                 <ul>
                     <li><a class="pc-user-links">
                             <i class="ph-duotone ph-user"></i>
                             <span>Minha Conta</span>
                         </a></li>
                     <li><a class="pc-user-links">
                             <i class="ph-duotone ph-gear"></i>
                             <span>Ajustes</span>
                         </a></li>
                     <li><a class="pc-user-links">
                             <i class="ph-duotone ph-lock-key"></i>
                             <span>Travar Tela</span>
                         </a></li>
                     <li><a href="/logout" class="pc-user-links">
                             <i class="ph-duotone ph-power"></i>
                             <span>Deslogar</span>
                         </a>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
     <?php
        $nivel_id = $_SESSION['user']->nivel_id;
        $menus = getModulosPermitidos($nivel_id);
        ?>
     <div class="navbar-content">
         <ul class="pc-navbar">
             <?php foreach ($menus as $menu): ?>
                 <li class="pc-item pc-caption">
                     <label><?= $menu->nome ?></label>
                     <i class="<?= $menu->icone ?>"></i>
                     <span><?= $menu->descricao ?></span>
                 </li>
                 <?php foreach ($menu->modulos as $modulo): ?>
                     <li class="pc-item">
                         <a href="<?= $modulo->rota ?>" class="pc-link">
                             <span class="pc-micon">
                                 <i class="<?= $modulo->icone ?>"></i></span>
                             <span class="pc-mtext"><?= $modulo->nome ?></span>
                         </a>
                     </li>
                 <?PHP endforeach; ?>
             <?php endforeach; ?>
         </ul>
     </div>
 </div>

 <!-- [ Sidebar Menu ] end -->