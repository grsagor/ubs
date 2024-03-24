@extends('layouts.app')
@section('title', __('VAT Rates'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('VAT Rates')
            <small>@lang('Manage your VAT rates')</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-primary', 'title' => __('All your VAT rates')])
            @can('tax_rate.create')
                @slot('tool')
                    <div class="box-tools">
                        <button type="button" class="btn btn-block btn-primary btn-modal"
                            data-href="{{ action([\App\Http\Controllers\TaxRateController::class, 'create']) }}"
                            data-container=".tax_rate_modal">
                            <i class="fa fa-plus"></i> @lang('messages.add')</button>
                    </div>
                @endslot
            @endcan
            @can('tax_rate.view')
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="tax_rates_table">
                        <thead>
                            <tr>
                                <th>@lang('tax_rate.name')</th>
                                <th>@lang('VAT Rates')</th>
                                <th>@lang('messages.action')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            @endcan
        @endcomponent

        @component('components.widget', ['class' => 'box-primary'])
            @slot('title')
                @lang('VAT groups') ( @lang('Combination of multiple VATS') ) @show_tooltip(__('tooltip.tax_groups'))
            @endslot
            @can('tax_rate.create')
                @slot('tool')
                    <div class="box-tools">
                        <button type="button" class="btn btn-block btn-primary btn-modal"
                            data-href="{{ action([\App\Http\Controllers\GroupTaxController::class, 'create']) }}"
                            data-container=".tax_group_modal">
                            <i class="fa fa-plus"></i> @lang('messages.add')</button>
                    </div>
                @endslot
            @endcan
            @can('tax_rate.view')
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="tax_groups_table">
                        <thead>
                            <tr>
                                <th>@lang('tax_rate.name')</th>
                                <th>@lang('VAT rates')</th>
                                <th>@lang('Sub VATS')</th>
                                <th>@lang('messages.action')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            @endcan
        @endcomponent

        <div class="modal fade tax_rate_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade tax_group_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

    </section>
    <!-- /.content -->
@endsection
