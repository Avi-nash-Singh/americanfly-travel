/* ============================================
   American Fly - Flight Booking Scripts
   ============================================ */
   

$(document).ready(function () {

    /* ============================================
       AIRPORT DATA FOR SEARCH DROPDOWN
       ============================================ */
    const airportData = [
        { code: "JFK", city: "New York", name: "John F. Kennedy International Airport" },
        { code: "LAX", city: "Los Angeles", name: "Los Angeles International Airport" },
        { code: "ORD", city: "Chicago", name: "O'Hare International Airport" },
        { code: "ATL", city: "Atlanta", name: "Hartsfield-Jackson Atlanta International Airport" },
        { code: "DFW", city: "Dallas", name: "Dallas/Fort Worth International Airport" },
        { code: "DEN", city: "Denver", name: "Denver International Airport" },
        { code: "SFO", city: "San Francisco", name: "San Francisco International Airport" },
        { code: "SEA", city: "Seattle", name: "Seattle-Tacoma International Airport" },
        { code: "MIA", city: "Miami", name: "Miami International Airport" },
        { code: "BOS", city: "Boston", name: "Boston Logan International Airport" },
        { code: "LHR", city: "London", name: "London Heathrow Airport" },
        { code: "CDG", city: "Paris", name: "Paris Charles de Gaulle Airport" },
        { code: "DXB", city: "Dubai", name: "Dubai International Airport" },
        { code: "SIN", city: "Singapore", name: "Singapore Changi Airport" },
        { code: "HKG", city: "Hong Kong", name: "Hong Kong International Airport" },
        { code: "NRT", city: "Tokyo", name: "Narita International Airport" },
        { code: "SYD", city: "Sydney", name: "Sydney Kingsford Smith Airport" },
        { code: "FRA", city: "Frankfurt", name: "Frankfurt Airport" },
        { code: "IST", city: "Istanbul", name: "Istanbul Airport" },
        { code: "DOH", city: "Doha", name: "Hamad International Airport" }
    ];

    /* ============================================
       JQUERY DATEPICKER SETUP
       ============================================ */
    // Day names for American format
    const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

    // Departure Date Picker
    $("#departureDate").datepicker({
        dateFormat: "mm/dd/yy",
        minDate: 0,
        showAnim: "fadeIn",
        onSelect: function (selectedDate) {
            // Show the day name below the input
            var date = $(this).datepicker("getDate");
            if (date) {
                var dayName = dayNames[date.getDay()];
                $("#departureDay").text(dayName);
            }
            // Set minimum date for return date
            $("#returnDate").datepicker("option", "minDate", selectedDate);
        }
    });

    // Return Date Picker
    $("#returnDate").datepicker({
        dateFormat: "mm/dd/yy",
        minDate: 0,
        showAnim: "fadeIn",
        onSelect: function (selectedDate) {
            // Show the day name below the input
            var date = $(this).datepicker("getDate");
            if (date) {
                var dayName = dayNames[date.getDay()];
                $("#returnDay").text(dayName);
            }
        }
    });

    // Set default dates
    var today = new Date();
    var tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);

    $("#departureDate").datepicker("setDate", today);
    $("#departureDay").text(dayNames[today.getDay()]);

    $("#returnDate").datepicker("setDate", tomorrow);
    $("#returnDay").text(dayNames[tomorrow.getDay()]);

    /* ============================================
       AIRPORT SEARCH & DROPDOWN FUNCTIONALITY
       ============================================ */
    // Function to filter and display airport results
    function filterAirports(inputValue, dropdownId) {
        var $dropdown = $("#" + dropdownId);
        $dropdown.empty();

        if (inputValue.length < 1 || inputValue.trim() === "") {
            $dropdown.removeClass("flight-search-form__dropdown--visible");
            return;
        }

        var filtered = airportData.filter(function (airport) {
            return (
                airport.code.toLowerCase().includes(inputValue.toLowerCase()) ||
                airport.city.toLowerCase().includes(inputValue.toLowerCase()) ||
                airport.name.toLowerCase().includes(inputValue.toLowerCase())
            );
        });

        if (filtered.length > 0) {
            filtered.forEach(function (airport) {
                var $item = $('<div class="flight-search-form__dropdown-item">');
                $item.html(
                    '<span class="flight-search-form__dropdown-item-code">' + airport.code + '</span>' +
                    '<span class="flight-search-form__dropdown-item-city">' + airport.city + '</span>' +
                    '<span class="flight-search-form__dropdown-item-name">' + airport.name + '</span>'
                );
                $item.on("click", function () {
                    var $input = $dropdown.prev(".flight-search-form__field-input") ||
                        $dropdown.closest(".flight-search-form__field").find(".flight-search-form__field-input");
                    $input.val(airport.city + " (" + airport.code + ")");
                    $dropdown.removeClass("flight-search-form__dropdown--visible");
                });
                $dropdown.append($item);
            });
            $dropdown.addClass("flight-search-form__dropdown--visible");
        } else {
            $dropdown.removeClass("flight-search-form__dropdown--visible");
        }
    }

    // Origin input search
    $("#originInput").on("input", function () {
        filterAirports($(this).val(), "originDropdown");
    });

    // Origin input focus - show dropdown with all results
    $("#originInput").on("focus", function () {
        // Close other dropdowns first
        $("#destinationDropdown").removeClass("flight-search-form__dropdown--visible");
        $("#passengerDropdown").removeClass("flight-search-form__passenger-dropdown--visible");
        var val = $(this).val();
        if (val.length >= 1) {
            filterAirports(val, "originDropdown");
        } else {
            // Show all airports on focus when empty
            filterAirports(" ", "originDropdown");
        }
    });

    // Prevent document click from closing when clicking inside origin field
    $(".flight-search-form__field--origin").on("click", function (e) {
        e.stopPropagation();
    });

    // Destination input search
    $("#destinationInput").on("input", function () {
        filterAirports($(this).val(), "destinationDropdown");
    });

    // Destination input focus - show dropdown with all results
    $("#destinationInput").on("focus", function () {
        // Close other dropdowns first
        $("#originDropdown").removeClass("flight-search-form__dropdown--visible");
        $("#passengerDropdown").removeClass("flight-search-form__passenger-dropdown--visible");
        var val = $(this).val();
        if (val.length >= 1) {
            filterAirports(val, "destinationDropdown");
        } else {
            // Show all airports on focus when empty
            filterAirports(" ", "destinationDropdown");
        }
    });

    // Prevent document click from closing when clicking inside destination field
    $(".flight-search-form__field--destination").on("click", function (e) {
        e.stopPropagation();
    });

    // Close all dropdowns when clicking outside the search form fields
    $(document).on("click", function (e) {
        if (!$(e.target).closest(".flight-search-form__field--origin, .flight-search-form__field--destination, #passengerField").length) {
            $("#originDropdown").removeClass("flight-search-form__dropdown--visible");
            $("#destinationDropdown").removeClass("flight-search-form__dropdown--visible");
            $("#passengerDropdown").removeClass("flight-search-form__passenger-dropdown--visible");
        }
    });

    /* ============================================
       SWAP ORIGIN & DESTINATION
       ============================================ */
    $("#swapBtn").on("click", function () {
        var originVal = $("#originInput").val();
        var destVal = $("#destinationInput").val();
        $("#originInput").val(destVal);
        $("#destinationInput").val(originVal);
    });

    /* ============================================
       PASSENGER COUNTER FUNCTIONALITY
       ============================================ */
    // Plus button click
    $(".flight-search-form__counter-btn--plus").on("click", function () {
        var targetId = $(this).data("target");
        var maxVal = parseInt($(this).data("max"));
        var currentVal = parseInt($("#" + targetId).text());

        if (currentVal < maxVal) {
            $("#" + targetId).text(currentVal + 1);
            updatePassengerDisplay();
        }
    });

    // Minus button click
    $(".flight-search-form__counter-btn--minus").on("click", function () {
        var targetId = $(this).data("target");
        var minVal = parseInt($(this).data("min"));
        var currentVal = parseInt($("#" + targetId).text());

        if (currentVal > minVal) {
            $("#" + targetId).text(currentVal - 1);
            updatePassengerDisplay();
        }
    });

    // Update passenger display text
    function updatePassengerDisplay() {
        var adults = parseInt($("#adultCount").text());
        var children = parseInt($("#childrenCount").text());
        var total = adults + children;
        var text = total + " Passenger" + (total !== 1 ? "s" : "");
        $("#passengerCount").text(text);
    }

    /* ============================================
       CABIN CLASS SELECTION
       ============================================ */
    $(".flight-search-form__cabin-radio").on("change", function () {
        var selectedClass = $(this).val();
        $("#cabinClassDisplay").text(selectedClass);
    });

    /* ============================================
       PASSENGER DROPDOWN TOGGLE
       ============================================ */
    // Toggle passenger dropdown on click
    $("#passengerDisplay").on("click", function (e) {
        e.stopPropagation();
        // Close airport dropdowns first
        $("#originDropdown").removeClass("flight-search-form__dropdown--visible");
        $("#destinationDropdown").removeClass("flight-search-form__dropdown--visible");
        $("#passengerDropdown").toggleClass("flight-search-form__passenger-dropdown--visible");
    });

    // Prevent document click from closing when clicking inside passenger field
    $("#passengerField").on("click", function (e) {
        e.stopPropagation();
    });

    // Close dropdown when Done button is clicked
    $("#passengerDoneBtn").on("click", function (e) {
        e.stopPropagation();
        $("#passengerDropdown").removeClass("flight-search-form__passenger-dropdown--visible");
    });

    /* ============================================
       NAVBAR MOBILE TOGGLE
       ============================================ */
    $("#navbarToggleBtn").on("click", function () {
        $("#navbarMenuList").toggleClass("flight-navbar__menu-list--open");
    });

    /* ============================================
       STICKY HEADER & NAVBAR SCROLL EFFECT
       ============================================ */
    // $(window).on("scroll", function () {
    //     var scrollTop = $(window).scrollTop();
    //     var $wrapper = $(".flight-sticky-wrapper");

    //     // Add scrolled class to wrapper, header and navbar when scrolled
    //     if (scrollTop > 50) {
    //         if (!$wrapper.hasClass("flight-sticky-wrapper--scrolled")) {
    //             // Add spacer to prevent content jump when wrapper becomes fixed
    //             $wrapper.css("height", $wrapper.outerHeight());
    //         }
    //         $wrapper.addClass("flight-sticky-wrapper--scrolled");
    //         $(".flight-header").addClass("flight-header--scrolled");
    //         $(".flight-navbar").addClass("flight-navbar--scrolled");
    //     } else {
    //         $wrapper.removeClass("flight-sticky-wrapper--scrolled");
    //         $wrapper.css("height", "");
    //         $(".flight-header").removeClass("flight-header--scrolled");
    //         $(".flight-navbar").removeClass("flight-navbar--scrolled");
    //     }
    // });

    /* ============================================
       DESTINATIONS CAROUSEL (SLICK SLIDER)
       ============================================ */
 $("#destinationsCarousell").slick({
    dots: true,
    arrows: true,
    infinite: true,
    speed: 500,
    slidesToShow: 4, // Default for screens larger than 1440px
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    pauseOnHover: true,
    centerMode: true,
    centerPadding: '20px',
    responsive: [
        {
            breakpoint: 1441, // Targets 1440px and below
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                centerPadding: '20px'
            }
        },
        {
            breakpoint: 1025, // Targets 1024px and below
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                centerPadding: '20px'
            }
        },
        {
            breakpoint: 993, // Targets 992px and below
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                centerPadding: '15px'
            }
        },
        {
            breakpoint: 787, // Targets 786px and below
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                arrows: false,
                centerPadding: '10px'
            }
        },
        {
            breakpoint: 481, // Targets 480px and below
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                centerPadding: '30px'
            }
        },
        {
            breakpoint: 461, // Targets 460px and below
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                centerPadding: '25px'
            }
        },
        {
            breakpoint: 426, // Targets 425px and below
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                centerPadding: '20px'
            }
        },
        {
            breakpoint: 376, // Targets 375px and below
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                centerPadding: '15px' // Adjusted for your 375px resolution target
            }
        },
        {
            breakpoint: 321, // Targets 320px and below
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                centerPadding: '10px'
            }
        }
    ]
});

    /* ============================================
       OFFER CARDS CAROUSEL (SLICK SLIDER)
       ============================================ */
    $("#offerCarousel").slick({
        dots: true,
        arrows: true,
        infinite: true,
        speed: 500,
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        pauseOnHover: true,
        responsive: [

                {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: false
                }
            },
            
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: true
                }
            }
        ]
    });

    /* ============================================
       SEARCH BUTTON CLICK
       ============================================ */
    $("#searchFlightBtn").on("click", function () {
        var origin = $("#originInput").val();
        var destination = $("#destinationInput").val();
        var departure = $("#departureDate").val();
        var returnDate = $("#returnDate").val();
        var passengers = $("#passengerCount").text();
        var cabinClass = $("#cabinClassDisplay").text();

        // Simple validation
        if (!origin) {
            $("#originInput").focus();
            return;
        }
        if (!destination) {
            $("#destinationInput").focus();
            return;
        }

        // Log search data (can be replaced with actual search logic)
        console.log("Search Flights:", {
            origin: origin,
            destination: destination,
            departure: departure,
            returnDate: returnDate,
            passengers: passengers,
            cabinClass: cabinClass
        });

        // Alert for demo
        alert("Searching flights from " + origin + " to " + destination);
    });

    /* ============================================
       COUNTER AREA - Number Animation
       ============================================ */
    function animateCounters() {
        $('.counter-area__number').each(function() {
            var $this = $(this);
            if ($this.data('animated')) return;
            var target = parseInt($this.attr('data-target'), 10);
            if (isNaN(target)) return;
            $this.data('animated', true);
            $({ count: 0 }).animate({ count: target }, {
                duration: 2000,
                easing: 'swing',
                step: function() {
                    $this.text(Math.floor(this.count));
                },
                complete: function() {
                    $this.text(target);
                }
            });
        });
    }

    // Trigger counter animation when section comes into view
    var counterSection = $('.counter-area');
    if (counterSection.length) {
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });
        observer.observe(counterSection[0]);
    }

});



// document.body.innerHTML = document.body.innerHTML.replace(/&nbsp;/g, '');









// $(document).ready(function(){
//       $('#destinationsCarousel').slick({
//         slidesToShow: 5,
//         slidesToScroll: 1,
//         arrows: true,
//         dots: true,
//         speed: 300,
//         infinite: true,
//         autoplaySpeed: 5000,
//         autoplay: true,
//         responsive: [
//       {
//         breakpoint: 991,
//         settings: {
//           slidesToShow: 3,
//         }
//       },
//       {
//         breakpoint: 767,
//         settings: {
//           slidesToShow: 1,
//         }
//       }
//     ]
//       });
//     });




// Main slider stays at 1 slide visible across all screens
$('.adelaide').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});

// Thumbnail slider breaks down for mobile viewports
$('.slider-nav').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.adelaide',
  dots: true,
  focusOnSelect: true,
  responsive: [
    {
      breakpoint: 480, // Target mobile devices
      settings: {
        slidesToShow: 2, // Show fewer thumbnails on tiny screens
        slidesToScroll: 1
      }
    }
  ]
});

// External control triggers
$('a[data-slide]').click(function(e) {
  e.preventDefault();
  var slideno = $(this).data('slide');
  $('.adelaide').slick('slickGoTo', slideno - 1); 
});

















        $(document).ready(function () {
            // Tab functionality
            $('.adelaide-tabs__nav-link').click(function (e) {
                e.preventDefault();
                var tabId = $(this).data('tab');

                // Update active tab
                $('.adelaide-tabs__nav-item').removeClass('adelaide-tabs__nav-item--active');
                $(this).parent().addClass('adelaide-tabs__nav-item--active');

                // Update active panel
                $('.adelaide-tabs__panel').removeClass('adelaide-tabs__panel--active');
                $('#' + tabId).addClass('adelaide-tabs__panel--active');

                // Initialize carousel if not already initialized
                if (!$('#' + tabId + ' .adelaide-tabs__carousel').hasClass('slick-initialized')) {
                    $('#' + tabId + ' .adelaide-tabs__carousel').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 3000,
                        dots: true,
                        arrows: true,
                        prevArrow: '<button class="slick-prev"><</button>',
                        nextArrow: '<button class="slick-next">></button>',
                        responsive: [
                            {
                                breakpoint: 768,
                                settings: {
                                    arrows: false
                                }
                            }
                        ]
                    });
                }
            });

            // Initialize the first carousel on page load
            if (!$('#tab1 .adelaide-tabs__carousel').hasClass('slick-initialized')) {
                $('#tab1 .adelaide-tabs__carousel').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    dots: true,
                    arrows: true,
                    prevArrow: '<button class="slick-prev"><</button>',
                    nextArrow: '<button class="slick-next">></button>',
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                arrows: false
                            }
                        }
                    ]
                });
            }
        });








   document.addEventListener("DOMContentLoaded", function() {
            // Target all dropdown toggle links inside multi-level setups
            const subToggleLinks = document.querySelectorAll('.dropdown-submenu > .dropdown-toggle');

            subToggleLinks.forEach(function(element) {
                element.addEventListener('click', function(e) {
                    // Stop event from bubbling up and closing the entire structural container
                    e.stopPropagation();
                    
                    // Look for the closest list-item node parent 
                    const subMenuParent = this.parentElement;

                    // If it is mobile/tablet viewpoint, prevent default anchor tracking to safely open submenus instead
                    if (window.innerWidth < 992) {
                        e.preventDefault();
                        
                        // Toggle view visibility class
                        subMenuParent.classList.toggle('show-submenu');

                        // Clean up neighboring submenus at the same hierarchy depth level
                        const siblings = subMenuParent.parentElement.children;
                        for (let sibling of siblings) {
                            if (sibling !== subMenuParent && sibling.classList.contains('dropdown-submenu')) {
                                sibling.classList.remove('show-submenu');
                            }
                        }
                    }
                });
            });

            // If the parent link has a real file location (like href="Dubai.html"), let it act normally on desktop hover environments
            const activeLinks = document.querySelectorAll('.dropdown-submenu > a');
            activeLinks.forEach(function(link) {
                link.addEventListener('click', function(e) {
                    const hrefValue = this.getAttribute('href');
                    if (window.innerWidth >= 992 && hrefValue && hrefValue !== '#') {
                        window.location.href = hrefValue;
                    }
                });
            });
        });

































































































