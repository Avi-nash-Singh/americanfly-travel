<!doctype html>
<?php 
  include('_config.php'); 

  // Query airport data
  $sql = "SELECT * FROM airports";
  $sql_from = "SELECT * FROM airports WHERE Country_Code = 'GB'";

  $result = $conn->query($sql_from);
  $result1 = $conn->query($sql);
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Los Angeles (LAX) Flight Deals & California Holidays | American Fly</title>

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
    <link rel="stylesheet" href="css/destination.css" />

  </head>

  <body>
    <!-- (Header + Navbar) -->
    <?php include('_nav.php'); ?>

    <!-- ============================================
         DISTINCT DESTINATION HERO & SEARCH ISLAND
         ============================================ -->
    <section class="dest-hero">
      <img
        src="assets/cards/los-angeles.webp"
        alt="Los Angeles Skyline and Palm Trees"
        class="dest-hero__bg"
      />

      <div class="container">
        <div class="text-center max-w-700 mx-auto">
          <h1 class="dest-hero__title pt-2">Los Angeles (LAX)</h1>

          <div class="dest-hero__meta">
            <span class="dest-hero__meta-item">
              <i class="fa-solid fa-plane-departure text-info"></i> Direct from LHR
            </span>
            <span class="dest-hero__meta-item">
              <i class="fa-solid fa-clock text-info"></i> ~11 hrs non-stop
            </span>
            <span class="dest-hero__meta-item">
              <i class="fa-solid fa-shield-halved text-info"></i> 100% ATOL Protected
            </span>
          </div>
        </div>

        <!-- Distinct Floating Island Search (Round Trip Fixed) -->
        <div class="dest-search-island">
          <div class="dest-search-header">
            <div class="dest-trip-badge">
              <i class="fa-solid fa-arrow-right-arrow-left"></i>
              <span>Round Trip Flight Deals</span>
            </div>
            <span class="text-muted small d-none d-md-inline">
              <i class="fa-solid fa-bolt text-warning me-1"></i> Special California return fares locked for 2026/2027
            </span>
          </div>

          <form action="flight-search.php" method="get">
            <div class="row g-2 align-items-center">
              <!-- Origin -->
              <div class="col-12 col-md-6 col-lg-3">
                <div class="dest-input-box">
                  <span class="dest-input-box__label">
                    <i class="fa-solid fa-plane-departure text-primary"></i> Leaving From
                  </span>
                  <select class="bs-select2-origin dest-input-box__input" name="origin" id="originSelect" required>
                    <option value="">Select UK Airport</option>
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

              <!-- Destination Locked to Los Angeles -->
              <div class="col-12 col-md-6 col-lg-3">
                <div class="dest-input-box" style="background: #f1f8fc; border-color: #bae6fd;">
                  <span class="dest-input-box__label" style="color: #0369a1;">
                    <i class="fa-solid fa-location-dot text-info"></i> Flying To (Destination)
                  </span>
                  <input
                    type="text"
                    class="dest-input-box__input text-primary"
                    value="Los Angeles Intl (LAX) - USA"
                    readonly
                  />
                  <input type="hidden" name="destination" value="LAX" />
                </div>
              </div>

              <!-- Departure Date -->
              <div class="col-12 col-md-6 col-lg-2">
                <div class="dest-input-box">
                  <span class="dest-input-box__label">
                    <i class="fa-regular fa-calendar text-primary"></i> Depart
                  </span>
                  <input
                    type="text"
                    id="destStartDate"
                    class="dest-input-box__input"
                    placeholder="Depart date"
                    readonly
                  />
                  <input type="hidden" name="startDate" id="startDate" />
                </div>
              </div>

              <!-- Return Date -->
              <div class="col-12 col-md-6 col-lg-2">
                <div class="dest-input-box">
                  <span class="dest-input-box__label">
                    <i class="fa-regular fa-calendar-check text-primary"></i> Return
                  </span>
                  <input
                    type="text"
                    id="destReturnDate"
                    class="dest-input-box__input"
                    placeholder="Return date"
                    readonly
                  />
                  <input type="hidden" name="endDate" id="endDate" />
                </div>
              </div>

              <!-- Search Button -->
              <div class="col-12 col-lg-2">
                <input type="hidden" name="adult" value="1" />
                <input type="hidden" name="child" value="0" />
                <input type="hidden" name="class" value="1" />
                <button type="submit" class="dest-submit-btn w-100">
                  <i class="fa-solid fa-magnifying-glass"></i>
                  <span>Find Deals</span>
                </button>
              </div>
            </div>

            <!-- Quick Origin Chips -->
            <div class="quick-chips-row">
              <span class="text-muted small fw-bold me-1">Popular UK Origins:</span>
              <a href="javascript:void(0)" class="quick-chip" onclick="setOrigin('LHR')">London Heathrow (LHR)</a>
              <a href="javascript:void(0)" class="quick-chip" onclick="setOrigin('LGW')">London Gatwick (LGW)</a>
              <a href="javascript:void(0)" class="quick-chip" onclick="setOrigin('MAN')">Manchester (MAN)</a>
              <a href="javascript:void(0)" class="quick-chip" onclick="setOrigin('EDI')">Edinburgh (EDI)</a>
            </div>
          </form>
        </div>
      </div>
    </section>

    <!-- ============================================
         QUICK STATS STRIP
         ============================================ -->
    <div class="dest-stats-strip">
      <div class="container">
        <div class="row g-3">
          <div class="col-6 col-lg-3">
            <div class="dest-stat-card">
              <div class="dest-stat-card__icon"><i class="fa-solid fa-plane"></i></div>
              <div>
                <div class="dest-stat-card__val">British Airways, Virgin, United</div>
                <div class="dest-stat-card__lbl">Daily Non-Stop Flights</div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <div class="dest-stat-card">
              <div class="dest-stat-card__icon"><i class="fa-solid fa-sun"></i></div>
              <div>
                <div class="dest-stat-card__val">24°C Mediterranean</div>
                <div class="dest-stat-card__lbl">Year-Round SoCal Sunshine</div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <div class="dest-stat-card">
              <div class="dest-stat-card__icon"><i class="fa-solid fa-money-bill-wave"></i></div>
              <div>
                <div class="dest-stat-card__val">Fares from £299</div>
                <div class="dest-stat-card__lbl">Return Flights Available</div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <div class="dest-stat-card">
              <div class="dest-stat-card__icon"><i class="fa-solid fa-shield-heart"></i></div>
              <div>
                <div class="dest-stat-card__val">ATOL & TTA</div>
                <div class="dest-stat-card__lbl">100% Financial Protection</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ============================================
         LOS ANGELES ATTRACTIONS & HIGHLIGHTS
         ============================================ -->
    <section class="py-5" style="background: #f8fafc;">
      <div class="container py-2">
        <div class="text-center max-w-700 mx-auto mb-5">
          <p class="gallery-section__subtitle">
            <span class="gallery-section__subtitle-icon">
              <img src="/assets/icons/flight.svg" alt="" /> THE CITY OF ANGELS
            </span>
          </p>
          <h2 class="flight-next-section__title">Why Los Angeles Captivates Every Traveler</h2>
          <p class="text-secondary mt-2">
            Sun-drenched Pacific beaches, world-famous movie studios, legendary boulevard glamour, and the gateway to California's Pacific Coast Highway.
          </p>
        </div>

        <div class="row g-4">
          <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
              <img src="assets/cards/la.png" class="card-img-top" alt="Hollywood and Beverly Hills" style="height: 230px; object-fit: cover;">
              <div class="card-body p-4">
                <span class="badge bg-primary text-white mb-2 px-3 py-2 rounded-pill">Hollywood & Glamour</span>
                <h4 class="fw-bold mt-2 text-dark">Hollywood & Beverly Hills</h4>
                <p class="text-muted small">
                  Walk the Walk of Fame, tour the Hollywood Hills and Sunset Strip, explore luxury boutiques on Rodeo Drive, and capture scenic views from the Griffith Observatory.
                </p>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
              <img src="assets/cards/destination-2.png" class="card-img-top" alt="Santa Monica and Venice Beach" style="height: 230px; object-fit: cover;">
              <div class="card-body p-4">
                <span class="badge bg-info text-white mb-2 px-3 py-2 rounded-pill">Coastal Vibes</span>
                <h4 class="fw-bold mt-2 text-dark">Santa Monica & Venice Beach</h4>
                <p class="text-muted small">
                  Ride the solar-powered Ferris wheel on Santa Monica Pier, cycle along the Pacific Ocean Strand, and experience the bohemian boardwalk charm of Venice Beach.
                </p>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
              <img src="assets/cards/destination-5.png" class="card-img-top" alt="Movie Studios & Theme Parks" style="height: 230px; object-fit: cover;">
              <div class="card-body p-4">
                <span class="badge bg-dark text-white mb-2 px-3 py-2 rounded-pill">Studio Magic</span>
                <h4 class="fw-bold mt-2 text-dark">Universal Studios & Warner Bros.</h4>
                <p class="text-muted small">
                  Go behind the scenes of legendary movie sets, experience the World-Famous Studio Tour, and immerse yourself in the Wizarding World and Super Nintendo World.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================
         LOS ANGELES PACKAGES
         ============================================ -->
    <section class="packages-area">
      <div class="container my-3">
        <div class="packages-area__header">
          <p class="packages-area__subtitle">
            <span class="packages-area__subtitle-icon">
              <img src="/assets/icons/flight.svg" alt="" /> PACKAGES
            </span>
          </p>
          <h2 class="packages-area__title">Curated Los Angeles Holiday Packages</h2>
        </div>

        <div class="packages-area__cards">
          <!-- Card 1 -->
          <div class="packages-card">
            <div class="packages-card__image-wrapper">
              <img src="assets/cards/destination-2.png" alt="Los Angeles City Escape" class="packages-card__image" />
              <span class="packages-card__badge">36% OFF</span>
            </div>
            <div class="packages-card__body">
              <div class="packages-card__tags">
                <span class="packages-card__tag">5 Nights</span>
                <span class="packages-card__tag packages-card__tag--flight">Flights + Hotel</span>
              </div>
              <div class="packages-card__route">
                <span class="packages-card__city">London (LHR)</span>
                <span class="packages-card__route-icon"><img src="assets/icons/returnArrow.svg" alt="Return" /></span>
                <span class="packages-card__city">Los Angeles (LAX)</span>
              </div>
              <h3 class="packages-card__name">Santa Monica Oceanfront Getaway</h3>
              <div class="packages-card__location">
                <span class="packages-card__location-icon"><i class="fa-solid fa-location-dot"></i></span>
                <span class="packages-card__location-text">Santa Monica, California</span>
              </div>
              <div class="packages-card__footer">
                <div class="packages-card__price-block">
                  <span class="packages-card__price-label">from</span>
                  <span class="packages-card__price">£579</span>
                  <span class="packages-card__price-old">£899</span>
                  <span class="packages-card__price-per">/Per person</span>
                </div>
              </div>
              <a href="tel:02031375177" class="packages-card__btn">
                Call to Book
                <span class="packages-card__btn-arrow"><i class="fa-solid fa-arrow-right"></i></span>
              </a>
            </div>
          </div>

          <!-- Card 2 -->
          <div class="packages-card">
            <div class="packages-card__image-wrapper">
              <img src="assets/cards/la.png" alt="Hollywood Stars & Studio Package" class="packages-card__image" />
              <span class="packages-card__badge">Top Seller</span>
            </div>
            <div class="packages-card__body">
              <div class="packages-card__tags">
                <span class="packages-card__tag">7 Nights</span>
                <span class="packages-card__tag packages-card__tag--flight">Direct Flights</span>
              </div>
              <div class="packages-card__route">
                <span class="packages-card__city">London (LHR)</span>
                <span class="packages-card__route-icon"><img src="assets/icons/returnArrow.svg" alt="Return" /></span>
                <span class="packages-card__city">Los Angeles (LAX)</span>
              </div>
              <h3 class="packages-card__name">Hollywood Boulevard & Studio Experience</h3>
              <div class="packages-card__location">
                <span class="packages-card__location-icon"><i class="fa-solid fa-location-dot"></i></span>
                <span class="packages-card__location-text">Hollywood, Los Angeles</span>
              </div>
              <div class="packages-card__footer">
                <div class="packages-card__price-block">
                  <span class="packages-card__price-label">from</span>
                  <span class="packages-card__price">£649</span>
                  <span class="packages-card__price-old">£980</span>
                  <span class="packages-card__price-per">/Per person</span>
                </div>
              </div>
              <a href="tel:02031375177" class="packages-card__btn">
                Call to Book
                <span class="packages-card__btn-arrow"><i class="fa-solid fa-arrow-right"></i></span>
              </a>
            </div>
          </div>

          <!-- Card 3 -->
          <div class="packages-card">
            <div class="packages-card__image-wrapper">
              <img src="assets/cards/lv-card.png" alt="LA & Vegas Golden West" class="packages-card__image" />
              <span class="packages-card__badge">Twin Centre</span>
            </div>
            <div class="packages-card__body">
              <div class="packages-card__tags">
                <span class="packages-card__tag">10 Nights</span>
                <span class="packages-card__tag packages-card__tag--flight">Multi-City + Car</span>
              </div>
              <div class="packages-card__route">
                <span class="packages-card__city">London</span>
                <span class="packages-card__route-icon"><img src="assets/icons/returnArrow.svg" alt="Return" /></span>
                <span class="packages-card__city">Los Angeles & Las Vegas</span>
              </div>
              <h3 class="packages-card__name">California Coast & Las Vegas Strip</h3>
              <div class="packages-card__location">
                <span class="packages-card__location-icon"><i class="fa-solid fa-location-dot"></i></span>
                <span class="packages-card__location-text">LA & Nevada Dual Stay</span>
              </div>
              <div class="packages-card__footer">
                <div class="packages-card__price-block">
                  <span class="packages-card__price-label">from</span>
                  <span class="packages-card__price">£729</span>
                  <span class="packages-card__price-old">£1,099</span>
                  <span class="packages-card__price-per">/Per person</span>
                </div>
              </div>
              <a href="tel:02031375177" class="packages-card__btn">
                Call to Book
                <span class="packages-card__btn-arrow"><i class="fa-solid fa-arrow-right"></i></span>
              </a>
            </div>
          </div>

          <!-- Card 4 -->
          <div class="packages-card">
            <div class="packages-card__image-wrapper">
              <img src="assets/cards/destination-5.png" alt="Pacific Coast Highway Fly-Drive" class="packages-card__image" />
              <span class="packages-card__badge">Fly-Drive</span>
            </div>
            <div class="packages-card__body">
              <div class="packages-card__tags">
                <span class="packages-card__tag">12 Nights</span>
                <span class="packages-card__tag packages-card__tag--flight">Flights + SUV</span>
              </div>
              <div class="packages-card__route">
                <span class="packages-card__city">Manchester (MAN)</span>
                <span class="packages-card__route-icon"><img src="assets/icons/returnArrow.svg" alt="Return" /></span>
                <span class="packages-card__city">LA & San Francisco</span>
              </div>
              <h3 class="packages-card__name">Pacific Coast Highway Coastal Drive</h3>
              <div class="packages-card__location">
                <span class="packages-card__location-icon"><i class="fa-solid fa-location-dot"></i></span>
                <span class="packages-card__location-text">LA to San Francisco</span>
              </div>
              <div class="packages-card__footer">
                <div class="packages-card__price-block">
                  <span class="packages-card__price-label">from</span>
                  <span class="packages-card__price">£819</span>
                  <span class="packages-card__price-old">£1,240</span>
                  <span class="packages-card__price-per">/Per person</span>
                </div>
              </div>
              <a href="tel:02031375177" class="packages-card__btn">
                Call to Book
                <span class="packages-card__btn-arrow"><i class="fa-solid fa-arrow-right"></i></span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

        <!-- ============================================
     2-COLUMN DESTINATION INQUIRY SECTION
     ============================================ -->
    <section class="dest-split-inquiry">
      <div class="container">
        <div class="dest-inquiry-box">
          <div class="row g-0 align-items-stretch">
            
            <!-- LEFT: Destination Info & Benefits -->
            <div class="col-12 col-lg-7">
              <div class="dest-inquiry-left">
                <span class="dest-inquiry-left__badge">
                  <i class="fa-solid fa-headset"></i> Dedicated Route Specialists
                </span>
                <h2 class="dest-inquiry-left__title">
                  Looking for Bespoke Flight & Resort Packages?
                </h2>
                <p class="dest-inquiry-left__desc">
                  Whether you are planning family theme park holidays, private luxury villas with pools, or multi-city fly-drive itineraries, our specialists negotiate direct consolidator contracts not searchable on public web portals.
                </p>

                <div class="dest-inquiry-features">
                  <div class="dest-inquiry-feature-item">
                    <div class="dest-inquiry-feature-icon">
                      <i class="fa-solid fa-tags"></i>
                    </div>
                    <div class="dest-inquiry-feature-text">
                      <h6>Unpublished Flight Rates</h6>
                      <p>Save up to 30% on combined transatlantic flight, hotel, and car rental packages.</p>
                    </div>
                  </div>

                  <div class="dest-inquiry-feature-item">
                    <div class="dest-inquiry-feature-icon">
                      <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div class="dest-inquiry-feature-text">
                      <h6>100% ATOL & TTA Protected</h6>
                      <p>Every booking comes with comprehensive financial security and flexible date options.</p>
                    </div>
                  </div>

                  <div class="dest-inquiry-feature-item">
                    <div class="dest-inquiry-feature-icon">
                      <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div class="dest-inquiry-feature-text">
                      <h6>Personalized Daily Itineraries</h6>
                      <p>Park-hopper passes, Orlando villa clusters, and car hires arranged seamlessly.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- RIGHT: Compact Vertical Form -->
            <div class="col-12 col-lg-5">
              <div class="dest-inquiry-right">
                <div class="dest-inquiry-form-header">
                  <h3 class="dest-inquiry-form-title">Request an Instant Quote</h3>
                  <p class="dest-inquiry-form-subtitle">Receive custom dates and prices within minutes</p>
                </div>

                <form action="process.php" method="POST">
                  <!-- Hidden contextual fields -->
                  <input type="hidden" name="destination_code" value="MCO" />
                  <input type="hidden" name="form_type" value="destination_inquiry" />

                  <!-- Full Name -->
                  <div class="dest-form-field">
                    <label class="dest-form-label" for="inqName">Full Name *</label>
                    <div class="dest-form-input-wrap">
                      <i class="fa-solid fa-user dest-form-icon"></i>
                      <input
                        type="text"
                        id="inqName"
                        name="name"
                        class="dest-form-input"
                        placeholder="e.g. John Smith"
                        required
                      />
                    </div>
                  </div>

                  <!-- Contact Number -->
                  <div class="dest-form-field">
                    <label class="dest-form-label" for="inqPhone">Contact Number *</label>
                    <div class="dest-form-input-wrap">
                      <i class="fa-solid fa-phone dest-form-icon"></i>
                      <input
                        type="tel"
                        id="inqPhone"
                        name="phone"
                        class="dest-form-input"
                        placeholder="e.g. 07123 456789"
                        required
                      />
                    </div>
                  </div>

                  <!-- Email Address -->
                  <div class="dest-form-field">
                    <label class="dest-form-label" for="inqEmail">Email Address *</label>
                    <div class="dest-form-input-wrap">
                      <i class="fa-solid fa-envelope dest-form-icon"></i>
                      <input
                        type="email"
                        id="inqEmail"
                        name="email"
                        class="dest-form-input"
                        placeholder="e.g. john@example.com"
                        required
                      />
                    </div>
                  </div>

                  <!-- Mandatory Pre-Checked Checkbox -->
                  <div class="dest-form-consent">
                    <input
                      type="checkbox"
                      id="inqConsent"
                      name="contact_consent"
                      checked
                      required
                    />
                    <label for="inqConsent">
                      I agree to be contacted by an American Fly specialist via phone, email, or WhatsApp regarding this inquiry. *
                    </label>
                  </div>

                  <!-- Submit Button -->
                  <button type="submit" class="dest-form-btn">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>Get Free Quote</span>
                  </button>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- ============================================
         WHEN TO VISIT LOS ANGELES (SEASONALITY GUIDE)
         ============================================ -->
    <section class="py-5 bg-white">
      <div class="container py-2">
        <div class="text-center max-w-700 mx-auto mb-5">
          <h2 class="flight-next-section__title">Best Times to Travel to Los Angeles</h2>
          <p class="text-secondary mt-2">
            Plan your California trip around ocean beach temperatures, outdoor sightseeing, and peak holiday seasons.
          </p>
        </div>

        <div class="row g-4">
          <div class="col-12 col-md-4">
            <div class="season-card">
              <span class="season-tag season-tag--peak">High Season</span>
              <h4 class="fw-bold">June – August (Summer Sun)</h4>
              <p class="text-muted small">
                Peak summer warmth and buzzing beach energy in Santa Monica and Malibu. Expect lively outdoor concert series at the Hollywood Bowl and vibrant coastal boardwalks.
              </p>
              <ul class="list-unstyled small text-secondary mt-3">
                <li><i class="fa-solid fa-check text-primary me-2"></i> Warm beach weather (~28°C)</li>
                <li><i class="fa-solid fa-check text-primary me-2"></i> Peak outdoor festivals & events</li>
              </ul>
            </div>
          </div>

          <div class="col-12 col-md-4">
            <div class="season-card">
              <span class="season-tag season-tag--shoulder">Shoulder Season</span>
              <h4 class="fw-bold">March – May & Sept – Nov</h4>
              <p class="text-muted small">
                The sweetest window for UK travelers. Clear blue skies, crisp coastal breezes, and shorter queues at Universal Studios and Warner Bros. studios.
              </p>
              <ul class="list-unstyled small text-secondary mt-3">
                <li><i class="fa-solid fa-check text-primary me-2"></i> Pleasant sightseeing warmth (~23°C)</li>
                <li><i class="fa-solid fa-check text-primary me-2"></i> Great hotel value in West Hollywood</li>
              </ul>
            </div>
          </div>

          <div class="col-12 col-md-4">
            <div class="season-card">
              <span class="season-tag season-tag--value">Value Season</span>
              <h4 class="fw-bold">December – February</h4>
              <p class="text-muted small">
                The lowest transatlantic airfares and luxury hotel rates of the year. Ideal for dining, museum hopping at The Getty, and mild winter California sun.
              </p>
              <ul class="list-unstyled small text-secondary mt-3">
                <li><i class="fa-solid fa-check text-primary me-2"></i> Lowest return fares from the UK</li>
                <li><i class="fa-solid fa-check text-primary me-2"></i> Mild winter days (~19°C)</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================
         DISTINCT LOWER CTA (LA FLIGHT DESK CONCIERGE)
         ============================================ -->
    <section class="py-5 bg-white">
      <div class="container">
        <div class="dest-concierge-cta">
          <div class="row align-items-center g-4">
            <div class="col-12 col-lg-7">
              <div class="d-flex align-items-center gap-3 mb-3">
                <img
                  src="assets/cards/ny.png"
                  alt="Specialist"
                  class="concierge-agent-avatar"
                />
                <div>
                  <h4 class="m-0 fw-bold text-white">Los Angeles Travel Specialists On Call</h4>
                  <span class="small text-info">Instant quotes & unpublished airline consolidator rates</span>
                </div>
              </div>
              <h2 class="fw-bold text-white mb-2">Can't Find Your Ideal California Dates Online?</h2>
              <p class="text-white-50 m-0" style="font-size: 0.95rem; line-height: 1.6;">
                Airlines often hold back their most competitive West Coast inventory from public search engines. Speak directly with our California route specialists to unlock bespoke flight-and-hotel quotes.
              </p>
            </div>

            <div class="col-12 col-lg-5 text-lg-end">
              <div class="d-flex flex-column flex-sm-row justify-content-lg-end gap-3">
                <a href="tel:02031375177" class="dest-cta-btn-call">
                  <i class="fa-solid fa-phone"></i>
                  <span>0203 137 5177</span>
                </a>
                <a href="https://wa.me/447446512247" target="_blank" class="dest-cta-btn-whatsapp">
                  <i class="fa-brands fa-whatsapp fs-5"></i>
                  <span>WhatsApp Quote</span>
                </a>
              </div>
              <div class="mt-3 text-white-50 small">
                <i class="fa-solid fa-clock me-1 text-info"></i> Average response time under 3 minutes
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FOOTER SECTION -->
    <?php include '_footer.php'; ?>

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
      integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
      // Function to quick-set origin from chips
      function setOrigin(code) {
        $("#originSelect").val(code).trigger("change");
      }

      $(document).ready(function () {
        // Initialize Select2 for Origin
        $(".bs-select2-origin").select2({
          dropdownAutoWidth: true,
          width: "100%",
        });

        // Date Picker Config (Strictly Round Trip)
        const today = new Date();
        const returnDay = new Date();
        returnDay.setDate(today.getDate() + 7);

        const returnDatePicker = flatpickr("#destReturnDate", {
          dateFormat: "D, d M Y",
          defaultDate: returnDay,
          minDate: "today",
          disableMobile: true,
          onChange: function (selectedDates) {
            if (selectedDates[0]) {
              document.getElementById("endDate").value =
                flatpickr.formatDate(selectedDates[0], "Y-m-d");
            }
          }
        });

        document.getElementById("endDate").value =
          flatpickr.formatDate(returnDay, "Y-m-d");

        flatpickr("#destStartDate", {
          dateFormat: "D, d M Y",
          defaultDate: today,
          minDate: "today",
          disableMobile: true,
          onChange: function (selectedDates) {
            if (selectedDates[0]) {
              document.getElementById("startDate").value =
                flatpickr.formatDate(selectedDates[0], "Y-m-d");
              returnDatePicker.set("minDate", selectedDates[0]);
            }
          }
        });

        document.getElementById("startDate").value =
          flatpickr.formatDate(today, "Y-m-d");
      });
    </script>
  </body>
</html>