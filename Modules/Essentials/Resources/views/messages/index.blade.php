@extends('layouts.app')

@section('title', __('essentials::lang.messages'))

@section('css')
    <style>
        .msg-right {
            margin-left: auto;
            margin-right: 0;
            text-align: right;
        }

        /* Position delete icon on the left side when message is aligned to the right */
        .msg-right .delete-icon-left {
            float: left;
            margin-right: 0;
            margin-left: 5px;
        }

        @media (max-width: 767px) {
            .sender_name {
                font-size: 14px;
            }
        }
    </style>
@endsection
@section('content')
    @include('essentials::layouts.nav_essentials')
    <section class="content">
        <!-- Chat box -->
        <div class="box box-solid">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Notice Board</h3>
            </div>
            <div class="box-body" id="chat-box" style="height: 70vh; overflow-y: scroll; background: #efeae2;">
                @can('essentials.view_message')
                    @foreach ($messages as $message)
                        @include('essentials::messages.message_div')
                    @endforeach
                @endcan
            </div>
            <!-- /.chat -->
            @can('essentials.create_message')
                <div class="box-footer">
                    {!! Form::open([
                        'url' => action([\Modules\Essentials\Http\Controllers\EssentialsMessageController::class, 'store']),
                        'method' => 'post',
                        'id' => 'add_essentials_msg_form',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    <div class="row">
                        <!-- First Column (Location Select) -->
                        <div class="col-md-3" style="padding: 0; border: none; margin-bottom:10px;">
                            {!! Form::select('location_id', $business_locations, null, [
                                'class' => 'form-control',
                                'placeholder' => __('lang_v1.select_location'),
                                'style' => 'width: 100%;',
                            ]) !!}
                        </div>

                        <!-- Second Column: File Input -->
                        <div class="col-md-3">
                            <input type="file" name="image_file[]" class="form-control" multiple
                                accept="image/*,.doc,.pdf,.ppt,.pptx,.xls,.xlsx,.csv,">
                            <span>image,doc,pdf,ppt,pptx,xls,xlsx,csv,</span>
                        </div>

                        <!-- Third Column: Textarea for message -->
                        <div class="col-12">
                            {!! Form::textarea('message', null, [
                                'class' => 'form-control',
                                'id' => 'chat-msg',
                                'placeholder' => __('essentials::lang.type_message'),
                                'rows' => 4,
                            ]) !!}
                        </div>

                        <!-- Fourth Column: Submit Button -->
                        <div class="col-3" style="margin-top:10px;">
                            <button type="submit" class="btn btn-success ladda-button" data-style="expand-right">
                                <span class="ladda-label">Send</span>
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            @endcan
        </div>
        <!-- /.box (chat box) -->
    </section>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            scroll_down_chat_div();
            $('#chat-msg').focus();

            $('form#add_essentials_msg_form').submit(function(e) {
                e.preventDefault();

                var message = $('#chat-msg').val().trim();
                var fileInput = $('input[name="image_file[]"]')[0].files; // Get the FileList object

                // Clear previous error messages
                $('.error-message').remove();
                $('textarea, input').removeClass('is-invalid');

                // Check if either the message or file input is filled
                if (!message && fileInput.length === 0) {
                    // If neither is filled, show an error message for both fields
                    if (!message) {
                        $('#chat-msg').addClass('is-invalid').after(
                            '<span class="error-message" style="color:red;">Message is required.</span>'
                        );
                    }

                    if (fileInput.length === 0) {
                        $('input[name="image_file[]"]').addClass('is-invalid').after(
                            '<span class="error-message" style="color:red;">File is required if no message is provided.</span>'
                        );
                    }

                    return; // Stop form submission
                }

                // Proceed with form submission if validation passes
                var formData = new FormData(this);
                var ladda = Ladda.create(document.querySelector('.ladda-button'));
                ladda.start();

                $.ajax({
                    url: "{{ action([\Modules\Essentials\Http\Controllers\EssentialsMessageController::class, 'store']) }}",
                    data: formData,
                    method: 'post',
                    processData: false, // Prevent jQuery from automatically processing the data
                    contentType: false, // Let the browser set the content type, including boundaries for files
                    dataType: 'json',
                    success: function(result) {
                        ladda.stop();
                        if (result.success) {
                            $('div#chat-box').append(result.html);
                            scroll_down_chat_div();
                            $('#chat-msg').val('').focus();
                            $('input[name="image_file[]"]').val(''); // Clear file input
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                    error: function(xhr) {
                        ladda.stop();
                        toastr.error('Error: ' + xhr.responseText);
                    }
                });
            });




            $(document).on('click', 'a.chat-delete', function(e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var chat_item = $(this).closest('.post');
                        $.ajax({
                            url: $(this).attr('href'),
                            method: 'DELETE',
                            dataType: "json",
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    chat_item.remove();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });
            var chat_refresh_interval = "{{ config('essentials::config.chat_refresh_interval', 20) }}";
            chat_refresh_interval = parseInt(chat_refresh_interval) * 1000;
            setInterval(function() {
                getNewMessages()
            }, chat_refresh_interval);
        });

        function scroll_down_chat_div() {
            var chat_box = $('#chat-box');
            var height = chat_box[0].scrollHeight;
            chat_box.scrollTop(height);
        }

        function getNewMessages() {
            var last_chat_time = $('div.msg-box').length ? $('div.msg-box:last').data('delivered-at') : '';
            $.ajax({
                url: "{{ action([\Modules\Essentials\Http\Controllers\EssentialsMessageController::class, 'getNewMessages']) }}?last_chat_time=" +
                    last_chat_time,
                dataType: 'html',
                global: false,
                success: function(result) {
                    if (result.trim() != '') {
                        $('div#chat-box').append(result);
                        scroll_down_chat_div();
                    }
                },
            });
        }
    </script>
@endsection
