<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        {{-- {!! Menu::render('contact-sidebar-menu', 'adminltecustom') !!} --}}

        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="active"><a href="{{ route('contact-dashboard.index') }}"><i class="fa fas fa-tachometer-alt"></i>
                    <span>Home</span></a></li>
            {{-- <li><a href="{{ url('contact/contact-purchases') }}"><i class="fa fas fa-list"></i> <span>List
                        Purchases</span></a></li> --}}
            {{-- <li><a href="{{ url('contact/contact-sells') }}"><i class="fa fas fa-list"></i> <span>My Orders</span></a></li> --}}
            <li><a href="{{ url('contact/contact-ledger') }}"><i class="fas fa-scroll"></i>
                    <span> &nbsp; Ledger</span></a></li>
            <li><a href="{{ url('/contact/bookings') }}"><i class="fas fa fa-calendar-check"></i>
                    <span>Bookings</span></a></li>
            {{-- <li><a href="{{ url('/contact/order-request') }}"><i class="fa fas fa-arrow-circle-up"></i>
                    <span>Order Request</span></a></li> --}}

            <li><a href="{{ url('/contact/property-wanted') }}"><i class="fa fas fa-arrow-circle-up"></i>
                    <span>Property Wanted</span></a></li>
            <li><a href="{{ url('/contact/products') }}"><i class="fa fas fa-arrow-circle-up"></i>
                    <span>My Orders</span></a></li>

            @php
                $uuid = optional(myInformation())->uuid;
            @endphp




            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-users"></i> <span>Jobs</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('recruitment.edit', ['id' => $uuid]) }}"><i class="fa fas fa-briefcase"></i>
                            <span>My Information</span></a>
                    </li>
                    <li><a href="{{ route('recruitment.appliedJobsCustomer', ['id' => $uuid]) }}"><i
                                class="fa fas fa-user"></i> <span>My Applications</span></a></li>
                </ul>
            </li>


            {{-- <li>
                <a href="{{ route('recruitment.edit', ['id' => $uuid]) }}">
                    <i class="fa fa-calendar"></i>
                    <span>My Information</span>
                </a>
            </li>

            <li>
                <a href="{{ route('recruitment.appliedJobsCustomer', ['id' => $uuid]) }}">
                    <i class="fa fa-calendar"></i>
                    <span>My Applications</span>
                </a>
            </li> --}}

            {{-- <li><a href="{{ url('/contact/service_wanted') }}"><i class="fas fa fa-calendar-check"></i>
                    <span>Service Wanted</span></a></li> --}}

            {{-- <li><a href="{{ url('/contact/education') }}"><i class="fa fas fa-arrow-circle-up"></i>
                    <span>Education</span></a></li> --}}

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
