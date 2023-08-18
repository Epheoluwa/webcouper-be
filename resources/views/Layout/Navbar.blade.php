  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
      <div class="container d-flex align-items-center">

          <h1 class="logo me-auto"><a href=""></a></h1>

          <nav id="navbar" class="navbar">
              <ul>
                  <li><a class="nav-link scrollto active" href="{{ route('/') }}">Recipes</a></li>
                  <li><a class="nav-link scrollto" href="{{ route('resturants') }}">Resturants</a></li>
                  <li><a class="nav-link scrollto" href="{{ route('profile') }}">User Profile</a></li>
                  <li><a class="nav-link scrollto" href="{{ route('allusers') }}">View All Users</a></li>
                  <li><a class="getstarted scrollto" href="{{ route('deactivate') }}">Deactivate Account</a></li>
                  <li><a class="getstarted scrollto" href="{{ route('logout') }}">Logout</a></li>
              </ul>
              <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->

      </div>
  </header><!-- End Header -->