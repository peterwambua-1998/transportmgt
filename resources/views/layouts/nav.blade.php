<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="ti-menu"></i>
            </a>
            <div class="mobile-search">
                <div class="header-search">
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                            <input type="text" class="form-control" placeholder="Enter Keyword">
                            <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <a href="">
                {{ $settings->company_name ?? 'company name' }}
            </a>
            <a class="mobile-options">
                <i class="ti-more"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li>
                    <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                </li>
                <li class="header-search">
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                            <input type="text" class="form-control">
                            <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="ti-fullscreen"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">

                @if (Auth::user()->user_type == 'office staff')
                    
                
                <li class="header-notification">
                    <a href="#!">
                        <i class="ti-bell"></i>
                        <span class="badge bg-c-pink"></span>
                    </a>
                    <ul class="show-notification">
                        <li>
                            <h6>Notifications</h6>
                            <label class="label label-danger">New</label>
                        </li>

                        @foreach ($notifications as $notification)

                        @if ($notification->type == 'App\Notifications\InvoicePaid')
                            
                        
                        <li>
                            <div class="media">
                                
                                <div class="media-body">

                                    @php
                                        
                                        $name = 'deleted';

                                        $user = App\User::where('id', '=', $notification->data['user'])->first();

                                        if ($user) {
                                            $name = $user->name;
                                        }
                                    @endphp
                                    <h5 class="notification-user">Paid Invoice</h5>
                                    <p class="notification-msg">Paid invoice from {{ $name }}, amount {{ $notification->data['amount'] }}</p>
                                    <span class="notification-time">{{ $notification->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </li>
                        @endif

                        @endforeach
                        
                        
                    </ul>
                </li>
                @endif

                
                <li class="user-profile header-notification">
                    <a href="#!">
                        
                        <span>{{Auth::user()->name}}</span>
                        <i class="ti-angle-down"></i>
                    </a>
                    <ul class="show-notification profile-notification">
                        @if (Auth::user()->user_type !== 'parent')
                        <li>
                            <a href="{{ route('settings.create') }}">
                                <i class="ti-settings"></i> Settings
                            </a>
                        </li>
                        @endif
                        
                        <li>
                            <a href="{{ route('profile_show', Auth::user()->id) }}">
                                <i class="ti-user"></i> Profile
                            </a>
                        </li>
                        
                        
                        <li>
                            <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="ti-layout-sidebar-left"></i> {{ __('Logout') }}
                            </a>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            
                            
                        
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>