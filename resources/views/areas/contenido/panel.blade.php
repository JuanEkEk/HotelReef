   <!-- Brand Logo -->
   <a href="" class="brand-link">
       <img src="{{ URL::asset('dist/img/reef.jpeg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="transform: translate(-15%, 25%); width: 50px">
       <span class="brand-text font-weight-light">Hotel Reef</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
       <!-- Sidebar user panel (optional) -->


       <!-- Sidebar Menu -->
       <nav class="mt-2">
           <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
               <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                   <a href="{{ url('perfil') }}" class="nav-link active">
                       <i class="nav-icon fas fa-id-card"></i>
                       <p>Perfil</p>
                   </a>

               </li>
               <li class="nav-item has-treeview menu-open">
                   <a href="#" class="nav-link active">
                       <i class="nav-icon fas fa-bars"></i>
                       <p>
                           Áreas
                           <i class="right fas fa-angle-left"></i>
                       </p>
                   </a>
                   <ul class="nav nav-treeview">

                       <li class="nav-item">
                           <a href="{{ url('contraloria') }}" class="nav-link">
                               <i class="fas fa-user nav-icon"></i>
                               <p>Contraloría</p>
                           </a>
                       </li>

                       <li class="nav-item">
                           <a href="{{ url('empleados') }}" class="nav-link">
                               <i class="fas fa-bed nav-icon"></i>
                               <p>División | Cuartos</p>
                           </a>
                       </li>

                       <li class="nav-item">
                           <a href="{{ url('alimentos') }}" class="nav-link">
                               <i class="fas fa-utensils nav-icon"></i>
                               <p>Alimentos y Bebidas</p>
                           </a>
                       </li>

                       <li class="nav-item">
                           <a href="{{ url('mantenimiento') }}" class="nav-link">
                               <i class="fas fa-user-cog nav-icon"></i>
                               <p>Mantenimiento</p>
                           </a>
                       </li>
                   </ul>
               </li>
               <li class="nav-item has-treeview menu-open">
                   <a href="#" class="nav-link active">
                       <i class="nav-icon fas fa-calendar-check"></i>
                       <p>
                           Control
                           <i class="right fas fa-angle-left"></i>
                       </p>
                   </a>
                   <ul class="nav nav-treeview">

                       <li class="nav-item">
                           <a href="{{ url('calendario') }}" class="nav-link">
                               <i class=" nav-icon fas fa-users"></i>
                               <p>Asistencias</p>
                           </a>
                       </li>
                   </ul>
               </li>
           </ul>
       </nav>
       <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
