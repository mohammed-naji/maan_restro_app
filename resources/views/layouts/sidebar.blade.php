<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }} " aria-current="page" href="{{ route('dashboard') }}">
            <span data-feather="home"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Active('orders') }}" href="{{ route('orders.index') }}">
            <span data-feather="file"></span>
            Orders
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Active('categories') }}" href="{{ route('categories.index') }}">
              <span data-feather="layers"></span>
              Categories
            </a>
          </li>
        <li class="nav-item">
          <a class="nav-link {{ Active('meals') }}" href="{{ route('meals.index') }}">
            <span data-feather="shopping-cart"></span>
            Meals
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="users"></span>
            Customers
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="bar-chart-2"></span>
            Reports
          </a>
        </li>
      </ul>

    </div>
  </nav>
