<aside class="sidebar-wrapper">
    <div class="sidebar-header">
    @php
        $logoSetting = \App\Helpers\CommonHelper::masterSettingsName('logo');
        $fileStorage = \App\Helpers\CommonHelper::masterSettingsName('file_storage')['master_value'] ?? 'local'; // Default to local if not set
    @endphp
    <div class="logo-icon">
        <img src="{{ $logoSetting['master_value'] }}" class="logo-img" alt="Logo" style="width: 80px; height: auto;">
    </div>
      <div class="logo-name flex-grow-1">
        <h5 class="mb-0">{{ \App\Helpers\CommonHelper::masterSettingsName('name')['master_value'] }}</h5>
      </div>
      <div class="sidebar-close">
        <span class="material-icons-outlined">close</span>
      </div>
    </div>
    <div class="sidebar-nav" data-simplebar="true">
        <!--navigation-->
        <ul class="metismenu" id="sidenav">
          <li>
            <a href="/">
              <div class="parent-icon"><i class="material-icons-outlined">home</i>
              </div>
              <div class="menu-title">Dashboard</div>
            </a>
          </li>
          
          @if(auth()->user()->can('create users') || auth()->user()->can('edit users') || auth()->user()->can('view users') || auth()->user()->can('delete users') || auth()->user()->can('create roles') || auth()->user()->can('view roles') || auth()->user()->can('edit roles') || auth()->user()->can('delete roles') 
          || auth()->user()->can('view features') || auth()->user()->can('feature status'))
          <li class="menu-label">ALL USERS</li>
          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><i class="material-icons-outlined">business</i>
              </div>
              <div class="menu-title">Users</div>
            </a>
            <ul>
              @if(auth()->user()->can('create users') || auth()->user()->can('view users') || auth()->user()->can('edit users') || auth()->user()->can('delete users'))
              <li><a href="{{ route('users.index') }}"><i class="material-icons-outlined">arrow_right</i>Users</a>
              </li>
              @endif
              @if(auth()->user()->can('create roles') || auth()->user()->can('edit roles') || auth()->user()->can('view roles') || auth()->user()->can('delete roles'))
              <li><a href="{{ route('roles.index') }}"><i class="material-icons-outlined">arrow_right</i>Roles</a>
              </li>
              @endif
              @if(auth()->user()->can('view features') || auth()->user()->can('feature status'))
              <li><a href="{{ route('features') }}"><i class="material-icons-outlined">arrow_right</i>Features</a>
              </li>
              @endif
            </ul>
          </li>
          @endif

          @if(auth()->user()->can('create customer') || auth()->user()->can('edit customer') || auth()->user()->can('delete customer'))
          <li>
          <a href="customer.customers">
              <div class="parent-icon">
                  <i class="material-icons-outlined">group</i>
              </div>
              <div class="menu-title">Customers</div>
          </a>
          </li>
          @endif
          @if(auth()->user()->user_type == 1)
          <li class="menu-label">SETTINGS</li>
          <li>
          <a href="{{ route('master-setting') }}">
              <div class="parent-icon">
                  <i class="material-icons-outlined">settings</i>
              </div>
              <div class="menu-title">Master Setting</div>
          </a>
          </li>
          @endif

          <li class="menu-label">Tranasaction</li>
          @if(auth()->user()->user_type = 1 || auth()->user()->user_type = 2)
          <li>
          <a href="{{ route('transaction') }}">
            <div class="parent-icon">
                <i class="material-icons-outlined">credit_card</i>
            </div>
              <div class="menu-title">All Tranasaction</div>
          </a>
          </li>
          @endif
         </ul>
        <!--end navigation-->
    </div>
    <div class="sidebar-bottom gap-4">
        <div class="dark-mode">
          <a href="javascript:;" class="footer-icon dark-mode-icon">
            <i class="material-icons-outlined">dark_mode</i>  
          </a>
        </div>
        <div class="dropdown dropup-center dropup dropdown-laungauge">
          <a class="dropdown-toggle dropdown-toggle-nocaret footer-icon" href="avascript:;" data-bs-toggle="dropdown"><img src="{{ URL::asset('build/images/county/02.png') }}" width="22" alt="">
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="{{ URL::asset('build/images/county/01.png') }}" width="20" alt=""><span class="ms-2">English</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="{{ URL::asset('build/images/county/02.png') }}" width="20" alt=""><span class="ms-2">Catalan</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="{{ URL::asset('build/images/county/03.png') }}" width="20" alt=""><span class="ms-2">French</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="{{ URL::asset('build/images/county/04.png') }}" width="20" alt=""><span class="ms-2">Belize</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="{{ URL::asset('build/images/county/05.png') }}" width="20" alt=""><span class="ms-2">Colombia</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="{{ URL::asset('build/images/county/06.png') }}" width="20" alt=""><span class="ms-2">Spanish</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="{{ URL::asset('build/images/county/07.png') }}" width="20" alt=""><span class="ms-2">Georgian</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="{{ URL::asset('build/images/county/08.png') }}" width="20" alt=""><span class="ms-2">Hindi</span></a>
            </li>
          </ul>
        </div>
        <div class="dropdown dropup-center dropup dropdown-help">
          <a class="footer-icon  dropdown-toggle dropdown-toggle-nocaret option" href="javascript:;"
            data-bs-toggle="dropdown" aria-expanded="false">
            <span class="material-icons-outlined">
              info
            </span>
          </a>
          <div class="dropdown-menu dropdown-option dropdown-menu-end shadow">
            <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                  class="material-icons-outlined fs-6">inventory_2</i>Archive All</a></div>
            <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                  class="material-icons-outlined fs-6">done_all</i>Mark all as read</a></div>
            <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                  class="material-icons-outlined fs-6">mic_off</i>Disable Notifications</a></div>
            <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                  class="material-icons-outlined fs-6">grade</i>What's new ?</a></div>
            <div>
              <hr class="dropdown-divider">
            </div>
            <div><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                  class="material-icons-outlined fs-6">leaderboard</i>Reports</a></div>
          </div>
        </div>

    </div>
</aside>
