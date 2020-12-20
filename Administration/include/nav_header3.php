
<style type="text/css">

.app-header {
  
  background-color: #f0ad4e;
 
}
.app-header__logo {
  background-color: #f0ad4e;
}
.app-sidebar__toggle:focus, .app-sidebar__toggle:hover {
  background-color: #dc3545;
}


.btn-primary {
  color: #fff;
  background-color:#009688; /*#6c757d*/
  border-color: #009688;
}
.btn-primary:hover {
  color: #fff;
  background-color: #009688;
  border-color: #009688;
}



a {
  color: #009688;
 
}

.page-link {
  color: #f0ad4e;
}
.page-item.active .page-link {
  z-index: 1;
  color: #000;
  background-color:#f0ad4e;
  border-color: #f0ad4e;
}


</style>


<header class="app-header"><a class="app-header__logo" href="dashboard.php">Administration</a>
    
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
       
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="edit-my-profile.php"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a class="dropdown-item" href="my-profile.php"><i class="fa fa-user fa-lg"></i> My Profile</a></li>
            <li><a class="dropdown-item" href="logout.php?logout=1"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>