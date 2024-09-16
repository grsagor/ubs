<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get references to the inputs and links
        var searchInput = document.getElementById('search_Main');
        var dateInput = document.getElementById('dateSearch');
        var regionLinks = document.querySelectorAll('.region-link');
        var languageLinks = document.querySelectorAll('.language-link');
        var specialLinks = document.querySelectorAll('.special-link');
        var categoryLinks = document.querySelectorAll('[data-category-id]');
        var subCategoryLinks = document.querySelectorAll('.subCategory-link');

        // Variables to store selected category and subcategory
        var selectedCategoryId = '';
        var selectedSubCategoryId = '';

        // Function to perform the AJAX request
        function performSearch() {
            var searchText = searchInput.value.trim();
            var selectedDate = dateInput.value;
            var selectedRegion = document.querySelector('.region-link.active')?.dataset.regionId || '';
            var selectedLanguage = document.querySelector('.language-link.active')?.dataset.languageId || '';
            var selectedSpecial = document.querySelector('.special-link.active')?.dataset.specialId || '';

            var data = {
                search: searchText,
                date: selectedDate,
                region: selectedRegion,
                language: selectedLanguage,
                special: selectedSpecial,
            };

            // Include category or subcategory if they exist
            if (selectedSubCategoryId) {
                data.subCategory = selectedSubCategoryId;
            } else if (selectedCategoryId) {
                data.category = selectedCategoryId;
            }

            // console.log('category: ' + data.category); // For debugging
            // console.log('subcategory: ' + data.subCategory); // For debugging

            $.ajax({
                url: '/news',
                type: 'GET',
                data: data,
                success: function(response) {
                    $('#newsfeed-container').empty();

                    // Check if the response contains news items
                    if (response.trim().length === 0) {
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

        // Event listener for region links
        regionLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                document.querySelectorAll('.region-link').forEach(function(link) {
                    link.classList.remove('active');
                });

                this.classList.add('active');
                performSearch();
            });
        });

        // Event listener for language links
        languageLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                document.querySelectorAll('.language-link').forEach(function(link) {
                    link.classList.remove('active');
                });

                this.classList.add('active');
                performSearch();
            });
        });

        // Event listener for special links
        specialLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                document.querySelectorAll('.special-link').forEach(function(link) {
                    link.classList.remove('active');
                });

                this.classList.add('active');
                performSearch();
            });
        });

        // Event listener for category links
        categoryLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                selectedCategoryId = this.dataset.categoryId;
                var children = this.dataset.children ? JSON.parse(this.dataset.children) : null;

                if (children && children.length > 0) {
                    // console.log('Subcategories exist: ', children);
                    // Handle subcategory logic (if needed)
                } else {
                    // console.log('No subcategories, searching by category ID: ',
                    //     selectedCategoryId);
                    selectedSubCategoryId =
                        ''; // Reset subcategory if only category is selected
                    performSearch();
                }
            });
        });

        // Event listener for subcategory links
        subCategoryLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                selectedSubCategoryId = this.dataset.subcategoryId;
                performSearch(); // Search by subcategory
            });
        });

        // Clear button functionality
        document.getElementById('clearDate').addEventListener('click', function() {
            document.getElementById('dateSearch').value = '';
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

            var currentRotation = (beforeRotation === 'none' || beforeRotation ===
                'matrix(1, 0, 0, 1, 0, 0)') ? 0 : 90;
            var newRotation = (currentRotation === 0) ? 90 : 0;
            svg.toggleClass('rotate-90', newRotation === 90);
            svg.css('transform', 'rotate(' + newRotation + 'deg)');

            var afterRotation = svg.css('transform');
        });
    });
</script>
