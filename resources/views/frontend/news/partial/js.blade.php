<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get references to the inputs
        var searchInput = document.getElementById('search_Main');
        var dateInput = document.getElementById('dateSearch');

        // Function to perform the AJAX request
        function performSearch() {
            var searchText = searchInput.value.trim();
            var selectedDate = dateInput.value;

            $.ajax({
                url: '/news',
                type: 'GET',
                data: {
                    search: searchText,
                    date: selectedDate // Send both search text and selected date as query parameters
                },
                success: function(response) {
                    $('#newsfeed-container').empty();

                    // Handle the response from the server
                    console.log('Server Response:', response);

                    // Check if the response contains news items
                    if (response.trim().length === 0) {
                        // No news found
                        $('#newsfeed-container').html(`
                            <div class="card">
                                <div class="card-body">
                                    <div class="page-center">
                                        <h4 class="text-center text-danger">No news found.</h4>
                                    </div>
                                </div>
                            </div>
                        `);

                    } else {
                        // Display the news feed
                        $('#newsfeed-container').html(response);
                    }

                    $('#newsfeed-container').show();
                },
                error: function(xhr, status, error) {
                    // Handle any errors
                    console.error('AJAX Error:', status, error);
                }
            });
        }

        // Event listener for search input
        searchInput.addEventListener('keyup', function() {
            performSearch();
        });

        // Event listener for date input
        dateInput.addEventListener('change', function() {
            performSearch();
        });
    });


    document.getElementById('dateSearch').addEventListener('click', function() {
        var today = new Date().toISOString().split('T')[0]; // Get current date in YYYY-MM-DD format
        document.getElementById('dateSearch').setAttribute('max', today);
        this.showPicker(); // Programmatically show the date picker
    });



    function handleMinWidth992px() {
        if (window.innerWidth <= 992) {
            $('.widget-toggle').addClass('closed')
        } else {
            $('.widget-toggle').removeClass('closed')
        }
    }

    // Attach the event listener to the window's resize event
    window.addEventListener('resize', handleMinWidth992px);

    // Call the function initially to check the condition
    handleMinWidth992px();

    $(document).ready(function() {
        $('.toggle-category').click(function() {
            $(this).siblings('ul').toggle();
            return false;
        });

        $('.toggle-category').click(function() {
            var svg = $(this).find('.toggle-icon svg');
            var beforeRotation = svg.css('transform');
            console.log("Before rotation: " + beforeRotation);

            var currentRotation = (beforeRotation === 'none' || beforeRotation ===
                'matrix(1, 0, 0, 1, 0, 0)') ? 0 : 90;
            var newRotation = (currentRotation === 0) ? 90 : 0;
            svg.toggleClass('rotate-90', newRotation === 90);
            svg.css('transform', 'rotate(' + newRotation + 'deg)');

            var afterRotation = svg.css('transform');
            console.log("After rotation: " + afterRotation);
        });
    });
</script>
