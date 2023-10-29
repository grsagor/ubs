@if ($categoryType == 'product')
@if (count($prods) > 0)
        <div class="col-lg-12">
          @includeIf('partials.product.product-different-view')
        </div>
    @else
        <div class="col-lg-12">
            <div class="page-center">
                <h4 class="text-center">{{ __('No product Found.') }}</h4>
            </div>
        </div>
    @endif
@else
    @if (count($services) > 0)
        <div class="col-lg-12">

            @include('partials.service.service-different-view')
        </div>
    @else
        <div class="col-lg-12">
            <div class="page-center">
                <h4 class="text-center">{{ __('No Service Found.') }}</h4>
            </div>
        </div>
    @endif
@endif

<script>
    lazy()

    $('[data-toggle="tooltip"]').tooltip({});

    $('[rel-toggle="tooltip"]').tooltip();

    $('[data-toggle="tooltip"]').on('click', function() {
        $(this).tooltip('hide');
    })


    $('[rel-toggle="tooltip"]').on('click', function() {
        $(this).tooltip('hide');
    })

    // Tooltip Section Ends
</script>
