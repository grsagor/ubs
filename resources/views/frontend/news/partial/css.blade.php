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
        /* Enable vertical scrolling */
        height: 100vh;
        /* Full viewport height */
        /* Adjust padding if needed */
    }

    /* Main Content Area */
    .laptop_news_card {
        overflow-y: auto;
        scrollbar-width: none;

        /* Enable vertical scrolling */
        flex: 1;
        /* Takes up remaining space */
        height: 100vh;
        /* Full viewport height */
        /* padding: 1rem; */
        /* Adjust padding if needed */
    }

    /* Right Sidebar */
    .right-side {
        overflow-y: auto;
        /* Enable vertical scrolling */
        height: 100vh;
        /* Full viewport height */
        /* padding: 1rem; */
        /* Adjust padding if needed */
        scrollbar-width: none;
        /* For Firefox */

    }

    /* Optional: Adjustments for card spacing and layout */
    .card {
        margin-bottom: 1rem;
        /* Space between cards */
    }

    ::-webkit-scrollbar {
        width: 6px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
