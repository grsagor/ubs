<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="modal-title">Property Booking Details</h4>
                </div>
                <div class="col-md-8 text-right">
                    <button type="button" class="btn btn-primary no-print" aria-label="Print"
                        onclick="printMultipageContent();">
                        <i class="fa fa-print"></i> Print
                    </button>
                    <button type="button" class="btn btn-default no-print"
                        data-dismiss="modal">@lang('messages.close')</button>

                </div>
            </div>
        </div>

        <div class="modal-body">
            <div id="printable-content">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <b>Title:</b>
                            {{ $booking_details->service_advertise->advert_title }}
                        </p>
                    </div>

                    <div class="col-md-12">

                        <p>
                            <b>Property Link:</b>
                            <a href="{{ route('room_show', $booking_details->service_advertise_id) }}" target="_blank">
                                {{ url('/room-show', $booking_details->service_advertise_id) }}
                            </a>
                        </p>
                        <hr style="border: 1px solid #8a8a8a; margin: 10px 0; height: 0px;">
                    </div>

                    <div class="col-md-12">
                        <p> <b>Number of shared
                                people:</b>{{ $booking_details->number_of_shared_people }} </p>
                    </div>
                    <div class="col-md-12">
                        <p><b>Period accommodation needed
                                for:</b>{{ $booking_details->preriod_accommodation_needed }}
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p><b>Want to stay in the
                                accommodation:</b>{{ $booking_details->want_stay_accommodation }}
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p><b>Email:</b>{{ $booking_details->email }}
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p><b>Mobile:</b>{{ $booking_details->mobile }}
                        </p>

                    </div>
                    <div class="col-md-12">

                        @foreach ($booking_occupant_details as $key => $occupant)
                            <hr style="border: 1px solid #8a8a8a; margin: 10px 0; height: 0px;">

                            <p><b>Occupants Details - {{ $key + 1 }}</b></p>

                            <div>

                                <p><b>Name:</b>
                                    @if ($occupant['occupant_name'])
                                        {{ $occupant['occupant_name'] }}
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p><b>Gender:</b>
                                    @if ($occupant['occupant_gender_req'] == 1)
                                        Male
                                    @elseif ($occupant['occupant_gender_req'] == 2)
                                        Female
                                    @elseif ($occupant['occupant_gender_req'] == 3)
                                        Others
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p>
                                    <b>Age:</b>
                                    @if ($occupant['occupant_age'])
                                        {{ $occupant['occupant_age'] }}
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p><b>Relationship:</b>
                                    @if ($occupant['occupant_relationship'] == 1)
                                        Family (Family member if relation is
                                        Father/Mother/Son/Daughter/Brother/Sister/Husband/Wife)
                                    @elseif ($occupant['occupant_relationship'] == 2)
                                        Relatives (Uncle/ Aunty/Cousin/ Brother-in-law/ Sister-in-law)
                                    @elseif ($occupant['occupant_relationship'] == 3)
                                        Friends
                                    @elseif ($occupant['occupant_relationship'] == 4)
                                        Others
                                    @elseif ($occupant['occupant_relationship'] == 5)
                                        Contact Person(The person as the point of contact or responsible party.)
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p><b>Occupation:</b>
                                    @if ($occupant['occupant_occupation'] == 1)
                                        Student
                                    @elseif ($occupant['occupant_occupation'] == 2)
                                        Employee
                                    @elseif ($occupant['occupant_occupation'] == 3)
                                        Others
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p>
                                    <b>Designation:</b>
                                    @if ($occupant['occupant_designation'])
                                        {{ $occupant['occupant_designation'] }}
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p>
                                    <b>Job Type:</b>
                                    @if ($occupant['occupant_job_type'] == 1)
                                        Part-time
                                    @elseif ($occupant['occupant_job_type'] == 2)
                                        Full-time
                                    @elseif ($occupant['occupant_job_type'] == 3)
                                        Self-employed
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p>
                                    <b>Monthly income before tax:</b>
                                    @if ($occupant['occupant_miat'])
                                        {{ $occupant['occupant_miat'] }}
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p>
                                    <b>University Name:</b>
                                    @if ($occupant['occupant_university_name'])
                                        {{ $occupant['occupant_university_name'] }}
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p>
                                    <b>Degree Name:</b>
                                    @if ($occupant['occupant_degree_name'])
                                        {{ $occupant['occupant_degree_name'] }}
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p>
                                    <b>Pay Rent:</b>
                                    @if ($occupant['occupant_pay_rent'] == 0)
                                        No
                                    @elseif ($occupant['occupant_pay_rent'] == 1)
                                        Yes
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p>
                                    <b>Nationality:</b>
                                    @if ($occupant['occupant_nationality'])
                                        {{ $occupant['occupant_nationality'] }}
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p>
                                    <b>Visa Status:</b>
                                    @if ($occupant['occupant_visa_status'])
                                        {{ $occupant['occupant_visa_status'] }}
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p><b>Photo:</b>
                                    @if ($occupant['occupant_photo'])
                                        {{ $occupant['occupant_photo'] }}
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p>
                                    <b>Passport:</b>
                                    @if ($occupant['occupant_passport_id'])
                                        {{ $occupant['occupant_passport_id'] }}
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p>
                                    <b>Pay Slip:</b>
                                    @if ($occupant['occupant_pay_slip'])
                                        {{ $occupant['occupant_pay_slip'] }}
                                    @else
                                        N/A
                                    @endif
                                </p>


                                <p>
                                    <b>Bank Statement:</b>
                                    @if ($occupant['occupant_bank_statement'])
                                        {{ $occupant['occupant_bank_statement'] }}
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p>
                                    <b>Other Documents:</b>
                                    @if ($occupant['occupant_other_documents'])
                                        {{ $occupant['occupant_other_documents'] }}
                                    @else
                                        N/A
                                    @endif
                                </p>

                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
        </div>

    </div>
</div>

<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">

<script>
    function printMultipageContent() {
        const printableContent = document.getElementById('printable-content');
        const contentToPrint = printableContent.innerHTML;

        const printWindow = window.open('', '_blank'); // Open in a new tab
        printWindow.document.open();
        printWindow.document.write('<html><head><title>Print</title></head><body>');

        const pages = contentToPrint.split('<!-- Page Break -->');

        for (let i = 0; i < pages.length; i++) {
            printWindow.document.write('<div style="page-break-before: always;">' + pages[i] + '</div>');
        }

        printWindow.document.write('</body></html>');
        printWindow.document.close();

        // Adding a delay before printing to allow time for the content to load
        setTimeout(() => {
            printWindow.print();
            printWindow.close();
        }, 1000); // Adjust the delay time if needed
    }
</script>
