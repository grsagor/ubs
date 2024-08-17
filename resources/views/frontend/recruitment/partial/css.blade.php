<style>
    .categories {
        background-color: #ffffff;
    }

    .custom-card {
        position: relative;
        background-color: #ffffff;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        /* Enhanced shadow for more depth */
        border-radius: 10px;
        /* Rounded corners for a modern look */
        /* padding: 3px; */
        overflow: hidden;
        /* Prevent overflow */
        transition: transform 0.3s ease-in-out;
        /* Add a slight scaling effect on hover */
    }

    .custom-card:hover {
        transform: scale(1.01);
        /* Slightly scale the card on hover for a pop effect */
    }

    .custom-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background-color: rgba(209, 224, 209, 0.5);
        /* Solid green overlay with 50% opacity */
        transition: all 0.5s ease-in-out;
        /* Smooth transition for a more engaging effect */
        z-index: 1;
        /* Ensure the overlay stays on top */
    }

    .custom-card:hover::before {
        left: 0;
        /* Slide the green overlay from left to right */
    }

    .custom-card * {
        position: relative;
        z-index: 2;
        /* Ensure content stays above the overlay */
    }

    .custom-card-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333333;
    }

    .custom-card-content {
        font-size: 1rem;
        color: #666666;
    }

    .list-page {
        background-color: #f0f2f5;
    }

    .laptop_view_card {
        padding: 0px 32px 0px 25px;
    }

    .category-wrapper {
        position: absolute;
        background-color: #fff;
        border-radius: 6%;
        box-shadow: 0 0px 4px rgba(0, 0, 0, 0.2);
        z-index: 3;
        background-color: #039f2d;
    }

    .category-badge h6 {
        margin: 0;
        padding: 3px;
        font-size: 13px;
        color: #fff;
    }

    @media (max-width: 767px) {
        .mobile_view_card {
            margin-top: 30px !important;
            width: unset !important;
            margin-left: unset;
            margin-right: unset;
        }

        .mobile_view_card_descripition {
            padding-left: 15px !important;
        }


        .laptop_view_card {
            padding: unset;
        }
    }
</style>
