<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <a href="{{ route('home') }}" class="logo">
            <span class="logo-lg">{{ Session::get('business.name') }}</span>
        </a>

        <!-- Sidebar Menu -->
        {{-- {!! Menu::render('admin-sidebar-menu', 'adminltecustom') !!} --}}
        <ul class="sidebar-menu tree" data-widget="tree">
            <li><a href="{{ route('home') }}"><i class="fa fas fa-tachometer-alt"></i> <span>Home</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-users"></i> <span>User Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('users.index') }}"><i class="fa fas fa-user"></i> <span>Users</span></a></li>
                    <li><a href="{{ route('roles.index') }}"><i class="fa fas fa-briefcase"></i> <span>Roles</span></a>
                    </li>
                    <li><a href="{{ route('sales-commission-agents.index') }}"><i class="fa fas fa-handshake"></i>
                            <span>Sales Commission Agents</span></a></li>
                </ul>
            </li>
            <li class="treeview" id="tour_step4">
                <a href="#">
                    <i class="fa fas fa-address-book"></i> <span>Contacts</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="contacts?type=supplier"><i class="fa fas fa-star"></i>
                            <span>Suppliers</span></a></li>
                    <li><a href="contacts?type=customer"><i class="fa fas fa-star"></i>
                            <span>Customers</span></a></li>
                    <li><a href="customer-group"><i class="fa fas fa-users"></i> <span>Customer
                                Groups</span></a></li>
                    <li><a href="contacts/import"><i class="fa fas fa-download"></i> <span>Import
                                Contacts</span></a></li>
                </ul>
            </li>
            <li class="treeview" id="tour_step5">
                <a href="#">
                    <i class="fa fas fa-cubes"></i> <span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="products"><i class="fa fas fa-list"></i> <span>List
                                Products</span></a></li>
                    <li><a href="products/create"><i class="fa fas fa-plus-circle"></i> <span>Add
                                Product</span></a></li>
                    <li><a href="labels/show"><i class="fa fas fa-barcode"></i> <span>Print
                                Labels</span></a></li>
                    <li><a href="variation-templates"><i class="fa fas fa-circle"></i>
                            <span>Variations</span></a></li>
                    <li><a href="import-products"><i class="fa fas fa-download"></i> <span>Import
                                Products</span></a></li>
                    <li><a href="import-opening-stock"><i class="fa fas fa-download"></i>
                            <span>Import Opening Stock</span></a></li>
                    <li><a href="selling-price-group"><i class="fa fas fa-circle"></i>
                            <span>Selling Price Group</span></a></li>
                    <li><a href="units"><i class="fa fas fa-balance-scale"></i>
                            <span>Units</span></a></li>
                    <li><a href="taxonomies?type=product"><i class="fa fas fa-tags"></i>
                            <span>Categories</span></a></li>
                    <li><a href="brands"><i class="fa fas fa-gem"></i>
                            <span>Brands</span></a></li>
                    <li><a href="warranties"><i class="fa fas fa-shield-alt"></i>
                            <span>Warranties</span></a></li>
                </ul>
            </li>
            <li><a href="manufacturing/recipe" style=""><i class="fa fas fa-industry"></i>
                    <span>Manufacturing</span></a></li>
            <li class="treeview" id="tour_step6">
                <a href="#">
                    <i class="fa fas fa-arrow-circle-down"></i> <span>Purchases</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="purchases"><i class="fa fas fa-list"></i> <span>List
                                Purchases</span></a></li>
                    <li><a href="purchases/create"><i class="fa fas fa-plus-circle"></i> <span>Add
                                Purchase</span></a></li>
                    <li><a href="purchase-return"><i class="fa fas fa-undo"></i> <span>List
                                Purchase Return</span></a></li>
                </ul>
            </li>
            <li class="treeview" id="tour_step7">
                <a href="#">
                    <i class="fa fas fa-arrow-circle-up"></i> <span>Sell</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="sells"><i class="fa fas fa-list"></i> <span>All sales</span></a>
                    </li>
                    <li><a href="sells/create"><i class="fa fas fa-plus-circle"></i> <span>Add
                                Sale</span></a></li>
                    <li><a href="pos"><i class="fa fas fa-list"></i> <span>List POS</span></a>
                    </li>
                    <li><a href="pos/create"><i class="fa fas fa-plus-circle"></i>
                            <span>POS</span></a></li>
                    <li><a href="sells/create?status=draft"><i class="fa fas fa-plus-circle"></i>
                            <span>Add Draft</span></a></li>
                    <li><a href="sells/drafts"><i class="fa fas fa-pen-square"></i> <span>List
                                Drafts</span></a></li>
                    <li><a href="sells/create?status=quotation"><i
                                class="fa fas fa-plus-circle"></i> <span>Add Quotation</span></a></li>
                    <li><a href="sells/quotations"><i class="fa fas fa-pen-square"></i>
                            <span>List quotations</span></a></li>
                    <li><a href="sell-return"><i class="fa fas fa-undo"></i> <span>List Sell
                                Return</span></a></li>
                    <li><a href="shipments"><i class="fa fas fa-truck"></i>
                            <span>Shipments</span></a></li>
                    <li><a href="discount"><i class="fa fas fa-percent"></i>
                            <span>Discounts</span></a></li>
                    <li><a href="sells/subscriptions"><i class="fa fas fa-recycle"></i>
                            <span>Subscriptions</span></a></li>
                    <li><a href="import-sales"><i class="fa fas fa-file-import"></i>
                            <span>Import Sales</span></a></li>
                    <li><a href="crm/order-request"><i class="fa fas fa-sync"></i> <span>Order
                                Request</span></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-truck"></i> <span>Stock Transfers</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="stock-transfers"><i class="fa fas fa-list"></i> <span>List
                                Stock Transfers</span></a></li>
                    <li><a href="stock-transfers/create"><i class="fa fas fa-plus-circle"></i>
                            <span>Add Stock Transfer</span></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-database"></i> <span>Stock Adjustment</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="stock-adjustments"><i class="fa fas fa-list"></i> <span>List
                                Stock Adjustments</span></a></li>
                    <li><a href="stock-adjustments/create"><i class="fa fas fa-plus-circle"></i>
                            <span>Add Stock Adjustment</span></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-minus-circle"></i> <span>Expenses</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="expenses"><i class="fa fas fa-list"></i> <span>List
                                Expenses</span></a></li>
                    <li><a href="expenses/create"><i class="fa fas fa-plus-circle"></i>
                            <span>Add Expense</span></a></li>
                    <li><a href="expense-categories"><i class="fa fas fa-circle"></i>
                            <span>Expense Categories</span></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-money-check-alt"></i> <span>Payment Accounts</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="account/account"><i class="fa fas fa-list"></i> <span>List
                                Accounts</span></a></li>
                    <li><a href="account/balance-sheet"><i class="fa fas fa-book"></i>
                            <span>Balance Sheet</span></a></li>
                    <li><a href="account/trial-balance"><i class="fa fas fa-balance-scale"></i>
                            <span>Trial Balance</span></a></li>
                    <li><a href="account/cash-flow"><i class="fa fas fa-exchange-alt"></i>
                            <span>Cash Flow</span></a></li>
                    <li><a href="account/payment-account-report"><i
                                class="fa fas fa-file-alt"></i> <span>Payment Account Report</span></a></li>
                </ul>
            </li>
            <li class="treeview" id="tour_step8">
                <a href="#">
                    <i class="fa fas fa-chart-bar"></i> <span>Reports</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="reports/profit-loss"><i
                                class="fa fas fa-file-invoice-dollar"></i> <span>Profit / Loss Report</span></a></li>
                    <li><a href="reports/purchase-sell"><i class="fa fas fa-exchange-alt"></i>
                            <span>Purchase &amp; Sale</span></a></li>
                    <li><a href="reports/tax-report"><i class="fa fas fa-percent"></i> <span>Tax
                                Report</span></a></li>
                    <li><a href="reports/customer-supplier"><i
                                class="fa fas fa-address-book"></i> <span>Supplier &amp; Customer Report</span></a>
                    </li>
                    <li><a href="reports/customer-group"><i class="fa fas fa-users"></i>
                            <span>Customer Groups Report</span></a></li>
                    <li><a href="reports/stock-report"><i class="fa fas fa-hourglass-half"></i>
                            <span>Stock Report</span></a></li>
                    <li><a href="reports/stock-adjustment-report"><i
                                class="fa fas fa-sliders-h"></i> <span>Stock Adjustment Report</span></a></li>
                    <li><a href="reports/trending-products"><i class="fa fas fa-chart-line"></i>
                            <span>Trending Products</span></a></li>
                    <li><a href="reports/items-report"><i class="fa fas fa-tasks"></i>
                            <span>Items Report</span></a></li>
                    <li><a href="reports/product-purchase-report"><i
                                class="fa fas fa-arrow-circle-down"></i> <span>Product Purchase Report</span></a></li>
                    <li><a href="reports/product-sell-report"><i
                                class="fa fas fa-arrow-circle-up"></i> <span>Product Sell Report</span></a></li>
                    <li><a href="reports/purchase-payment-report"><i
                                class="fa fas fa-search-dollar"></i> <span>Purchase Payment Report</span></a></li>
                    <li><a href="reports/sell-payment-report"><i
                                class="fa fas fa-search-dollar"></i> <span>Sell Payment Report</span></a></li>
                    <li><a href="reports/expense-report"><i class="fa fas fa-search-minus"></i>
                            <span>Expense Report</span></a></li>
                    <li><a href="reports/register-report"><i class="fa fas fa-briefcase"></i>
                            <span>Register Report</span></a></li>
                    <li><a href="reports/sales-representative-report"><i
                                class="fa fas fa-user"></i> <span>Sales Representative Report</span></a></li>
                    <li><a href="reports/table-report"><i class="fa fas fa-table"></i>
                            <span>Table Report</span></a></li>
                    <li><a href="reports/service-staff-report"><i
                                class="fa fas fa-user-secret"></i> <span>Service Staff Report</span></a></li>
                    <li><a href="reports/activity-log"><i class="fa fas fa-user-secret"></i>
                            <span>Activity Log</span></a></li>
                </ul>
            </li>
            <!-- Services Start -->
            <li class="treeview" id="tour_step9">
                <a href="#">
                    <i class="fa fas fa-chart-bar"></i> <span>Services</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('property-wanted.index') }}"><i class="fa fas fa-user-secret"></i>
                            <span>Property Wanted</span></a></li>

                    <li><a href="{{ route('service-advertise.index') }}"><i class="fa fas fa-user-secret"></i>
                            <span>Room Advertise</span></a></li>
                </ul>
            </li>
            <!-- Services End -->
            <li><a href="bookings"><i class="fas fa fa-calendar-check"></i>
                    <span>Bookings</span></a></li>
            <li><a href="modules/kitchen"><i class="fa fas fa-fire"></i>
                    <span>Kitchen</span></a></li>
            <li><a href="modules/orders"><i class="fa fas fa-list-alt"></i>
                    <span>Orders</span></a></li>
            <li><a href="notification-templates"><i class="fa fas fa-envelope"></i>
                    <span>Notification Templates</span></a></li>
            <li class="treeview" id="tour_step3">
                <a href="#">
                    <i class="fa fas fa-cog"></i> <span>Settings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="business/settings" id="tour_step2"><i
                                class="fa fas fa-cogs"></i> <span>Business Settings</span></a></li>
                    <li><a href="business-location"><i class="fa fas fa-map-marker"></i>
                            <span>Business Locations</span></a></li>
                    <li><a href="invoice-schemes"><i class="fa fas fa-file"></i> <span>Invoice
                                Settings</span></a></li>
                    <li><a href="barcodes"><i class="fa fas fa-barcode"></i> <span>Barcode
                                Settings</span></a></li>
                    <li><a href="printers"><i class="fa fas fa-share-alt"></i> <span>Receipt
                                Printers</span></a></li>
                    <li><a href="tax-rates"><i class="fa fas fa-bolt"></i> <span>Tax
                                Rates</span></a></li>
                    <li><a href="modules/tables"><i class="fa fas fa-table"></i>
                            <span>Tables</span></a></li>
                    <li><a href="modules/modifiers"><i class="fa fas fa-pizza-slice"></i>
                            <span>Modifiers</span></a></li>
                    <li><a href="types-of-service"><i class="fa fas fa-user-circle"></i>
                            <span>Types of service</span></a></li>
                    <li><a href="subscription"><i class="fa fas fa-sync"></i> <span>Package
                                Subscription</span></a></li>
                </ul>
            </li>
            <li><a href="crm/dashboard"><i class="fas fa fa-broadcast-tower"></i>
                    <span>CRM</span></a></li>
            <li><a href="project/project?project_view=list_view" style=""><i
                        class="fa fa-project-diagram"></i> <span>Project</span></a></li>
            <li><a href="hrm/dashboard" style=""><i class="fa fas fa-users"></i>
                    <span>HRM</span></a></li>
            <li><a href="essentials/todo" style=""><i class="fa fas fa-check-circle"></i>
                    <span>Essentials</span></a></li>
            <li><a href="woocommerce" style=""><i class="fab fa-wordpress"></i>
                    <span>Woocommerce</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
