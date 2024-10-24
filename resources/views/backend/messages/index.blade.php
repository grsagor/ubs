@extends('layouts.app')
@section('title', 'Messages')
@section('css')
    <style>
        .content {
            padding: 0px !important;
        }

        .main-footer {
            display: none;
        }

        .scroll {
            display: none;
        }

        .chat-input-container {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            /* Add a subtle shadow */
        }

        .chat-input-container:focus-within {
            border-color: #007bff;
            /* Highlight the border when input is focused */
        }
    </style>
@endsection
@section('content')
    <section class="content">
        <!-- Chat box -->
        <div class="box box-solid">

            {!! Form::open([
                'url' => action([App\Http\Controllers\Backend\MessageController::class, 'store']),
                'method' => 'post',
                'id' => 'add_msg_form',
                'enctype' => 'multipart/form-data',
            ]) !!}

            <div class="notice-board-container"
                style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px;">

                <div class="links-container" style="display: flex; align-items: center;">
                    <div class="all-link" style="margin-left: 15px; font-size: 14px;">
                        <a href="#" style="color: #007bff; text-decoration: none;">All</a>
                    </div>

                    <div class="notice-board-link" style="margin-left: 10px; font-size: 16px; font-weight: 600;">
                        <a href="{{ route('messages.index') }}" style="color: #333; text-decoration: none;">Notice</a>
                    </div>

                    <div style="margin-left: 10px;"> <!-- Reduced margin for the select box -->
                        {!! Form::select('location_id', $business_locations, null, [
                            'class' => 'form-control',
                            'placeholder' => __('lang_v1.select_location'),
                            'style' => 'width: 100%; min-width: 150px;', // Added min-width for better layout
                        ]) !!}
                    </div>
                </div>

                <div class="search-container" style="position: relative; display: inline-block;">
                    <input type="text" placeholder="Search..." class="form-control"
                        style="width: 300px; padding: 8px 12px; border-radius: 20px; border: 1px solid #ccc; transition: border-color 0.3s; outline: none;"
                        onfocus="this.style.borderColor='#007bff';" onblur="this.style.borderColor='#ccc';"
                        id="search-input" onkeyup="filterMessages()">

                    <button id="clear-search" type="button"
                        style="display: none; position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: transparent; border: none; cursor: pointer; color: #007bff;"
                        onclick="clearSearch()">
                        <i class="fas fa-times" style="font-size: 16px;"></i>
                    </button>
                </div>

            </div>

            <div class="box-body" id="chat-box" style="height: 70vh; overflow-y: scroll; background: #243540;">
                @foreach ($messages as $message)
                    @include('backend.messages.message_div')
                @endforeach
            </div>
            <!-- /.chat -->
            <div class="box-footer">

                <div class="row">
                    <div class="col-12">
                        <div class="chat-input-container"
                            style="display: flex; align-items: center; border: 1px solid #ccc; border-radius: 25px; padding: 10px; background-color: #fff;">

                            <!-- Textarea for message -->
                            {!! Form::textarea('message', null, [
                                'class' => 'form-control',
                                'id' => 'chat-msg',
                                'placeholder' => __('Type message...'),
                                'rows' => 1,
                                'style' => 'resize: none; border: none; outline: none; padding: 10px; border-radius: 20px; flex-grow: 1;',
                            ]) !!}

                            <!-- Custom File Input with Icon -->
                            <div style="position: relative; margin-left: 10px;">
                                <input type="file" name="image_file[]" id="file-upload" class="form-control" multiple
                                    accept="image/*,.doc,.docx,.txt,.rtf,.odt,.pdf,.ppt,.pptx,.xls,.xlsx,.csv,.heic,.html,.css,.js,.py,.json"
                                    style="opacity: 0; position: absolute; z-index: -1; width: 0; height: 0;">

                                <label for="file-upload"
                                    style="cursor: pointer; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; background-color: #007bff; border-radius: 50%;">
                                    <i class="fas fa-paperclip" style="color: #fff; font-size: 18px;"></i>
                                </label>
                            </div>

                            <!-- Send Button -->
                            <button type="submit" class="btn btn-primary ladda-button"
                                style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-left: 10px;">
                                <i class="fa fa-paper-plane" style="color: #fff; font-size: 18px;"></i>
                            </button>
                        </div>
                    </div>
                </div>


            </div>

            {!! Form::close() !!}

        </div>

    </section>
@endsection

@section('javascript')


    <script type="text/javascript">
        document.getElementById('search-input').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent form submission
            }
        });

        function clearSearch() {
            const searchInput = document.getElementById('search-input');
            searchInput.value = ''; // Clear the input value
            toggleClearButton(); // Update the clear button visibility
            showAllMessages(); // Show all messages
        }

        function showAllMessages() {
            const messagesDiv = document.querySelectorAll(
                '#chat-box .msg-box'); // Assuming each message has a class of msg-box
            messagesDiv.forEach(msgDiv => {
                msgDiv.style.display = ''; // Show all messages
            });
        }

        function filterMessages() {
            const searchInput = document.getElementById('search-input');
            const filter = searchInput.value.toLowerCase();
            const messagesDiv = document.querySelectorAll('#chat-box .msg-box');

            // Show/hide the clear button based on input value
            toggleClearButton();

            // Iterate over each message and check if it contains the search term
            messagesDiv.forEach(msgDiv => {
                const messageText = msgDiv.textContent.toLowerCase();
                if (messageText.includes(filter)) {
                    msgDiv.style.display = ''; // Show message
                } else {
                    msgDiv.style.display = 'none'; // Hide message
                }
            });
        }

        function toggleClearButton() {
            const searchInput = document.getElementById('search-input');
            const clearButton = document.getElementById('clear-search');

            // Show the clear button if there is text in the input, otherwise hide it
            if (searchInput.value.trim() !== '') {
                clearButton.style.display = 'block'; // Show clear button
            } else {
                clearButton.style.display = 'none'; // Hide clear button
            }
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            document.body.classList.add('sidebar-collapse');


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
