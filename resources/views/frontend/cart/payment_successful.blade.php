@extends('frontend.layouts.master_layout')
@section('title', 'Payment Successful - ')
@section('css')
    <style>
        .print_section {
            display: none;
        }

        .invoice {
            position: relative;
            background: #fff;
            border: 1px solid #f4f4f4;
            padding: 20px;
            margin: 10px 25px;
        }

        @media print {

            #payment_thanks_container,
            .ecommerce-header,
            .loader,
            footer {
                display: none !important;
            }

            .print_section {
                display: block !important;
            }
        }

        #payment_thanks_container {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 36px;
        }

        #payment_thanks_container .btn {
            background: #7abad3 !important;
            color: white !important;
        }

        #payment_thanks_container .btn:hover {
            background: #61a0b9 !important;
            color: white !important;
        }

        #payment_thanks_container .btn {
            width: 130px !important;
        }
    </style>
@endsection
@section('content')
    <div>
        @includeIf('frontend.partials.global.common-header')
        <div id="payment_thanks_container" class="load_cart content no-print">
            <h1>Thank you for</h1>
            <h1 class="mb-5">Your Order!</h1>
            <div class="d-flex flex-column flex-md-row gap-4">
                <a class="btn" href="{{ route('service.list') }}">Buy more</a>
                <button class="btn" id="create_invoice_btn" type="button">
                    <span id="create_invoice_btn_text">Invoice</span>
                    <div id="create_invoice_btn_loader" style="display: none;">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </button>
                @if (Auth::user() && Auth::user()->user_type == 'user_customer')
                    <a href="{{ url('contact/contact-dashboard') }}" class="btn">Dashboard</a>
                @else
                    <a href="{{ url('home') }}" class="btn">Dashboard</a>
                @endif
            </div>
        </div>
        <section class="invoice print_section" id="receipt_section">
        </section>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#create_invoice_btn', async function() {
                // $('#create_invoice_btn_text').hide();
                // $('#create_invoice_btn_loader').show();
                // const receipt = @json($receipt);
                // const response = await pos_print(receipt);
                const invoice_token = @json($invoice_token);
                console.log(invoice_token, "token")
                // if (response) {
                    setTimeout(function() {
                        // $('#create_invoice_btn_text').show();
                        // $('#create_invoice_btn_loader').hide();
                        location.href = '{{ route('show_invoice', ':token') }}'.replace(
                            ':token', invoice_token);
                    }, 3000);
                // }
            })
        })

        function __currency_convert_recursively(element, use_page_currency = false) {
            element.find(".display_currency").each(function() {
                var value = $(this).text();

                var show_symbol = $(this).data("currency_symbol");
                if (show_symbol == undefined || show_symbol != true) {
                    show_symbol = false;
                }

                //If data-use_page_currency is present in the element use_page_currency
                //value will be over written
                if (typeof $(this).data("use_page_currency") !== "undefined") {
                    use_page_currency = $(this).data("use_page_currency");
                }

                var highlight = $(this).data("highlight");
                if (highlight == true) {
                    __highlight(value, $(this));
                }

                var is_quantity = $(this).data("is_quantity");
                if (is_quantity == undefined || is_quantity != true) {
                    is_quantity = false;
                }

                if (is_quantity) {
                    show_symbol = false;
                }

                $(this).text(
                    __currency_trans_from_en(
                        value,
                        show_symbol,
                        use_page_currency,
                        null,
                        is_quantity
                    )
                );
            });
        }

        function __currency_trans_from_en(
            input,
            show_symbol = true,
            use_page_currency = false,
            precision,
            is_quantity = false
        ) {
            if (use_page_currency && __p_currency_symbol) {
                var s = __p_currency_symbol;
                var thousand = __p_currency_thousand_separator;
                var decimal = __p_currency_decimal_separator;
            } else {
                var s = '$';
                var thousand = '';
                var decimal = '';
            }

            symbol = "";
            var format = "%s%v";
            if (show_symbol) {
                symbol = s;
                format = "%s %v";
                if (__currency_symbol_placement == "after") {
                    format = "%v %s";
                }
            }

            if (is_quantity) {
                precision = __quantity_precision;
            }

            return accounting.formatMoney(
                input,
                symbol,
                precision,
                thousand,
                decimal,
                format
            );
        }

        function pos_print(receipt) {
            //If printer type then connect with websocket
            if (receipt.print_type == 'printer') {
                var content = receipt;
                content.type = 'print-receipt';

                //Check if ready or not, then print.
                if (socket.readyState != 1) {
                    initializeSocket();
                    setTimeout(function() {
                        socket.send(JSON.stringify(content));
                    }, 700);
                } else {
                    socket.send(JSON.stringify(content));
                }
            } else if (receipt.html_content != '') {
                var title = document.title;
                if (typeof receipt.print_title != 'undefined') {
                    document.title = receipt.print_title;
                }

                //If printer type browser then print content
                console.log(receipt.html_content);
                $('#receipt_section').html(receipt.html_content);
                console.log($('#receipt_section'));
                __currency_convert_recursively($('#receipt_section'));
                setTimeout(function() {
                    window.print();
                    document.title = title;
                }, 1000);
            }

            return 1;
        }
    </script>
@endsection
