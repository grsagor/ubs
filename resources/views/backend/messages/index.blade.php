@extends('layouts.app')
@section('title', 'Messages')
@section('css')
    <style>
        .content {
            padding: 0px !important;
        }
    </style>
@endsection
@section('content')
    <section class="content">
        <!-- Chat box -->
        <div class="box box-solid">

            <div class="box-message-header"
                style="display: flex; justify-content: space-between; align-items: center; padding: 10px;">

                <!-- Title Section -->
                <div style="display: flex; align-items: center;">
                    <i class="fa fa-comments-o" style="margin-right: 10px;"></i>
                    <h3 class="box-title" style="margin: 0;">Notice Board</h3>
                </div>

                <!-- Search Box -->
                <div>
                    <input type="text" placeholder="Search..." class="form-control" style="width: 300px;">
                </div>
            </div>

            <div class="box-body" id="chat-box" style="height: 105vh; overflow-y: scroll; background: #243540;">
                @foreach ($messages as $message)
                    @include('backend.messages.message_div')
                @endforeach
            </div>
            <!-- /.chat -->
            <div class="box-footer">
                {!! Form::open([
                    'url' => action([App\Http\Controllers\Backend\MessageController::class, 'store']),
                    'method' => 'post',
                    'id' => 'add_msg_form',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                <div class="row">

                    <!-- Third Column: Textarea for message -->
                    <div class="col-12">
                        {!! Form::textarea('message', null, [
                            'class' => 'form-control',
                            'id' => 'chat-msg',
                            'placeholder' => __('Type message...'),
                            'rows' => 4,
                        ]) !!}
                    </div>

                    <!-- Fourth Column: Submit Button and Other Inputs -->
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">

                        <div style="display: flex; align-items: center;">
                            <!-- File Input -->
                            <div style="margin: 0;"> <!-- Remove margin if needed -->
                                <input type="file" name="image_file[]" id="file-upload" class="form-control" multiple
                                    accept="image/*,.doc,.docx,.txt,.rtf,.odt,.pdf,.ppt,.pptx,.xls,.xlsx,.csv,.heic,.html,.css,.js,.py,.json"
                                    style="margin: 0; padding: 5px; width: 200px;"> <!-- Set a specific width -->
                            </div>

                            <!-- Location Select -->
                            <div style="margin-left: 10px;"> <!-- Reduce margin for the select box -->
                                {!! Form::select('location_id', $business_locations, null, [
                                    'class' => 'form-control',
                                    'placeholder' => __('lang_v1.select_location'),
                                    'style' => 'width: 100%;',
                                ]) !!}
                            </div>
                        </div>


                        <!-- Right side: Submit Button -->
                        <div>
                            <button type="submit" class="btn btn-success ladda-button" data-style="expand-right">
                                <span class="ladda-label">Send</span>
                            </button>
                        </div>
                    </div>


                </div>
                {!! Form::close() !!}

            </div>
        </div>
        <!-- /.box (chat box) -->
    </section>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {




            scroll_down_chat_div();
            $('#chat-msg').focus();

            $('form#add_msg_form').submit(function(e) {
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
                    url: "{{ action([App\Http\Controllers\Backend\MessageController::class, 'store']) }}",
                    data: formData,
                    method: 'post',
                    processData: false, // Prevent jQuery from automatically processing the data
                    contentType: false, // Let the browser set the content type, including boundaries for files
                    dataType: 'json',
                    success: function(result) {
                        ladda.stop();
                        if (result.success) {
                            $('div#chat-box').append(result.html);
                            toastr.success("Message sent");
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
                        var chat_item = $(this).closest('.post'); // Get the message post container

                        $.ajax({
                            url: $(this).attr('href'),
                            method: 'DELETE',
                            dataType: "json",
                            success: function(result) {
                                if (result.success) {
                                    toastr.success(result.msg);

                                    // Replace the content of the message with "You deleted this message"
                                    var deletedMessageHTML = `
                                    <div class="delete_message_area">
                                        <p class="delete_message">You deleted this message</p>
                                        <p class="description">
                                            <small>
                                                <i class="fas fa-clock"></i> ${new Date().toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })}
                                            </small>
                                        </p>
                                    </div>
                                `;

                                    // Clear the message content and replace with deleted message
                                    chat_item.html(deletedMessageHTML);
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                            error: function(xhr) {
                                toastr.error('Error deleting the message');
                            }
                        });
                    }
                });
            });

            //Interval to check for new chats in seconds, default 20sec
            // 'chat_refresh_interval' => 20, 

            var chat_refresh_interval = 20;
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
                url: "{{ action([\App\Http\Controllers\Backend\MessageController::class, 'getNewMessages']) }}?last_chat_time=" +
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
