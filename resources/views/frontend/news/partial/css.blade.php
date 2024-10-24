<style>
    /* Container for news feed card */
    .search-bar,
    .newsfeed-container {
        width: 100%;
        max-width: 100%;
        padding: 10px;
        box-sizing: border-box;
        padding: 0px 100px 0px 100px;

    }

    /* Card styling */
    .newsfeed-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    /* Header styling */
    .card-header {
        display: flex;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        align-items: center;
    }

    /* Profile picture styling */
    .profile-pic {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 10px;
    }

    /* User info styling */
    .user-info {
        flex: 1;
    }

    /* Username styling */
    .username {
        margin: 0;
        font-weight: bold;
        font-size: 16px;
    }

    /* Timestamp styling */
    .timestamp {
        margin: 0;
        color: #888;
        font-size: 14px;
    }

    /* Body styling */

    /* Hide the native calendar icon */
    input[type="date"]::-webkit-calendar-picker-indicator {
        display: none;
    }

    input[type="date"] {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }



    /* Ensure the link takes up the full width */
    .card-link {
        display: block;
        text-decoration: none;
        /* Remove underline from the link */
    }

    /* Style the card body */
    .card-body {
        padding: 10px;
        cursor: pointer;
        /* Change cursor to indicate it's clickable */
        transition: background 0.3s ease;
        /* Smooth transition for background color */
    }

    /* Hover effect for card-body */
    .card-body:hover {
        background-color: #f9f9f9;
        /* Light background color on hover */
    }

    /* Post content styling */
    .post-content {
        margin: 0 0 10px;
        font-size: 14px;
        line-height: 1.5;
        color: black;
    }

    /* Post image styling */
    .post-image {
        height: 350px;
        /* Set a fixed height */
        width: 100%;
        border-radius: 8px;
        object-fit: cover;
    }

    /* Remove underline from link text */
    .card-link .card-body {
        color: inherit;
        /* Ensure text color inherits from parent */
    }

    /* Styling for the sidebar */
    #sidebar {
        background-color: white;
        padding: 10px;
        /* Adjust padding as needed */
        box-sizing: border-box;
        /* Ensure padding is included in the height calculation */
        /* Remove any fixed height to allow the sidebar to adjust based on content */
        overflow: hidden;
        /* Ensure no scrollbars are visible */
    }



    /* Left Sidebar */
    .left-side {
        overflow-y: auto;
        height: 100vh;
    }

    /* Main Content Area */
    .laptop_news_card {
        overflow-y: auto;
        /* scrollbar-width: none; */
        flex: 1;
        height: 100vh;
    }

    /* Right Sidebar */
    .right-side {
        overflow-y: auto;
        height: 100vh;
        /* scrollbar-width: none; */
    }

    /* Optional: Adjustments for card spacing and layout */
    .card {
        margin-bottom: 1rem;
        /* Space between cards */
    }

    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .region-link.active {
        color: #dc3545;
        /* Change text color to red */
        font-weight: bold;
        /* Optionally, make the font bold */
    }

    .language-link.active {
        color: red;
        /* Change text color to red */
        font-weight: bold;
        /* Optionally, make the font bold */
    }

    .special-link.active {
        color: red;
        /* Change text color to red */
        font-weight: bold;
        /* Optionally, make the font bold */
    }

    .subCategory-link.active {
        color: red;
        /* Change text color to red */
        font-weight: bold;
        /* Optionally, make the font bold */
    }

    @media only screen and (max-width: 768px) {
        .marketing_mobile_view {
            display: none;
        }

        .left-side {
            overflow-y: unset;
            height: unset;
        }

        .laptop_news_card {
            overflow-y: unset;
            scrollbar-width: unset;
            flex: unset;
            height: unset;
        }

        .search-bar,
        .newsfeed-container {
            padding: unset;
        }

        .search-field {
            margin-top: 15px;
        }

        .widget_product_categories {
            border: unset;
            padding: 0px 10px;
        }

        #sidebar .widget {
            margin-bottom: 20px;
        }

        #sidebar {
            overflow-y: scroll;
            max-height: calc(65vh - 100px);
        }


        .p_m_relative {
            position: relative;
        }

        .p_m_absolute {
            position: absolute;
            z-index: 10;
            background: white;
            width: 95%;
        }
    }
</style>
