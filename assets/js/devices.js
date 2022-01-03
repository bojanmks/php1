var currentPage = 1;

$(document).ready(function() {
    // PRICE RANGE
    function printPriceRangeValue() {
        $('#priceRange').html(`< ${$('#rnPrice').val()}€`);
    }

    printPriceRangeValue();

    $('#rnPrice').on('input', printPriceRangeValue);

    // DEVICES
    filterDevices();

    function filterDevices(resetPage = false) {
        if(resetPage) currentPage = 1;
        let data = {
            "search": getFilter('#tbSearch'),
            "order": getFilter('#ddlOrder'),
            "os": getFilter('.chbOS'),
            "brand": getFilter('.chbBrand'),
            "priceRange": getFilter('#rnPrice'),
            "page": currentPage
        };

        ajaxCallback('assets/php/device-filtering.php', 'get', function(output) {
            $('#devicesContainer').html(output.response);
            $('.btnAddToCart').click(function() {
                addToCart(this);
            });
            enablePaging();
        }, data);
    }

    function getFilter(data) {
        if(data.startsWith('#')) return $(data).val();
        else if(data.startsWith('.')) {
            let arr = [];
            for(let el of $(data)) {
                if(el.checked) arr.push(el.value);
            }
            return arr;
        }
    }

    // FILTERING
    $('#tbSearch').keyup(function() {
        filterDevices(true);
    });
    $('.filterAction').change(function() {
        filterDevices(true);
    });

    // ADDING TO CART
    function addToCart(btn) {
        let cartDevices = loadLocalStorage('cart');
        var deviceId = parseInt($(btn).data('id'));
        var isInCart = false;
        var index;
        for(let i in cartDevices) {
            if(deviceId == cartDevices[i].id) {
                index = i;
                isInCart = true;
                break;
            }
        }
        if(isInCart) {
            if(cartDevices[index].quantity < 10) {
                cartDevices[index].quantity++;
                updateLocalStorage(cartDevices, 'cart');
                successfullyAddedModal();
                printCartNumber();
            }
            else cannotAddModal();
        } else {
            ajaxCallback('assets/php/add-to-cart.php', 'get', function(output) {
                cartDevices.push({
                    "id": output.id,
                    "name": output.name,
                    "price": output.price,
                    "quantity": 1
                });
                updateLocalStorage(cartDevices, 'cart');
                successfullyAddedModal();
                printCartNumber();
            }, {"deviceId": deviceId});
        }
    }

    function addToCartModal(modal) {
        $('body').append(modal);
        modal.hide();
        modal.fadeIn('fast');
        setTimeout(function() {
            modal.fadeOut('fast', function() {
                modal.remove();
            });
        }, 2000);
    }

    function successfullyAddedModal() {
        var modal = $('<div class="addToCartModal"><div class="addToCartModalContent"><p class="font-small">Item has been succesfully added to your cart.</p></div></div>');
        addToCartModal(modal);
    }

    function cannotAddModal() {
        var modal = $("<div class='addToCartModal'><div class='addToCartModalContent cannotAdd'><p class='font-small'>You can't have more than 10 of the same device in your cart.</p></div></div>");
        addToCartModal(modal);
    }

    // PAGING
    function enablePaging() {
        $('.btnPage').removeClass('disabled').eq(currentPage - 1).addClass('activePage');
        if(currentPage == 1) $('.prevPage').addClass('disabled');
        if(currentPage == $('.btnPage').length) $('.nextPage').addClass('disabled');
        $('#paging a').click(function(e) {
            e.preventDefault();
            if(!$(this).hasClass('disabled')) {
                if($(this).hasClass('prevPage') || $(this).hasClass('nextPage')) {
                    if($(this).hasClass('prevPage')) {
                        if(currentPage > 1) currentPage--;
                    }
                    else if(currentPage < $('.btnPage').length) currentPage++;
                    $('.btnPage').removeClass('activePage').eq(currentPage - 1).addClass('activePage');
                } else {
                    $('.btnPage').removeClass('activePage');
                    $(this).addClass('activePage');
                    currentPage = $(this).data('page')
                }
                filterDevices();
            }
        });
    }
});