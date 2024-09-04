<!-- business information here -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Receipt-{{ $receipt_details->invoice_no }}</title>
</head>

<body>
    <div class="ticket">

        @if (empty($receipt_details->letter_head))
            @if (!empty($receipt_details->logo))
                <div class="text-box centered">
                    <img style="max-height: 100px; width: auto;" src="{{ $receipt_details->logo }}" alt="Logo">
                </div>
            @endif
            <div class="text-box">
                <!-- Logo -->
                <p class="centered">
                    <!-- Header text -->
                    @if (!empty($receipt_details->header_text))
                        <span class="headings">{!! $receipt_details->header_text !!}</span>
                        <br />
                    @endif

                    <!-- business information here -->
                    @if (!empty($receipt_details->display_name))
                        <span class="headings">
                            {{ $receipt_details->display_name }}
                        </span>
                        <br />
                    @endif

                    @if (!empty($receipt_details->address))
                        {!! $receipt_details->address !!}
                        <br />
                    @endif

                    @if (!empty($receipt_details->contact))
                        {!! $receipt_details->contact !!}
                    @endif
                    @if (!empty($receipt_details->contact) && !empty($receipt_details->website))
                        ,
                    @endif
                    @if (!empty($receipt_details->website))
                        {{ $receipt_details->website }}
                    @endif
                    @if (!empty($receipt_details->location_custom_fields))
                        <br>{{ $receipt_details->location_custom_fields }}
                    @endif

                    @if (!empty($receipt_details->sub_heading_line1))
                        {{ $receipt_details->sub_heading_line1 }}<br />
                    @endif
                    @if (!empty($receipt_details->sub_heading_line2))
                        {{ $receipt_details->sub_heading_line2 }}<br />
                    @endif
                    @if (!empty($receipt_details->sub_heading_line3))
                        {{ $receipt_details->sub_heading_line3 }}<br />
                    @endif
                    @if (!empty($receipt_details->sub_heading_line4))
                        {{ $receipt_details->sub_heading_line4 }}<br />
                    @endif
                    @if (!empty($receipt_details->sub_heading_line5))
                        {{ $receipt_details->sub_heading_line5 }}<br />
                    @endif

                    @if (!empty($receipt_details->tax_info1))
                        <br><b>{{ $receipt_details->tax_label1 }}</b> {{ $receipt_details->tax_info1 }}
                    @endif

                    @if (!empty($receipt_details->tax_info2))
                        <b>{{ $receipt_details->tax_label2 }}</b> {{ $receipt_details->tax_info2 }}
                    @endif

                    <!-- Title of receipt -->
                    @if (!empty($receipt_details->invoice_heading))
                        <br /><span class="sub-headings">{!! $receipt_details->invoice_heading !!}</span>
                    @endif
                </p>
            </div>
        @else
            <div class="text-box">
                <img style="width: 100%;margin-bottom: 10px;" src="{{ $receipt_details->letter_head }}">
            </div>
        @endif
        <div style="display: flex; justify-content:space-between;">
            <div class="border-top textbox-info" style="display: flex; gap: 6px;">
                <p class="f-left"><strong>{!! $receipt_details->invoice_no_prefix !!}</strong></p>
                <p class="f-right">
                    {{ $receipt_details->invoice_no }}
                </p>
            </div>
            <div class="textbox-info" style="display: flex; gap: 6px;">
                <p class="f-left"><strong>{!! $receipt_details->date_label !!}</strong></p>
                <p class="f-right">
                    {{ $receipt_details->invoice_date }}
                </p>
            </div>
        </div>

        @if (!empty($receipt_details->due_date_label))
            <div class="textbox-info" style="display: flex; gap: 6px;">
                <p class="f-left"><strong>{{ $receipt_details->due_date_label }}</strong></p>
                <p class="f-right">{{ $receipt_details->due_date ?? '' }}</p>
            </div>
        @endif

        <!-- customer info -->
        <div class="textbox-info" style="display: flex; gap: 6px;">
            <p style="vertical-align: top;"><strong>
                    {{ $receipt_details->customer_label ?? '' }}
                </strong></p>

            <p>
                @if (!empty($receipt_details->customer_info))
                    <div class="bw">
                        {!! $receipt_details->customer_info !!}
                    </div>
                @endif
            </p>
        </div>

        {{-- @if (!empty($receipt_details->sales_person_label))
            <div class="textbox-info" style="display: flex; gap: 6px;">
                <p class="f-left"><strong>{{ $receipt_details->sales_person_label }}</strong></p>

                <p class="f-right">{{ $receipt_details->sales_person }}</p>
            </div>
        @endif --}}
        {{-- @if (!empty($receipt_details->commission_agent_label))
            <div class="textbox-info" style="display: flex; gap: 6px;">
                <p class="f-left"><strong>{{ $receipt_details->commission_agent_label }}</strong></p>

                <p class="f-right">{{ $receipt_details->commission_agent }}</p>
            </div>
        @endif --}}
        {{-- @if (!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand))
            <div class="textbox-info" style="display: flex; gap: 6px;">
                <p class="f-left"><strong>{{ $receipt_details->brand_label }}</strong></p>

                <p class="f-right">{{ $receipt_details->repair_brand }}</p>
            </div>
        @endif --}}



        {{-- @if (!empty($receipt_details->device_label) || !empty($receipt_details->repair_device))
            <div class="textbox-info">
                <p class="f-left"><strong>{{ $receipt_details->device_label }}</strong></p>

                <p class="f-right">{{ $receipt_details->repair_device }}</p>
            </div>
        @endif --}}

        {{-- @if (!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no))
            <div class="textbox-info">
                <p class="f-left"><strong>{{ $receipt_details->model_no_label }}</strong></p>

                <p class="f-right">{{ $receipt_details->repair_model_no }}</p>
            </div>
        @endif --}}

        {{-- @if (!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no))
            <div class="textbox-info">
                <p class="f-left"><strong>{{ $receipt_details->serial_no_label }}</strong></p>

                <p class="f-right">{{ $receipt_details->repair_serial_no }}</p>
            </div>
        @endif --}}

        {{-- @if (!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status))
            <div class="textbox-info">
                <p class="f-left"><strong>
                        {!! $receipt_details->repair_status_label !!}
                    </strong></p>
                <p class="f-right">
                    {{ $receipt_details->repair_status }}
                </p>
            </div>
        @endif --}}

        {{-- @if (!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
            <div class="textbox-info">
                <p class="f-left"><strong>
                        {!! $receipt_details->repair_warranty_label !!}
                    </strong></p>
                <p class="f-right">
                    {{ $receipt_details->repair_warranty }}
                </p>
            </div>
        @endif --}}

        <!-- Waiter info -->
        @if (!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff))
            <div class="textbox-info">
                <p class="f-left"><strong>
                        {!! $receipt_details->service_staff_label !!}
                    </strong></p>
                <p class="f-right">
                    {{ $receipt_details->service_staff }}
                </p>
            </div>
        @endif

        @if (!empty($receipt_details->table_label) || !empty($receipt_details->table))
            <div class="textbox-info">
                <p class="f-left"><strong>
                        @if (!empty($receipt_details->table_label))
                            <b>{!! $receipt_details->table_label !!}</b>
                        @endif
                    </strong></p>
                <p class="f-right">
                    {{ $receipt_details->table }}
                </p>
            </div>
        @endif



        @if (!empty($receipt_details->client_id_label))
            <div class="textbox-info">
                <p class="f-left"><strong>
                        {{ $receipt_details->client_id_label }}
                    </strong></p>
                <p class="f-right">
                    {{ $receipt_details->client_id }}
                </p>
            </div>
        @endif

        @if (!empty($receipt_details->customer_tax_label))
            <div class="textbox-info">
                <p class="f-left"><strong>
                        {{ $receipt_details->customer_tax_label }}
                    </strong></p>
                <p class="f-right">
                    {{ $receipt_details->customer_tax_number }}
                </p>
            </div>
        @endif

        @if (!empty($receipt_details->customer_custom_fields))
            <div class="textbox-info">
                <p class="centered">
                    {!! $receipt_details->customer_custom_fields !!}
                </p>
            </div>
        @endif

        @if (!empty($receipt_details->customer_rp_label))
            <div class="textbox-info">
                <p class="f-left"><strong>
                        {{ $receipt_details->customer_rp_label }}
                    </strong></p>
                <p class="f-right">
                    {{ $receipt_details->customer_total_rp }}
                </p>
            </div>
        @endif
        @if (!empty($receipt_details->shipping_custom_field_1_label))
            <div class="textbox-info">
                <p class="f-left"><strong>
                        {!! $receipt_details->shipping_custom_field_1_label !!}
                    </strong></p>
                <p class="f-right">
                    {!! $receipt_details->shipping_custom_field_1_value ?? '' !!}
                </p>
            </div>
        @endif
        @if (!empty($receipt_details->shipping_custom_field_2_label))
            <div class="textbox-info">
                <p class="f-left"><strong>
                        {!! $receipt_details->shipping_custom_field_2_label !!}
                    </strong></p>
                <p class="f-right">
                    {!! $receipt_details->shipping_custom_field_2_value ?? '' !!}
                </p>
            </div>
        @endif
        @if (!empty($receipt_details->shipping_custom_field_3_label))
            <div class="textbox-info">
                <p class="f-left"><strong>
                        {!! $receipt_details->shipping_custom_field_3_label !!}
                    </strong></p>
                <p class="f-right">
                    {!! $receipt_details->shipping_custom_field_3_value ?? '' !!}
                </p>
            </div>
        @endif
        @if (!empty($receipt_details->shipping_custom_field_4_label))
            <div class="textbox-info">
                <p class="f-left"><strong>
                        {!! $receipt_details->shipping_custom_field_4_label !!}
                    </strong></p>
                <p class="f-right">
                    {!! $receipt_details->shipping_custom_field_4_value ?? '' !!}
                </p>
            </div>
        @endif
        @if (!empty($receipt_details->shipping_custom_field_5_label))
            <div class="textbox-info">
                <p class="f-left"><strong>
                        {!! $receipt_details->shipping_custom_field_5_label !!}
                    </strong></p>
                <p class="f-right">
                    {!! $receipt_details->shipping_custom_field_5_value ?? '' !!}
                </p>
            </div>
        @endif
        @if (!empty($receipt_details->sale_orders_invoice_no))
            <div class="textbox-info">
                <p class="f-left"><strong>
                        @lang('restaurant.order_no')
                    </strong></p>
                <p class="f-right">
                    {!! $receipt_details->sale_orders_invoice_no ?? '' !!}
                </p>
            </div>
        @endif

        @if (!empty($receipt_details->sale_orders_invoice_date))
            <div class="textbox-info">
                <p class="f-left"><strong>
                        @lang('lang_v1.order_dates')
                    </strong></p>
                <p class="f-right">
                    {!! $receipt_details->sale_orders_invoice_date ?? '' !!}
                </p>
            </div>
        @endif
        <table style="margin-top: 25px !important" class="border-bottom width-100 table-f-12 mb-10">
            <thead class="border-bottom">
                <tr>
                    <th class="description" width="30%">Service</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @forelse($receipt_details->lines as $line)
                    <tr>
                        <td class="description">
                            {{ $line['name'] }} {{ $line['product_variation'] }} {{ $line['variation'] }}
                            @if (!empty($line['sub_sku']))
                                , {{ $line['sub_sku'] }}
                                @endif @if (!empty($line['brand']))
                                    , {{ $line['brand'] }}
                                    @endif @if (!empty($line['cat_code']))
                                        , {{ $line['cat_code'] }}
                                    @endif
                                    @if (!empty($line['product_custom_fields']))
                                        , {{ $line['product_custom_fields'] }}
                                    @endif
                                    @if (!empty($line['product_description']))
                                        <div class="f-8">
                                            {!! $line['product_description'] !!}
                                        </div>
                                    @endif
                                    @if (!empty($line['sell_line_note']))
                                        <br>
                                        <span class="f-8">
                                            {!! $line['sell_line_note'] !!}
                                        </span>
                                    @endif
                                    @if (!empty($line['lot_number']))
                                        <br> {{ $line['lot_number_label'] }}: {{ $line['lot_number'] }}
                                    @endif
                                    @if (!empty($line['product_expiry']))
                                        , {{ $line['product_expiry_label'] }}: {{ $line['product_expiry'] }}
                                    @endif
                                    @if (!empty($line['warranty_name']))
                                        <br>
                                        <small>
                                            {{ $line['warranty_name'] }}
                                        </small>
                                    @endif
                                    @if (!empty($line['warranty_exp_date']))
                                        <small>
                                            - {{ @format_date($line['warranty_exp_date']) }}
                                        </small>
                                    @endif
                                    @if (!empty($line['warranty_description']))
                                        <small> {{ $line['warranty_description'] ?? '' }}</small>
                                    @endif

                                    @if ($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                                        <br><small>
                                            1 {{ $line['units'] }} = {{ $line['base_unit_multiplier'] }}
                                            {{ $line['base_unit_name'] }} <br>
                                            {{ $line['base_unit_price'] }} x {{ $line['orig_quantity'] }} =
                                            {{ $line['line_total'] }}
                                        </small>
                                    @endif
                        </td>
                        <td>{{ $receipt_details->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if (!empty($receipt_details->tax))
            <div class="flex-box">
                <p class="width-50 text-right">
                    {!! $receipt_details->tax_label !!}
                </p>
                <p class="width-50 text-right">
                    (+) {{ $receipt_details->tax }}
                </p>
            </div>
        @endif

        <div class="flex-box">
            <p class="width-50 text-right sub-headings">
                {!! $receipt_details->total_label !!}
            </p>
            <p class="width-50 text-right sub-headings">
                {{ $receipt_details->total }}
            </p>
        </div>

        <div class="flex-box">
            <p class="width-50 text-right sub-headings">Payment Method</p>
            <p class="width-50 text-right sub-headings">{{ $payment_method == 'stripe' ? 'Card' : 'Cash' }}</p>
        </div>
        <div class="flex-box">
            <p class="width-50 text-right sub-headings">Paid</p>
            <p class="width-50 text-right sub-headings">
                {{ $payment_method == 'stripe' ? $receipt_details->total : '0' }}</p>
        </div>
        <div class="flex-box">
            <p class="width-50 text-right sub-headings">Due</p>
            <p class="width-50 text-right sub-headings">
                {{ $payment_method == 'stripe' ? '0' : $receipt_details->total }}</p>
        </div>

        @if (!empty($receipt_details->total_in_words))
            <p colspan="2" class="text-right mb-0">
                <small>
                    ({{ $receipt_details->total_in_words }})
                </small>
            </p>
        @endif

        <div class="border-bottom width-100">&nbsp;</div>
        @if (empty($receipt_details->hide_price) && !empty($receipt_details->tax_summary_label))
            <!-- tax -->
            @if (!empty($receipt_details->taxes))
                <table class="border-bottom width-100 table-f-12">
                    <tr>
                        <th colspan="2" class="text-center">{{ $receipt_details->tax_summary_label }}</th>
                    </tr>
                    @foreach ($receipt_details->taxes as $key => $val)
                        <tr>
                            <td class="left">{{ $key }}</td>
                            <td class="right">{{ $val }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        @endif

        @if (!empty($receipt_details->additional_notes))
            <p class="centered">
                {!! nl2br($receipt_details->additional_notes) !!}
            </p>
        @endif

        {{-- Barcode --}}
        @if ($receipt_details->show_barcode)
            <br />
            <img class="center-block"
                src="data:image/png;base64,{{ DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2, 30, [39, 48, 54], true) }}">
        @endif

        @if ($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
            <img class="center-block mt-5"
                src="data:image/png;base64,{{ DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE') }}">
        @endif

        @if (!empty($receipt_details->footer_text))
            <p class="centered">
                {!! $receipt_details->footer_text !!}
            </p>
        @endif

    </div>
    <!-- <button id="btnPrint" class="hidden-print">Print</button>
        <script src="script.js"></script> -->
</body>

</html>

<style type="text/css">
    .f-8 {
        font-size: 8px !important;
    }

    body {
        color: #000000;
    }

    @media print {
        * {
            font-size: 12px;
            font-family: 'Times New Roman';
            word-break: break-all;
        }

        .f-8 {
            font-size: 8px !important;
        }

        .headings {
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .sub-headings {
            font-size: 15px !important;
            font-weight: 700 !important;
        }

        .border-top {
            border-top: 1px solid #242424;
        }

        .border-bottom {
            border-bottom: 1px solid #242424;
        }

        .border-bottom-dotted {
            border-bottom: 1px dotted darkgray;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 100%;
            max-width: 100%;
        }

        img {
            max-width: inherit;
            width: auto;
        }

        .hidden-print,
        .hidden-print * {
            display: none !important;
        }
    }

    .table-info {
        width: 100%;
    }

    .table-info tr:first-child td,
    .table-info tr:first-child th {
        padding-top: 8px;
    }

    .table-info th {
        text-align: left;
    }

    .table-info td {
        text-align: right;
    }

    .logo {
        float: left;
        width: 35%;
        padding: 10px;
    }

    .text-with-image {
        float: left;
        width: 65%;
    }

    .text-box {
        width: 100%;
        height: auto;
    }

    .textbox-info {
        clear: both;
    }

    .textbox-info p {
        margin-bottom: 0px
    }

    .flex-box {
        display: flex;
        width: 100%;
    }

    .flex-box p {
        width: 50%;
        margin-bottom: 0px;
        white-space: nowrap;
    }

    .table-f-12 th,
    .table-f-12 td {
        font-size: 12px;
        word-break: break-word;
    }

    .bw {
        word-break: break-word;
    }

    .width-100 {
        width: 100% !important;
    }
</style>
