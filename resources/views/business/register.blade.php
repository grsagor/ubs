@extends('layouts.auth2')
@section('title', __('lang_v1.register'))

@section('content')
    <div class="login-form col-md-12 col-xs-12 right-col-content-register">

        <p class="form-header text-white">@lang('business.register_and_get_started_in_minutes')</p>
        {!! Form::open([
            'url' => route('business.postRegister'),
            'method' => 'post',
            'id' => 'business_register_form',
            'files' => true,
        ]) !!}
        @include('business.partials.register_form')
        {!! Form::hidden('package_id', $package_id) !!}
        {!! Form::close() !!}
    </div>
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#change_lang').change(function() {
                window.location = "{{ route('business.getRegister') }}?lang=" + $(this).val();
            });

            // Listen for the category change event
            $('#category_id').on('change', function() {
                var categoryId = $(this).val(); // Get selected category ID

                if (categoryId) {
                    // Make an AJAX request to fetch subcategories
                    $.ajax({
                        url: "{{ route('business.getSubCategory', '') }}/" +
                            categoryId, // Append the category ID to the URL
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#sub_category_id').empty(); // Clear previous options
                            $('#sub_category_id').append(
                                '<option value="" selected disabled>Select Subcategory</option>'
                            );

                            // If the response is not an array or object, this will fail
                            $.each(data, function(key, value) {
                                $('#sub_category_id').append('<option value="' + key +
                                    '">' + value + '</option>');
                            });
                        },

                        error: function(xhr, status, error) {
                            // console.log('Error:', error);
                        }
                    });
                } else {
                    $('#sub_category_id').empty(); // Clear subcategory options if no category selected
                    $('#sub_category_id').append(
                        '<option value="" selected disabled>Select Subcategory</option>');
                }
            });
        })
    </script>
@endsection
