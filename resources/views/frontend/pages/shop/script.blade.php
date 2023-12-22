<script>
    function seeVendorContact() {
        $(".vendor_contact").css("display", "block");
    }

    function seeShopContact() {
        $(".shop_contact").toggle();
    }

    function loadMarketingProducts(page) {
        const links = document.querySelectorAll('.marketing-pagination-link');
        [].forEach.call(links, function(link) {
            link.classList.remove('active');
        });
        const currentPageLink = document.querySelector('#marketing-pagination-link-' + page);
        currentPageLink.classList.add('active');

        $.ajax({
            url: "#",
            type: "GET",
            data: {
                page: page,
                shop_id: "{{ $shop->id }}"
            },
            success: function(response) {
                $("#marketing-card-view").html(response);
            }
        });
    }

    function loadNewsProducts(page) {
        const links = document.querySelectorAll('.news-pagination-link');
        [].forEach.call(links, function(link) {
            link.classList.remove('active');
        });
        const currentPageLink = document.querySelector('#news-pagination-link-' + page);
        currentPageLink.classList.add('active');

        $.ajax({
            url: "#",
            type: "GET",
            data: {
                page: page,
                shop_id: "{{ $shop->id }}"
            },
            success: function(response) {
                $("#news-card-view").html(response);
            }
        });
    }

    $(document).ready(function() {
        $('.view-list').click(function() {
            console.log('list');
            $('.view-list-section').show();
            $('.view-card-section').hide();
        });

        $('.view-card').click(function() {
            console.log('card');
            $('.view-list-section').hide();
            $('.view-card-section').show();
        });
    });
</script>
