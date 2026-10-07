<!doctype html>
<?php 
	  include('_config.php'); 

	  $sql = "SELECT * FROM airports";
	  $sql_from = "SELECT * FROM airports WHERE Country_Code = 'GB'";

	  $result = $conn->query($sql_from);
	  $result1 = $conn->query($sql);
	?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>American Fly - Cheap Flights, Hotels and Holidays</title>

    <!-- Bootstrap 5.0.2 CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="css/index.css" />
    <link
      rel="stylesheet"
      href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
      integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- Font Awesome Icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />

    <!-- Select2 CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
      rel="stylesheet"
    />

    <!-- Flatpickr Datepicker CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"
    />
    <link
      rel="stylesheet"
      href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css"
    />

    <style>
      /* Glassmorphism Outer Container */
      .bs-hero-search {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.35);
        border-radius: 1.5rem;
        padding: 1.5rem;
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 10;
      }

      /* Inner Input Cards */
      .bs-field-card {
        background: #ffffff;
        border-radius: 0.85rem;
        padding: 0.65rem 1rem;
        min-height: 64px;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        border: 1.5px solid transparent;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition:
          border-color 0.2s ease,
          box-shadow 0.2s ease;
      }

      .bs-field-card:focus-within {
        border-color: #0ea5e9;
        box-shadow: 0 6px 18px rgba(14, 165, 233, 0.16);
      }

      .bs-field-icon {
        font-size: 1.15rem;
        color: #64748b;
        min-width: 22px;
        text-align: center;
      }

      .bs-field-label {
        font-size: 0.7rem;
        font-weight: 700;
        color: #94a3b8;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        line-height: 1;
        margin-bottom: 3px;
      }

      /* Plain Clean Inputs */
      .bs-field-input,
      .bs-field-select {
        border: none;
        outline: none;
        background: transparent;
        font-size: 0.94rem;
        font-weight: 600;
        color: #0f172a;
        width: 100%;
        box-shadow: none;
        padding: 0;
        cursor: pointer;
      }

      .bs-field-select {
        appearance: none;
        -webkit-appearance: none;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E")
          no-repeat right 0 center/14px;
        padding-right: 18px;
      }

      /* Submit Button */
      .bs-search-btn {
        background: linear-gradient(135deg, #0284c7 0%, #06b6d4 100%);
        color: #ffffff;
        font-size: 0.95rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        border-radius: 0.85rem;
        border: none;
        min-height: 64px;
        box-shadow: 0 8px 20px rgba(6, 182, 212, 0.35);
        transition:
          transform 0.2s ease,
          box-shadow 0.2s ease;
        white-space: nowrap;
      }

      .bs-search-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(6, 182, 212, 0.45);
        color: #ffffff;
      }

      /* Select2 overrides inside the card */
      .bs-field-card .select2-container {
        width: 100% !important;
      }

      .bs-field-card .select2-container--default .select2-selection--single {
        border: none !important;
        background: transparent !important;
        height: auto !important;
        padding: 0 !important;
      }

      .bs-field-card
        .select2-container--default
        .select2-selection--single
        .select2-selection__rendered {
        padding: 0 !important;
        font-weight: 600 !important;
        color: #0f172a !important;
        font-size: 0.94rem !important;
        line-height: normal !important;
      }

      .bs-field-card
        .select2-container--default
        .select2-selection--single
        .select2-selection__arrow {
        height: 100% !important;
        top: 0 !important;
        right: 0 !important;
      }

      .select2-dropdown {
        border-radius: 12px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 10px 28px rgba(0, 0, 0, 0.14) !important;
        z-index: 99999 !important;
      }

      .select2-results__option--highlighted[aria-selected] {
        background-color: #0284c7 !important;
      }
    </style>
  </head>

  <body>
    <!-- ============================================
         STICKY WRAPPER START (Header + Navbar)
         ============================================ -->
    <div class="flight-sticky-wrapper" id="flightStickyWrapper">
      <!-- ============================================
         HEADER SECTION START
         ============================================ -->
      <header class="flight-header">
        <div class="container">
          <div class="flight-header__top-row">
            <!-- First Div: Logo & Badges -->
            <div class="flight-header__logo-badges">
              <!-- Logo Div -->
              <div class="flight-header__logo">
                <a href="#" class="flight-header__logo-link">
                  <img
                    src="assets/logo.png"
                    alt="American Fly Logo"
                    class="flight-header__logo-img"
                  />
                </a>
              </div>
              <!-- Logo Div End -->

              <!-- Badges Div -->
              <!-- Badges Div End -->
            </div>
            <div class="flight-header__badges">
              <img
                src="assets/cert/tta.png"
                alt="Badge 1"
                class="flight-header__badge-item"
              />
              <img
                src="assets/cert/tta-trans.png"
                alt="Badge 2"
                class="flight-header__badge-item"
              />
              <img
                src="assets/cert/atol_logo_white.png"
                alt="Badge 3"
                class="flight-header__badge-item"
              />
            </div>
            <!-- First Div End -->

            <!-- Second Div: Contact Info -->
            <div class="flight-header__contact-info">
              <img
                src="assets/icons/callIcon.svg"
                alt="Call Icon"
                class="flight-header__call-icon"
              />
              <div class="flight-header__contact-text">
                <span class="flight-header__contact-title"
                  >Talk to our Specialists Today for Lowest Price</span
                >
                <span class="flight-header__contact-phone">0203 137 5177</span>
                <span class="flight-header__contact-timing"
                  >08:00 AM - 11:30 PM / 7 Days a Week</span
                >
              </div>
            </div>
            <!-- Second Div End -->
          </div>
        </div>
      </header>
      <!-- ============================================
         NAVBAR SECTION START
         ============================================ -->
      <nav class="flight-navbar">
        <div class="container">
          <div
            class="flight-navbar__container d-flex align-items-center justify-content-between"
          >
            <a href="#" class="flight-header__logo-link d-block d-md-none">
              <img
                src="assets/logo.png"
                alt="American Fly Logo"
                class="flight-header__logo-img"
              />
            </a>
            <!-- Mobile Toggle Button -->
            <button
              class="flight-navbar__toggle ms-auto"
              type="button"
              id="navbarToggleBtn"
            >
              <div class="flight-navbar__toggle-icon">
                <span></span>
                <span></span>
                <span></span>
              </div>
            </button>

            <!-- Navbar Menu -->
            <ul class="flight-navbar__menu-list" id="navbarMenuList">
              <li class="flight-navbar__menu-item">
                <a
                  href="Index.html"
                  class="flight-navbar__menu-link flight-navbar__menu-link--active"
                  >Home</a
                >
              </li>
              <li class="flight-navbar__menu-item">
                <a href="about-us.html" class="flight-navbar__menu-link"
                  >About Us</a
                >
              </li>
              <!-- <li
                class="flight-navbar__menu-item flight-navbar__menu-item--has-dropdown"
              >
                <a href="#" class="flight-navbar__menu-link"
                  >Pages <span class="flight-navbar__dropdown-arrow">▼</span></a
                >
                <ul class="flight-navbar__dropdown">
                  <li class="flight-navbar__dropdown-item">
                    <a
                      href="Destination.html"
                      class="flight-navbar__dropdown-link"
                      >Destination</a
                    >
                  </li>
                  <li class="flight-navbar__dropdown-item">
                    <a href="Package.html" class="flight-navbar__dropdown-link"
                      >Package</a
                    >
                  </li>
                  <li class="flight-navbar__dropdown-item">
                    <a href="Camper.html" class="flight-navbar__dropdown-link"
                      >Camper</a
                    >
                  </li>
                  <li class="flight-navbar__dropdown-item">
                    <a
                      href="BusinessClass.html"
                      class="flight-navbar__dropdown-link"
                      >Business Class</a
                    >
                  </li>
                  <li class="flight-navbar__dropdown-item">
                    <a
                      href="BeatMyQuote.html"
                      class="flight-navbar__dropdown-link"
                      >Beat My Quote</a
                    >
                  </li>
                </ul>
              </li> -->
              <li class="flight-navbar__menu-item">
                <a href="privacy-policy.html" class="flight-navbar__menu-link"
                  >Privacy Policy</a
                >
              </li>
              <li class="flight-navbar__menu-item">
                <a
                  href="terms-and-conditions.html"
                  class="flight-navbar__menu-link"
                  >Terms & Condition</a
                >
              </li>
              <li class="flight-navbar__menu-item">
                <a href="contact-us.html" class="flight-navbar__menu-link"
                  >Contact Us</a
                >
              </li>
            </ul>
            <!-- Navbar Menu End -->
          </div>
        </div>
      </nav>
    </div>
    <!-- STICKY WRAPPER END (Header + Navbar) -->

    <div class="home-wrapper">
      <!-- ============================================
         BANNER SECTION START
         ============================================ -->
      <section class="flight-banner">
        <!-- Banner Background Image -->
        <img
          src="assets/banner/hero2.png"
          alt="Flight Banner"
          class="flight-banner__bg-image"
        />
        <!-- Banner Overlay -->
        <div class="flight-banner__overlay"></div>

        <!-- Banner Content -->
        <div class="flight-banner__content">
          <h2 class="flight-banner__title">Explore The World Together</h2>
          <p class="flight-banner__subtitle">
            Find awesome flight, hotel, tour, car and packages
          </p>

          <!-- BOOTSTRAP 5 POWERED SEARCH BOX -->
          <div class="container px-0 my-4">
            <div class="bs-hero-search mx-auto">
              <form
                onsubmit="
                  event.preventDefault();
                  window.location.href = '#';
                "
              >
                <!-- Top Row: Origin & Destination -->
                <div class="row g-3 mb-3">
                  <!-- Origin -->
                  <div class="col-12 col-md-6">
                    <div class="bs-field-card">
                      <div class="bs-field-icon">
                        <i class="fa-solid fa-location-dot"></i>
                      </div>
                      <div class="flex-grow-1 overflow-hidden">
                        <div class="bs-field-label">Origin</div>
                        <select class="bs-select2-origin" name="origin">
                          <option>Select Origin</option>
                          <?php
                            if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                echo "<option value=\"".$row["Airport_Code"]."\">".$row["Airport_Name"]." (".$row["Airport_Code"].")</option>";
                              }
                            }
                          ?>
                          <!-- <option value="DEL">
                            DEL - Indira Gandhi Intl, New Delhi
                          </option>
                          <option value="LHR">LHR - Heathrow, London</option>
                          <option value="DXB">DXB - Dubai International</option>
                          <option value="HND">HND - Haneda, Tokyo</option> -->
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Destination -->
                  <div class="col-12 col-md-6">
                    <div class="bs-field-card">
                      <div class="bs-field-icon">
                        <i
                          class="fa-solid fa-arrows-split-up-and-left fa-rotate-90"
                        ></i>
                      </div>
                      <div class="flex-grow-1 overflow-hidden">
                        <div class="bs-field-label">Destination</div>
                        <select
                          class="bs-select2-destination"
                          name="destination"
                        >
                        <option value="">Select Destination</option>
                        <?php
                          if ($result1->num_rows > 0) {
                            while($row1 = $result1->fetch_assoc()) {
                              echo "<option value=\"".$row1["Airport_Code"]."\">".$row1["Airport_Name"]." (".$row1["Airport_Code"].")</option>";
                            }
                          }
                        ?>
                          <!-- <option value="HNL" selected>
                            HNL - Honolulu, Hawaii
                          </option>
                          <option value="CDG">
                            CDG - Charles de Gaulle, Paris
                          </option>
                          <option value="SIN">SIN - Changi, Singapore</option>
                          <option value="SYD">
                            SYD - Sydney Kingsford Smith
                          </option>
                          <option value="BOM">BOM - Mumbai, India</option> -->
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Bottom Row: Dates, Adults, Class, Search Button -->
                <div class="row g-3 align-items-stretch">
                  <!-- Start Date -->
                  <div class="col-12 col-sm-6 col-lg-3">
                    <div class="bs-field-card h-100">
                      <div class="bs-field-icon">
                        <i class="fa-regular fa-calendar-days"></i>
                      </div>
                      <div class="flex-grow-1">
                        <div class="bs-field-label">Start Date</div>
                        <input
                          type="text"
                          class="bs-field-input"
                          id="bsStartDate"
                          placeholder="Select date"
                          readonly
                        />
                      </div>
                    </div>
                  </div>

                  <!-- Return Date -->
                  <div class="col-12 col-sm-6 col-lg-3">
                    <div class="bs-field-card h-100">
                      <div class="bs-field-icon">
                        <i class="fa-regular fa-calendar-check"></i>
                      </div>
                      <div class="flex-grow-1">
                        <div class="bs-field-label">Return Date</div>
                        <input
                          type="text"
                          class="bs-field-input"
                          id="bsReturnDate"
                          placeholder="Select date"
                          readonly
                        />
                      </div>
                    </div>
                  </div>

                  <!-- Adults -->
                  <div class="col-12 col-sm-6 col-lg-2">
                    <div class="bs-field-card h-100">
                      <div class="bs-field-icon">
                        <i class="fa-solid fa-user-group"></i>
                      </div>
                      <div class="flex-grow-1">
                        <div class="bs-field-label">Adults</div>
                        <select class="bs-field-select" name="adults">
                          <option value="1" selected>1 Adult</option>
                          <option value="2">2 Adults</option>
                          <option value="3">3 Adults</option>
                          <option value="4">4 Adults</option>
                          <option value="5">5+ Adults</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Class -->
                  <div class="col-12 col-sm-6 col-lg-2">
                    <div class="bs-field-card h-100">
                      <div class="bs-field-icon">
                        <i class="fa-solid fa-plane-up"></i>
                      </div>
                      <div class="flex-grow-1">
                        <div class="bs-field-label">Class</div>
                        <select class="bs-field-select" name="cabin_class">
                          <option value="1">Economy</option>
                          <option value="4">Premium</option>
                          <option value="2" selected>Business</option>
                          <option value="3">First Class</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="child" value="0" />
                  <!-- Search Button -->
                  <div class="col-12 col-lg-2 d-grid">
                    <button
                      type="submit"
                      class="bs-search-btn w-100 d-flex align-items-center justify-content-center gap-2"
                    >
                      <i class="fa-solid fa-arrow-right"></i>
                      <span>Search</span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- END BOOTSTRAP 5 SEARCH BOX -->
        </div>
      </section>
      <!-- BANNER SECTION END -->

      <!-- ============================================
         NEXT SECTION DIV START
         ============================================ -->
      <div class="flight-next-section" id="nextSection">
        <div class="container">
          <!-- Section Header -->
          <div class="flight-next-section__header index-header">
            <p class="flight-next-section__subtitle">
              <span class="flight-next-section__subtitle-icon"
                ><img src="/assets/icons/flight.svg" alt="" /> FLIGHTS</span
              >
            </p>
            <h2 class="flight-next-section__title">
              Fly the Favourites - Most Booked Flights
            </h2>
          </div>

          <!-- Destinations Carousel -->
          <div class="flight-destinations-carousel" id="destinationsCarousell">
            <!-- Destination Card 1 - New York -->
            <div class="flight-destination-card">
              <div class="flight-destination-card__image-wrapper">
                <img
                  src="assets/cards/new-york.webp"
                  alt="New York"
                  class="flight-destination-card__image"
                />
                <div class="flight-destination-card__overlay">
                  <span class="flight-destination-card__price">From £259</span>
                </div>
              </div>
              <div class="flight-destination-card__content">
                <h3 class="flight-destination-card__name">New York</h3>
                <p class="flight-destination-card__detail">
                  JFK - John F. Kennedy Intl
                </p>
                <div class="flight-destination-card__meta">
                  <span class="flight-destination-card__route"
                    >Return Flight</span
                  >
                  <a
                    href="tel:02031375177"
                    class="flight-destination-card__link"
                    >Contact Now →</a
                  >
                </div>
              </div>
            </div>

            <!-- Destination Card 2 - Los Angeles -->
            <div class="flight-destination-card">
              <div class="flight-destination-card__image-wrapper">
                <img
                  src="assets/cards/los-angeles.webp"
                  alt="Los Angeles"
                  class="flight-destination-card__image"
                />
                <div class="flight-destination-card__overlay">
                  <span class="flight-destination-card__price">From £299</span>
                </div>
              </div>
              <div class="flight-destination-card__content">
                <h3 class="flight-destination-card__name">Los Angeles</h3>
                <p class="flight-destination-card__detail">
                  LAX - Los Angeles Intl
                </p>
                <div class="flight-destination-card__meta">
                  <span class="flight-destination-card__route"
                    >Return Flight</span
                  >
                  <a
                    href="tel:02031375177"
                    class="flight-destination-card__link"
                    >Contact Now →</a
                  >
                </div>
              </div>
            </div>

            <!-- Destination Card 3 - Miami -->
            <div class="flight-destination-card">
              <div class="flight-destination-card__image-wrapper">
                <img
                  src="assets/cards/miami.webp"
                  alt="Miami"
                  class="flight-destination-card__image"
                />
                <div class="flight-destination-card__overlay">
                  <span class="flight-destination-card__price">From £279</span>
                </div>
              </div>
              <div class="flight-destination-card__content">
                <h3 class="flight-destination-card__name">Miami</h3>
                <p class="flight-destination-card__detail">MIA - Miami Intl</p>
                <div class="flight-destination-card__meta">
                  <span class="flight-destination-card__route"
                    >Return Flight</span
                  >
                  <a
                    href="tel:02031375177"
                    class="flight-destination-card__link"
                    >Contact Now →</a
                  >
                </div>
              </div>
            </div>

            <!-- Destination Card 4 - Orlando -->
            <div class="flight-destination-card">
              <div class="flight-destination-card__image-wrapper">
                <img
                  src="assets/cards/orlando.webp"
                  alt="Orlando"
                  class="flight-destination-card__image"
                />
                <div class="flight-destination-card__overlay">
                  <span class="flight-destination-card__price">From £249</span>
                </div>
              </div>
              <div class="flight-destination-card__content">
                <h3 class="flight-destination-card__name">Orlando</h3>
                <p class="flight-destination-card__detail">
                  MCO - Orlando Intl
                </p>
                <div class="flight-destination-card__meta">
                  <span class="flight-destination-card__route"
                    >Return Flight</span
                  >
                  <a
                    href="tel:02031375177"
                    class="flight-destination-card__link"
                    >Contact Now →</a
                  >
                </div>
              </div>
            </div>

            <!-- Destination Card 5 - Boston -->
            <div class="flight-destination-card">
              <div class="flight-destination-card__image-wrapper">
                <img
                  src="assets/cards/boston.webp"
                  alt="Boston"
                  class="flight-destination-card__image"
                />
                <div class="flight-destination-card__overlay">
                  <span class="flight-destination-card__price">From £269</span>
                </div>
              </div>
              <div class="flight-destination-card__content">
                <h3 class="flight-destination-card__name">Boston</h3>
                <p class="flight-destination-card__detail">
                  BOS - Boston Logan Intl
                </p>
                <div class="flight-destination-card__meta">
                  <span class="flight-destination-card__route"
                    >Return Flight</span
                  >
                  <a
                    href="tel:02031375177"
                    class="flight-destination-card__link"
                    >Contact Now →</a
                  >
                </div>
              </div>
            </div>

            <!-- Destination Card 6 - Las Vegas -->
            <div class="flight-destination-card">
              <div class="flight-destination-card__image-wrapper">
                <img
                  src="assets/cards/las-vegas.webp"
                  alt="Las Vegas"
                  class="flight-destination-card__image"
                />
                <div class="flight-destination-card__overlay">
                  <span class="flight-destination-card__price">From £289</span>
                </div>
              </div>
              <div class="flight-destination-card__content">
                <h3 class="flight-destination-card__name">Las Vegas</h3>
                <p class="flight-destination-card__detail">
                  LAS - McCarran Intl
                </p>
                <div class="flight-destination-card__meta">
                  <span class="flight-destination-card__route"
                    >Return Flight</span
                  >
                  <a
                    href="tel:02031375177"
                    class="flight-destination-card__link"
                    >Contact Now →</a
                  >
                </div>
              </div>
            </div>

            <!-- Destination Card 7 - Toronto -->
            <div class="flight-destination-card">
              <div class="flight-destination-card__image-wrapper">
                <img
                  src="assets/cards/toronto.webp"
                  alt="Toronto"
                  class="flight-destination-card__image"
                />
                <div class="flight-destination-card__overlay">
                  <span class="flight-destination-card__price">From £239</span>
                </div>
              </div>
              <div class="flight-destination-card__content">
                <h3 class="flight-destination-card__name">Toronto</h3>
                <p class="flight-destination-card__detail">
                  YYZ - Pearson Intl
                </p>
                <div class="flight-destination-card__meta">
                  <span class="flight-destination-card__route"
                    >Return Flight</span
                  >
                  <a
                    href="tel:02031375177"
                    class="flight-destination-card__link"
                    >Contact Now →</a
                  >
                </div>
              </div>
            </div>
          </div>
          <!-- Destinations Carousel End -->
        </div>
      </div>
      <!-- NEXT SECTION DIV END -->

      <!-- ============================================
         GALLERY SECTION START
         ============================================ -->
      <section class="gallery-section" id="gallerySection">
        <div class="container mt-5">
          <!-- Gallery Section Header -->
          <div class="gallery-section__header">
            <p class="gallery-section__subtitle">
              <span class="gallery-section__subtitle-icon"
                ><img src="/assets/icons/flight.svg" alt="" /> HOLIDAYS</span
              >
            </p>
            <h2 class="gallery-section__title">
              USA Holiday Packages - Best Deals Await
            </h2>
          </div>

          <!-- Gallery Content -->
          <div class="gallery-section__content">
            <!-- Left Side: Full Height Featured Image -->
            <div class="gallery-section__featured">
              <div class="gallery-section__featured-image-wrapper">
                <img
                  src="assets/cards/london.png"
                  alt="USA Holiday"
                  class="gallery-section__featured-image"
                />
                <div class="gallery-section__featured-overlay">
                  <span class="gallery-section__featured-badge"
                    >Up to 50% Off</span
                  >
                  <h3 class="gallery-section__featured-title">
                    USA Holiday Packages
                  </h3>
                  <p class="gallery-section__featured-text">
                    Explore the best destinations across America with unbeatable
                    deals
                  </p>
                  <a
                    href="tel:02031375177"
                    class="gallery-section__featured-btn"
                    >Contact Now</a
                  >
                </div>
              </div>
            </div>

            <!-- Right Side: Mini Diamond Cards Grid -->
            <div class="gallery-section__grid">
              <!-- Card 1 -->
              <div class="gallery-section__card">
                <div class="gallery-section__card-image-wrapper">
                  <img
                    src="assets/cards/ny.png"
                    alt="New York"
                    class="gallery-section__card-image"
                  />
                  <div class="gallery-section__card-overlay">
                    <span class="gallery-section__card-name">New York</span>
                  </div>
                </div>
                <a href="tel:02031375177" class="gallery-section__card-btn"
                  >Contact Now</a
                >
              </div>

              <!-- Card 2 -->
              <div class="gallery-section__card">
                <div class="gallery-section__card-image-wrapper">
                  <img
                    src="assets/cards/lv.png"
                    alt="Las Vegas"
                    class="gallery-section__card-image"
                  />
                  <div class="gallery-section__card-overlay">
                    <span class="gallery-section__card-name">Las Vegas</span>
                  </div>
                </div>
                <a href="tel:02031375177" class="gallery-section__card-btn"
                  >Contact Now</a
                >
              </div>

              <!-- Card 3 -->
              <div class="gallery-section__card">
                <div class="gallery-section__card-image-wrapper">
                  <img
                    src="assets/cards/la.png"
                    alt="San Francisco"
                    class="gallery-section__card-image"
                  />
                  <div class="gallery-section__card-overlay">
                    <span class="gallery-section__card-name">Los Angeles</span>
                  </div>
                </div>
                <a href="tel:02031375177" class="gallery-section__card-btn"
                  >Contact Now</a
                >
              </div>

              <!-- Card 4 -->
              <div class="gallery-section__card">
                <div class="gallery-section__card-image-wrapper">
                  <img
                    src="assets/cards/or.png"
                    alt="Orlando"
                    class="gallery-section__card-image"
                  />
                  <div class="gallery-section__card-overlay">
                    <span class="gallery-section__card-name">Orlando</span>
                  </div>
                </div>
                <a href="tel:02031375177" class="gallery-section__card-btn"
                  >Contact Now</a
                >
              </div>

              <!-- Card 5 -->
              <div class="gallery-section__card">
                <div class="gallery-section__card-image-wrapper">
                  <img
                    src="assets/cards/boston.webp"
                    alt="Washington DC"
                    class="gallery-section__card-image"
                  />
                  <div class="gallery-section__card-overlay">
                    <span class="gallery-section__card-name"
                      >Washington DC</span
                    >
                  </div>
                </div>
                <a href="tel:02031375177" class="gallery-section__card-btn"
                  >Contact Now</a
                >
              </div>

              <!-- Card 6 -->
              <div class="gallery-section__card">
                <div class="gallery-section__card-image-wrapper">
                  <img
                    src="assets/cards/miami.webp"
                    alt="Miami"
                    class="gallery-section__card-image"
                  />
                  <div class="gallery-section__card-overlay">
                    <span class="gallery-section__card-name">Miami</span>
                  </div>
                </div>
                <a href="tel:02031375177" class="gallery-section__card-btn"
                  >Contact Now</a
                >
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- GALLERY SECTION END -->

      <!-- ============================================
         OFFER CARDS SECTION START
         ============================================ -->
      <section class="offer-section" id="offerSection">
        <div class="container mt-5">
          <!-- Offer Section Header -->
          <div class="offer-section__header">
            <p class="offer-section__subtitle">
              <span class="offer-section__subtitle-icon"
                ><img src="/assets/icons/flight.svg" alt="" /> OFFERS</span
              >
            </p>
            <h2 class="offer-section__title">Let's Check Exclusive Offers</h2>
          </div>

          <!-- Offer Cards Carousel -->
          <div class="offer-section__carousel" id="offerCarousel">
            <!-- Offer Card 1 -->
            <div class="offer-card">
              <div class="offer-card__image-side">
                <img
                  src="assets/cards/ny-card.png"
                  alt="Offer 1"
                  class="offer-card__image"
                />
              </div>
              <div class="offer-card__content-side">
                <span class="offer-card__badge">Limited Time</span>
                <h3 class="offer-card__title">New York Adventure</h3>
                <p class="offer-card__description">
                  Explore the city that never sleeps with our exclusive flight
                  and hotel packages. Book now and save big!
                </p>
                <div class="offer-card__price-row">
                  <span class="offer-card__price-label">Starting from</span>
                  <span class="offer-card__price">£259</span>
                </div>
                <a href="tel:02031375177" class="offer-card__btn"
                  >Contact Us
                  <span class="offer-card__btn-arrow"
                    ><svg
                      width="13"
                      height="10"
                      viewBox="0 0 13 10"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M-0.000540733 4.9971C-0.000540733 4.79818 0.0784773 4.60742 0.21913 4.46676C0.359782 4.32611 0.550547 4.2471 0.749459 4.2471H9.53646L6.24946 1.3061C6.10253 1.17313 6.0142 0.987427 6.00375 0.789545C5.9933 0.591663 6.06159 0.397688 6.1937 0.249993C6.32581 0.102297 6.511 0.0128845 6.70881 0.00128682C6.90663 -0.0103109 7.101 0.0568487 7.24946 0.188095L11.9995 4.4381C12.0783 4.50845 12.1413 4.59466 12.1845 4.69108C12.2277 4.7875 12.25 4.89195 12.25 4.99759C12.25 5.10324 12.2277 5.20769 12.1845 5.30411C12.1413 5.40053 12.0783 5.48674 11.9995 5.5571L7.24946 9.8071C7.17616 9.87343 7.09047 9.92462 6.99732 9.95772C6.90416 9.99081 6.80539 10.0052 6.70667 9.99996C6.60795 9.99475 6.51123 9.97007 6.42208 9.92734C6.33293 9.88462 6.25311 9.82469 6.1872 9.75101C6.12129 9.67733 6.07061 9.59134 6.03805 9.498C6.00549 9.40465 5.99171 9.30579 5.9975 9.20711C6.00328 9.10842 6.02852 9.01185 6.07176 8.92295C6.115 8.83405 6.17539 8.75457 6.24946 8.6891L9.53646 5.7471H0.749459C0.550547 5.7471 0.359782 5.66808 0.21913 5.52742C0.0784773 5.38677 -0.000540733 5.19601 -0.000540733 4.9971Z"
                        fill="#24BDC7"
                      />
                    </svg> </span
                ></a>
              </div>
            </div>

            <!-- Offer Card 2 -->
            <div class="offer-card">
              <div class="offer-card__image-side">
                <img
                  src="assets/cards/lv-card.png"
                  alt="Offer 2"
                  class="offer-card__image"
                />
              </div>
              <div class="offer-card__content-side">
                <span class="offer-card__badge">Hot Deal</span>
                <h3 class="offer-card__title">Las Vegas Getaway</h3>
                <p class="offer-card__description">
                  Experience the entertainment capital of the world. Unbeatable
                  prices on flights and stays!
                </p>
                <div class="offer-card__price-row">
                  <span class="offer-card__price-label">Starting from</span>
                  <span class="offer-card__price">£289</span>
                </div>
                <a href="tel:02031375177" class="offer-card__btn"
                  >Contact Us
                  <span class="offer-card__btn-arrow"
                    ><svg
                      width="13"
                      height="10"
                      viewBox="0 0 13 10"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M-0.000540733 4.9971C-0.000540733 4.79818 0.0784773 4.60742 0.21913 4.46676C0.359782 4.32611 0.550547 4.2471 0.749459 4.2471H9.53646L6.24946 1.3061C6.10253 1.17313 6.0142 0.987427 6.00375 0.789545C5.9933 0.591663 6.06159 0.397688 6.1937 0.249993C6.32581 0.102297 6.511 0.0128845 6.70881 0.00128682C6.90663 -0.0103109 7.101 0.0568487 7.24946 0.188095L11.9995 4.4381C12.0783 4.50845 12.1413 4.59466 12.1845 4.69108C12.2277 4.7875 12.25 4.89195 12.25 4.99759C12.25 5.10324 12.2277 5.20769 12.1845 5.30411C12.1413 5.40053 12.0783 5.48674 11.9995 5.5571L7.24946 9.8071C7.17616 9.87343 7.09047 9.92462 6.99732 9.95772C6.90416 9.99081 6.80539 10.0052 6.70667 9.99996C6.60795 9.99475 6.51123 9.97007 6.42208 9.92734C6.33293 9.88462 6.25311 9.82469 6.1872 9.75101C6.12129 9.67733 6.07061 9.59134 6.03805 9.498C6.00549 9.40465 5.99171 9.30579 5.9975 9.20711C6.00328 9.10842 6.02852 9.01185 6.07176 8.92295C6.115 8.83405 6.17539 8.75457 6.24946 8.6891L9.53646 5.7471H0.749459C0.550547 5.7471 0.359782 5.66808 0.21913 5.52742C0.0784773 5.38677 -0.000540733 5.19601 -0.000540733 4.9971Z"
                        fill="#24BDC7"
                      />
                    </svg> </span
                ></a>
              </div>
            </div>

            <!-- Offer Card 3 -->
            <div class="offer-card">
              <div class="offer-card__image-side">
                <img
                  src="assets/cards/miami-card.png"
                  alt="Offer 3"
                  class="offer-card__image"
                />
              </div>
              <div class="offer-card__content-side">
                <span class="offer-card__badge">Special Offer</span>
                <h3 class="offer-card__title">Miami Beach Escape</h3>
                <p class="offer-card__description">
                  Relax on stunning beaches and enjoy vibrant nightlife. Grab
                  this deal before it's gone!
                </p>
                <div class="offer-card__price-row">
                  <span class="offer-card__price-label">Starting from</span>
                  <span class="offer-card__price">£299</span>
                </div>
                <a href="tel:02031375177" class="offer-card__btn"
                  >Contact Us
                  <span class="offer-card__btn-arrow"
                    ><svg
                      width="13"
                      height="10"
                      viewBox="0 0 13 10"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M-0.000540733 4.9971C-0.000540733 4.79818 0.0784773 4.60742 0.21913 4.46676C0.359782 4.32611 0.550547 4.2471 0.749459 4.2471H9.53646L6.24946 1.3061C6.10253 1.17313 6.0142 0.987427 6.00375 0.789545C5.9933 0.591663 6.06159 0.397688 6.1937 0.249993C6.32581 0.102297 6.511 0.0128845 6.70881 0.00128682C6.90663 -0.0103109 7.101 0.0568487 7.24946 0.188095L11.9995 4.4381C12.0783 4.50845 12.1413 4.59466 12.1845 4.69108C12.2277 4.7875 12.25 4.89195 12.25 4.99759C12.25 5.10324 12.2277 5.20769 12.1845 5.30411C12.1413 5.40053 12.0783 5.48674 11.9995 5.5571L7.24946 9.8071C7.17616 9.87343 7.09047 9.92462 6.99732 9.95772C6.90416 9.99081 6.80539 10.0052 6.70667 9.99996C6.60795 9.99475 6.51123 9.97007 6.42208 9.92734C6.33293 9.88462 6.25311 9.82469 6.1872 9.75101C6.12129 9.67733 6.07061 9.59134 6.03805 9.498C6.00549 9.40465 5.99171 9.30579 5.9975 9.20711C6.00328 9.10842 6.02852 9.01185 6.07176 8.92295C6.115 8.83405 6.17539 8.75457 6.24946 8.6891L9.53646 5.7471H0.749459C0.550547 5.7471 0.359782 5.66808 0.21913 5.52742C0.0784773 5.38677 -0.000540733 5.19601 -0.000540733 4.9971Z"
                        fill="#24BDC7"
                      />
                    </svg> </span
                ></a>
              </div>
            </div>

            <!-- Offer Card 4 -->
            <div class="offer-card">
              <div class="offer-card__image-side">
                <img
                  src="assets/cards/or-card.png"
                  alt="Offer 4"
                  class="offer-card__image"
                />
              </div>
              <div class="offer-card__content-side">
                <span class="offer-card__badge">Best Price</span>
                <h3 class="offer-card__title">Orlando Family Fun</h3>
                <p class="offer-card__description">
                  Create unforgettable memories with theme parks and sunshine.
                  Perfect family holiday awaits!
                </p>
                <div class="offer-card__price-row">
                  <span class="offer-card__price-label">Starting from</span>
                  <span class="offer-card__price">£269</span>
                </div>
                <a href="tel:02031375177" class="offer-card__btn"
                  >Contact Us
                  <span class="offer-card__btn-arrow"
                    ><svg
                      width="13"
                      height="10"
                      viewBox="0 0 13 10"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M-0.000540733 4.9971C-0.000540733 4.79818 0.0784773 4.60742 0.21913 4.46676C0.359782 4.32611 0.550547 4.2471 0.749459 4.2471H9.53646L6.24946 1.3061C6.10253 1.17313 6.0142 0.987427 6.00375 0.789545C5.9933 0.591663 6.06159 0.397688 6.1937 0.249993C6.32581 0.102297 6.511 0.0128845 6.70881 0.00128682C6.90663 -0.0103109 7.101 0.0568487 7.24946 0.188095L11.9995 4.4381C12.0783 4.50845 12.1413 4.59466 12.1845 4.69108C12.2277 4.7875 12.25 4.89195 12.25 4.99759C12.25 5.10324 12.2277 5.20769 12.1845 5.30411C12.1413 5.40053 12.0783 5.48674 11.9995 5.5571L7.24946 9.8071C7.17616 9.87343 7.09047 9.92462 6.99732 9.95772C6.90416 9.99081 6.80539 10.0052 6.70667 9.99996C6.60795 9.99475 6.51123 9.97007 6.42208 9.92734C6.33293 9.88462 6.25311 9.82469 6.1872 9.75101C6.12129 9.67733 6.07061 9.59134 6.03805 9.498C6.00549 9.40465 5.99171 9.30579 5.9975 9.20711C6.00328 9.10842 6.02852 9.01185 6.07176 8.92295C6.115 8.83405 6.17539 8.75457 6.24946 8.6891L9.53646 5.7471H0.749459C0.550547 5.7471 0.359782 5.66808 0.21913 5.52742C0.0784773 5.38677 -0.000540733 5.19601 -0.000540733 4.9971Z"
                        fill="#24BDC7"
                      />
                    </svg> </span
                ></a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- OFFER CARDS SECTION END -->

      <!-- COUNTER AREA SECTION START -->
      <section class="counter-area">
        <div class="container">
          <div class="counter-area__inner">
            <div class="counter-area__card">
              <div class="counter-area__icon" style="background-color: #ffffff">
                <svg
                  width="32"
                  height="32"
                  viewBox="0 0 33 32"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M15.7446 17.7094L14.8327 17.3943C14.7112 17.3529 14.579 17.3609 14.4628 17.417C14.348 17.473 14.2599 17.5718 14.2185 17.6933C14.1758 17.8135 14.1838 17.947 14.2412 18.0618C14.2973 18.1767 14.3961 18.2648 14.5176 18.3062L15.4295 18.6213C15.551 18.6627 15.6832 18.6547 15.7993 18.5986C15.9141 18.5438 16.0023 18.4437 16.0437 18.3222C16.0864 18.202 16.077 18.0685 16.021 17.9537C15.9649 17.8389 15.8661 17.7508 15.7446 17.7094Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M19.2325 18.0605C18.6664 18.2087 18.0789 18.2514 17.4968 18.1887C17.37 18.174 17.2418 18.2114 17.1416 18.2902C17.0415 18.3703 16.9774 18.4878 16.9641 18.6146C16.9494 18.7415 16.9868 18.8696 17.0669 18.9698C17.147 19.0699 17.2645 19.1327 17.3913 19.1474C18.0896 19.2248 18.7973 19.1727 19.4782 18.9938C19.7345 18.9257 19.8881 18.6627 19.8213 18.405C19.7532 18.1473 19.4902 17.9938 19.2325 18.0605Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M15.9304 8.01716C16.1908 8.07458 16.4485 7.90901 16.5045 7.64867C16.562 7.38831 16.3964 7.13063 16.136 7.07454L14.2535 6.66332C13.9931 6.60724 13.7354 6.77147 13.6793 7.03182C13.6219 7.29217 13.7875 7.54985 14.0478 7.60594L15.9304 8.01716Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M19.9494 7.95329C19.7197 7.87185 19.4861 7.80509 19.2497 7.75436L18.0187 7.48599C17.7583 7.42857 17.502 7.59414 17.4446 7.85448C17.3885 8.11484 17.5527 8.37119 17.8131 8.42861L19.0441 8.69698C19.2417 8.7397 19.4366 8.79578 19.6276 8.86254C19.8786 8.95066 20.1536 8.81848 20.2417 8.56747C20.3299 8.31779 20.199 8.04141 19.9494 7.95329Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M22.6951 15.9407C22.5883 15.87 22.4575 15.8446 22.3333 15.8699C22.2078 15.894 22.097 15.9688 22.0262 16.0742C21.7018 16.5616 21.2906 16.9848 20.8125 17.3226C20.5949 17.4775 20.5442 17.7779 20.6991 17.9955C20.8526 18.2132 21.1543 18.2639 21.372 18.109C21.9448 17.7031 22.4388 17.1944 22.8287 16.611C22.8994 16.5042 22.9248 16.3733 22.9008 16.2478C22.8754 16.1223 22.802 16.0128 22.6951 15.9407Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M23.1822 15.065C23.4065 15.0637 23.6015 14.9088 23.6522 14.6898C23.8097 14.0049 23.8404 13.2972 23.743 12.6003C23.7056 12.3372 23.4626 12.153 23.1996 12.1904C22.9352 12.2278 22.751 12.4708 22.7883 12.7338C22.8685 13.3146 22.8431 13.9034 22.7109 14.4735C22.6789 14.6177 22.7136 14.7672 22.8044 14.882C22.8965 14.9969 23.0353 15.065 23.1822 15.065Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M21.7632 8.996C21.6657 8.91322 21.5402 8.87183 21.4121 8.88251C21.2852 8.8932 21.1664 8.95328 21.0836 9.05075C20.9114 9.25369 20.9354 9.55812 21.1384 9.73035C21.5843 10.1095 21.9568 10.5675 22.2386 11.0815C22.3 11.1937 22.4041 11.2765 22.527 11.3125C22.6498 11.3486 22.782 11.3339 22.8941 11.2725C23.0063 11.211 23.0904 11.1069 23.1251 10.9841C23.1611 10.8599 23.1465 10.7277 23.0837 10.6156C22.7459 10 22.2986 9.45132 21.7632 8.996Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M10.4086 8.06525C10.486 8.06525 10.5634 8.04655 10.6315 8.00917C11.1509 7.73813 11.7144 7.56322 12.2965 7.49513C12.5609 7.46309 12.7491 7.22276 12.7184 6.9584C12.6864 6.69404 12.446 6.50579 12.1817 6.53648C11.4834 6.61926 10.8065 6.82888 10.1843 7.15467C9.98798 7.25747 9.88651 7.48178 9.93992 7.69806C9.99332 7.91302 10.1856 8.06525 10.4086 8.06525Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M7.80726 9.7346C7.98751 9.93087 8.29327 9.94289 8.48954 9.76264L9.1985 9.10839V9.10706C9.39343 8.92681 9.40679 8.62105 9.2252 8.42612C9.04496 8.22985 8.7392 8.21783 8.54427 8.39808L7.8353 9.05366C7.63903 9.2339 7.62702 9.53834 7.80726 9.7346Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M20.6669 10.2825C20.4399 10.0889 20.293 9.81783 20.2543 9.52142C19.978 9.63624 19.6682 9.64559 19.3865 9.54545C19.2236 9.48804 19.058 9.44131 18.8898 9.40393L18.293 9.27441V10.5789C18.293 11.3279 19.0754 11.5202 19.6468 11.6604V11.659C19.8925 11.7004 20.1288 11.7832 20.3478 11.9034L21.6429 13.1985C21.7324 13.2893 21.8125 13.3867 21.8846 13.4922L22.0875 13.7966C22.1009 13.6631 22.1102 13.5296 22.1102 13.3961C22.1102 13.2092 22.0969 13.0209 22.0715 12.834C22.0288 12.5389 22.0995 12.2372 22.2678 11.9901C21.9847 11.8927 21.7471 11.6937 21.6029 11.4307C21.3639 10.9941 21.0461 10.6056 20.6669 10.2825Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M15.668 16.9167L15.9818 17.0248C16.2835 17.129 16.5332 17.3493 16.672 17.6377C16.6854 17.6644 16.6921 17.6937 16.7027 17.7218H16.7041C16.915 17.5536 17.1754 17.4628 17.4451 17.4614C17.4892 17.4614 17.5332 17.4641 17.5759 17.4694C17.7228 17.4855 17.8697 17.4935 18.0179 17.4935C18.3664 17.4935 18.7135 17.4494 19.05 17.3613C19.3397 17.2852 19.6481 17.3199 19.9138 17.4588C19.9779 17.165 20.1488 16.906 20.3931 16.7324C20.6868 16.5241 20.9512 16.2785 21.1795 16.0008C20.7563 15.3479 20.0486 14.9366 19.2729 14.8899L18.2128 14.8312C16.9511 14.7591 15.8456 15.6656 15.668 16.9167Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M1.64952 16.0793C1.66287 17.2209 1.81107 18.3571 2.09147 19.4639C2.2103 19.0807 2.51206 18.7817 2.89658 18.6655C2.75506 17.9859 2.6656 17.2943 2.63089 16.6L5.03283 16.8096C5.07022 16.8123 5.10626 16.8136 5.14231 16.8136C6.01285 16.815 6.74185 16.1541 6.8273 15.2876L6.86869 14.8737H6.86735C6.89939 14.5719 7.11302 14.3196 7.40675 14.2408L9.31602 13.7334C10.057 13.5345 10.5724 12.8629 10.5724 12.0952C10.5724 11.8989 10.6499 11.7106 10.7887 11.5731C10.9289 11.4343 11.1172 11.3582 11.3134 11.3622C11.5044 11.3622 11.6873 11.4396 11.8195 11.5771L12.2267 11.9844C12.6046 12.3609 13.1373 12.5385 13.6647 12.4637C14.1921 12.3876 14.654 12.0685 14.9104 11.6012L16.4311 8.83605C16.4645 8.77463 16.4939 8.71054 16.5192 8.64379C16.367 8.71455 16.2015 8.7506 16.0332 8.75194C15.9478 8.75194 15.861 8.74259 15.7769 8.72523L13.8943 8.31401H13.893C13.5885 8.24859 13.3215 8.06567 13.1479 7.80664C12.9517 8.03362 12.678 8.17914 12.3802 8.21386C11.8849 8.27261 11.4055 8.42081 10.9649 8.65178C10.6899 8.79598 10.3695 8.82802 10.0717 8.74124C10.0717 8.76126 10.0757 8.78129 10.0757 8.80132H10.0744C10.0624 9.12176 9.92351 9.4235 9.68719 9.63979L8.97823 10.294C8.51225 10.728 7.78725 10.7186 7.33064 10.2753C7.29592 10.3421 7.26254 10.4035 7.23451 10.4569C7.02489 10.8508 6.61632 11.0965 6.17037 11.0965C5.72442 11.0965 5.31587 10.8508 5.10624 10.4569C4.87659 10.027 4.42264 9.15247 3.98069 8.19115V8.19249C2.54406 10.3581 1.73894 12.8817 1.65483 15.4797C1.64949 15.6813 1.64681 15.8789 1.64949 16.0779L1.64952 16.0793Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M6.171 10.3727C6.34991 10.3727 6.5128 10.2739 6.59692 10.1164C6.81856 9.69981 8.76388 6.0134 8.76388 4.76377C8.76388 3.33115 7.60363 2.1709 6.171 2.1709C4.73837 2.1709 3.57812 3.33115 3.57812 4.76377C3.57812 6.01347 5.52346 9.70111 5.74508 10.1164C5.8292 10.2739 5.99342 10.3727 6.171 10.3727ZM5.74908 4.82393C5.74908 4.55824 5.96538 4.34329 6.23109 4.34329C6.4968 4.34329 6.7131 4.55825 6.71443 4.82393V5.5476C6.7131 5.81329 6.4968 6.0296 6.23109 6.0296C5.96538 6.0296 5.74908 5.81331 5.74908 5.5476V4.82393Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M12.6637 28.5417L12.9922 22.1517C13.5609 21.0436 13.8734 19.8205 13.9068 18.5748C13.9068 18.3091 13.6905 18.0928 13.4247 18.0928C12.179 18.1262 10.956 18.4386 9.84778 19.0074L3.45779 19.3358C3.24016 19.3465 3.05857 19.5014 3.01184 19.7137C2.96378 19.926 3.06525 20.1436 3.25751 20.2451L6.79585 22.1116V22.1103C6.20036 22.9555 5.66496 23.8407 5.19365 24.7593C4.78776 25.523 4.47399 26.3294 4.25503 27.1652C4.21764 27.3281 4.26571 27.4977 4.38454 27.6152C4.50204 27.734 4.6716 27.7821 4.83449 27.7447C5.66896 27.5257 6.47675 27.212 7.23914 26.8074C8.15906 26.3348 9.04426 25.7994 9.88943 25.2039L11.756 28.7422H11.7546C11.8561 28.9345 12.0737 29.036 12.286 28.9879C12.4983 28.9412 12.653 28.7594 12.6637 28.5417Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M1.83674 25.2478C1.6378 25.2878 1.48561 25.4467 1.45488 25.647C1.42417 25.8459 1.5203 26.0449 1.69654 26.1423L3.52707 27.1584V27.1597C3.53241 27.1063 3.54042 27.0543 3.55243 27.0022C3.75271 26.2171 4.03844 25.4561 4.40161 24.7324L1.83674 25.2478Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M4.83984 28.4738L5.85725 30.3043V30.3056C5.95472 30.4819 6.15366 30.578 6.35259 30.5473C6.55287 30.5166 6.71176 30.3644 6.75182 30.1654L7.26719 27.6006C6.54352 27.9638 5.78247 28.2495 4.99741 28.4498C4.94534 28.4618 4.89325 28.4698 4.83984 28.4738Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M4.49525 24.5354C4.5126 24.5007 4.52863 24.4674 4.54598 24.4326C4.68618 24.1549 4.84105 23.8719 5.0026 23.5875H5.00393C4.53129 22.9052 4.12273 22.1802 3.7836 21.4232L2.67674 20.8851C2.60731 20.8477 2.54189 20.8037 2.48047 20.7529C2.96111 22.1068 3.63941 23.382 4.49525 24.5354Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M10.5933 28.2423C9.82562 27.8979 9.09263 27.4826 8.40233 27.002C8.12194 27.1608 7.8429 27.313 7.56785 27.4519C7.53046 27.4706 7.49442 27.488 7.45703 27.5066C8.62128 28.3798 9.91107 29.0701 11.2821 29.5575C11.2181 29.4854 11.162 29.4066 11.1166 29.3211L10.5933 28.2423Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M28.7791 8.89653L28.7778 8.8952C27.4746 6.54931 25.5453 4.60934 23.2047 3.29408C23.2007 3.29141 23.1953 3.29008 23.1913 3.28741L23.19 3.28874C21.3782 2.26867 19.3649 1.65585 17.2925 1.49428C16.8746 1.4609 16.4634 1.44488 16.0749 1.44755H16.0735C13.6435 1.46357 11.2589 2.10979 9.15477 3.3248C9.37373 3.77341 9.48723 4.26609 9.48723 4.76409C9.48723 5.40897 9.10003 6.49713 8.63672 7.57059C8.71416 7.55457 8.7916 7.5479 8.87037 7.54656C8.98386 7.54923 9.09735 7.56792 9.2055 7.60131C9.19749 7.14736 9.44583 6.72544 9.84771 6.51448C10.5487 6.14731 11.3097 5.91099 12.0948 5.81884C12.1428 5.81217 12.1909 5.80949 12.2403 5.80949C12.6422 5.80949 13.0174 6.0111 13.2404 6.34623C13.5288 6.01244 13.9774 5.86288 14.4086 5.9577L15.8119 6.26345L15.7505 6.17266C15.5903 5.93233 15.5876 5.6199 15.7425 5.37691L17.5089 2.48226C19.1538 2.64782 20.7547 3.11647 22.2289 3.86817L20.1327 6.5158C20.0566 6.61193 19.891 6.78283 19.7174 6.96441C19.6747 7.00848 19.6333 7.05253 19.5919 7.09526C19.7935 7.146 19.9938 7.20207 20.1888 7.2715H20.1901C20.6187 7.42237 20.9244 7.80023 20.9845 8.25018C21.4038 8.07527 21.8857 8.15138 22.2315 8.44511C22.8337 8.95782 23.3371 9.57467 23.7163 10.2676C23.9352 10.6655 23.9125 11.1515 23.6575 11.5267C24.0861 11.6762 24.3959 12.0514 24.46 12.5C24.5694 13.2838 24.5347 14.0809 24.3571 14.8512C24.3171 15.0248 24.2397 15.1877 24.1288 15.3279C24.1475 15.3319 24.1649 15.3372 24.1822 15.3399H24.1836C24.3558 15.3706 24.5294 15.3866 24.7043 15.3866C25.9433 15.3826 27.0421 14.5922 27.44 13.4199L28.4481 10.3878V10.3864C30.352 14.6497 29.9381 19.5898 27.3506 23.4764L26.5108 20.9503V20.949C26.4373 20.6579 26.4093 20.3575 26.428 20.0584C26.4293 19.5791 26.4307 19.1265 26.1236 18.8194C25.954 18.6538 25.723 18.5644 25.4867 18.5724C25.4159 18.5737 25.3452 18.579 25.2757 18.5897C24.6082 18.6925 23.9566 18.328 23.6949 17.7059C23.6535 17.6071 23.5814 17.5256 23.4906 17.4735L23.2089 17.312C22.8097 17.8447 22.3304 18.3134 21.7883 18.6992C21.4198 18.9623 20.9351 18.9956 20.5332 18.786C20.5052 18.9088 20.4598 19.0277 20.3957 19.1371C20.2342 19.4135 19.9698 19.6138 19.6601 19.6939C18.8937 19.8955 18.0979 19.9543 17.3102 19.8675C16.8669 19.8234 16.485 19.531 16.3275 19.1131C16.1406 19.2587 15.9163 19.3468 15.6799 19.3641C15.74 19.7059 15.8749 20.0304 16.0725 20.3161L17.1526 21.8769C17.4931 22.3656 17.5051 23.0118 17.1833 23.5125L16.0271 25.3096C15.7747 25.7035 15.6399 26.1601 15.6399 26.6275V29.4113C14.8615 29.3752 14.0871 29.2831 13.3234 29.1349C13.1939 29.5261 12.8748 29.8238 12.4769 29.9253C13.6665 30.2364 14.8922 30.394 16.1219 30.3953C16.3235 30.3953 16.5264 30.3899 16.7334 30.3833H16.7321C18.421 30.3152 20.0833 29.9533 21.6468 29.3138L21.6508 29.3111C21.7737 29.2604 21.8978 29.2123 22.0193 29.1589V29.1603C22.046 29.1469 22.0727 29.1322 22.0968 29.1162C23.6228 28.4286 25.0168 27.482 26.2172 26.3164C26.2452 26.299 26.2693 26.279 26.2933 26.2576C26.7432 25.8143 27.1638 25.3417 27.551 24.8423C27.5497 24.8437 27.551 24.845 27.5497 24.8464C27.5577 24.837 27.5644 24.8277 27.5711 24.8183L27.5724 24.817V24.8143C29.5498 22.2695 30.6152 19.1332 30.5966 15.9087C30.5939 13.4546 29.969 11.0421 28.7794 8.89624L28.7791 8.89653ZM21.7294 25.2295C22.2862 24.6688 23.1661 24.5913 23.8136 25.044L25.1768 25.9692V25.9679C24.2276 26.8224 23.1608 27.538 22.0098 28.0908L21.4851 27.2176C21.0992 26.578 21.1994 25.7569 21.7294 25.2295Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M30.0443 8.19254C28.6077 5.60766 26.482 3.47259 23.9038 2.02677C23.8891 2.01876 23.8731 2.01075 23.8558 2.0014C21.873 0.893211 19.6742 0.228303 17.4097 0.0520701C16.9798 0.0173567 16.5579 0 16.152 0H16.0705C13.5751 0.0173574 11.1223 0.63688 8.91799 1.80513C7.74172 0.710299 6.02737 0.417887 4.55455 1.0601C3.08172 1.70231 2.12987 3.1563 2.13124 4.76387C2.13124 5.34199 2.35688 6.18446 2.82018 7.33005C2.80282 7.35275 2.7868 7.37544 2.77211 7.39948L2.77078 7.39814C1.18994 9.79209 0.303376 12.5758 0.208595 15.4425C0.203254 15.6614 0.200584 15.8777 0.203254 16.094C0.217941 17.3504 0.38083 18.6014 0.689262 19.819C0.75335 20.074 1.02973 20.9872 1.11785 21.2356H1.11918C1.4196 22.0847 1.79212 22.9058 2.23404 23.6909L1.5491 23.8284C0.756019 23.9887 0.147167 24.6255 0.023024 25.424C-0.101146 26.2237 0.284715 27.0155 0.992341 27.408L2.82286 28.4241H2.82153C3.10592 28.6404 3.35959 28.8928 3.57455 29.1771L4.59196 31.0077C4.98448 31.7153 5.77624 32.1012 6.57602 31.977C7.37443 31.8528 8.01131 31.244 8.17155 30.4509L8.30507 29.7847C9.10215 30.2346 9.93529 30.6151 10.7978 30.9222C10.954 30.977 11.878 31.2653 12.113 31.3268V31.3254C13.4214 31.6672 14.7699 31.8408 16.1223 31.8421C16.3413 31.8421 16.5616 31.8368 16.7926 31.8288C18.6498 31.754 20.4789 31.3561 22.1999 30.6525L22.2933 30.6138C22.3988 30.5711 22.503 30.5283 22.6044 30.4829C22.6645 30.4576 22.7219 30.4282 22.778 30.3948C24.3936 29.6578 25.8729 28.6537 27.1548 27.4241C27.2082 27.3814 27.2589 27.336 27.3083 27.2892C27.793 26.8113 28.2469 26.3025 28.6662 25.7658C28.6769 25.7538 28.6862 25.7418 28.6969 25.7284L28.7223 25.695L28.7209 25.6964C30.6235 23.225 31.7624 20.2515 31.9987 17.1421C32.2337 14.0325 31.5544 10.9218 30.0443 8.19254ZM28.1484 25.2532L28.1177 25.2933L28.1163 25.292H28.1177C27.7118 25.814 27.2725 26.3094 26.8012 26.7727C26.7638 26.81 26.7237 26.8434 26.681 26.8755C25.4433 28.0691 24.0107 29.0424 22.4433 29.7528C22.402 29.7781 22.3579 29.8022 22.3125 29.8208C22.2164 29.8636 22.1189 29.9023 22.0214 29.9423C22.0214 29.9423 21.9253 29.9811 21.9213 29.9837H21.9226C20.2804 30.6553 18.5353 31.0345 16.7635 31.1053C16.5445 31.1133 16.3322 31.1186 16.1226 31.1186C14.8315 31.1173 13.5444 30.9517 12.2947 30.6259C12.0291 30.5565 11.1185 30.2681 11.0397 30.2401C9.89947 29.8342 8.81131 29.2935 7.79923 28.6285L7.46143 30.3082C7.36263 30.8035 6.96476 31.1854 6.46539 31.2628C5.96472 31.3403 5.47067 31.0986 5.22502 30.6567L4.20761 28.8262C3.89385 28.4523 3.54671 28.1065 3.17421 27.7928L1.34369 26.7767V26.7754C0.901738 26.5297 0.660084 26.0357 0.737536 25.5363C0.814975 25.0357 1.19685 24.6378 1.69219 24.5389L3.3865 24.1985H3.38517C2.73226 23.1958 2.20089 22.121 1.80167 20.9941C1.69752 20.7004 1.46921 19.9447 1.39178 19.6416C1.09671 18.4787 0.940496 17.2864 0.927132 16.0862C0.924461 15.8779 0.927132 15.6709 0.932472 15.46V15.4613C1.02326 12.7296 1.86976 10.0752 3.37714 7.79605C3.45325 7.6799 3.56273 7.59044 3.68957 7.5357C3.23296 6.47423 2.8551 5.4021 2.8551 4.76522V4.76388C2.85376 3.35128 3.74833 2.09222 5.08347 1.63024C6.41862 1.16693 7.90068 1.6022 8.77391 2.71307C8.78192 2.70773 8.7886 2.70105 8.79661 2.69705C11.0117 1.42329 13.5176 0.742351 16.0732 0.723689H16.1547C16.5392 0.723689 16.9424 0.741046 17.3523 0.77309H17.351C19.5179 0.942654 21.6221 1.57954 23.5195 2.64234C23.5328 2.64901 23.5449 2.65435 23.5555 2.66103C27.4114 4.83202 30.1325 8.57045 31.015 12.9072C31.8962 17.244 30.8507 21.7484 28.1484 25.2532Z"
                    fill="#24BDC7"
                  />
                </svg>
              </div>
              <div class="counter-area__card-caption">
                <div class="counter-area__number" data-target="300">0</div>
                <div class="counter-area__label">Awesome Tour</div>
              </div>
            </div>
            <div class="counter-area__card">
              <div class="counter-area__icon" style="background-color: #ffffff">
                <svg
                  width="32"
                  height="32"
                  viewBox="0 0 32 32"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M10.4335 13.2396L14.0598 19.5209L14.0846 19.5639L14.0859 19.5652L14.9596 21.0782C15.1822 21.4623 15.5507 21.6746 15.9947 21.6746C16.44 21.6746 16.8072 21.4624 17.0286 21.0782L21.5546 13.2396L22.5403 11.5312C22.5416 11.5299 22.5429 11.5273 22.5429 11.526C23.246 10.3489 23.6171 8.99868 23.6171 7.62234C23.6184 3.42067 20.1978 0 15.9934 0C11.7891 0 8.37109 3.42067 8.37109 7.62234C8.37109 8.99864 8.74219 10.3489 9.44533 11.526L10.4335 13.2396ZM10.7772 7.37758C10.9009 4.69918 13.0689 2.52991 15.7472 2.40757C18.8202 2.26565 21.3489 4.79561 21.2082 7.86725C21.0845 10.5456 18.9166 12.7149 16.2382 12.8386C13.1666 12.9805 10.6366 10.4505 10.7772 7.37758Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M29.371 13.985L23.8203 10.8145C23.6615 11.2051 23.4726 11.5827 23.2552 11.9473L22.3398 13.5332L24.6224 29.1802L31.9921 31.9641L29.371 13.985Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M21.1289 21.9564C21.1289 21.2741 20.0534 20.5749 18.4805 20.2129L17.7422 21.4915C17.3724 22.1335 16.7344 22.5006 15.9935 22.5006C15.2539 22.5006 14.6172 22.1321 14.2448 21.4915L13.5065 20.2129C11.9336 20.5762 10.8594 21.2754 10.8594 21.9564C10.8594 22.9082 12.9674 23.9668 15.992 23.9668C19.0194 23.9668 21.1289 22.9069 21.1289 21.9564Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M8.73431 11.9453C8.51817 11.582 8.32938 11.2057 8.17181 10.8164L2.6198 13.9857L0 31.9637L7.36968 29.1798L9.65225 13.5328L8.73431 11.9453Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M15.7046 12.0104C18.3543 12.181 20.5483 9.98569 20.379 7.33608C20.2383 5.14598 18.4688 3.37641 16.2786 3.23575C13.6276 3.06647 11.4336 5.26048 11.6029 7.91009C11.7449 10.1015 13.5144 11.8711 15.7046 12.0104ZM12.8622 6.48975C12.9273 6.27751 13.1018 6.11345 13.3257 6.05615L14.6994 5.72672L15.4338 4.53142C15.5523 4.3335 15.7606 4.21632 15.9937 4.21632C16.2268 4.21632 16.4351 4.3335 16.5549 4.53142L17.2905 5.72672L18.6577 6.05485C18.8817 6.11344 19.0549 6.2736 19.1252 6.48715C19.1968 6.7085 19.1512 6.94418 19.0028 7.11865L18.09 8.18895L18.1994 9.58998C18.215 9.82566 18.1122 10.0431 17.9247 10.1759C17.8127 10.2566 17.6799 10.2983 17.5445 10.2983C17.4598 10.2983 17.3752 10.2814 17.2932 10.2488L15.9937 9.71237L14.6942 10.2501C14.4833 10.3374 14.2463 10.3087 14.0601 10.1746C13.8765 10.0457 13.7737 9.82825 13.7893 9.59778L13.8987 8.19151L12.9859 7.12121C12.8361 6.94413 12.7906 6.70978 12.8622 6.48975Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M14.7266 8.17547V8.18328L14.6329 9.38382L15.7461 8.92418C15.8256 8.89033 15.9102 8.8747 15.9948 8.8747C16.0808 8.8747 16.1667 8.89163 16.2474 8.92548L17.3581 9.38382L17.2644 8.18328C17.2487 8.01011 17.3034 7.84345 17.4206 7.70542L18.2005 6.79135L17.0313 6.5101C16.8594 6.46973 16.7136 6.36296 16.6224 6.21062L15.9961 5.19238L15.3672 6.21452C15.2682 6.36946 15.1289 6.47103 14.9583 6.51139L13.793 6.79264L14.5729 7.70671C14.6823 7.83822 14.737 8.00101 14.7266 8.17547Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M10.0339 21.9568C10.0339 20.8839 11.1849 19.9542 13.0756 19.4686L10.3138 14.6846L8.19531 29.2106L15.578 31.9997L15.5793 24.7847C14.1965 24.7417 12.9048 24.4839 11.905 24.0464C10.6992 23.5191 10.0339 22.7771 10.0339 21.9568Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M18.9114 19.467C20.8046 19.9539 21.9556 20.8823 21.9556 21.9552C21.9556 22.7768 21.2916 23.5191 20.0832 24.0464C19.0832 24.4826 17.7903 24.7417 16.4076 24.7847L16.4062 31.9997L23.7916 29.2106L21.6731 14.6846L18.9114 19.467Z"
                    fill="#24BDC7"
                  />
                </svg>
              </div>
              <div class="counter-area__card-caption">
                <div class="counter-area__number" data-target="250">0</div>
                <div class="counter-area__label">Stunning Places</div>
              </div>
            </div>
            <div class="counter-area__card">
              <div class="counter-area__icon" style="background-color: #ffffff">
                <svg
                  width="30"
                  height="32"
                  viewBox="0 0 30 32"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M19.205 29.2174C19.2029 29.2043 19.1996 29.1911 19.1985 29.1781L18.9377 27.6617C18.7942 26.8248 19.0714 25.9724 19.6794 25.3809L22.7853 22.3516C22.7908 22.3473 22.8028 22.3353 22.8028 22.3155C22.8028 22.31 22.8017 22.3046 22.7995 22.2979C22.7886 22.2673 22.7645 22.263 22.7568 22.2618L18.4634 21.6385C17.9671 21.5661 17.5113 21.3525 17.1432 21.0315C17.1355 21.0249 17.1279 21.0194 17.1213 21.0129C17.1136 21.0063 17.1071 20.9998 17.1005 20.9932C16.8639 20.7806 16.6677 20.5221 16.5231 20.2285L16.2931 19.7618C16.2887 19.753 16.2843 19.7443 16.2799 19.7355L14.6027 16.3382C14.5994 16.3305 14.5884 16.3086 14.5555 16.3086C14.5227 16.3086 14.5117 16.3305 14.5084 16.3382L12.5879 20.2285C12.4422 20.5221 12.245 20.7817 12.0084 20.9932C12.0018 20.9998 11.9953 21.0063 11.9876 21.0129C11.6162 21.3449 11.1528 21.5651 10.6477 21.6385L6.35428 22.2618C6.34551 22.263 6.32141 22.2673 6.31154 22.2979C6.3017 22.3286 6.31922 22.3462 6.3247 22.3516L9.43165 25.3809C10.0397 25.9724 10.3158 26.8248 10.1733 27.6617L9.91261 29.1781C9.91152 29.1879 9.90932 29.1977 9.90713 29.2076L9.43933 31.9377C9.43823 31.9454 9.43385 31.9695 9.46014 31.9891C9.48753 32.0089 9.50836 31.9968 9.51601 31.9935L13.3559 29.9745C14.1075 29.5789 15.0036 29.5789 15.7541 29.9745L19.595 31.9935C19.6016 31.9968 19.6235 32.0089 19.6498 31.9891C19.6772 31.9695 19.6728 31.9454 19.6718 31.9377L19.205 29.2174Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M29.1089 21.4357L25.4103 20.899C24.6719 20.7916 24.0354 20.3282 23.7056 19.6599L22.6265 17.4731C22.6243 17.471 22.6232 17.4688 22.6221 17.4656C22.621 17.4644 22.621 17.4622 22.6199 17.4612C22.6188 17.4601 22.6188 17.4578 22.6177 17.4568C22.6177 17.4557 22.6167 17.4545 22.6167 17.4535L22.0514 16.3086L21.0478 18.3408L21.0314 18.3748C21.0303 18.3782 21.0281 18.3814 21.0259 18.3847L20.3971 19.6599C20.0673 20.3282 19.4297 20.7916 18.6913 20.899L18.3594 20.9471C18.424 20.9647 18.4908 20.9778 18.5576 20.9877L22.8511 21.6122C23.1206 21.6506 23.3408 21.8356 23.4241 22.0953C23.5084 22.3539 23.4394 22.6332 23.2444 22.8227L20.1374 25.8509C19.685 26.2923 19.479 26.9278 19.5853 27.55L19.7715 28.6379L20.9974 27.9937C21.657 27.6464 22.4457 27.6464 23.1053 27.9937L26.4127 29.7334L25.7806 26.0502C25.6546 25.3151 25.8989 24.5657 26.4325 24.0454L29.1089 21.4357Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M13.2923 8.83545C13.3306 8.85086 13.3657 8.87493 13.3942 8.90446C13.3942 8.90446 13.3964 8.90446 13.3964 8.90564C13.9989 9.29122 14.4996 9.3109 14.5554 9.31208C14.6069 9.3109 15.1076 9.29229 15.7101 8.90671H15.7112C15.7408 8.87493 15.777 8.84968 15.8175 8.83331H15.8186C15.8186 8.83331 15.8197 8.83331 15.8197 8.83224C16.5899 8.29207 17.486 7.14281 17.83 4.70083C17.0522 4.61 15.1909 4.19917 13.4971 2.34766C13.2507 3.01921 12.6547 3.99868 11.2305 4.31964C11.2316 4.3328 11.2337 4.34703 11.2349 4.36126C11.5405 7.03989 12.4849 8.26906 13.2901 8.83331C13.2912 8.83331 13.2923 8.83545 13.2923 8.83545Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M13.0117 1.62246C13.0238 1.48883 13.1169 1.37596 13.2462 1.33766C13.3743 1.29925 13.5135 1.34311 13.5967 1.44828C15.2379 3.52543 17.1748 3.95713 17.9033 4.04689C17.98 2.90534 17.7259 1.97851 17.1485 1.28834C16.2272 0.186157 14.7471 0.0174389 14.5564 0C14.3658 0.0174389 12.8857 0.186157 11.9644 1.28834C11.4549 1.89741 11.1975 2.68955 11.1953 3.65147C12.8452 3.21646 13.0052 1.69253 13.0117 1.62246Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M8.97142 25.8509L5.86446 22.8227C5.66945 22.6332 5.60152 22.3539 5.68478 22.0953C5.76914 21.8356 5.98935 21.6506 6.25775 21.6122L10.5523 20.9877C10.6191 20.9778 10.6849 20.9647 10.7495 20.9471L10.4175 20.899C9.67914 20.7916 9.04262 20.3282 8.71289 19.6599L8.07088 18.3584C8.06979 18.3573 8.06979 18.3573 8.06979 18.3562L7.0586 16.3086L6.49331 17.4535C6.49331 17.4545 6.49221 17.4557 6.49221 17.4568C6.49111 17.4578 6.49111 17.4601 6.49002 17.4612C6.48892 17.4622 6.48892 17.4644 6.48782 17.4656C6.48673 17.4688 6.48563 17.471 6.48344 17.4731L5.40431 19.6599C5.07458 20.3282 4.43696 20.7916 3.69857 20.899L0 21.4369L2.67641 24.0454C3.20996 24.5647 3.45317 25.314 3.32826 26.0491L2.69613 29.7334L6.00467 27.9937C6.66419 27.6464 7.45191 27.6464 8.11253 27.9937L9.33734 28.6379L9.52358 27.55C9.63094 26.9278 9.4239 26.2923 8.97142 25.8509Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M17.7254 13.5246C18.0715 12.8115 18.4922 11.442 17.6563 9.96968H17.6552C17.6311 9.95973 17.607 9.95106 17.5818 9.94336C17.3759 10.4495 16.8434 11.3916 15.6055 11.9383C16.3077 12.2429 17.2291 12.7611 17.7254 13.5246Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M6.46964 16.0182C6.58139 15.7914 6.80705 15.6511 7.05903 15.6511C7.30992 15.6511 7.53561 15.7914 7.64735 16.017L8.56322 17.8708C8.61909 17.8652 8.67606 17.8576 8.73413 17.8488L8.90175 16.5769C8.92585 16.3972 9.09128 16.2712 9.27093 16.2942C9.45062 16.3183 9.5766 16.4838 9.55359 16.6634L9.37503 18.012C9.64673 18.2542 10.5232 18.9115 12.3439 19.2358L13.9182 16.0466C14.0388 15.8023 14.282 15.6511 14.5548 15.6511C14.8264 15.6511 15.0708 15.8023 15.1913 16.0466L16.7656 19.2358C18.5853 18.9115 19.4617 18.2542 19.7345 18.012L19.5559 16.6634C19.5318 16.4838 19.6589 16.3183 19.8386 16.2942C20.0183 16.2712 20.1837 16.3972 20.2078 16.5769L20.3754 17.8488C20.4335 17.8576 20.4904 17.8652 20.5463 17.8708L21.4611 16.0182C21.5717 15.7924 21.7974 15.6523 22.0483 15.6511C22.0494 15.6511 22.0494 15.6511 22.0494 15.6511C22.3014 15.6511 22.5281 15.7914 22.6388 16.017L22.8481 16.441C23.3027 13.1138 20.657 11.2601 18.5459 10.3245C19.35 12.5124 18.02 14.3419 17.9564 14.4274C17.894 14.5118 17.7954 14.5599 17.6935 14.5599C17.6727 14.5599 17.653 14.5578 17.6322 14.5545C17.5095 14.5315 17.4098 14.4395 17.3758 14.3189C17.0373 13.0832 15.0302 12.3973 14.5876 12.2604C14.145 12.3973 12.1391 13.0832 11.7995 14.3189C11.7655 14.4395 11.6669 14.5315 11.5431 14.5545C11.5223 14.5578 11.5026 14.5599 11.4828 14.5599C11.3799 14.5599 11.2813 14.5118 11.2188 14.4274C11.1553 14.3419 9.81325 12.4949 10.6404 10.2939C9.33778 10.8593 7.8544 11.7499 6.97796 13.0864C6.32941 14.0747 6.08946 15.2009 6.26037 16.441L6.46964 16.0182Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M13.5704 11.9384C12.3171 11.3852 11.7879 10.4266 11.5863 9.9248C11.5688 9.93026 11.5524 9.93679 11.5349 9.94235C10.6891 11.4103 11.1087 12.7984 11.4527 13.5203C11.9512 12.759 12.8703 12.243 13.5704 11.9384Z"
                    fill="#24BDC7"
                  />
                  <path
                    d="M14.5861 11.581C16.1286 11.2381 16.7421 10.2334 16.9547 9.73614C16.5274 9.60573 16.1954 9.5257 16.0223 9.48633H16.0213C15.2653 9.95408 14.6233 9.96948 14.5554 9.96948H14.5543C14.5532 9.96948 14.5532 9.96948 14.5532 9.96948C14.4853 9.96948 13.8433 9.95408 13.0874 9.4874C12.9208 9.52463 12.6108 9.5992 12.2109 9.71967C12.4147 10.2116 13.0183 11.2304 14.5861 11.581Z"
                    fill="#24BDC7"
                  />
                </svg>
              </div>
              <div class="counter-area__card-caption">
                <div class="counter-area__number" data-target="500">0</div>
                <div class="counter-area__label">Happy Customers</div>
              </div>
            </div>
            <div class="counter-area__card">
              <div class="counter-area__icon" style="background-color: #ffffff">
                <svg
                  width="32"
                  height="32"
                  viewBox="0 0 32 32"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M30.8429 17.1521L25.2391 14.3807L30.8429 11.6058V17.1521ZM2.36358 5.32425H15.8543C16.0188 5.32425 16.1466 5.19811 16.1466 5.03595C16.1466 4.87377 16.0188 4.74762 15.8543 4.74762H2.36358C1.97789 4.75013 1.98659 5.32265 2.36358 5.32425ZM8.02216 4.02685H10.1884C9.80668 3.11691 8.40553 3.12013 8.02216 4.02685ZM10.9592 4.02685H13.9182C12.9275 -1.34006 5.29459 -1.34451 4.29606 4.02685H7.25507C7.75041 2.16296 10.4602 2.1621 10.9592 4.02685ZM13.889 7.86136C14.1155 7.75325 14.3347 7.46134 14.4589 7.10456C14.6123 6.62524 14.4844 6.21081 14.152 6.09905C13.978 6.0447 13.7743 6.18699 13.615 6.04503H4.6066C4.44678 6.18611 4.24665 6.04203 4.06591 6.10268C3.73347 6.21081 3.61294 6.62524 3.77004 7.10456C3.87965 7.45052 4.10244 7.74964 4.33263 7.86136C4.44585 7.91543 4.51893 8.02354 4.53356 8.14601C4.8268 11.4789 8.25859 14.0343 11.2917 12.1536C12.5994 11.3328 13.4965 9.84388 13.6844 8.14608C13.6954 8.02354 13.7757 7.91543 13.889 7.86136ZM9.82314 14.9826C10.4099 14.8792 10.9838 14.6535 11.4488 14.2762C11.372 13.869 11.3026 13.4473 11.2405 13.0077C9.90524 13.6761 8.31068 13.6731 6.97744 13.0113C6.91166 13.4546 6.84223 13.8762 6.76553 14.2762C7.60531 14.954 8.7695 15.1521 9.82314 14.9826ZM13.4287 14.5285C13.1313 14.4118 12.8234 14.3071 12.5154 14.215C11.9166 15.0422 10.9117 15.5331 9.91081 15.6961C9.91081 15.707 10.9373 16.7557 10.9373 16.7557L13.4287 14.5285ZM5.95822 14.4961C5.86689 14.3988 5.78288 14.3123 5.77922 14.3123C5.47082 14.406 5.18515 14.515 4.89882 14.6294L7.28062 16.7557L8.31077 15.6997C7.40241 15.5357 6.58974 15.1946 5.95822 14.4961ZM31.6684 24.504L25.3596 29.9062C24.8043 30.3855 23.9751 30.3458 23.471 29.8161C22.5994 28.9033 18.7626 24.9171 18.0023 24.0571C17.7932 23.8096 17.359 23.9796 17.3667 24.2985V32H4.2924V28.3385C4.2924 28.1403 4.12803 27.9781 3.9271 27.9781C3.72616 27.9781 3.56179 28.1403 3.56179 28.3385V32H5.73707e-05V21.7434C-0.0106449 18.7654 1.47635 16.2941 4.17552 14.9574L7.05414 17.5269C7.19862 17.6537 7.42711 17.6463 7.56187 17.5089L9.11077 15.9196L10.656 17.5089C10.7909 17.6463 11.0193 17.6537 11.1638 17.5269L14.1666 14.842C15.3955 15.4311 16.6849 16.2171 17.5165 17.3071L24.1176 25.8338C24.5048 26.3419 25.2281 26.4645 25.7651 26.1113L30.5031 22.9939C30.9232 22.7165 31.4967 22.8102 31.8036 23.203C32.1105 23.6066 32.052 24.176 31.6684 24.504ZM9.1072 24.1075C8.41864 24.1187 8.42225 25.1314 9.10715 25.1419C9.79714 25.1323 9.80093 24.118 9.1072 24.1075ZM9.1072 21.329C8.41859 21.3401 8.42225 22.3529 9.10715 22.3633C9.79714 22.3537 9.80098 21.3394 9.1072 21.329ZM9.1072 18.5504C8.41864 18.5615 8.42221 19.5743 9.10715 19.5847C9.79714 19.5752 9.80093 18.5609 9.1072 18.5504Z"
                    fill="#24BDC7"
                  />
                </svg>
              </div>
              <div class="counter-area__card-caption">
                <div class="counter-area__number" data-target="400">0</div>
                <div class="counter-area__label">Travel Guides</div>
              </div>
            </div>
            <div class="counter-area__card">
              <div class="counter-area__icon" style="background-color: #ffffff">
                <svg
                  width="36"
                  height="32"
                  viewBox="0 0 36 32"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M29.8602 29.6915H0.299057C0.217495 29.6915 0.141977 29.7243 0.0876013 29.778C0.0332256 29.8317 0 29.9064 0 29.9869V31.7045C0 31.7866 0.0332283 31.8597 0.0876013 31.9134C0.141974 31.9672 0.217495 32 0.299057 32H29.8602C29.9433 32 30.0173 31.9672 30.0717 31.9134C30.126 31.8597 30.1593 31.7851 30.1593 31.7045V29.9869C30.1593 29.9049 30.126 29.8318 30.0717 29.778C30.0173 29.7258 29.9418 29.6915 29.8602 29.6915ZM17.8317 20.5112V14.6274L13.1206 10.8311C12.6977 10.4894 12.6343 9.87159 12.9787 9.45374L13.0285 9.39255C13.385 8.9598 14.0253 8.90758 14.4498 9.27467C15.868 10.5013 17.6427 12.1502 19.348 12.9501L19.8978 14.8199C19.934 14.9243 20.0171 15.0094 20.1228 15.0482L19.7075 17.8551C19.6908 17.9656 19.7241 18.082 19.8086 18.1685L20.9188 19.3086L20.9294 19.319C21.0789 19.4623 21.319 19.4578 21.464 19.3086L22.5605 18.1834C22.6481 18.1029 22.6965 17.982 22.6768 17.8552L22.2615 15.0467C22.3582 15.0109 22.4397 14.9348 22.4805 14.8318L22.9774 12.9769C24.7008 12.1861 26.4997 10.5147 27.9328 9.27466L27.9344 9.27317V2.91029C27.9344 2.70287 28.1035 2.53574 28.3135 2.53574C28.5234 2.53574 28.6926 2.70287 28.6926 2.91029H33.438V6.23354H28.6926V9.03598C28.9418 9.06284 29.1819 9.18222 29.3541 9.39262L29.4039 9.45381C29.7498 9.87166 29.6849 10.4909 29.262 10.8312L24.5509 14.6275V20.5113H29.8597C29.9413 20.5113 30.0168 20.5441 30.0712 20.5978C30.1256 20.6516 30.1588 20.7262 30.1588 20.8068V22.5243C30.1588 22.6049 30.1256 22.6795 30.0712 22.7333C30.0168 22.787 29.9413 22.8198 29.8597 22.8198L12.522 22.8228C12.4404 22.8228 12.3649 22.79 12.3105 22.7363C12.2562 22.6825 12.2229 22.6079 12.2229 22.5273V20.8097C12.2229 20.7277 12.2562 20.6546 12.3105 20.6008C12.3649 20.5471 12.4404 20.5143 12.522 20.5143L17.8317 20.5112ZM4.37405 28.9423H29.8602C29.9418 28.9423 30.0173 28.9095 30.0717 28.8558C30.126 28.8021 30.1593 28.7275 30.1593 28.6469V26.9293C30.1593 26.8487 30.126 26.7741 30.0717 26.7204C30.0173 26.6666 29.9418 26.6338 29.8602 26.6338L8.44749 26.6308H4.37405C4.29248 26.6308 4.21697 26.6637 4.16259 26.7174C4.10821 26.7711 4.07499 26.8457 4.07499 26.9263V28.6439C4.07499 28.726 4.10822 28.7991 4.16259 28.8528C4.21545 28.9095 4.29097 28.9423 4.37405 28.9423ZM8.44749 25.8832H29.8587C29.9402 25.8832 30.0158 25.8504 30.0701 25.7967C30.1245 25.743 30.1577 25.6683 30.1577 25.5878V23.8702C30.1577 23.7896 30.1245 23.715 30.0701 23.6613C30.0158 23.6075 29.9402 23.5747 29.8587 23.5747L12.5225 23.5717H8.44749C8.36593 23.5717 8.29041 23.6045 8.23603 23.6583C8.18166 23.712 8.14843 23.7866 8.14843 23.8672V25.5848C8.14843 25.6668 8.18166 25.74 8.23603 25.7937C8.2904 25.8489 8.36593 25.8832 8.44749 25.8832ZM21.2768 0.189515C21.239 0.0746117 21.1348 0 21.0125 0C20.8901 0 20.7859 0.0746117 20.7482 0.189515L20.3283 1.47286C20.2905 1.58777 20.1863 1.66238 20.064 1.66238L18.7001 1.65939C18.5778 1.65939 18.4736 1.73401 18.4358 1.84891C18.398 1.96381 18.4373 2.08469 18.537 2.15631L19.6426 2.9472C19.7423 3.01734 19.7816 3.13971 19.7438 3.25461L19.3194 4.53647C19.2816 4.65137 19.3209 4.77225 19.4206 4.84387C19.5203 4.9155 19.6486 4.91401 19.7468 4.84387L20.8494 4.04851C20.9491 3.97689 21.0775 3.97689 21.1772 4.04851L22.2798 4.84387C22.3779 4.9155 22.5078 4.9155 22.606 4.84387C22.7057 4.77225 22.745 4.65137 22.7072 4.53647L22.2828 3.25461C22.245 3.13971 22.2843 3.01883 22.384 2.9472L23.4896 2.15631C23.5892 2.08618 23.6285 1.96381 23.5908 1.84891C23.553 1.73401 23.4488 1.65939 23.3264 1.65939L21.9626 1.66238C21.8402 1.66238 21.736 1.58777 21.6983 1.47286L21.2768 0.189515ZM14.4121 2.48907C14.3743 2.37416 14.2701 2.29955 14.1478 2.29955C14.0254 2.29955 13.9212 2.37416 13.8834 2.48907L13.4636 3.77242C13.4258 3.88732 13.3216 3.96193 13.1993 3.96193L11.8354 3.95895C11.7131 3.95895 11.6088 4.03356 11.5711 4.14846C11.5333 4.26336 11.5726 4.38424 11.6723 4.45587L12.7779 5.24676C12.8776 5.31689 12.9168 5.43926 12.8791 5.55416L12.4546 6.83602C12.4169 6.95092 12.4562 7.0718 12.5558 7.14343C12.6555 7.21505 12.7839 7.21356 12.8821 7.14343L13.9847 6.34956C14.0844 6.27793 14.2127 6.27793 14.3124 6.34956L15.415 7.14343C15.5132 7.21505 15.6431 7.21505 15.7413 7.14343C15.841 7.0718 15.8802 6.95092 15.8425 6.83602L15.418 5.55416C15.3803 5.43926 15.4195 5.31839 15.5192 5.24676L16.6248 4.45587C16.7245 4.38573 16.7638 4.26336 16.726 4.14846C16.6883 4.03356 16.5841 3.95895 16.4617 3.95895L15.0979 3.96193C14.9755 3.96193 14.8713 3.88732 14.8335 3.77242L14.4121 2.48907ZM34.195 4.75282V6.98224H30.8752V7.99248H36L34.7902 6.51217L36 4.75279L34.195 4.75282ZM21.177 6.55098C19.6576 6.55098 18.4251 7.76866 18.4251 9.26987C18.4251 10.7711 19.6576 11.9888 21.177 11.9888C22.6965 11.9888 23.929 10.7711 23.929 9.26987C23.929 7.76866 22.6965 6.55098 21.177 6.55098ZM20.2119 13.2794L20.5049 14.324H21.8688L22.1316 13.2899C21.8114 13.378 21.4972 13.4257 21.1906 13.4257C20.8719 13.4272 20.5442 13.3735 20.2119 13.2794ZM21.4987 15.0731H20.8825L20.4807 17.7831L21.1906 18.5113L21.9004 17.7831L21.4987 15.0731Z"
                    fill="#24BDC7"
                  />
                </svg>
              </div>
              <div class="counter-area__card-caption">
                <div class="counter-area__number" data-target="800">0</div>
                <div class="counter-area__label">Success Trip</div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- COUNTER AREA SECTION END -->

      <!-- PACKAGES AREA SECTION START -->
      <section class="packages-area">
        <div class="container mt-5">
          <!-- Section Header -->
          <div class="packages-area__header">
            <p class="packages-area__subtitle">
              <span class="packages-area__subtitle-icon"
                ><img src="/assets/icons/flight.svg" alt="" /> PACKAGES</span
              >
            </p>
            <h2 class="packages-area__title">
              Traveller Favourites: Tour Packages
            </h2>
          </div>

          <!-- Packages Cards Row -->
          <div class="packages-area__cards">
            <!-- Card 1 -->
            <div class="packages-card">
              <div class="packages-card__image-wrapper">
                <img
                  src="assets/cards/destination-1.png"
                  alt="Package"
                  class="packages-card__image"
                />
                <span class="packages-card__badge">39% OFF</span>
              </div>
              <div class="packages-card__body">
                <div class="packages-card__tags">
                  <span class="packages-card__tag">4 Night Package</span>
                  <span class="packages-card__tag packages-card__tag--flight"
                    >Flights included</span
                  >
                </div>
                <div class="packages-card__route">
                  <span class="packages-card__city">London</span>
                  <span class="packages-card__route-icon"
                    ><img src="assets/icons/returnArrow.svg" alt="Return"
                  /></span>
                  <span class="packages-card__city">Orlando</span>
                </div>
                <div class="packages-card__date">
                  <span class="packages-card__date-icon"
                    ><img src="assets/icons/calendar.svg" alt="Calendar"
                  /></span>
                  <!-- <span class="packages-card__date-text"
                    >Aug 01, 2025 - Aug 30, 2025</span
                  > -->
                </div>
                <h3 class="packages-card__name">Orlando Family Adventure</h3>
                <div class="packages-card__location">
                  <span class="packages-card__location-icon"
                    ><svg
                      width="14"
                      height="14"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path
                        d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"
                      ></path>
                      <circle cx="12" cy="10" r="3"></circle></svg
                  ></span>
                  <span class="packages-card__location-text"
                    >Orlando, Florida</span
                  >
                </div>
                <div class="packages-card__footer">
                  <div class="packages-card__price-block">
                    <span class="packages-card__price-label">from</span>
                    <span class="packages-card__price">£429</span>
                    <span class="packages-card__price-old">£699</span>
                    <span class="packages-card__price-per">/Per person</span>
                  </div>
                  <div class="packages-card__rating">
                    <span class="packages-card__rating-score">4.9/5</span>
                    <span class="packages-card__rating-label">Excellent</span>
                    <span class="packages-card__rating-reviews"
                      >(186 review's)</span
                    >
                  </div>
                </div>
                <a href="tel:02031375177" class="packages-card__btn"
                  >Contact Us
                  <span class="packages-card__btn-arrow"
                    ><svg
                      width="13"
                      height="10"
                      viewBox="0 0 13 10"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M-0.000540733 4.9971C-0.000540733 4.79818 0.0784773 4.60742 0.21913 4.46676C0.359782 4.32611 0.550547 4.2471 0.749459 4.2471H9.53646L6.24946 1.3061C6.10253 1.17313 6.0142 0.987427 6.00375 0.789545C5.9933 0.591663 6.06159 0.397688 6.1937 0.249993C6.32581 0.102297 6.511 0.0128845 6.70881 0.00128682C6.90663 -0.0103109 7.101 0.0568487 7.24946 0.188095L11.9995 4.4381C12.0783 4.50845 12.1413 4.59466 12.1845 4.69108C12.2277 4.7875 12.25 4.89195 12.25 4.99759C12.25 5.10324 12.2277 5.20769 12.1845 5.30411C12.1413 5.40053 12.0783 5.48674 11.9995 5.5571L7.24946 9.8071C7.17616 9.87343 7.09047 9.92462 6.99732 9.95772C6.90416 9.99081 6.80539 10.0052 6.70667 9.99996C6.60795 9.99475 6.51123 9.97007 6.42208 9.92734C6.33293 9.88462 6.25311 9.82469 6.1872 9.75101C6.12129 9.67733 6.07061 9.59134 6.03805 9.498C6.00549 9.40465 5.99171 9.30579 5.9975 9.20711C6.00328 9.10842 6.02852 9.01185 6.07176 8.92295C6.115 8.83405 6.17539 8.75457 6.24946 8.6891L9.53646 5.7471H0.749459C0.550547 5.7471 0.359782 5.66808 0.21913 5.52742C0.0784773 5.38677 -0.000540733 5.19601 -0.000540733 4.9971Z"
                        fill="currentColor"
                      ></path></svg></span
                ></a>
              </div>
            </div>

            <!-- Card 2 -->
            <div class="packages-card">
              <div class="packages-card__image-wrapper">
                <img
                  src="assets/cards/destination-2.png"
                  alt="Package"
                  class="packages-card__image"
                />
                <span class="packages-card__badge">36% OFF</span>
              </div>
              <div class="packages-card__body">
                <div class="packages-card__tags">
                  <span class="packages-card__tag">5 Night Package</span>
                  <span class="packages-card__tag packages-card__tag--flight"
                    >Flights included</span
                  >
                </div>
                <div class="packages-card__route">
                  <span class="packages-card__city">London</span>
                  <span class="packages-card__route-icon"
                    ><img src="assets/icons/returnArrow.svg" alt="Return"
                  /></span>
                  <span class="packages-card__city">Los Angeles</span>
                </div>
                <div class="packages-card__date">
                  <span class="packages-card__date-icon"
                    ><img src="assets/icons/calendar.svg" alt="Calendar"
                  /></span>
                  <!-- <span class="packages-card__date-text"
                    >Aug 01, 2025 - Aug 30, 2025</span
                  > -->
                </div>
                <h3 class="packages-card__name">Los Angeles City Escape</h3>
                <div class="packages-card__location">
                  <span class="packages-card__location-icon"
                    ><svg
                      width="14"
                      height="14"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path
                        d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"
                      ></path>
                      <circle cx="12" cy="10" r="3"></circle></svg
                  ></span>
                  <span class="packages-card__location-text"
                    >Los Angeles, California</span
                  >
                </div>
                <div class="packages-card__footer">
                  <div class="packages-card__price-block">
                    <span class="packages-card__price-label">from</span>
                    <span class="packages-card__price">£579</span>
                    <span class="packages-card__price-old">£899</span>
                    <span class="packages-card__price-per">/Per person</span>
                  </div>
                  <div class="packages-card__rating">
                    <span class="packages-card__rating-score">4.7/5</span>
                    <span class="packages-card__rating-label">Excellent</span>
                    <span class="packages-card__rating-reviews"
                      >(142 review's)</span
                    >
                  </div>
                </div>
                <a href="tel:02031375177" class="packages-card__btn"
                  >Contact Us
                  <span class="packages-card__btn-arrow"
                    ><svg
                      width="13"
                      height="10"
                      viewBox="0 0 13 10"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M-0.000540733 4.9971C-0.000540733 4.79818 0.0784773 4.60742 0.21913 4.46676C0.359782 4.32611 0.550547 4.2471 0.749459 4.2471H9.53646L6.24946 1.3061C6.10253 1.17313 6.0142 0.987427 6.00375 0.789545C5.9933 0.591663 6.06159 0.397688 6.1937 0.249993C6.32581 0.102297 6.511 0.0128845 6.70881 0.00128682C6.90663 -0.0103109 7.101 0.0568487 7.24946 0.188095L11.9995 4.4381C12.0783 4.50845 12.1413 4.59466 12.1845 4.69108C12.2277 4.7875 12.25 4.89195 12.25 4.99759C12.25 5.10324 12.2277 5.20769 12.1845 5.30411C12.1413 5.40053 12.0783 5.48674 11.9995 5.5571L7.24946 9.8071C7.17616 9.87343 7.09047 9.92462 6.99732 9.95772C6.90416 9.99081 6.80539 10.0052 6.70667 9.99996C6.60795 9.99475 6.51123 9.97007 6.42208 9.92734C6.33293 9.88462 6.25311 9.82469 6.1872 9.75101C6.12129 9.67733 6.07061 9.59134 6.03805 9.498C6.00549 9.40465 5.99171 9.30579 5.9975 9.20711C6.00328 9.10842 6.02852 9.01185 6.07176 8.92295C6.115 8.83405 6.17539 8.75457 6.24946 8.6891L9.53646 5.7471H0.749459C0.550547 5.7471 0.359782 5.66808 0.21913 5.52742C0.0784773 5.38677 -0.000540733 5.19601 -0.000540733 4.9971Z"
                        fill="currentColor"
                      ></path></svg></span
                ></a>
              </div>
            </div>

            <!-- Card 3 -->
            <div class="packages-card">
              <div class="packages-card__image-wrapper">
                <img
                  src="assets/cards/destination-3.png"
                  alt="Package"
                  class="packages-card__image"
                />
                <span class="packages-card__badge">40% OFF</span>
              </div>
              <div class="packages-card__body">
                <div class="packages-card__tags">
                  <span class="packages-card__tag">3 Night Package</span>
                  <span class="packages-card__tag packages-card__tag--flight"
                    >Flights included</span
                  >
                </div>
                <div class="packages-card__route">
                  <span class="packages-card__city">London</span>
                  <span class="packages-card__route-icon"
                    ><img src="assets/icons/returnArrow.svg" alt="Return"
                  /></span>
                  <span class="packages-card__city">New Orleans</span>
                </div>
                <div class="packages-card__date">
                  <span class="packages-card__date-icon"
                    ><img src="assets/icons/calendar.svg" alt="Calendar"
                  /></span>
                  <!-- <span class="packages-card__date-text"
                    >Aug 01, 2025 - Aug 30, 2025</span
                  > -->
                </div>
                <h3 class="packages-card__name">New Orleans Jazz Tour</h3>
                <div class="packages-card__location">
                  <span class="packages-card__location-icon"
                    ><svg
                      width="14"
                      height="14"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path
                        d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"
                      ></path>
                      <circle cx="12" cy="10" r="3"></circle></svg
                  ></span>
                  <span class="packages-card__location-text"
                    >New Orleans, Louisiana</span
                  >
                </div>
                <div class="packages-card__footer">
                  <div class="packages-card__price-block">
                    <span class="packages-card__price-label">from</span>
                    <span class="packages-card__price">£389</span>
                    <span class="packages-card__price-old">£649</span>
                    <span class="packages-card__price-per">/Per person</span>
                  </div>
                  <div class="packages-card__rating">
                    <span class="packages-card__rating-score">4.8/5</span>
                    <span class="packages-card__rating-label">Excellent</span>
                    <span class="packages-card__rating-reviews"
                      >(98 review's)</span
                    >
                  </div>
                </div>
                <a href="tel:02031375177" class="packages-card__btn"
                  >Contact Us
                  <span class="packages-card__btn-arrow"
                    ><svg
                      width="13"
                      height="10"
                      viewBox="0 0 13 10"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M-0.000540733 4.9971C-0.000540733 4.79818 0.0784773 4.60742 0.21913 4.46676C0.359782 4.32611 0.550547 4.2471 0.749459 4.2471H9.53646L6.24946 1.3061C6.10253 1.17313 6.0142 0.987427 6.00375 0.789545C5.9933 0.591663 6.06159 0.397688 6.1937 0.249993C6.32581 0.102297 6.511 0.0128845 6.70881 0.00128682C6.90663 -0.0103109 7.101 0.0568487 7.24946 0.188095L11.9995 4.4381C12.0783 4.50845 12.1413 4.59466 12.1845 4.69108C12.2277 4.7875 12.25 4.89195 12.25 4.99759C12.25 5.10324 12.2277 5.20769 12.1845 5.30411C12.1413 5.40053 12.0783 5.48674 11.9995 5.5571L7.24946 9.8071C7.17616 9.87343 7.09047 9.92462 6.99732 9.95772C6.90416 9.99081 6.80539 10.0052 6.70667 9.99996C6.60795 9.99475 6.51123 9.97007 6.42208 9.92734C6.33293 9.88462 6.25311 9.82469 6.1872 9.75101C6.12129 9.67733 6.07061 9.59134 6.03805 9.498C6.00549 9.40465 5.99171 9.30579 5.9975 9.20711C6.00328 9.10842 6.02852 9.01185 6.07176 8.92295C6.115 8.83405 6.17539 8.75457 6.24946 8.6891L9.53646 5.7471H0.749459C0.550547 5.7471 0.359782 5.66808 0.21913 5.52742C0.0784773 5.38677 -0.000540733 5.19601 -0.000540733 4.9971Z"
                        fill="currentColor"
                      ></path></svg></span
                ></a>
              </div>
            </div>

            <!-- Card 4 -->
            <div class="packages-card">
              <div class="packages-card__image-wrapper">
                <img
                  src="assets/cards/destination-4.png"
                  alt="Package"
                  class="packages-card__image"
                />
                <span class="packages-card__badge">38% OFF</span>
              </div>
              <div class="packages-card__body">
                <div class="packages-card__tags">
                  <span class="packages-card__tag">5 Night Package</span>
                  <span class="packages-card__tag packages-card__tag--flight"
                    >Flights included</span
                  >
                </div>
                <div class="packages-card__route">
                  <span class="packages-card__city">London</span>
                  <span class="packages-card__route-icon"
                    ><img src="assets/icons/returnArrow.svg" alt="Return"
                  /></span>
                  <span class="packages-card__city">Miami</span>
                </div>
                <div class="packages-card__date">
                  <span class="packages-card__date-icon"
                    ><img src="assets/icons/calendar.svg" alt="Calendar"
                  /></span>
                  <!-- <span class="packages-card__date-text"
                    >Aug 01, 2025 - Aug 30, 2025</span
                  > -->
                </div>
                <h3 class="packages-card__name">Miami Beach Getaway</h3>
                <div class="packages-card__location">
                  <span class="packages-card__location-icon"
                    ><svg
                      width="14"
                      height="14"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path
                        d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"
                      ></path>
                      <circle cx="12" cy="10" r="3"></circle></svg
                  ></span>
                  <span class="packages-card__location-text"
                    >Miami, Florida</span
                  >
                </div>
                <div class="packages-card__footer">
                  <div class="packages-card__price-block">
                    <span class="packages-card__price-label">from</span>
                    <span class="packages-card__price">£499</span>
                    <span class="packages-card__price-old">£799</span>
                    <span class="packages-card__price-per">/Per person</span>
                  </div>
                  <div class="packages-card__rating">
                    <span class="packages-card__rating-score">4.9/5</span>
                    <span class="packages-card__rating-label">Excellent</span>
                    <span class="packages-card__rating-reviews"
                      >(215 review's)</span
                    >
                  </div>
                </div>
                <a href="tel:02031375177" class="packages-card__btn"
                  >Contact Us
                  <span class="packages-card__btn-arrow"
                    ><svg
                      width="13"
                      height="10"
                      viewBox="0 0 13 10"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M-0.000540733 4.9971C-0.000540733 4.79818 0.0784773 4.60742 0.21913 4.46676C0.359782 4.32611 0.550547 4.2471 0.749459 4.2471H9.53646L6.24946 1.3061C6.10253 1.17313 6.0142 0.987427 6.00375 0.789545C5.9933 0.591663 6.06159 0.397688 6.1937 0.249993C6.32581 0.102297 6.511 0.0128845 6.70881 0.00128682C6.90663 -0.0103109 7.101 0.0568487 7.24946 0.188095L11.9995 4.4381C12.0783 4.50845 12.1413 4.59466 12.1845 4.69108C12.2277 4.7875 12.25 4.89195 12.25 4.99759C12.25 5.10324 12.2277 5.20769 12.1845 5.30411C12.1413 5.40053 12.0783 5.48674 11.9995 5.5571L7.24946 9.8071C7.17616 9.87343 7.09047 9.92462 6.99732 9.95772C6.90416 9.99081 6.80539 10.0052 6.70667 9.99996C6.60795 9.99475 6.51123 9.97007 6.42208 9.92734C6.33293 9.88462 6.25311 9.82469 6.1872 9.75101C6.12129 9.67733 6.07061 9.59134 6.03805 9.498C6.00549 9.40465 5.99171 9.30579 5.9975 9.20711C6.00328 9.10842 6.02852 9.01185 6.07176 8.92295C6.115 8.83405 6.17539 8.75457 6.24946 8.6891L9.53646 5.7471H0.749459C0.550547 5.7471 0.359782 5.66808 0.21913 5.52742C0.0784773 5.38677 -0.000540733 5.19601 -0.000540733 4.9971Z"
                        fill="currentColor"
                      ></path></svg></span
                ></a>
              </div>
            </div>

            <!-- Card 5 -->
            <div class="packages-card">
              <div class="packages-card__image-wrapper">
                <img
                  src="assets/cards/destination-5.png"
                  alt="Package"
                  class="packages-card__image"
                />
                <span class="packages-card__badge">37% OFF</span>
              </div>
              <div class="packages-card__body">
                <div class="packages-card__tags">
                  <span class="packages-card__tag">6 Night Package</span>
                  <span class="packages-card__tag packages-card__tag--flight"
                    >Flights included</span
                  >
                </div>
                <div class="packages-card__route">
                  <span class="packages-card__city">London</span>
                  <span class="packages-card__route-icon"
                    ><img src="assets/icons/returnArrow.svg" alt="Return"
                  /></span>
                  <span class="packages-card__city">San Francisco</span>
                </div>
                <div class="packages-card__date">
                  <span class="packages-card__date-icon"
                    ><img src="assets/icons/calendar.svg" alt="Calendar"
                  /></span>
                  <!-- <span class="packages-card__date-text"
                    >Aug 01, 2025 - Aug 30, 2025</span
                  > -->
                </div>
                <h3 class="packages-card__name">San Francisco Bay Discovery</h3>
                <div class="packages-card__location">
                  <span class="packages-card__location-icon"
                    ><svg
                      width="14"
                      height="14"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path
                        d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"
                      ></path>
                      <circle cx="12" cy="10" r="3"></circle></svg
                  ></span>
                  <span class="packages-card__location-text"
                    >San Francisco, California</span
                  >
                </div>
                <div class="packages-card__footer">
                  <div class="packages-card__price-block">
                    <span class="packages-card__price-label">from</span>
                    <span class="packages-card__price">£629</span>
                    <span class="packages-card__price-old">£999</span>
                    <span class="packages-card__price-per">/Per person</span>
                  </div>
                  <div class="packages-card__rating">
                    <span class="packages-card__rating-score">4.8/5</span>
                    <span class="packages-card__rating-label">Excellent</span>
                    <span class="packages-card__rating-reviews"
                      >(167 review's)</span
                    >
                  </div>
                </div>
                <a href="tel:02031375177" class="packages-card__btn"
                  >Contact Us
                  <span class="packages-card__btn-arrow"
                    ><svg
                      width="13"
                      height="10"
                      viewBox="0 0 13 10"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M-0.000540733 4.9971C-0.000540733 4.79818 0.0784773 4.60742 0.21913 4.46676C0.359782 4.32611 0.550547 4.2471 0.749459 4.2471H9.53646L6.24946 1.3061C6.10253 1.17313 6.0142 0.987427 6.00375 0.789545C5.9933 0.591663 6.06159 0.397688 6.1937 0.249993C6.32581 0.102297 6.511 0.0128845 6.70881 0.00128682C6.90663 -0.0103109 7.101 0.0568487 7.24946 0.188095L11.9995 4.4381C12.0783 4.50845 12.1413 4.59466 12.1845 4.69108C12.2277 4.7875 12.25 4.89195 12.25 4.99759C12.25 5.10324 12.2277 5.20769 12.1845 5.30411C12.1413 5.40053 12.0783 5.48674 11.9995 5.5571L7.24946 9.8071C7.17616 9.87343 7.09047 9.92462 6.99732 9.95772C6.90416 9.99081 6.80539 10.0052 6.70667 9.99996C6.60795 9.99475 6.51123 9.97007 6.42208 9.92734C6.33293 9.88462 6.25311 9.82469 6.1872 9.75101C6.12129 9.67733 6.07061 9.59134 6.03805 9.498C6.00549 9.40465 5.99171 9.30579 5.9975 9.20711C6.00328 9.10842 6.02852 9.01185 6.07176 8.92295C6.115 8.83405 6.17539 8.75457 6.24946 8.6891L9.53646 5.7471H0.749459C0.550547 5.7471 0.359782 5.66808 0.21913 5.52742C0.0784773 5.38677 -0.000540733 5.19601 -0.000540733 4.9971Z"
                        fill="currentColor"
                      ></path></svg></span
                ></a>
              </div>
            </div>

            <!-- Card 6 -->
            <div class="packages-card">
              <div class="packages-card__image-wrapper">
                <img
                  src="assets/cards/destination-6.png"
                  alt="Package"
                  class="packages-card__image"
                />
                <span class="packages-card__badge">40% OFF</span>
              </div>
              <div class="packages-card__body">
                <div class="packages-card__tags">
                  <span class="packages-card__tag">3 Night Package</span>
                  <span class="packages-card__tag packages-card__tag--flight"
                    >Flights included</span
                  >
                </div>
                <div class="packages-card__route">
                  <span class="packages-card__city">London</span>
                  <span class="packages-card__route-icon"
                    ><img src="assets/icons/returnArrow.svg" alt="Return"
                  /></span>
                  <span class="packages-card__city">Phoenix</span>
                </div>
                <div class="packages-card__date">
                  <span class="packages-card__date-icon"
                    ><img src="assets/icons/calendar.svg" alt="Calendar"
                  /></span>
                  <!-- <span class="packages-card__date-text"
                    >Aug 01, 2025 - Aug 30, 2025</span
                  > -->
                </div>
                <h3 class="packages-card__name">Paris Romantic Getaway</h3>
                <div class="packages-card__location">
                  <span class="packages-card__location-icon"
                    ><svg
                      width="14"
                      height="14"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path
                        d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"
                      ></path>
                      <circle cx="12" cy="10" r="3"></circle></svg
                  ></span>
                  <span class="packages-card__location-text"
                    >Phoenix, Arizona</span
                  >
                </div>
                <div class="packages-card__footer">
                  <div class="packages-card__price-block">
                    <span class="packages-card__price-label">from</span>
                    <span class="packages-card__price">£359</span>
                    <span class="packages-card__price-old">£599</span>
                    <span class="packages-card__price-per">/Per person</span>
                  </div>
                  <div class="packages-card__rating">
                    <span class="packages-card__rating-score">4.6/5</span>
                    <span class="packages-card__rating-label">Excellent</span>
                    <span class="packages-card__rating-reviews"
                      >(89 review's)</span
                    >
                  </div>
                </div>
                <a href="tel:02031375177" class="packages-card__btn"
                  >Contact Us
                  <span class="packages-card__btn-arrow"
                    ><svg
                      width="13"
                      height="10"
                      viewBox="0 0 13 10"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M-0.000540733 4.9971C-0.000540733 4.79818 0.0784773 4.60742 0.21913 4.46676C0.359782 4.32611 0.550547 4.2471 0.749459 4.2471H9.53646L6.24946 1.3061C6.10253 1.17313 6.0142 0.987427 6.00375 0.789545C5.9933 0.591663 6.06159 0.397688 6.1937 0.249993C6.32581 0.102297 6.511 0.0128845 6.70881 0.00128682C6.90663 -0.0103109 7.101 0.0568487 7.24946 0.188095L11.9995 4.4381C12.0783 4.50845 12.1413 4.59466 12.1845 4.69108C12.2277 4.7875 12.25 4.89195 12.25 4.99759C12.25 5.10324 12.2277 5.20769 12.1845 5.30411C12.1413 5.40053 12.0783 5.48674 11.9995 5.5571L7.24946 9.8071C7.17616 9.87343 7.09047 9.92462 6.99732 9.95772C6.90416 9.99081 6.80539 10.0052 6.70667 9.99996C6.60795 9.99475 6.51123 9.97007 6.42208 9.92734C6.33293 9.88462 6.25311 9.82469 6.1872 9.75101C6.12129 9.67733 6.07061 9.59134 6.03805 9.498C6.00549 9.40465 5.99171 9.30579 5.9975 9.20711C6.00328 9.10842 6.02852 9.01185 6.07176 8.92295C6.115 8.83405 6.17539 8.75457 6.24946 8.6891L9.53646 5.7471H0.749459C0.550547 5.7471 0.359782 5.66808 0.21913 5.52742C0.0784773 5.38677 -0.000540733 5.19601 -0.000540733 4.9971Z"
                        fill="currentColor"
                      ></path></svg></span
                ></a>
              </div>
            </div>

            <!-- Card 7 -->
            <div class="packages-card">
              <div class="packages-card__image-wrapper">
                <img
                  src="assets/cards/ny-card.png"
                  alt="Package"
                  class="packages-card__image"
                />
                <span class="packages-card__badge">39% OFF</span>
              </div>
              <div class="packages-card__body">
                <div class="packages-card__tags">
                  <span class="packages-card__tag">4 Night Package</span>
                  <span class="packages-card__tag packages-card__tag--flight"
                    >Flights included</span
                  >
                </div>
                <div class="packages-card__route">
                  <span class="packages-card__city">London</span>
                  <span class="packages-card__route-icon"
                    ><img src="assets/icons/returnArrow.svg" alt="Return"
                  /></span>
                  <span class="packages-card__city">New York</span>
                </div>
                <div class="packages-card__date">
                  <span class="packages-card__date-icon"
                    ><img src="assets/icons/calendar.svg" alt="Calendar"
                  /></span>
                  <!-- <span class="packages-card__date-text"
                    >Aug 01, 2025 - Aug 30, 2025</span
                  > -->
                </div>
                <h3 class="packages-card__name">New York Skyline Experience</h3>
                <div class="packages-card__location">
                  <span class="packages-card__location-icon"
                    ><svg
                      width="14"
                      height="14"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path
                        d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"
                      ></path>
                      <circle cx="12" cy="10" r="3"></circle></svg
                  ></span>
                  <span class="packages-card__location-text"
                    >New York City, New York</span
                  >
                </div>
                <div class="packages-card__footer">
                  <div class="packages-card__price-block">
                    <span class="packages-card__price-label">from</span>
                    <span class="packages-card__price">£549</span>
                    <span class="packages-card__price-old">£899</span>
                    <span class="packages-card__price-per">/Per person</span>
                  </div>
                  <div class="packages-card__rating">
                    <span class="packages-card__rating-score">4.9/5</span>
                    <span class="packages-card__rating-label">Excellent</span>
                    <span class="packages-card__rating-reviews"
                      >(243 review's)</span
                    >
                  </div>
                </div>
                <a href="tel:02031375177" class="packages-card__btn"
                  >Contact Us
                  <span class="packages-card__btn-arrow"
                    ><svg
                      width="13"
                      height="10"
                      viewBox="0 0 13 10"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M-0.000540733 4.9971C-0.000540733 4.79818 0.0784773 4.60742 0.21913 4.46676C0.359782 4.32611 0.550547 4.2471 0.749459 4.2471H9.53646L6.24946 1.3061C6.10253 1.17313 6.0142 0.987427 6.00375 0.789545C5.9933 0.591663 6.06159 0.397688 6.1937 0.249993C6.32581 0.102297 6.511 0.0128845 6.70881 0.00128682C6.90663 -0.0103109 7.101 0.0568487 7.24946 0.188095L11.9995 4.4381C12.0783 4.50845 12.1413 4.59466 12.1845 4.69108C12.2277 4.7875 12.25 4.89195 12.25 4.99759C12.25 5.10324 12.2277 5.20769 12.1845 5.30411C12.1413 5.40053 12.0783 5.48674 11.9995 5.5571L7.24946 9.8071C7.17616 9.87343 7.09047 9.92462 6.99732 9.95772C6.90416 9.99081 6.80539 10.0052 6.70667 9.99996C6.60795 9.99475 6.51123 9.97007 6.42208 9.92734C6.33293 9.88462 6.25311 9.82469 6.1872 9.75101C6.12129 9.67733 6.07061 9.59134 6.03805 9.498C6.00549 9.40465 5.99171 9.30579 5.9975 9.20711C6.00328 9.10842 6.02852 9.01185 6.07176 8.92295C6.115 8.83405 6.17539 8.75457 6.24946 8.6891L9.53646 5.7471H0.749459C0.550547 5.7471 0.359782 5.66808 0.21913 5.52742C0.0784773 5.38677 -0.000540733 5.19601 -0.000540733 4.9971Z"
                        fill="currentColor"
                      ></path></svg></span
                ></a>
              </div>
            </div>

            <!-- Card 8 -->
            <div class="packages-card">
              <div class="packages-card__image-wrapper">
                <img
                  src="assets/cards/miami-card.png"
                  alt="Package"
                  class="packages-card__image"
                />
                <span class="packages-card__badge">40% OFF</span>
              </div>
              <div class="packages-card__body">
                <div class="packages-card__tags">
                  <span class="packages-card__tag">4 Night Package</span>
                  <span class="packages-card__tag packages-card__tag--flight"
                    >Flights included</span
                  >
                </div>
                <div class="packages-card__route">
                  <span class="packages-card__city">London</span>
                  <span class="packages-card__route-icon"
                    ><img src="assets/icons/returnArrow.svg" alt="Return"
                  /></span>
                  <span class="packages-card__city">Chicago</span>
                </div>
                <div class="packages-card__date">
                  <span class="packages-card__date-icon"
                    ><img src="assets/icons/calendar.svg" alt="Calendar"
                  /></span>
                  <!-- <span class="packages-card__date-text"
                    >Aug 01, 2025 - Aug 30, 2025</span
                  > -->
                </div>
                <h3 class="packages-card__name">Chicago Lakeside City Break</h3>
                <div class="packages-card__location">
                  <span class="packages-card__location-icon"
                    ><svg
                      width="14"
                      height="14"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path
                        d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"
                      ></path>
                      <circle cx="12" cy="10" r="3"></circle></svg
                  ></span>
                  <span class="packages-card__location-text"
                    >Chicago, Illinois</span
                  >
                </div>
                <div class="packages-card__footer">
                  <div class="packages-card__price-block">
                    <span class="packages-card__price-label">from</span>
                    <span class="packages-card__price">£419</span>
                    <span class="packages-card__price-old">£699</span>
                    <span class="packages-card__price-per">/Per person</span>
                  </div>
                  <div class="packages-card__rating">
                    <span class="packages-card__rating-score">4.7/5</span>
                    <span class="packages-card__rating-label">Excellent</span>
                    <span class="packages-card__rating-reviews"
                      >(129 review's)</span
                    >
                  </div>
                </div>
                <a href="tel:02031375177" class="packages-card__btn"
                  >Contact Us
                  <span class="packages-card__btn-arrow"
                    ><svg
                      width="13"
                      height="10"
                      viewBox="0 0 13 10"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M-0.000540733 4.9971C-0.000540733 4.79818 0.0784773 4.60742 0.21913 4.46676C0.359782 4.32611 0.550547 4.2471 0.749459 4.2471H9.53646L6.24946 1.3061C6.10253 1.17313 6.0142 0.987427 6.00375 0.789545C5.9933 0.591663 6.06159 0.397688 6.1937 0.249993C6.32581 0.102297 6.511 0.0128845 6.70881 0.00128682C6.90663 -0.0103109 7.101 0.0568487 7.24946 0.188095L11.9995 4.4381C12.0783 4.50845 12.1413 4.59466 12.1845 4.69108C12.2277 4.7875 12.25 4.89195 12.25 4.99759C12.25 5.10324 12.2277 5.20769 12.1845 5.30411C12.1413 5.40053 12.0783 5.48674 11.9995 5.5571L7.24946 9.8071C7.17616 9.87343 7.09047 9.92462 6.99732 9.95772C6.90416 9.99081 6.80539 10.0052 6.70667 9.99996C6.60795 9.99475 6.51123 9.97007 6.42208 9.92734C6.33293 9.88462 6.25311 9.82469 6.1872 9.75101C6.12129 9.67733 6.07061 9.59134 6.03805 9.498C6.00549 9.40465 5.99171 9.30579 5.9975 9.20711C6.00328 9.10842 6.02852 9.01185 6.07176 8.92295C6.115 8.83405 6.17539 8.75457 6.24946 8.6891L9.53646 5.7471H0.749459C0.550547 5.7471 0.359782 5.66808 0.21913 5.52742C0.0784773 5.38677 -0.000540733 5.19601 -0.000540733 4.9971Z"
                        fill="currentColor"
                      ></path></svg></span
                ></a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- PACKAGES AREA SECTION END -->

      <div class="paymentBanner">
        <div class="container">
          <div class="paymentBanner__poster">
            <div class="paymentBanner__waves">
              <img
                src="assets/icons/wave2.svg"
                alt=""
                class="paymentBanner__wave paymentBanner__wave--back"
              />
              <img
                src="assets/icons/wave3.svg"
                alt=""
                class="paymentBanner__wave paymentBanner__wave--front"
              />
            </div>
            <div class="paymentBanner__bubbles">
              <span
                class="paymentBanner__bubble paymentBanner__bubble--1"
              ></span>
              <span
                class="paymentBanner__bubble paymentBanner__bubble--2"
              ></span>
              <span
                class="paymentBanner__bubble paymentBanner__bubble--3"
              ></span>
              <span
                class="paymentBanner__bubble paymentBanner__bubble--4"
              ></span>
              <span
                class="paymentBanner__bubble paymentBanner__bubble--5"
              ></span>
              <span
                class="paymentBanner__bubble paymentBanner__bubble--6"
              ></span>
              <span
                class="paymentBanner__bubble paymentBanner__bubble--7"
              ></span>
              <span
                class="paymentBanner__bubble paymentBanner__bubble--8"
              ></span>
            </div>
            <div class="paymentBanner__left">
              <div class="paymentBanner__content">
                <div class="paymentBanner__badges">
                  <span
                    class="paymentBanner__badge paymentBanner__badge--secure"
                    >🔒 Secure</span
                  >
                  <span class="paymentBanner__badge paymentBanner__badge--fast"
                    >⚡ Fast</span
                  >
                  <span
                    class="paymentBanner__badge paymentBanner__badge--trusted"
                    >✓ Trusted</span
                  >
                  <span
                    class="paymentBanner__badge paymentBanner__badge--global"
                    >🌍 Global</span
                  >
                  <span class="paymentBanner__badge paymentBanner__badge--easy"
                    >💎 Easy</span
                  >
                </div>
                <h3 class="paymentBanner__title">Seamless & Secure Payments</h3>
                <p class="paymentBanner__caption">
                  Make your online payment effortlessly with our trusted
                  partner, Felloh. Simply click the button to proceed.
                </p>
                <p class="paymentBanner__subtext">
                  Enjoy instant transactions, zero hidden fees, and 24/7
                  customer support — all in one place.
                </p>
                <div class="paymentBanner__stats">
                  <div class="paymentBanner__stat">
                    <span class="paymentBanner__stat-number">10M+</span>
                    <span class="paymentBanner__stat-label">Transactions</span>
                  </div>
                  <div class="paymentBanner__stat">
                    <span class="paymentBanner__stat-number">99.9%</span>
                    <span class="paymentBanner__stat-label">Uptime</span>
                  </div>
                  <div class="paymentBanner__stat">
                    <span class="paymentBanner__stat-number">150+</span>
                    <span class="paymentBanner__stat-label">Countries</span>
                  </div>
                </div>
                <a href="#" class="paymentBanner__btn"
                  >Click To Now Pay
                  <span class="paymentBanner__btn-arrow"
                    ><svg
                      width="13"
                      height="10"
                      viewBox="0 0 13 10"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M-0.000540733 4.9971C-0.000540733 4.79818 0.0784773 4.60742 0.21913 4.46676C0.359782 4.32611 0.550547 4.2471 0.749459 4.2471H9.53646L6.24946 1.3061C6.10253 1.17313 6.0142 0.987427 6.00375 0.789545C5.9933 0.591663 6.06159 0.397688 6.1937 0.249993C6.32581 0.102297 6.511 0.0128845 6.70881 0.00128682C6.90663 -0.0103109 7.101 0.0568487 7.24946 0.188095L11.9995 4.4381C12.0783 4.50845 12.1413 4.59466 12.1845 4.69108C12.2277 4.7875 12.25 4.89195 12.25 4.99759C12.25 5.10324 12.2277 5.20769 12.1845 5.30411C12.1413 5.40053 12.0783 5.48674 11.9995 5.5571L7.24946 9.8071C7.17616 9.87343 7.09047 9.92462 6.99732 9.95772C6.90416 9.99081 6.80539 10.0052 6.70667 9.99996C6.60795 9.99475 6.51123 9.97007 6.42208 9.92734C6.33293 9.88462 6.25311 9.82469 6.1872 9.75101C6.12129 9.67733 6.07061 9.59134 6.03805 9.498C6.00549 9.40465 5.99171 9.30579 5.9975 9.20711C6.00328 9.10842 6.02852 9.01185 6.07176 8.92295C6.115 8.83405 6.17539 8.75457 6.24946 8.6891L9.53646 5.7471H0.749459C0.550547 5.7471 0.359782 5.66808 0.21913 5.52742C0.0784773 5.38677 -0.000540733 5.19601 -0.000540733 4.9971Z"
                        fill="currentColor"
                      ></path></svg></span
                ></a>
              </div>
            </div>
            <div class="paymentBanner__right">
              <img
                src="assets/plane-cta.png"
                alt="Payment"
                class="paymentBanner__demo-img"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ============================================
         FOOTER SECTION
         ============================================ -->
    <footer class="footer">
      <!-- Wave Top Border -->
      <div class="footer__wave">
        <img
          src="assets/icons/wave2.svg"
          alt=""
          class="footer__wave-img footer__wave-img--back"
        />
        <img
          src="assets/icons/wave3.svg"
          alt=""
          class="footer__wave-img footer__wave-img--front"
        />
      </div>

      <div class="footer__main">
        <div class="container">
          <div class="footer__grid">
            <!-- Logo & Badges & Help -->
            <div class="footer__brand">
              <div class="footer__logo">
                <img
                  src="assets/logo.png"
                  alt="American Fly Logo"
                  class="footer__logo-img"
                />
              </div>
              <div class="footer__badges">
                <img
                  src="assets/cert/tta.png"
                  alt="Badge 1"
                  class="footer__badge"
                />
                <img
                  src="assets/cert/tta-trans.png"
                  alt="Badge 2"
                  class="footer__badge"
                />
                <img
                  src="assets/cert/atol_logo_white.png"
                  alt="Badge 3"
                  class="footer__badge"
                />
              </div>
              <div class="footer__help">
                <h4 class="footer__help-title">Need any help?</h4>
                <div class="footer__help-items">
                  <div class="footer__help-item">
                    <span class="footer__help-label">Talk to our experts</span>
                    <a href="tel:02031375177" class="footer__help-value"
                      >0203 137 5177</a
                    >
                  </div>
                  <div class="footer__help-item">
                    <span class="footer__help-label">WhatsApp us</span>
                    <a
                      href="https://wa.me/447446512247"
                      class="footer__help-value"
                      >07446512247</a
                    >
                  </div>
                  <div class="footer__help-item">
                    <span class="footer__help-label"
                      >Mail to our support team</span
                    >
                    <a
                      href="mailto:info@americanfly.co.uk"
                      class="footer__help-value"
                      >info@americanfly.co.uk</a
                    >
                  </div>
                </div>
              </div>
            </div>

            <!-- Company Links -->
            <div class="footer__links">
              <h4 class="footer__links-title">Company</h4>
              <ul class="footer__links-list">
                <li><a href="index.html">Home</a></li>
                <li><a href="about-us.html">About Us</a></li>
                <li><a href="privacy-policy.html">Privacy Policy</a></li>
                <li>
                  <a href="terms-and-conditions.html">Terms Conditions</a>
                </li>
                <li><a href="contact-us.html">Contact Us</a></li>
              </ul>
            </div>

            <!-- City Breaks -->
            <div class="footer__links">
              <h4 class="footer__links-title">City Breaks</h4>
              <ul class="footer__links-list">
                <li><a href="#">Savannah</a></li>
                <li><a href="#">Charleston</a></li>
                <li><a href="#">New Orleans</a></li>
                <li><a href="#">Chicago</a></li>
                <li><a href="#">San Francisco</a></li>
              </ul>
            </div>

            <!-- Top Destinations -->
            <div class="footer__links">
              <h4 class="footer__links-title">Top Destinations</h4>
              <ul class="footer__links-list">
                <li><a href="#">Las Vegas</a></li>
                <li><a href="#">Toronto</a></li>
                <li><a href="#">Miami</a></li>
                <li><a href="#">Boston</a></li>
                <li><a href="#">Orlando</a></li>
              </ul>
            </div>

            <!-- Top Cities -->
            <div class="footer__links">
              <h4 class="footer__links-title">Top Cities</h4>
              <ul class="footer__links-list">
                <li><a href="#">Chicago</a></li>
                <li><a href="#">New York</a></li>
                <li><a href="#">San Francisco</a></li>
                <li><a href="#">Vancouver</a></li>
                <li><a href="#">Houston</a></li>
              </ul>
            </div>
          </div>

          <!-- Summary -->
          <div class="footer__summary">
            <p>
              At American Fly, we offer a wide range of flight ticket options,
              including Economy, Premium Economy, Business, and First Class. We
              specialize in securing the best deals for our customers traveling
              to the USA, South America, Canada, and Caribbean destinations. Our
              website features exclusive offers from leading airlines and
              trusted suppliers worldwide. With our user-friendly interface and
              powerful search tools, you can easily find affordable flights to
              your preferred destinations—saving you both time and money.
            </p>
            <p>
              American Fly operates under the trading name of FLY2WORLD UK LTD,
              headquartered at 450 Bath Road, West Drayton, England, UB7 0EB,
              with Company Registration Number: 14919426. We provide a
              comprehensive suite of travel services, including flights, hotels,
              and vehicle rentals. Our mission is to deliver exceptional and
              memorable travel experiences to all our customers.
            </p>
            <p>
              Committed to quality customer service, our dedicated team works
              tirelessly to secure the best rates on flights, hotels, car
              rentals, and holiday packages—ensuring you receive the best value
              for your journey.
            </p>
            <p>
              Some of the flights and flight-inclusive holidays on this website
              are financially protected by the ATOL scheme. But ATOL protection
              does not apply to all holiday and travel services listed on this
              website. Please feel free to check with us to confirm the level of
              protection applicable to your specific booking. If you do not
              receive an ATOL Certificate, then the booking will not be ATOL
              protected. If you do receive an ATOL Certificate but all the parts
              of your trip are not listed on it, those parts will not be ATOL
              protected. Please see our booking conditions for information, or
              for more information about financial protection and the ATOL
              Certificate go to:
              <a href="https://www.caa.co.uk" target="_blank" rel="noopener"
                >www.caa.co.uk</a
              >
            </p>
          </div>
        </div>
      </div>

      <!-- Copyright Bar -->
      <div class="footer__copyright">
        <div class="container">
          <div class="footer__copyright-inner">
            <p class="footer__copyright-text">
              Copyright &copy; 2026 All Rights Reserved. American Fly.
            </p>
            <div class="footer__cards">
              <img
                src="assets/cards.webp"
                alt="Accepted Cards"
                class="footer__cards-img"
              />
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- jQuery UI for Datepicker -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Bootstrap 5 JS Bundle -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <!-- Slick Slider  -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
      integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <!-- Custom Script -->
    <script src="script.js"></script>

    <!-- <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Target all dropdown toggle links inside multi-level setups
        const subToggleLinks = document.querySelectorAll(
          ".dropdown-submenu > .dropdown-toggle",
        );

        subToggleLinks.forEach(function (element) {
          element.addEventListener("click", function (e) {
            // Stop event from bubbling up and closing the entire structural container
            e.stopPropagation();

            // Look for the closest list-item node parent
            const subMenuParent = this.parentElement;

            // If it is mobile/tablet viewpoint, prevent default anchor tracking to safely open submenus instead
            if (window.innerWidth < 992) {
              e.preventDefault();

              // Toggle view visibility class
              subMenuParent.classList.toggle("show-submenu");

              // Clean up neighboring submenus at the same hierarchy depth level
              const siblings = subMenuParent.parentElement.children;
              for (let sibling of siblings) {
                if (
                  sibling !== subMenuParent &&
                  sibling.classList.contains("dropdown-submenu")
                ) {
                  sibling.classList.remove("show-submenu");
                }
              }
            }
          });
        });

        // If the parent link has a real file location (like href="Dubai.html"), let it act normally on desktop hover environments
        const activeLinks = document.querySelectorAll(".dropdown-submenu > a");
        activeLinks.forEach(function (link) {
          link.addEventListener("click", function (e) {
            const hrefValue = this.getAttribute("href");
            if (window.innerWidth >= 992 && hrefValue && hrefValue !== "#") {
              window.location.href = hrefValue;
            }
          });
        });
      });
    </script> -->

    <!-- <script>
      (function () {
        function c() {
          var b = a.contentDocument || a.contentWindow.document;
          if (b) {
            var d = b.createElement("script");
            d.innerHTML =
              "window.__CF$cv$params={r:'a139f746fe059e2e',t:'MTc4Mjc4ODkwMA=='};var a=document.createElement('script');a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
            b.getElementsByTagName("head")[0].appendChild(d);
          }
        }
        if (document.body) {
          var a = document.createElement("iframe");
          a.height = 1;
          a.width = 1;
          a.style.position = "absolute";
          a.style.top = 0;
          a.style.left = 0;
          a.style.border = "none";
          a.style.visibility = "hidden";
          document.body.appendChild(a);
          if ("loading" !== document.readyState) c();
          else if (window.addEventListener)
            document.addEventListener("DOMContentLoaded", c);
          else {
            var e = document.onreadystatechange || function () {};
            document.onreadystatechange = function (b) {
              e(b);
              "loading" !== document.readyState &&
                ((document.onreadystatechange = e), c());
            };
          }
        }
      })();
    </script> -->
    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->

    <!-- Bootstrap 5 Bundle JS (Optional if you use BS tooltips/dropdowns elsewhere) -->
    <!-- <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script> -->

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
      $(document).ready(function () {
        // 1. Initialize Select2 on Origin and Destination
        $(".bs-select2-origin, .bs-select2-destination").select2({
          dropdownAutoWidth: true,
          width: "100%",
        });

        // 2. Initialize Modern Flatpickr Datepickers
        const today = new Date();
        const returnDay = new Date();
        returnDay.setDate(today.getDate() + 7);

        const returnDatePicker = flatpickr("#bsReturnDate", {
          dateFormat: "D, d M Y",
          defaultDate: returnDay,
          minDate: "today",
          disableMobile: true,
        });

        flatpickr("#bsStartDate", {
          dateFormat: "D, d M Y",
          defaultDate: today,
          minDate: "today",
          disableMobile: true,
          onChange: function (selectedDates) {
            if (selectedDates[0]) {
              returnDatePicker.set("minDate", selectedDates[0]);
            }
          },
        });
      });
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
      var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
      (function () {
        var s1 = document.createElement("script"),
          s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = "https://embed.tawk.to/66cd98b5ea492f34bc0a8992/1i69hp1jq";
        s1.charset = "UTF-8";
        s1.setAttribute("crossorigin", "*");
        s0.parentNode.insertBefore(s1, s0);
      })();
    </script>
    <!--End of Tawk.to Script-->
  </body>
</html>
