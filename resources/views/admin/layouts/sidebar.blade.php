  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-end me-2 rotate-caret bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute start-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="me-1 text-sm text-dark">SCS DASHBOARD</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse px-0 w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{route('admin.dashboard')}}">
            <i class="material-symbols-rounded opacity-10">space_dashboard</i>
            <span class="nav-link-text me-1">لوحة القيادة</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{route('admin.articles')}}">
            <i class="material-symbols-rounded opacity-10">article</i>
            <span class="nav-link-text me-1">المقالات</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{ route('profile.edit') }}">
            <i class="material-symbols-rounded opacity-10">person</i>
            <span class="nav-link-text me-1">تعديل الحساب</span>
          </a>
        </li>

      @if (auth()->user()->role == 'admin')
        
          
      <li class="nav-item">
        <a class="nav-link text-dark" href="{{route('admin.users')}}">
          <i class="material-symbols-rounded opacity-10">group</i>
          <span class="nav-link-text me-1">المستخدمون</span>
        </a>
      </li>
      @endif
        <li class="nav-item">
            <a class="nav-link text-dark" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="material-symbols-rounded opacity-10">logout</i>
                <span class="nav-link-text me-1">تسجيل الخروج</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
            </form>
        </li>

      </ul>
    </div>
    {{-- <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn btn-outline-dark mt-4 w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard?ref=sidebarfree" type="button">Documentation</a>
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
      </div>
    </div> --}}
  </aside>