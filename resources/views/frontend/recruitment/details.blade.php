@extends('frontend.layouts.master_layout')
@section('title', 'Jobs')
@section('css')
    <style>
        .container {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .color-black {
            color: black !important;
        }

        .text-justify {
            text-align: justify;
        }

        .card-design {
            background-color: #fdfdfd;
            color: #212529;
            /* Dark text color */
        }

        .job-title {
            color: #333;
            font-size: 18px;
            font-weight: 600;
        }

        .deadline-heading {
            color: #333;
            font-size: 14px;
            font-weight: 400;
        }

        .deadline-date {
            color: #B32D7D;
            font-size: 14px;
            font-weight: 600;
        }

        .apply-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .deadline-heading {
            flex: 1;
        }

        .applynow {
            border-radius: 4px;
            background: #008020;
            color: #FFF;
            font-weight: 500;
        }

        .summery-card,
        .company-info-card {
            border-radius: 4px;
            border: 0.5px solid #DDD;
            background: #F4F4F4;
            display: flex;
            flex-direction: column;
            padding: 15px 20px;
        }

        .requirements-card {
            border-radius: 4px;
            border: 0.5px solid #bababa;
            background: #fcfcfc;
            display: flex;
            flex-direction: column;
            padding: 15px 20px;
        }

        .sectitle {
            color: #B32D7D;
            font-size: 16px !important;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .txtbold {
            font-weight: 600;
        }

        .subheading {
            color: #333;
            font-size: 14px;
            font-weight: 600;
        }

        .reptitle {
            color: #B83835;
            font-size: 18px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .report-card {
            border-radius: 4px;
            border: 0.5px solid #FDB5B3;
            background: #FFEFEF;
            padding: 10px;
        }

        .report-button {
            background-color: #e43200e2;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .complain-info-item {
            display: flex;
            align-items: center;
        }

        .complain-info-item i {
            margin-right: 5px;
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">

        <div class="row">
            <div class="col-md-12 mt-2 p-2">

                <div class="card custom-card card-design laptop-view">
                    <div class="card-body">
                        <div class="row header">
                            <div class="col-md-9">
                                <div class="job-title">অনন্য সমাজ কল্যান সংস্থা</div>
                                <p class="card-text company-name color-black">প্রোগ্রাম অফিসার (হিসাব রক্ষক)</p>

                            </div>

                            <div class="col-md-3 text-end">
                                <img src="https://shorturl.at/inBEM" alt="" style="height: 90px">
                            </div>
                        </div>

                        <div class="apply-section mt-3">
                            <div class="deadline-heading">
                                Application Deadline: <span class="deadline-date">19 Feb 2024</span>
                            </div>
                            <div class="apply-button">
                                <button class="btn applynow">
                                    Apply now
                                </button>
                            </div>
                        </div>

                        <div class="summary-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="summery-card">
                                    <h3 class="sectitle">Summary</h3>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div>
                                                Vacancy: <span class="txtbold">01</span>
                                            </div>
                                            <div>
                                                Vacancy: <span class="txtbold">01</span>
                                            </div>
                                            <div>
                                                Vacancy: <span class="txtbold">01</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div>
                                                Vacancy: <span class="txtbold">01</span>
                                            </div>
                                            <div>
                                                Vacancy: <span class="txtbold">01</span>
                                            </div>
                                            <div>
                                                Vacancy: <span class="txtbold">01</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div>
                                                Vacancy: <span class="txtbold">01</span>
                                            </div>
                                            <div>
                                                Vacancy: <span class="txtbold">01</span>
                                            </div>
                                            <div>
                                                Vacancy: <span class="txtbold">01</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="requirements-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="requirements-card">
                                    <h3 class="sectitle">Requirements</h3>
                                    <div class="col-md-12">
                                        <p>অনন্য সমাজ কল্যান সংস্থা </p>

                                        <h5 class="subheading mb-0">Address:</h5>
                                        <p>Anannyo Center, Dhaka Road, Shalgaria, Pabna-6600</p>

                                        <h5 class="subheading mb-0">Business:</h5>
                                        <p>Anannyo Center, Dhaka Road, Shalgaria, Pabna-6600</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="company-info-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="company-info-card">
                                    <h3 class="sectitle">Company Information</h3>
                                    <div class="col-md-12">
                                        <p>অনন্য সমাজ কল্যান সংস্থা </p>

                                        <h5 class="subheading mb-0">Address:</h5>
                                        <p>Anannyo Center, Dhaka Road, Shalgaria, Pabna-6600</p>

                                        <h5 class="subheading mb-0">Business:</h5>
                                        <p>Anannyo Center, Dhaka Road, Shalgaria, Pabna-6600</p>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="report-section row mt-3">
                            <div class="col-sm-12">
                                <div class="report-card">
                                    <h3 class="reptitle">
                                        Report this Job / Company
                                        <a href="" class="report-button"><i class="fas fa-flag"></i> Report</a>
                                    </h3>
                                    <div class="col-md-12">
                                        <p>A type of false payer may accept money from you for this job advertisement or
                                            forward any or misleading information or code the job. Paying back/organization
                                            for job bdjobs no justification. BdJobs will not be responsible for Lennon's
                                            liability of any kind. </p>
                                    </div>

                                    <div class="complain-information">
                                        <div class="complain-info-item">
                                            <i class="fas fa-info-circle"></i>
                                            <div>
                                                16479
                                            </div>
                                        </div>
                                        <div class="complain-info-item">
                                            <i class="fas fa-envelope"></i>
                                            <div>
                                                complain@bdjobs.com
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
