<!-- Post -->
<div class="post msg-box {{ $message->user_id == auth()->user()->id ? 'msg-right' : 'msg-left' }} {{ $message->user_id == auth()->user()->id ? 'user-message' : 'other-message' }}"
    data-delivered-at="{{ $message->created_at }}">
    <div class="user-block">
        <span class="username">
            <span class="sender_name">{{ $message->sender->user_full_name }}</span>

            @if ($message->user_id == auth()->user()->id)
                <a href="{{ action([\App\Http\Controllers\Backend\MessageController::class, 'destroy'], [$message->id]) }}"
                    class="btn-box-tool chat-delete delete-icon-left" title="@lang('messages.delete')">
                    <i class="fa fa-times text-danger" style="font-size: 20px;"></i>
                </a>
            @endif
        </span>
        <span class="description">
            <small><i class="fas fa-clock"></i> {{ $message->created_at->diffForHumans() }}</small>
        </span>
    </div>
    <!-- /.user-block -->

    <p style="text-align: left;">{!! strip_tags($message->message, '<br>') !!}</p>

    @if (!empty($message->image_file))
        @php
            $files = json_decode($message->image_file);
        @endphp

        <div class="file-attachment">
            @if (is_array($files) && count($files) > 0)
                @foreach ($files as $file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp

                    @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                        <!-- Add more image extensions if needed -->
                        <!-- Show clickable image preview -->
                        <div class="image-preview" style="margin-bottom: 10px;">
                            <a href="{{ asset($file) }}" target="_blank">
                                <img src="{{ asset($file) }}" alt="Image Preview"
                                    style="max-width: 200px; max-height: 200px; border: 1px solid #ccc; cursor: pointer;">
                            </a>
                        </div>
                    @else
                        <!-- Show download link for other files -->
                        <a href="{{ asset($file) }}" target="_blank" class="btn btn-info btn-sm"
                            style="margin-bottom: 5px;">
                            <i class="fa fa-file"></i> {{ ucfirst($extension) }} File
                        </a>
                        <br> <!-- Line break for spacing -->
                    @endif
                @endforeach
            @else
                <p>No files available for download.</p>
            @endif
        </div>
    @endif


</div>
<!-- /.post -->

<style>
    .username,
    .description {
        margin-left: unset !important;
    }

    .post {
        display: block;
        margin-left: 15px;
        margin-right: 15px;
        width: auto;
        max-width: 70%;
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

    .description {
        color: #000 !important;
    }

    .file-attachment {
        margin-top: 10px;
    }
</style>
