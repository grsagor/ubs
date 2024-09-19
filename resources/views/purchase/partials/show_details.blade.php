    <div class="modal-header">
        <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalTitle"> @lang('purchase.purchase_details') (<b>
                @if ($purchase->type == 'sales_order')
                    @lang('restaurant.order_no')
                @else
                    @lang('sale.invoice_no')
                @endif :
            </b> {{ $purchase->invoice_no }})
        </h4>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-xs-12">
                <p class="pull-right"><b>@lang('messages.date'):</b> {{ @format_date($purchase->transaction_date) }}</p>
            </div>
        </div>
        <div class="row">
            @php
                $custom_labels = json_decode(session('business.custom_labels'), true);
                $export_custom_fields = [];
                if (!empty($purchase->is_export) && !empty($purchase->export_custom_fields_info)) {
                    $export_custom_fields = $purchase->export_custom_fields_info;
                }
            @endphp
            <div class="@if (!empty($export_custom_fields)) col-sm-3 @else col-sm-4 @endif">
                <b>
                    @if ($purchase->type == 'sales_order')
                        {{ __('restaurant.order_no') }}
                    @else
                        {{ __('sale.invoice_no') }}
                    @endif:
                </b> #{{ $purchase->invoice_no }}<br>
                <b>{{ __('sale.status') }}:</b>
                @if ($purchase->status == 'draft' && $purchase->is_quotation == 1)
                    {{ __('lang_v1.quotation') }}
                @else
                    {{ $statuses[$purchase->status] ?? __('sale.' . $purchase->status) }}
                @endif
                <br>
                @if ($purchase->type != 'sales_order')
                    <b>{{ __('sale.payment_status') }}:</b>
                    @if (!empty($purchase->payment_status))
                        {{ __('lang_v1.' . $purchase->payment_status) }}
                    @endif
                @endif
                @if (!empty($custom_labels['purchase']['custom_field_1']))
                    <br><strong>{{ $custom_labels['purchase']['custom_field_1'] ?? '' }}: </strong>
                    {{ $purchase->custom_field_1 }}
                @endif
                @if (!empty($custom_labels['purchase']['custom_field_2']))
                    <br><strong>{{ $custom_labels['purchase']['custom_field_2'] ?? '' }}: </strong>
                    {{ $purchase->custom_field_2 }}
                @endif
                @if (!empty($custom_labels['purchase']['custom_field_3']))
                    <br><strong>{{ $custom_labels['purchase']['custom_field_3'] ?? '' }}: </strong>
                    {{ $purchase->custom_field_3 }}
                @endif
                @if (!empty($custom_labels['purchase']['custom_field_4']))
                    <br><strong>{{ $custom_labels['purchase']['custom_field_4'] ?? '' }}: </strong>
                    {{ $purchase->custom_field_4 }}
                @endif

                @if (!empty($sales_orders))
                    <br><br><strong>@lang('lang_v1.sales_orders'):</strong>
                    <table class="table table-slim no-border">
                        <tr>
                            <th>@lang('lang_v1.sales_order')</th>
                            <th>@lang('lang_v1.date')</th>
                        </tr>
                        @foreach ($sales_orders as $so)
                            <tr>
                                <td>{{ $so->invoice_no }}</td>
                                <td>{{ @format_datetime($so->transaction_date) }}</td>
                            </tr>
                        @endforeach
                    </table>
                @endif
                @if ($purchase->document_path)
                    <br>
                    <br>
                    <a href="{{ $purchase->document_path }}" download="{{ $purchase->document_name }}"
                        class="btn btn-xs btn-success pull-left no-print">
                        <i class="fa fa-download"></i>
                        &nbsp;{{ __('purchase.download_document') }}
                    </a>
                @endif
            </div>
            <div class="@if (!empty($export_custom_fields)) col-sm-3 @else col-sm-4 @endif">
                @if (!empty($purchase->contact->supplier_business_name))
                    {{ $purchase->contact->supplier_business_name }}<br>
                @endif
                <b>{{ __('sale.customer_name') }}:</b> {{ $purchase->contact->name }}<br>
                <b>{{ __('business.address') }}:</b><br>
                @if (!empty($purchase->billing_address()))
                    {{ $purchase->billing_address() }}
                @else
                    {!! $purchase->contact->contact_address !!}
                    @if ($purchase->contact->mobile)
                        <br>
                        {{ __('contact.mobile') }}: {{ $purchase->contact->mobile }}
                    @endif
                    @if ($purchase->contact->alternate_number)
                        <br>
                        {{ __('contact.alternate_contact_number') }}: {{ $purchase->contact->alternate_number }}
                    @endif
                    @if ($purchase->contact->landline)
                        <br>
                        {{ __('contact.landline') }}: {{ $purchase->contact->landline }}
                    @endif
                    @if ($purchase->contact->email)
                        <br>
                        {{ __('business.email') }}: {{ $purchase->contact->email }}
                    @endif
                @endif

            </div>
            <div class="@if (!empty($export_custom_fields)) col-sm-3 @else col-sm-4 @endif">
                @if (in_array('tables', $enabled_modules))
                    <strong>@lang('restaurant.table'):</strong>
                    {{ $purchase->table->name ?? '' }}<br>
                @endif
                @if (in_array('service_staff', $enabled_modules))
                    <strong>@lang('restaurant.service_staff'):</strong>
                    {{ $purchase->service_staff->user_full_name ?? '' }}<br>
                @endif

                <strong>@lang('sale.shipping'):</strong>
                <span
                    class="label @if (!empty($shipping_status_colors[$purchase->shipping_status])) {{ $shipping_status_colors[$purchase->shipping_status] }} @else {{ 'bg-gray' }} @endif">{{ $shipping_statuses[$purchase->shipping_status] ?? '' }}</span><br>
                @if (!empty($purchase->shipping_address()))
                    {{ $purchase->shipping_address() }}
                @else
                    {{ $purchase->shipping_address ?? '--' }}
                @endif
                @if (!empty($purchase->delivered_to))
                    <br><strong>@lang('lang_v1.delivered_to'): </strong> {{ $purchase->delivered_to }}
                @endif
                @if (!empty($purchase->shipping_custom_field_1))
                    <br><strong>{{ $custom_labels['shipping']['custom_field_1'] ?? '' }}: </strong>
                    {{ $purchase->shipping_custom_field_1 }}
                @endif
                @if (!empty($purchase->shipping_custom_field_2))
                    <br><strong>{{ $custom_labels['shipping']['custom_field_2'] ?? '' }}: </strong>
                    {{ $purchase->shipping_custom_field_2 }}
                @endif
                @if (!empty($purchase->shipping_custom_field_3))
                    <br><strong>{{ $custom_labels['shipping']['custom_field_3'] ?? '' }}: </strong>
                    {{ $purchase->shipping_custom_field_3 }}
                @endif
                @if (!empty($purchase->shipping_custom_field_4))
                    <br><strong>{{ $custom_labels['shipping']['custom_field_4'] ?? '' }}: </strong>
                    {{ $purchase->shipping_custom_field_4 }}
                @endif
                @if (!empty($purchase->shipping_custom_field_5))
                    <br><strong>{{ $custom_labels['shipping']['custom_field_5'] ?? '' }}: </strong>
                    {{ $purchase->shipping_custom_field_5 }}
                @endif
                @php
                    $medias = $purchase->media->where('model_media_type', 'shipping_document')->all();
                @endphp
                @if (count($medias))
                    @include('purchase.partials.media_table', ['medias' => $medias])
                @endif

                @if (in_array('types_of_service', $enabled_modules))
                    @if (!empty($purchase->types_of_service))
                        <strong>@lang('lang_v1.types_of_service'):</strong>
                        {{ $purchase->types_of_service->name }}<br>
                    @endif
                    @if (!empty($purchase->types_of_service->enable_custom_fields))
                        <strong>{{ $custom_labels['types_of_service']['custom_field_1'] ?? __('lang_v1.service_custom_field_1') }}:</strong>
                        {{ $purchase->service_custom_field_1 }}<br>
                        <strong>{{ $custom_labels['types_of_service']['custom_field_2'] ?? __('lang_v1.service_custom_field_2') }}:</strong>
                        {{ $purchase->service_custom_field_2 }}<br>
                        <strong>{{ $custom_labels['types_of_service']['custom_field_3'] ?? __('lang_v1.service_custom_field_3') }}:</strong>
                        {{ $purchase->service_custom_field_3 }}<br>
                        <strong>{{ $custom_labels['types_of_service']['custom_field_4'] ?? __('lang_v1.service_custom_field_4') }}:</strong>
                        {{ $purchase->service_custom_field_4 }}<br>
                        <strong>{{ $custom_labels['types_of_service']['custom_field_5'] ?? __('lang_v1.custom_field', ['number' => 5]) }}:</strong>
                        {{ $purchase->service_custom_field_5 }}<br>
                        <strong>{{ $custom_labels['types_of_service']['custom_field_6'] ?? __('lang_v1.custom_field', ['number' => 6]) }}:</strong>
                        {{ $purchase->service_custom_field_6 }}
                    @endif
                @endif
            </div>
            @if (!empty($export_custom_fields))
                <div class="col-sm-3">
                    @foreach ($export_custom_fields as $label => $value)
                        <strong>
                            @php
                                $export_label = __('lang_v1.export_custom_field1');
                                if ($label == 'export_custom_field_1') {
                                    $export_label = __('lang_v1.export_custom_field1');
                                } elseif ($label == 'export_custom_field_2') {
                                    $export_label = __('lang_v1.export_custom_field2');
                                } elseif ($label == 'export_custom_field_3') {
                                    $export_label = __('lang_v1.export_custom_field3');
                                } elseif ($label == 'export_custom_field_4') {
                                    $export_label = __('lang_v1.export_custom_field4');
                                } elseif ($label == 'export_custom_field_5') {
                                    $export_label = __('lang_v1.export_custom_field5');
                                } elseif ($label == 'export_custom_field_6') {
                                    $export_label = __('lang_v1.export_custom_field6');
                                }
                            @endphp

                            {{ $export_label }}
                            :
                        </strong> {{ $value ?? '' }} <br>
                    @endforeach
                </div>
            @endif
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <h4>{{ __('sale.products') }}:</h4>
            </div>

            <div class="col-sm-12 col-xs-12">
                <div class="table-responsive">
                    @include('sale_pos.partials.purchase_line_details')
                </div>
            </div>
        </div>
        <div class="row">
            @php
                $total_paid = 0;
            @endphp
            @if ($purchase->type != 'sales_order')
                <div class="col-sm-12 col-xs-12">
                    <h4>{{ __('sale.payment_info') }}:</h4>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table class="table bg-gray">
                            <tr class="bg-green">
                                <th>#</th>
                                <th>{{ __('messages.date') }}</th>
                                <th>{{ __('purchase.ref_no') }}</th>
                                <th>{{ __('sale.amount') }}</th>
                                <th>{{ __('sale.payment_mode') }}</th>
                                <th>{{ __('sale.payment_note') }}</th>
                            </tr>
                            @foreach ($purchase->payment_lines as $payment_line)
                                @php
                                    if ($payment_line->is_return == 1) {
                                        $total_paid -= $payment_line->amount;
                                    } else {
                                        $total_paid += $payment_line->amount;
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ @format_date($payment_line->paid_on) }}</td>
                                    <td>{{ $payment_line->payment_ref_no }}</td>
                                    <td><span class="display_currency"
                                            data-currency_symbol="true">{{ $payment_line->amount }}</span></td>
                                    <td>
                                        {{ $payment_types[$payment_line->method] ?? $payment_line->method }}
                                        @if ($payment_line->is_return == 1)
                                            <br />
                                            ({{ __('lang_v1.change_return') }})
                                        @endif
                                    </td>
                                    <td>
                                        @if ($payment_line->note)
                                            {{ ucfirst($payment_line->note) }}
                                        @else
                                            --
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            @endif
            <div class="col-md-6 col-sm-12 col-xs-12 @if ($purchase->type == 'sales_order') col-md-offset-6 @endif">
                <div class="table-responsive">
                    <table class="table bg-gray">
                        <tr>
                            <th>{{ __('sale.total') }}: </th>
                            <td></td>
                            <td><span class="display_currency pull-right"
                                    data-currency_symbol="true">{{ $purchase->total_before_tax }}</span></td>
                        </tr>
                        <tr>
                            <th>{{ __('sale.discount') }}:</th>
                            <td><b>(-)</b></td>
                            <td>
                                <div class="pull-right"><span class="display_currency"
                                        @if ($purchase->discount_type == 'fixed') data-currency_symbol="true" @endif>{{ $purchase->discount_amount }}</span>
                                    @if ($purchase->discount_type == 'percentage')
                                        {{ '%' }}
                                    @endif
                                    </span>
                                </div>
                            </td>
                        </tr>
                        @if (in_array('types_of_service', $enabled_modules) && !empty($purchase->packing_charge))
                            <tr>
                                <th>{{ __('lang_v1.packing_charge') }}:</th>
                                <td><b>(+)</b></td>
                                <td>
                                    <div class="pull-right"><span class="display_currency"
                                            @if ($purchase->packing_charge_type == 'fixed') data-currency_symbol="true" @endif>{{ $purchase->packing_charge }}</span>
                                        @if ($purchase->packing_charge_type == 'percent')
                                            {{ '%' }}
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @if (session('business.enable_rp') == 1 && !empty($purchase->rp_redeemed))
                            <tr>
                                <th>{{ session('business.rp_name') }}:</th>
                                <td><b>(-)</b></td>
                                <td> <span class="display_currency pull-right"
                                        data-currency_symbol="true">{{ $purchase->rp_redeemed_amount }}</span></td>
                            </tr>
                        @endif
                        <tr>
                            <th>{{ __('sale.order_tax') }}:</th>
                            <td><b>(+)</b></td>
                            <td class="text-right">
                                @if (!empty($order_taxes))
                                    @foreach ($order_taxes as $k => $v)
                                        <strong><small>{{ $k }}</small></strong> - <span
                                            class="display_currency pull-right"
                                            data-currency_symbol="true">{{ $v }}</span><br>
                                    @endforeach
                                @else
                                    0.00
                                @endif
                            </td>
                        </tr>
                        @if (!empty($line_taxes))
                            <tr>
                                <th>{{ __('lang_v1.line_taxes') }}:</th>
                                <td></td>
                                <td class="text-right">
                                    @if (!empty($line_taxes))
                                        @foreach ($line_taxes as $k => $v)
                                            <strong><small>{{ $k }}</small></strong> - <span
                                                class="display_currency pull-right"
                                                data-currency_symbol="true">{{ $v }}</span><br>
                                        @endforeach
                                    @else
                                        0.00
                                    @endif
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <th>{{ __('sale.shipping') }}: @if ($purchase->shipping_details)
                                    ({{ $purchase->shipping_details }})
                                @endif
                            </th>
                            <td><b>(+)</b></td>
                            <td><span class="display_currency pull-right"
                                    data-currency_symbol="true">{{ $purchase->shipping_charges }}</span></td>
                        </tr>

                        @if (!empty($purchase->additional_expense_value_1) && !empty($purchase->additional_expense_key_1))
                            <tr>
                                <th>{{ $purchase->additional_expense_key_1 }}:</th>
                                <td><b>(+)</b></td>
                                <td><span
                                        class="display_currency pull-right">{{ $purchase->additional_expense_value_1 }}</span>
                                </td>
                            </tr>
                        @endif
                        @if (!empty($purchase->additional_expense_value_2) && !empty($purchase->additional_expense_key_2))
                            <tr>
                                <th>{{ $purchase->additional_expense_key_2 }}:</th>
                                <td><b>(+)</b></td>
                                <td><span
                                        class="display_currency pull-right">{{ $purchase->additional_expense_value_2 }}</span>
                                </td>
                            </tr>
                        @endif
                        @if (!empty($purchase->additional_expense_value_3) && !empty($purchase->additional_expense_key_3))
                            <tr>
                                <th>{{ $purchase->additional_expense_key_3 }}:</th>
                                <td><b>(+)</b></td>
                                <td><span
                                        class="display_currency pull-right">{{ $purchase->additional_expense_value_3 }}</span>
                                </td>
                            </tr>
                        @endif
                        @if (!empty($purchase->additional_expense_value_4) && !empty($purchase->additional_expense_key_4))
                            <tr>
                                <th>{{ $purchase->additional_expense_key_4 }}:</th>
                                <td><b>(+)</b></td>
                                <td><span
                                        class="display_currency pull-right">{{ $purchase->additional_expense_value_4 }}</span>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <th>{{ __('lang_v1.round_off') }}: </th>
                            <td></td>
                            <td><span class="display_currency pull-right"
                                    data-currency_symbol="true">{{ $purchase->round_off_amount }}</span></td>
                        </tr>
                        <tr>
                            <th>{{ __('sale.total_payable') }}: </th>
                            <td></td>
                            <td><span class="display_currency pull-right"
                                    data-currency_symbol="true">{{ $purchase->final_total }}</span></td>
                        </tr>
                        @if ($purchase->type != 'sales_order')
                            <tr>
                                <th>{{ __('sale.total_paid') }}:</th>
                                <td></td>
                                <td><span class="display_currency pull-right"
                                        data-currency_symbol="true">{{ $total_paid }}</span></td>
                            </tr>
                            <tr>
                                <th>{{ __('sale.total_remaining') }}:</th>
                                <td></td>
                                <td>
                                    <!-- Converting total paid to string for floating point substraction issue -->
                                    @php
                                        $total_paid = (string) $total_paid;
                                    @endphp
                                    <span class="display_currency pull-right"
                                        data-currency_symbol="true">{{ $purchase->final_total - $total_paid }}</span>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <strong>{{ __('sale.purchase_note') }}:</strong><br>
                <p class="well well-sm no-shadow bg-gray">
                    @if ($purchase->additional_notes)
                        {!! nl2br($purchase->additional_notes) !!}
                    @else
                        --
                    @endif
                </p>
            </div>
            <div class="col-sm-6">
                <strong>{{ __('sale.staff_note') }}:</strong><br>
                <p class="well well-sm no-shadow bg-gray">
                    @if ($purchase->staff_note)
                        {!! nl2br($purchase->staff_note) !!}
                    @else
                        --
                    @endif
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <strong>{{ __('lang_v1.activities') }}:</strong><br>
                {{-- @includeIf('activity_log.activities', ['activity_type' => 'sell']) --}}
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var element = $('div.modal-xl');
            __currency_convert_recursively(element);
        });
    </script>
