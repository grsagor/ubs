<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Campaign</title>

    <!-- Title logo -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/title_fav.png') }}" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        img {
            width: 150px;
            height: 50px;
            object-fit: contain;
            display: block;
            margin: 0 auto 10px;
        }

        .details {
            font-size: 16px;
            margin: 0;
            color: #000;
            text-align: center;
        }

        .description {
            max-width: 800px;
            margin: 10px auto;
            padding: 10px;
        }

        .title_header {
            margin-top: 0;
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }

        .body_text {
            font-size: 17px;
            line-height: 1.6;
        }

        .contact-button {
            display: inline-block;
            background-color: #333;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .contact-button:hover {
            background-color: #555;
        }

        hr {
            width: 800px;
            margin: 20px auto;
        }
    </style>
</head>

<body>

    <header>
        <img src="{{ asset($campaign->businessLocation->logo) }}" alt="Company Logo">

        <p class="details" style="font-weight: bold; margin: 10px;">{{ $campaign->businessLocation->name }}</p>
        <p class="details">{{ $address }}</p>
        <hr>
    </header>

    <div class="description">
        <p class="title_header" style="text-align: center">{{ $campaign->subject }}</p>
        <p class="body_text"> {!! $campaign->email_body ?? '' !!} </p>

        <div class="contact-section">
            <a href="#contact" class="contact-button">Contact</a>
        </div>
    </div>
</body>

</html>
