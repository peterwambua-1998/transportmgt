<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Layout</div>
        <ul class="pcoded-item pcoded-left-item">
            @if (Auth::user()->user_type == 'office staff' || Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'supervisor'  || Auth::user()->user_type == 'manager'  || Auth::user()->user_type == 'office_executive')
                
            

            <li class="{{ activeSegment('home') }}">
                <a href="{{ route('home') }}">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            {{--
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                    <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Components</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="accordion.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Accordion</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="breadcrumb.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Breadcrumbs</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="button.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Button</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="tabs.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Tabs</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="color.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Color</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="label-badge.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Label Badge</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="tooltip.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Tooltip</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="typography.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Typography</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="notification.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Notification</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="icon-themify.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Themify</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>
            ---}}
        </ul>
        {{--<div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms">Forms &amp; Tables</div>--}}
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{activeSegment('students') }}">
                <a href="{{ route('students.index') }}">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Students</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <li class="{{activeSegment('parents') }}">
                <a href="{{ route('parents.index') }}">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Parents</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <li class="{{activeSegment('vehicles') }}">
                <a href="{{ route('vehicles.index') }}">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Vehicles</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ activeSegment('drivers') }}">
                
                <a href="{{ route('drivers.index') }}">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Drivers</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <li class="{{ activeSegment('routes') }}">
                
                <a href="{{ route('routes.index') }}">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Routes</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <li class="{{ activeSegment('staff') }}">
                
                <a href="{{ route('staff_index') }}">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Staff</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <li class="{{ activeSegment('tracker') }}">
                
                <a href="{{ route('tracker') }}">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Tracker</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>


            <li class="{{ activeSegment('attendances') }}">
                
                <a href="{{ route('attendances.index') }}">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Attendance</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            {{--
            <li class="{{ activeSegment('settings') }}">
                
                <a href="{{ route('settings.create') }}">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Settings</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            --}}

            <li class="{{ activeSegment('chatify') }}">
                
                <a href="{{ route('chatify') }}">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Chat</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            @endif

            @if (Auth::user()->user_type == 'teacher')
                <li class="{{ activeSegment('school-attendance.create') }}">
                    <a href="{{ route('school-attendance.create') }}">
                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Mark Attendance</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>

                <li class="{{ activeSegment('school-attendance/index') }}">
                    <a href="{{ route('school-attendance.index') }}">
                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Attendance List</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->user_type == 'parent')
            <li class="{{ activeSegment('phome') }}">
                <a href="{{ route('phome') }}">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ activeSegment('children') }}">
                <a href="{{ route('pchildren', Auth::user()->id) }}">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Children</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ activeSegment('pinvoices') }}">

                <a href="{{ route('pinvoice', Auth::user()->id) }}">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Paid Invoices</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ activeSegment('unpinvoices') }}">
                <a href="{{ route('unpinvoice', Auth::user()->id) }}">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Unpaid Invoices</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <li class="{{ activeSegment('pnotification') }}">
                <a href="{{ route('pnotification_get') }}">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Notifications <label class="label label-danger" style="border-radius: 50%; text-align:center; align-items: center">{{ $numOfNotifications }}</label></span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <li class="{{ activeSegment('chatify') }}">
                
                <a href="{{ route('chatify') }}">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Chat</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            @endif
        </ul>

        {{--<div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms">Chart &amp; Maps</div>--}}
        <ul class="pcoded-item pcoded-left-item">
            @if (Auth::user()->user_type == 'office staff' || Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'supervisor'  || Auth::user()->user_type == 'manager'  || Auth::user()->user_type == 'office_executive')
            
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)" class="{{ activeSegment('invoices') }}">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                    <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Invoices</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{ route('invoice_paid') }}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Paid</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('invoice_unpaid') }}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Unpaid</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" " class="{{ activeSegment('invoices') }}">
                        <a href="{{ route('invoice_all') }}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">All Invoices</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>

        <ul class="pcoded-item pcoded-left-item">
            @if (Auth::user()->user_type == 'office staff' || Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'supervisor'  || Auth::user()->user_type == 'manager'  || Auth::user()->user_type == 'office_executive')
            
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)" class="{{ activeSegment('notification') }}">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                    <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Notifications</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{ route('notification_get') }}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Unread Notifications</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('pnotification_view') }}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">send Notification</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            @endif
        </ul>



        <ul class="pcoded-item pcoded-left-item">
            @if (Auth::user()->user_type == 'office staff' || Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'supervisor'  || Auth::user()->user_type == 'manager'  || Auth::user()->user_type == 'office_executive')
            
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)" class="{{ activeSegment('invoices') }}">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                    <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Reports</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{ route('att-report') }}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Attendance</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('financialview') }}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Transactions</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            @endif
        </ul>
    </div>
</nav>