<!-- Post -->
<div class="post msg-box {{ $message->user_id == auth()->user()->id ? 'msg-right' : 'msg-left' }} {{ $message->user_id == auth()->user()->id ? 'user-message' : 'other-message' }}"
    data-delivered-at="{{ $message->created_at }}">
    @if (!$message->deleted_at)
        <div class="visible_message">
            <div class="user-block">
                <span class="username">
                    <span class="sender_name">{{ $message->sender->user_full_name }}</span>

                    @if ($message->user_id == auth()->user()->id)
                        <a href="{{ action([\App\Http\Controllers\Backend\MessageController::class, 'destroy'], [$message->id]) }}"
                            class="btn-box-tool chat-delete delete-icon-left" title="@lang('messages.delete')">
                            <i class="fa fa-trash text-danger" style="font-size: 14px;"></i>
                        </a>
                    @endif
                </span>
            </div>

            <p class="message_area" style="text-align: left;">
                {!! preg_replace('!https?://\S+!', '<a href="$0" target="_blank">$0</a>', strip_tags($message->message)) !!}
            </p>

            @if (!empty($message->image_file))
                @php
                    // Decode JSON and check if it's valid
                    $files = json_decode($message->image_file, true); // Decode as an associative array

                    // Check if $files is an array and not a string
                    if (!is_array($files)) {
                        $files = [];
                    }
                @endphp

                <div class="file-attachment">
                    @if (count($files) > 0)
                        @foreach ($files as $file)
                            @php
                                // Ensure $file is an array and contains the keys we need
                                if (is_array($file) && isset($file['file_path'], $file['original_name'])) {
                                    $file_path = $file['file_path'];
                                    $original_name = $file['original_name'];
                                    $extension = pathinfo($file_path, PATHINFO_EXTENSION);
                                } else {
                                    continue; // Skip if the data structure is incorrect
                                }
                            @endphp

                            @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                <!-- Show clickable image preview -->
                                <div class="image-preview" style="margin-bottom: 10px; text-align: center;">
                                    <a href="{{ asset($file_path) }}" target="_blank"
                                        style="display: inline-block; max-width: 100%;">
                                        <img src="{{ asset($file_path) }}" alt="Image Preview"
                                            style="max-width: 100%; max-height: 200px; border: 1px solid #ccc; cursor: pointer; object-fit: contain;">
                                    </a>
                                </div>
                            @else
                                <!-- Show download link for other files -->
                                <a href="{{ asset($file_path) }}" target="_blank" class="btn btn-info btn-sm"
                                    style="margin-bottom: 5px;">
                                    <i class="fa fa-file"></i> {{ $original_name }}
                                </a>
                                <br>
                            @endif
                        @endforeach
                    @else
                        <p>No files available for download.</p>
                    @endif
                </div>
            @endif

            <p class="description" style="text-align: right">
                <small>
                    @if ($message->created_at->diffInHours() < 24)
                        {{ $message->created_at->format('h:i A') }}
                    @else
                        {{ $message->created_at->format('d M, Y h:i A') }}
                    @endif
                </small>
            </p>
        </div>
    @else
        <div class="delete_message_area">
            <p class="delete_message">You deleted this message </p>
            <p class="description" style="text-align: right">
                <small>
                    @if ($message->deleted_at->diffInHours() < 24)
                        {{ $message->deleted_at->format('h:i A') }}
                    @else
                        {{ $message->deleted_at->format('d M, Y h:i A') }}
                    @endif
                </small>
            </p>
        </div>
    @endif
</div>

<style>
    .post .user-block {
        margin-bottom: 0px;
    }

    .delete_message {
        font-style: italic;
        color: #7a7a7a;
        font-size: 14px;
        margin: 0px;
    }

    .description {
        font-style: italic;
        color: #7a7a7a;
        margin: 0px;
    }

    .post:last-of-type {
        padding-bottom: 10px;
    }

    .username,
    .description {
        margin-left: unset !important;
    }

    .post {
        display: block;
        width: auto;
        max-width: 85%;
        border-bottom: unset;
        padding: 10px;
        border-radius: 10px;
        box-sizing: border-box;
        clear: both;
    }

    .msg-right {
        float: right;
    }

    .msg-left {
        float: left;
    }

    .user-message {
        background: #d9fdd3;
        color: #000;
    }

    .other-message {
        background: #ffffff;
        color: #000;
    }

    .file-attachment {
        margin-top: 10px;
    }

    .message_area {
        word-wrap: break-word;
        /* Allows long words to be broken onto the next line */
        /* overflow-wrap: break-word; */
        /* Ensures that long words are broken correctly in all browsers */
        /* white-space: pre-wrap; */
        /* Preserves whitespace and wraps text */
        margin: 0;
        /* Removes default margin for better alignment */
    }


    .msg-right {
        margin-left: auto;
        margin-right: 0;
        text-align: right;
    }

    /* Position delete icon on the left side when message is aligned to the right */
    .msg-right .delete-icon-left {
        float: left;
        margin-right: 5px;
        margin-top: -2px;
    }

    @media (max-width: 767px) {
        .sender_name {
            font-size: 14px;
        }

        .post {
            max-width: 95% !important;
        }

        .box .box-body {
            padding: 18px 10px;
        }

    }
</style>
