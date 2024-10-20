@extends('crm::layouts.app')

@section('title', __('home.home'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header content-header-custom">
        <h1>{{ __('home.welcome_message', ['name' => Session::get('user.first_name')]) }}
        </h1> <br>
    </section>

    <!-- Main content -->
    <section class="content content-custom no-print">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('home.total_sell') }}</span>
                        <span class="info-box-number total_sell"><i
                                class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Available Balance</span>
                        <span class="info-box-number available_balance"><i
                                class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-green">
                        <i class="ion ion-ios-paper-outline"></i>

                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('lang_v1.net') }}
                            @show_tooltip(__('lang_v1.net_home_tooltip'))</span>
                        <span class="info-box-number net"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-yellow">
                        <i class="ion ion-ios-paper-outline"></i>
                        <i class="fa fa-exclamation"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('home.invoice_due') }}</span>
                        <span class="info-box-number invoice_due"><i
                                class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-red text-white">
                        <i class="fas fa-exchange-alt"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('lang_v1.total_sell_return') }}</span>
                        <span class="info-box-number total_sell_return"><i
                                class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                    </div>
                    <!-- /.info-box-content -->
                    <p class="mb-0 text-muted fs-10 mt-5">{{ __('lang_v1.total_sell_return') }}: <span
                            class="total_sr"></span><br>
                        {{ __('lang_v1.total_sell_return_paid') }}<span class="total_srp"></span></p>
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-cash"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('home.total_purchase') }}</span>
                        <span class="info-box-number total_purchase"><i
                                class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-yellow">
                        <i class="fa fa-dollar"></i>
                        <i class="fa fa-exclamation"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('home.purchase_due') }}</span>
                        <span class="info-box-number purchase_due"><i
                                class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-red text-white">
                        <i class="fas fa-undo-alt"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('lang_v1.total_purchase_return') }}</span>
                        <span class="info-box-number total_purchase_return"><i
                                class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                    </div>
                    <!-- /.info-box-content -->
                    <p class="mb-0 text-muted fs-10 mt-5">{{ __('lang_v1.total_purchase_return') }}: <span
                            class="total_pr"></span><br>
                        {{ __('lang_v1.total_purchase_return_paid') }}<span class="total_prp"></span></p>
                </div>
                <!-- /.info-box -->
            </div>

            <!-- expense -->
            <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-red">
                        <i class="fas fa-minus-circle"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">
                            {{ __('lang_v1.expense') }}
                        </span>
                        <span class="info-box-number total_expense"><i
                                class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        <div class="row row-custom">

            @if ($contact->type == 'supplier' || $contact->type == 'both')
                <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                    <div class="info-box info-box-new-style">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-cash"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text fs-10">@lang('report.total_purchase')</span>
                            <span class="info-box-number display_currency" data-currency_symbol="true">
                                {{ $contact->total_purchase }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                    <div class="info-box info-box-new-style">
                        <span class="info-box-icon bg-green">
                            <i class="fas fa-money-check-alt"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text fs-10">@lang('contact.total_purchase_paid')</span>
                            <span class="info-box-number display_currency" data-currency_symbol="true">
                                {{ $contact->purchase_paid }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                    <div class="info-box info-box-new-style">
                        <span class="info-box-icon bg-yellow">
                            <i class="fas fa-money-check-alt"></i>
                            <i class="fa fa-exclamation"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text fs-10">@lang('contact.total_purchase_due')</span>
                            <span class="info-box-number display_currency" data-currency_symbol="true">
                                {{ $contact->total_purchase - $contact->purchase_paid }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            @if ($contact->type == 'customer' || $contact->type == 'both')
                <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                    <div class="info-box info-box-new-style">
                        <span class="info-box-icon bg-aqua">
                            <i class="ion ion-ios-cart-outline"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text fs-10">@lang('report.total_sell')</span>
                            <span class="info-box-number display_currency" data-currency_symbol="true">
                                {{ $contact->total_invoice }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                    <div class="info-box info-box-new-style">
                        <span class="info-box-icon bg-green">
                            <i class="fas fa-money-check-alt"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text fs-10">
                                @lang('contact.total_sale_paid')
                            </span>
                            <span class="info-box-number display_currency" data-currency_symbol="true">
                                {{ $contact->invoice_received }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                    <div class="info-box info-box-new-style">
                        <span class="info-box-icon bg-yellow">
                            <i class="fas fa-money-check-alt"></i>
                            <i class="fa fa-exclamation"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text fs-10">
                                @lang('contact.total_sale_due')
                            </span>
                            <span class="info-box-number display_currency" data-currency_symbol="true">
                                {{ $contact->total_invoice - $contact->invoice_received }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            @if (!empty($contact->opening_balance) && $contact->opening_balance != '0.00')
                <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                    <div class="info-box info-box-new-style">
                        <span class="info-box-icon bg-aqua">
                            <i class="fas fa-donate"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text fs-10">
                                @lang('lang_v1.opening_balance')
                            </span>
                            <span class="info-box-number display_currency" data-currency_symbol="true">
                                {{ $contact->opening_balance }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                    <div class="info-box info-box-new-style">
                        <span class="info-box-icon bg-yellow">
                            <i class="fas fa-donate"></i>
                            <i class="fa fa-exclamation"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text fs-10">
                                @lang('lang_v1.opening_balance_due')
                            </span>
                            <span class="info-box-number display_currency" data-currency_symbol="true">
                                {{ $contact->opening_balance - $contact->opening_balance_paid }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('javascript')
    <script src="{{ asset('js/home.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
    @includeIf('sales_order.common_js')
    @includeIf('purchase_order.common_js')
    @if (!empty($all_locations))
        {!! $sells_chart_1->script() !!}
        {!! $sells_chart_2->script() !!}
    @endif
@endsection
