 <!-- [ Sidebar Menu ] start -->

 <div class="navbar-wrapper">
     <div class="m-header">
         <a href="<?= getenv('APP_URL') ?>/" class="b-brand text-primary">
             <!-- ========   Change your logo from here   ============ -->
             <img src="<?= getenv('APP_URL') ?>/assets/images/logo-white.svg" alt="logo image" class="logo-lg">
             <span class="badge bg-primary rounded-pill ms-2 theme-version">v1.2</span>
         </a>
     </div>

     <div class="card pc-user-card">
         <div class="card-body">
             <div class="nav-user-image">
                 <a data-bs-toggle="collapse" href="#navuserlink">
                     <img src="<?= getenv('APP_URL') ?>/assets/images/user/avatar-1.jpg" alt="user-image" class="user-avtar rounded-circle">
                 </a>
             </div>
             <div class="pc-user-collpsed collapse" id="navuserlink">
                 <h4 class="mb-0">Jonh Smith</h4>
                 <span>Administrator</span>
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
     <div class="navbar-content">
         <ul class="pc-navbar">
             <li class="pc-item pc-caption">
                 <label>Painel</label>
             </li>
             <li class="pc-item pc-hasmenu">
                 <a href="#!" class="pc-link">
                     <span class="pc-micon">
                         <i class="ph-duotone ph-gauge"></i>
                     </span>
                     <span class="pc-mtext">Dashboard</span>
                     <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                 </a>
                 <ul class="pc-submenu">
                     <li class="pc-item"><a class="pc-link" href="<?= getenv('APP_URL') ?>/dashboard/index.html">Default</a></li>
                     <li class="pc-item"><a class="pc-link" href="<?= getenv('APP_URL') ?>/dashboard/affiliate.html">Affiliate</a></li>
                     <li class="pc-item"><a class="pc-link" href="<?= getenv('APP_URL') ?>/dashboard/analytics.html">Analytics</a></li>
                     <li class="pc-item"><a class="pc-link" href="<?= getenv('APP_URL') ?>/dashboard/ecommerce.html">E-commerce</a></li>
                     <li class="pc-item"><a class="pc-link" href="<?= getenv('APP_URL') ?>/dashboard/project.html">Project</a></li>
                 </ul>
             </li>

             <li class="pc-item pc-caption">
                 <label>Serviços</label>
                 <i class="ph-duotone ph-chart-pie"></i>
                 <span>Gerenciar Movimentações</span>
             </li>

             <li class="pc-item">
                 <a href="<?= getenv('APP_URL') ?>/ativo" class="pc-link">
                     <span class="pc-micon">
                         <i class="ph-duotone ph-identification-card"></i>
                     </span>
                     <span class="pc-mtext">Ativos</span>
                 </a>
             </li>

             <li class="pc-item">
                 <a href="<?= getenv('APP_URL') ?>/emprestimo" class="pc-link">
                     <span class="pc-micon">
                         <i class="ph-duotone ph-identification-card"></i>
                     </span>
                     <span class="pc-mtext">Empréstimo</span>
                 </a>
             </li>

             <li class="pc-item">
                 <a href="<?= getenv('APP_URL') ?>/movimentacao" class="pc-link">
                     <span class="pc-micon">
                         <i class="ph-duotone ph-identification-card"></i>
                     </span>
                     <span class="pc-mtext">Movimentação</span>
                 </a>
             </li>

             <li class="pc-item">
                 <a href="<?= getenv('APP_URL') ?>/transferencia" class="pc-link">
                     <span class="pc-micon">
                         <i class="ph-duotone ph-identification-card"></i>
                     </span>
                     <span class="pc-mtext">Transferências</span>
                 </a>
             </li>

             <li class="pc-item pc-caption">
                 <label>Cadastros</label>
             </li>
             <li class="pc-item pc-hasmenu">
                 <a href="#!" class="pc-link">
                     <span class="pc-micon">
                         <i class="ph-duotone ph-gauge"></i>
                     </span>
                     <span class="pc-mtext">Módulos</span>
                     <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                 </a>
                 <ul class="pc-submenu">
                     <li class="pc-item"><a href="<?= getenv('APP_URL') ?>/categoria" class="pc-link">
                             <span class="pc-micon">
                                 <i class="ph-duotone ph-identification-card"></i>
                             </span>
                             <span class="pc-mtext">Categorias</span>
                         </a></li>
                     <li class="pc-item"><a href="<?= getenv('APP_URL') ?>/departamento" class="pc-link">
                             <span class="pc-micon">
                                 <i class="ph-duotone ph-chart-pie"></i>
                             </span>
                             <span class="pc-mtext">Departamentos</span>
                         </a>
                     <li class="pc-item"> <a href="<?= getenv('APP_URL') ?>/fabricante" class="pc-link">
                             <span class="pc-micon">
                                 <i class="ph-duotone ph-identification-card"></i>
                             </span>
                             <span class="pc-mtext">Fabricantes</span>
                         </a>
                     </li>
                     <li class="pc-item"><a href="<?= getenv('APP_URL') ?>/fornecedor" class="pc-link">
                             <span class="pc-micon">
                                 <i class="ph-duotone ph-database"></i>
                             </span>
                             <span class="pc-mtext">Fornecedores</span>
                         </a>
                     </li>
                     <li class="pc-item"><a href="<?= getenv('APP_URL') ?>/modulo" class="pc-link">
                             <span class="pc-micon">
                                 <i class="ph-duotone ph-chart-pie"></i>
                             </span>
                             <span class="pc-mtext">Modulos</span></a>
                     </li>
                 </ul>
             </li>

             <li class="pc-item pc-caption">
                 <label>Usuários</label>
                 <i class="ph-duotone ph-chart-pie"></i>
                 <span>Gerenciar Usuários</span>
             </li>
             <li class="pc-item">
                 <a href="/usuario" class="pc-link">
                     <span class="pc-micon">
                         <i class="ph-duotone ph-projector-screen-chart"></i>
                     </span>
                     <span class="pc-mtext">Usuários</span>
                 </a>
             </li>

             <li class="pc-item pc-caption">
                 <label>Other</label>
                 <i class="ph-duotone ph-suitcase"></i>
                 <span>Extra More Things</span>
             </li>
             <li class="pc-item pc-hasmenu">
                 <a href="#!" class="pc-link"><span class="pc-micon">
                         <i class="ph-duotone ph-tree-structure"></i> </span><span class="pc-mtext">Menu levels</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                 <ul class="pc-submenu">
                     <li class="pc-item"><a class="pc-link" href="#!">Level 2.1</a></li>
                     <li class="pc-item pc-hasmenu">
                         <a href="#!" class="pc-link">Level 2.2<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                         <ul class="pc-submenu">
                             <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                             <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                             <li class="pc-item pc-hasmenu">
                                 <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                                 <ul class="pc-submenu">
                                     <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                                     <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                                 </ul>
                             </li>
                         </ul>
                     </li>
                     <li class="pc-item pc-hasmenu">
                         <a href="#!" class="pc-link">Level 2.3<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                         <ul class="pc-submenu">
                             <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                             <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                             <li class="pc-item pc-hasmenu">
                                 <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                                 <ul class="pc-submenu">
                                     <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                                     <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                                 </ul>
                             </li>
                         </ul>
                     </li>
                 </ul>
             </li>
             <li class="pc-item"><a href="../other/sample-page.html" class="pc-link">
                     <span class="pc-micon">
                         <i class="ph-duotone ph-desktop"></i>
                     </span>
                     <span class="pc-mtext">Sample page</span></a></li>

         </ul>
         <div class="card nav-action-card">
             <div class="card-body">
                 <h5 class="text-white">Help Center</h5>
                 <p class="text-white text-opacity-75">Please contact us for more questions.</p>
                 <a target="_blank" href="https://phoenixcoded.authordesk.app/" class="btn btn-primary">Go to help Center</a>
             </div>
         </div>
     </div>
 </div>

 <!-- [ Sidebar Menu ] end -->