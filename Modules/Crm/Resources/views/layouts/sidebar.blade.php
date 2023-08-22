<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <a href="{{ action('\Modules\Crm\Http\Controllers\DashboardController@index') }}" class="logo">
            <span class="logo-lg">{{ Session::get('business.name') }}</span>
        </a>

        <!-- Sidebar Menu -->
        {{-- {!! Menu::render('contact-sidebar-menu', 'adminltecustom') !!} --}}

        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="active"><a href="{{ route('contact-dashboard.index') }}"><i class="fa fas fa-tachometer-alt"></i>
                    <span>Home</span></a></li>
            <li><a href="{{ url('contact/contact-purchases') }}"><i class="fa fas fa-list"></i> <span>List
                        Purchases</span></a></li>
            <li><a href="{{ url('contact/contact-sells') }}"><i class="fa fas fa-list"></i> <span>All
                        sales</span></a></li>
            <li><a href="{{ url('contact/contact-ledger') }}"><i class="fas fa-scroll"></i>
                    <span>Ledger</span></a></li>
            <li><a href="{{ url('/contact/bookings') }}"><i class="fas fa fa-calendar-check"></i>
                    <span>Bookings</span></a></li>
            <li><a href="{{ url('/contact/order-request') }}"><i class="fa fas fa-arrow-circle-up"></i>
                    <span>Order Request</span></a></li>

            <li><a href="{{ url('/contact/property-wanted') }}"><i class="fa fas fa-arrow-circle-up"></i>
                    <span>Property Wanted</span></a></li>

            <li><a href="{{ url('/contact/room-to-rent') }}"><i class="fa fas fa-arrow-circle-up"></i>
                    <span>Room to rent</span></a></li>

            <li><a href="{{ url('/contact/education') }}"><i class="fa fas fa-arrow-circle-up"></i>
                    <span>Education</span></a></li>

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
