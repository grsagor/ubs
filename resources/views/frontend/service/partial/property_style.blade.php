<style>
    .w3-opacity,
    .w3-hover-opacity:hover {
        opacity: 0.60
    }

    .w3-opacity-off,
    .w3-hover-opacity-off:hover {
        opacity: 1
    }

    .w3-opacity-max {
        opacity: 0.25
    }

    .w3-opacity-min {
        opacity: 0.75
    }


    .mySlides {
        display: none;
        height: 50vh;
    }

    .demo {
        width: 100px;
        cursor: pointer;
    }


    .image-carousel {
        position: relative;
    }

    .carousel-container {
        position: relative !important;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .previous,
    .next {
        font-size: 24px;
        cursor: pointer;
        padding: 8px;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        border-radius: 4px;
        position: absolute !important;
        top: 50%;
        z-index: 1;
    }

    .previous {
        left: 0;
    }

    .next {
        right: 0;
    }

    .image-slide {
        position: relative;
    }

    .image-slide img {
        max-width: 100%;
        height: auto;
        display: block;
    }

    .active {
        background-color: #333;
    }


    #call_id {
        display: none;
        margin-left: 10px;
    }

    @media (max-width: 768px) {

        #call_id {
            display: none !important;
            display: block;
            margin-left: 0;
            margin-top: 10px;
        }
    }


    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }


    .table-container {
        width: 100%;
        /* Set the desired width for the container */
        overflow-x: auto;
        /* Add a horizontal scrollbar when the table overflows */
    }

    table {
        width: 100%;
        /* Set the table width to fill the container */
        border-collapse: collapse;
    }

    /* Optional: Style the table with some basic CSS */
    table,
    th,
    td {
        border: 1px solid #ccc;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
    }

    #containerrrr {
        /* box-shadow: 3px 3px 4px rgba(0, 0, 0, 0.3); */
        /* height: 400px; */
        /* width: 400px; */
        overflow: hidden;
    }

    #imggg {
        transform-origin: center center;
        /* object-fit: cover; */
        /* height: 100%; */
        /* width: 100%; */
        cursor: all-scroll;
    }

    @media (max-width: 767px) {
        .full-row {
            padding-top: 1.5rem !important;
            padding-bottom: 1.5rem !important;
        }

        .mySlides {
            width: 80% !important;
            height: 0% !important;
        }

        .mobile_view_slider {
            display: none;
        }
    }
</style>
