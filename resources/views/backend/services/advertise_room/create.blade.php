@include('backend.services.advertise_room.advertise_style')

<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h1 class="modal-title text-center mt-2">Property advertising form</h1>
        </div>

        <div class="modal-body">
            <form class="row g-3 mt-2" action="{{ route('service-advertise.store') }}" id="multi-step-form"
                method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="service_category_id" value="{{ $category->id }}" id="service_category_id">
                <input type="hidden" name="sub_category_id" value="{{ $sub_category->id }}" id="sub_category_id">
                <input type="hidden" name="service_charge_room" id="service_charge_room">

                <!-- Step 1 -->
                @include('backend.services.advertise_room.partial.step_1')

                <!-- Step 2 -->
                @include('backend.services.advertise_room.partial.step_2')

                <!-- Step 3 -->
                @include('backend.services.advertise_room.partial.step_3')

                <!-- Step 4 -->
                @include('backend.services.advertise_room.partial.step_4')

                <!-- Step 5 -->
                @include('backend.services.advertise_room.partial.step_5')

                <!-- Step 6 -->
                @include('backend.services.advertise_room.partial.step_6')

            </form>
        </div>

        <div class="modal-footer">
            {{-- <input type="submit" class="btn btn-primary"> --}}
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
        </div>
    </div>
</div>

@include('backend.services.advertise_room.advertise_script')
