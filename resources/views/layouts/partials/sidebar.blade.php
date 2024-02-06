<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu tree" data-widget="tree">
            @if (auth()->user()->id == 5)
                <li><a href="{{ url('superadmin') }}"><i class="fa fas fa-users-cog"></i> <span>Superadmin</span></a></li>
            @endif
            <li><a href="{{ route('home') }}"><i class="fa fas fa-tachometer-alt"></i> <span>Home</span></a></li>

            </li>
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
                    <li><a href="{{ url('contacts?type=supplier') }}"><i class="fa fas fa-star"></i>
                            <span>Suppliers</span></a></li>
                    <li><a href="{{ url('contacts?type=customer') }}"><i class="fa fas fa-star"></i>
                            <span>Customers</span></a></li>
                    <li><a href="{{ route('customer-group.index') }}"><i class="fa fas fa-users"></i> <span>Customer
                                Groups</span></a></li>
                    <li><a href="{{ route('contacts.import') }}"><i class="fa fas fa-download"></i> <span>Import
                                Contacts</span></a></li>
                </ul>
            </li>
            <li class="treeview" id="tour_step5">
                <a href="#">
                    <i class="fa fas fa-cubes"></i> <span>Shops</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('shop.share.page') }}"><i class="fa fas fa-list"></i> <span>Shop
                                Share</span></a></li>
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
                    <li><a href="{{ route('product.resell.page') }}"><i class="fa fas fa-list"></i> <span>Resell
                                Products</span></a></li>
                    <li><a href="{{ route('products.index') }}"><i class="fa fas fa-list"></i> <span>List
                                Products</span></a></li>
                    <li><a href="{{ route('products.create') }}"><i class="fa fas fa-plus-circle"></i> <span>Add
                                Product</span></a></li>
                    <li><a href="{{ url('labels/show') }}"><i class="fa fas fa-barcode"></i> <span>Print
                                Labels</span></a></li>
                    <li><a href="{{ route('variation-templates.index') }}"><i class="fa fas fa-circle"></i>
                            <span>Variations</span></a></li>
                    <li><a href="{{ url('import-products') }}"><i class="fa fas fa-download"></i> <span>Import
                                Products</span></a></li>
                    <li><a href="{{ url('import-opening-stock') }}"><i class="fa fas fa-download"></i>
                            <span>Import Opening Stock</span></a></li>
                    <li><a href="{{ url('selling-price-group') }}"><i class="fa fas fa-circle"></i>
                            <span>Selling Price Group</span></a></li>
                    <li><a href="{{ route('units.index') }}"><i class="fa fas fa-balance-scale"></i>
                            <span>Units</span></a></li>
                    <li><a href="{{ url('taxonomies?type=product') }}"><i class="fa fas fa-tags"></i>
                            <span>Categories</span></a></li>
                    <li><a href="{{ route('brands.index') }}"><i class="fa fas fa-gem"></i>
                            <span>Brands</span></a></li>
                    <li><a href="{{ route('warranties.index') }}"><i class="fa fas fa-shield-alt"></i>
                            <span>Warranties</span></a></li>
                </ul>
            </li>
            <li><a href="{{ url('manufacturing/recipe') }}" style=""><i class="fa fas fa-industry"></i>
                    <span>Manufacturing</span></a></li>
            <li class="treeview" id="tour_step6">
                <a href="#">
                    <i class="fa fas fa-arrow-circle-down"></i> <span>Purchases</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('purchases.index') }}"><i class="fa fas fa-list"></i> <span>List
                                Purchases</span></a></li>
                    <li><a href="{{ route('purchases.create') }}"><i class="fa fas fa-plus-circle"></i> <span>Add
                                Purchase</span></a></li>
                    <li><a href="{{ url('purchase-return') }}"><i class="fa fas fa-undo"></i> <span>List
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
                    <li><a href="{{ route('sells.index') }}"><i class="fa fas fa-list"></i> <span>All
                                sales</span></a>
                    </li>
                    <li><a href="{{ route('sells.create') }}"><i class="fa fas fa-plus-circle"></i> <span>Add
                                Sale</span></a></li>
                    <li><a href="{{ route('pos.index') }}"><i class="fa fas fa-list"></i> <span>List POS</span></a>
                    </li>
                    <li><a href="{{ route('pos.create') }}"><i class="fa fas fa-plus-circle"></i>
                            <span>POS</span></a></li>
                    <li><a href="{{ url('sells/create?status=draft') }}"><i class="fa fas fa-plus-circle"></i>
                            <span>Add Draft</span></a></li>
                    <li><a href="{{ url('sells/drafts') }}"><i class="fa fas fa-pen-square"></i> <span>List
                                Drafts</span></a></li>
                    <li><a href="{{ url('sells/create?status=quotation') }}"><i class="fa fas fa-plus-circle"></i>
                            <span>Add
                                Quotation</span></a></li>
                    <li><a href="{{ url('sells/quotations') }}"><i class="fa fas fa-pen-square"></i>
                            <span>List quotations</span></a></li>
                    <li><a href="{{ route('sell-return.index') }}"><i class="fa fas fa-undo"></i> <span>List Sell
                                Return</span></a></li>
                    <li><a href="{{ url('shipments') }}"><i class="fa fas fa-truck"></i>
                            <span>Shipments</span></a></li>
                    <li><a href="{{ route('discount.index') }}"><i class="fa fas fa-percent"></i>
                            <span>Discounts</span></a></li>
                    <li><a href="{{ url('sells/subscriptions') }}"><i class="fa fas fa-recycle"></i>
                            <span>Subscriptions</span></a></li>
                    <li><a href="{{ url('import-sales') }}"><i class="fa fas fa-file-import"></i>
                            <span>Import Sales</span></a></li>
                    <li><a href="{{ url('crm/order-request') }}"><i class="fa fas fa-sync"></i> <span>Order
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
                    <li><a href="{{ route('stock-transfers.index') }}"><i class="fa fas fa-list"></i> <span>List
                                Stock Transfers</span></a></li>
                    <li><a href="{{ route('stock-transfers.create') }}"><i class="fa fas fa-plus-circle"></i>
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
                    <li><a href="{{ route('stock-adjustments.index') }}"><i class="fa fas fa-list"></i> <span>List
                                Stock Adjustments</span></a></li>
                    <li><a href="{{ route('stock-adjustments.create') }}"><i class="fa fas fa-plus-circle"></i>
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
                    <li><a href="{{ route('expenses.index') }}"><i class="fa fas fa-list"></i> <span>List
                                Expenses</span></a></li>
                    <li><a href="{{ route('expenses.create') }}"><i class="fa fas fa-plus-circle"></i>
                            <span>Add Expense</span></a></li>
                    <li><a href="{{ route('expense-categories.index') }}"><i class="fa fas fa-circle"></i>
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
                    <li><a href="{{ url('account/account') }}"><i class="fa fas fa-list"></i> <span>List
                                Accounts</span></a></li>
                    <li><a href="{{ url('account/balance-sheet') }}"><i class="fa fas fa-book"></i>
                            <span>Balance Sheet</span></a></li>
                    <li><a href="{{ url('account/trial-balance') }}"><i class="fa fas fa-balance-scale"></i>
                            <span>Trial Balance</span></a></li>
                    <li><a href="{{ url('account/cash-flow') }}"><i class="fa fas fa-exchange-alt"></i>
                            <span>Cash Flow</span></a></li>
                    <li><a href="{{ url('account/payment-account-report') }}"><i class="fa fas fa-file-alt"></i>
                            <span>Payment
                                Account Report</span></a></li>
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
                    <li><a href="{{ url('reports/profit-loss') }}"><i class="fa fas fa-file-invoice-dollar"></i>
                            <span>Profit /
                                Loss Report</span></a></li>
                    <li><a href="{{ url('reports/purchase-sell') }}"><i class="fa fas fa-exchange-alt"></i>
                            <span>Purchase &amp; Sale</span></a></li>
                    <li><a href="{{ url('reports/tax-report') }}"><i class="fa fas fa-percent"></i> <span>Tax
                                Report</span></a></li>
                    <li><a href="{{ url('reports/customer-supplier') }}"><i class="fa fas fa-address-book"></i>
                            <span>Supplier
                                &amp; Customer Report</span></a>
                    </li>
                    <li><a href="{{ url('reports/customer-group') }}"><i class="fa fas fa-users"></i>
                            <span>Customer Groups Report</span></a></li>
                    <li><a href="{{ url('reports/stock-report') }}"><i class="fa fas fa-hourglass-half"></i>
                            <span>Stock Report</span></a></li>
                    <li><a href="{{ url('reports/stock-adjustment-report') }}"><i class="fa fas fa-sliders-h"></i>
                            <span>Stock
                                Adjustment Report</span></a></li>
                    <li><a href="{{ url('reports/trending-products') }}"><i class="fa fas fa-chart-line"></i>
                            <span>Trending Products</span></a></li>
                    <li><a href="{{ url('reports/items-report') }}"><i class="fa fas fa-tasks"></i>
                            <span>Items Report</span></a></li>
                    <li><a href="{{ url('reports/product-purchase-report') }}"><i
                                class="fa fas fa-arrow-circle-down"></i>
                            <span>Product Purchase Report</span></a></li>
                    <li><a href="{{ url('reports/product-sell-report') }}"><i class="fa fas fa-arrow-circle-up"></i>
                            <span>Product
                                Sell Report</span></a></li>
                    <li><a href="{{ url('reports/purchase-payment-report') }}"><i
                                class="fa fas fa-search-dollar"></i>
                            <span>Purchase Payment Report</span></a></li>
                    <li><a href="{{ url('reports/sell-payment-report') }}"><i class="fa fas fa-search-dollar"></i>
                            <span>Sell
                                Payment Report</span></a></li>
                    <li><a href="{{ url('reports/expense-report') }}"><i class="fa fas fa-search-minus"></i>
                            <span>Expense Report</span></a></li>
                    <li><a href="{{ url('reports/register-report') }}"><i class="fa fas fa-briefcase"></i>
                            <span>Register Report</span></a></li>
                    <li><a href="{{ url('reports/sales-representative-report') }}"><i class="fa fas fa-user"></i>
                            <span>Sales
                                Representative Report</span></a></li>
                    <li><a href="{{ url('reports/table-report') }}"><i class="fa fas fa-table"></i>
                            <span>Table Report</span></a></li>
                    <li><a href="{{ url('reports/service-staff-report') }}"><i class="fa fas fa-user-secret"></i>
                            <span>Service
                                Staff Report</span></a></li>
                    <li><a href="{{ url('reports/activity-log') }}"><i class="fa fas fa-user-secret"></i>
                            <span>Activity Log</span></a></li>
                </ul>
            </li>
            <!-- Services Start -->
            <li class="treeview" id="tour_step9">
                <a href="#">
                    <i class="fa fas fa-chart-bar"></i> <span>Advertise</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('service-advertise.index') }}"><i class="fa fas fa-user-secret"></i>
                            <span>Property To Rent</span></a></li>
                </ul>
            </li>
            <!-- Services End -->
            <li><a href="{{ route('bookings.index') }}"><i class="fas fa fa-calendar-check"></i>
                    <span>Bookings</span></a></li>
            <li><a href="{{ url('modules/kitchen') }}"><i class="fa fas fa-fire"></i>
                    <span>Kitchen</span></a></li>
            <li><a href="{{ url('modules/orders') }}"><i class="fa fas fa-list-alt"></i>
                    <span>Orders</span></a></li>
            <li><a href="{{ url('notification-templates') }}"><i class="fa fas fa-envelope"></i>
                    <span>Notification Templates</span></a></li>
            <li class="treeview" id="tour_step3">
                <a href="#">
                    <i class="fa fas fa-cog"></i> <span>Settings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('business/settings') }}" id="tour_step2"><i class="fa fas fa-cogs"></i>
                            <span>Business
                                Settings</span></a></li>
                    <li><a href="{{ url('business-location') }}"><i class="fa fas fa-map-marker"></i>
                            <span>Business Locations</span></a></li>
                    <li><a href="{{ url('invoice-schemes') }}"><i class="fa fas fa-file"></i> <span>Invoice
                                Settings</span></a></li>
                    <li><a href="{{ route('barcodes.index') }}"><i class="fa fas fa-barcode"></i> <span>Barcode
                                Settings</span></a></li>
                    <li><a href="{{ route('printers.index') }}"><i class="fa fas fa-share-alt"></i> <span>Receipt
                                Printers</span></a></li>
                    <li><a href="{{ route('tax-rates.index') }}"><i class="fa fas fa-bolt"></i> <span>Tax
                                Rates</span></a></li>
                    <li><a href="{{ url('modules/tables') }}"><i class="fa fas fa-table"></i>
                            <span>Tables</span></a></li>
                    <li><a href="{{ url('modules/modifiers') }}"><i class="fa fas fa-pizza-slice"></i>
                            <span>Modifiers</span></a></li>
                    <li><a href="{{ route('types-of-service.index') }}"><i class="fa fas fa-user-circle"></i>
                            <span>Types of service</span></a></li>
                    <li><a href="{{ route('subscription.index') }}"><i class="fa fas fa-sync"></i> <span>Package
                                Subscription</span></a></li>
                </ul>
            </li>
            <li><a href="{{ url('crm/dashboard') }}"><i class="fas fa fa-broadcast-tower"></i>
                    <span>CRM</span></a></li>
            <li><a href="{{ url('project/project?project_view=list_view') }}" style=""><i
                        class="fa fa-project-diagram"></i>
                    <span>Project</span></a></li>
            <li><a href="{{ url('hrm/dashboard') }}" style=""><i class="fa fas fa-users"></i>
                    <span>HRM</span></a></li>
            <li><a href="{{ url('essentials/todo') }}" style=""><i class="fa fas fa-check-circle"></i>
                    <span>Essentials</span></a></li>
            <li><a href="{{ url('woocommerce') }}"><i class="fab fa-wordpress"></i>
                    <span style="margin-left: 10px;">Woocommerce</span></a></li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fas fa-cog"></i> <span>Jobs</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('recruitment.myApplications') }}">
                            <i class="fa fas fa-cogs"></i>
                            <span>My Applications</span></a>
                    </li>
                    <li><a href="{{ route('recruitment.index') }}"><i class="fa fas fa-cogs"></i>
                            <span>All Applicants</span></a></li>
                    <li><a href="{{ route('jobs.index') }}"><i class="fa fas fa-cogs"></i>
                            <span>Jobs</span></a></li>
                    @if (auth()->user()->id == 5)
                        <li><a href="{{ route('job-category.index') }}"><i class="fa fas fa-cogs"></i>
                                <span>Job Categories</span></a></li>
                    @endif
                </ul>
            </li>

            @if (auth()->user()->id == 5)
                <li><a href="{{ route('footer.index') }}"><i class="fa fa-asterisk"></i>
                        <span>Footer/Menu</span></a>
                </li>
            @endif

            {{-- <li><a href="{{ route('shop-news.index') }}"><i class="fa fa-newspaper"></i>
                    <span>News</span></a>
            </li>
            <li><a href="{{ route('shop-news-category.index') }}"><i class="fa fa-list-alt"></i>
                    <span>Category For News</span></a>
            </li>
            <li><a href="{{ route('shop-marketing.index') }}"><i class="fa fa-bullhorn"></i>
                    <span>Marketing</span></a>
            </li>
            <li><a href="{{ route('shop-marketing-category.index') }}"><i class="fa fa-list-alt"></i>
                    <span>Category For Marketing</span></a>
            </li> --}}
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
