<!-- Post -->
<div class="post msg-box {{ $message->user_id == auth()->user()->id ? 'msg-right' : 'msg-left' }} {{ $message->user_id == auth()->user()->id ? 'user-message' : 'other-message' }}"
    data-delivered-at="{{ $message->created_at }}">
    <div class="user-block">
        <span class="username">
            <span class="sender_name">{{ $message->sender->user_full_name }}</span>

            @if ($message->user_id == auth()->user()->id)
                <a href="{{ action([\Modules\Essentials\Http\Controllers\EssentialsMessageController::class, 'destroy'], [$message->id]) }}"
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
</div>
<!-- /.post -->


<style>
    .username,
    .description {
        margin-left: unset !important;
    }

    .post {
        margin-left: 15px;
        margin-right: 15px;
        width: 70%;
        border-bottom: unset;
        padding: 10px;
        border-radius: 10px;
    }

    .msg-right {
        float: right;
    }

    .msg-left {
        float: left;
    }

    .user-message {
        background: #7266ba;
        color: #ffffff;
    }

    .other-message {
        background: #ebebeb;
        color: #000;
    }

    .user-message .sender_name,
    .user-message .description {
        color: #fff;
    }

    .other-message .sender_name,
    .other-message .description {
        color: #333333;
    }
</style>
