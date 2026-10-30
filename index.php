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
    <!-- (Header + Navbar) -->
    <?php include '_nav.php'; ?>

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
                action="flight-search.php" method="get"
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
                        <select class="bs-select2-origin" name="origin" required>
                          <option value="">Select Origin</option>
                          <?php
                            if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                echo "<option value=\"".$row["Airport_Code"]."\">".$row["Airport_Name"]." (".$row["Airport_Code"].")</option>";
                              }
                            }
                          ?>
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
                          required
                        >
                        <option value="">Select Destination</option>
                        <?php
                          if ($result1->num_rows > 0) {
                            while($row1 = $result1->fetch_assoc()) {
                              echo "<option value=\"".$row1["Airport_Code"]."\">".$row1["Airport_Name"]." (".$row1["Airport_Code"].")</option>";
                            }
                          }
                        ?>
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
                        <!-- Visible date -->
                        <input
                          type="text"
                          class="bs-field-input"
                          id="bsStartDate"
                          placeholder="Select date"
                          readonly
                        />

                        <!-- Actual submitted date -->
                        <input
                          type="hidden"
                          name="startDate"
                          id="startDate"
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
                        <!-- Visible date -->
                        <input
                          type="text"
                          class="bs-field-input"
                          id="bsReturnDate"
                          placeholder="Select date"
                          readonly
                        />

                        <!-- Actual submitted date -->
                        <input
                          type="hidden"
                          name="endDate"
                          id="endDate"
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
                        <select class="bs-field-select" name="adult">
                          <option value="1" selected>1 Adult</option>
                          <option value="2">2 Adults</option>
                          <option value="3">3 Adults</option>
                          <option value="4">4 Adults</option>
                          <option value="5">5 Adults</option>
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
                        <select class="bs-field-select" name="class">
                          <option value="1" selected>Economy</option>
                          <option value="2">Business</option>
                          <option value="4">Premium</option>
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
                  <span class="flight-destination-card__price">From £475</span>
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
                  <span class="flight-destination-card__price">From £483</span>
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
                  <span class="flight-destination-card__price">From £529</span>
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
                  <span class="flight-destination-card__price">From £535</span>
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
                  <span class="flight-destination-card__price">From £489</span>
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
                  <span class="flight-destination-card__price">From £499</span>
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
                  <span class="flight-destination-card__price">From £429</span>
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
                  <span class="offer-card__price">£579</span>
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
                  <span class="offer-card__price">£599</span>
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
                  <span class="offer-card__price">£587</span>
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
                  <span class="offer-card__price">£629</span>
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

      
      <!-- ============================================
          TRAVEL BENEFITS STRIP START
          ============================================ -->
      <section class="travel-benefits">
        <div class="container">
          <div class="travel-benefits__inner">

            <!-- Benefit 1 -->
            <div class="travel-benefits__item">
              <div class="travel-benefits__icon">
                <i class="fa-solid fa-user-tie"></i>
              </div>
              <div class="travel-benefits__content">
                <h4>Tailored Travel</h4>
                <p>Trips built around you</p>
              </div>
            </div>

            <!-- Benefit 2 -->
            <div class="travel-benefits__item">
              <div class="travel-benefits__icon">
                <i class="fa-solid fa-globe"></i>
              </div>
              <div class="travel-benefits__content">
                <h4>Worldwide Flights</h4>
                <p>Economy to Business Class</p>
              </div>
            </div>

            <!-- Benefit 3 -->
            <div class="travel-benefits__item">
              <div class="travel-benefits__icon">
                <i class="fa-solid fa-suitcase"></i>
              </div>
              <div class="travel-benefits__content">
                <h4>Holiday Packages</h4>
                <p>Flights and stays together</p>
              </div>
            </div>

            <!-- Benefit 4 -->
            <div class="travel-benefits__item">
              <div class="travel-benefits__icon">
                <i class="fa-solid fa-headset"></i>
              </div>
              <div class="travel-benefits__content">
                <h4>Personal Service</h4>
                <p>Support from real experts</p>
              </div>
            </div>

            <!-- Benefit 5 -->
            <div class="travel-benefits__item">
              <div class="travel-benefits__icon">
                <i class="fa-solid fa-shield-halved"></i>
              </div>
              <div class="travel-benefits__content">
                <h4>Travel with Confidence</h4>
                <p>Clear advice, reliable support</p>
              </div>
            </div>

          </div>
        </div>
      </section>
      <!-- TRAVEL BENEFITS STRIP END -->


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
                    <span class="packages-card__price">£629</span>
                    <span class="packages-card__price-old">£888</span>
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
                    <span class="packages-card__price">£650</span>
                    <span class="packages-card__price-old">£884</span>
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
                    <span class="packages-card__price">£579</span>
                    <span class="packages-card__price-old">£810</span>
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
                    <span class="packages-card__price">£675</span>
                    <span class="packages-card__price-old">£931</span>
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
                    <span class="packages-card__price">£699</span>
                    <span class="packages-card__price-old">£957</span>
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
                    <span class="packages-card__price">£613</span>
                    <span class="packages-card__price-old">£858</span>
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
                    <span class="packages-card__price">£659</span>
                    <span class="packages-card__price-old">£916</span>
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
                    <span class="packages-card__price">£635</span>
                    <span class="packages-card__price-old">£889</span>
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

      


      <!-- PAYMENT CTA SECTION -->
      <section class="paymentBanner">
        <div class="container">
          <div class="paymentBanner__poster">

            <div class="paymentBanner__content">

              <div class="paymentBanner__eyebrow">
                <span class="paymentBanner__flag">🇺🇸</span>
                AMERICAN FLY | SECURE PAYMENTS
              </div>

              <h2 class="paymentBanner__title">
                Your Journey, Just One Payment Away.
              </h2>

              <p class="paymentBanner__caption">
                Enjoy seamless transactions, zero hidden fees, and dedicated customer support, available 7 days a week — all in one place.
              </p>

              <div class="paymentBanner__bottom">

                <a
                  href="https://payments.americanfly.co.uk"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="paymentBanner__btn"
                >
                  Make a Payment
                  <i class="fa-solid fa-arrow-right"></i>
                </a>

                <div class="paymentBanner__note">
                  <i class="fa-solid fa-shield-halved"></i>
                  Secure & Trusted Payment
                </div>

              </div>

            </div>

            <div class="paymentBanner__accent">
              <i class="fa-solid fa-plane"></i>
            </div>

          </div>
        </div>
      </section>


    </div>
    <!-- FOOTER SECTION -->
    <?php include '_footer.php'; ?>
    <!-- SCRIPTS -->
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
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
      $(document).ready(function () {

        // Initialize Select2
        $(".bs-select2-origin, .bs-select2-destination").select2({
          dropdownAutoWidth: true,
          width: "100%",
        });

        // Today's date
        const today = new Date();

        // Return date = 7 days from today
        const returnDay = new Date();
        returnDay.setDate(today.getDate() + 7);

        // Return Date Picker
        const returnDatePicker = flatpickr("#bsReturnDate", {
          dateFormat: "D, d M Y",
          defaultDate: returnDay,
          minDate: "today",
          disableMobile: true,

          onChange: function (selectedDates) {
            if (selectedDates[0]) {
              // Submit format: YYYY-MM-DD
              document.getElementById("endDate").value =
                flatpickr.formatDate(selectedDates[0], "Y-m-d");
            }
          }
        });

        // Set initial return date
        document.getElementById("endDate").value =
          flatpickr.formatDate(returnDay, "Y-m-d");


        // Start Date Picker
        flatpickr("#bsStartDate", {
          dateFormat: "D, d M Y",
          defaultDate: today,
          minDate: "today",
          disableMobile: true,

          onChange: function (selectedDates) {
            if (selectedDates[0]) {

              // Submit format: YYYY-MM-DD
              document.getElementById("startDate").value =
                flatpickr.formatDate(selectedDates[0], "Y-m-d");

              // Return date cannot be before start date
              returnDatePicker.set("minDate", selectedDates[0]);
            }
          }
        });

        // Set initial start date
        document.getElementById("startDate").value =
          flatpickr.formatDate(today, "Y-m-d");

      });
    </script>
    
  </body>
</html>
