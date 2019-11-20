<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
  <div class="c-sidebar-brand">
      <img style="margin : -27px auto;" class="c-sidebar-brand-full" src="{{ asset('assets/img/ppt_header.png')}}" width="208" height="146" alt="CoreUI Logo">
      <img class="c-sidebar-brand-minimized" src="{{ asset('assets/img/ppt_header_putih.png')}}" width="50" height="46" alt="CoreUI Logo">
  </div>
  <ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item c-sidebar-nav-item-header text-center p-1" style="background: rgba(0, 0, 5, 0.1);">
      Menu
    </li>
    <li class="c-sidebar-nav-item ">
      <a class="c-sidebar-nav-link" href="{{ url('admin/') }}">
          <span class="c-sidebar-nav-icon">
                <i class="fa fa-dashboard"></i>   
          </span>
        Dashboard
      </a>
    </li>
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="{{ route('uangmasuk.index') }}">
        <span class="c-sidebar-nav-icon">
          <i class="fa fa-sign-in"></i>   
        </span> Uang Masuk
      </a>
    </li>
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="{{ route('uangkeluar.index') }}">
        <span class="c-sidebar-nav-icon">
          <i class="fa fa-sign-out"></i>   
        </span> Uang Keluar
      </a>
    </li>
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="{{ route('kajian.index') }}">
        <span class="c-sidebar-nav-icon">
          <i class="fa fa-users"></i>   
        </span> Kajian
      </a>
    </li>
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="{{ route('kegiatan.index') }}">
        <span class="c-sidebar-nav-icon">
          <i class="fa fa-sticky-note"></i>   
        </span> Agenda
      </a>
    </li>
   
  </ul>
  <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>