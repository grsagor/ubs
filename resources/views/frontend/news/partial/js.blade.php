<script>
    function handleMinWidth992px() {
        if (window.innerWidth <= 992) {
            $('.widget-toggle').removeClass('closed')
        } else {
            $('.widget-toggle').addClass('closed')
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
