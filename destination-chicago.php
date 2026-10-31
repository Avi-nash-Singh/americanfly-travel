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
    <title>Chicago (ORD) Flight Deals & Vacation Packages | American Fly</title>

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
        src="assets/destinations/chicago/chicago-banner.png"
        alt="Chicago Illinois Skyline"
        class="dest-hero__bg"
      />

      <div class="container">
        <div class="text-center max-w-700 mx-auto">
          <!-- <span class="dest-badge-pill">
            <i class="fa-solid fa-city"></i> The Windy City
          </span> -->
          <h1 class="dest-hero__title pt-2">Chicago (ORD)</h1>
          
          <div class="dest-hero__meta">
            <span class="dest-hero__meta-item">
              <i class="fa-solid fa-plane-departure text-info"></i> Direct from LHR & MAN
            </span>
            <span class="dest-hero__meta-item">
              <i class="fa-solid fa-clock text-info"></i> ~8 hrs 45 mins non-stop
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
              <i class="fa-solid fa-bolt text-warning me-1"></i> Special return rates locked for 2026/2027
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

              <!-- Destination Locked to Chicago O'Hare -->
              <div class="col-12 col-md-6 col-lg-3">
                <div class="dest-input-box" style="background: #f1f8fc; border-color: #bae6fd;">
                  <span class="dest-input-box__label" style="color: #0369a1;">
                    <i class="fa-solid fa-location-dot text-info"></i> Flying To (Destination)
                  </span>
                  <input
                    type="text"
                    class="dest-input-box__input text-primary"
                    value="Chicago O'Hare (ORD) - USA"
                    readonly
                  />
                  <input type="hidden" name="destination" value="ORD" />
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
                <div class="dest-stat-card__val">British Airways, United, American</div>
                <div class="dest-stat-card__lbl">Primary Direct Carriers</div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <div class="dest-stat-card">
              <div class="dest-stat-card__icon"><i class="fa-solid fa-cloud-sun"></i></div>
              <div>
                <div class="dest-stat-card__val">20°C Average</div>
                <div class="dest-stat-card__lbl">Lakefront Continental</div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <div class="dest-stat-card">
              <div class="dest-stat-card__icon"><i class="fa-solid fa-money-bill-wave"></i></div>
              <div>
                <div class="dest-stat-card__val">Fares from £339</div>
                <div class="dest-stat-card__lbl">Return Flights Available</div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <div class="dest-stat-card">
              <div class="dest-stat-card__icon"><i class="fa-solid fa-shield-heart"></i></div>
              <div>
                <div class="dest-stat-card__val">ATOL & TTA</div>
                <div class="dest-stat-card__lbl">100% Booking Protection</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>    

    <!-- ============================================
         CHICAGO ATTRACTIONS & HIGHLIGHTS
         ============================================ -->
    <section class="py-5" style="background: #f8fafc;">
      <div class="container py-2">
        <div class="text-center max-w-700 mx-auto mb-5">
          <p class="gallery-section__subtitle">
            <span class="gallery-section__subtitle-icon">
              <img src="/assets/icons/flight.svg" alt="" /> EXPERIENCE THE MIDWEST JEWEL
            </span>
          </p>
          <h2 class="flight-next-section__title">Why Chicago is the Ultimate Skyline City Break</h2>
          <p class="text-secondary mt-2">
            Renowned worldwide for pioneering modern skyscraper architecture, lively riverwalks, deep-dish culinary traditions, and vibrant blues clubs.
          </p>
        </div>

        <div class="row g-4">
          <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
              <img src="assets/destinations/chicago/chicago-1.png" class="card-img-top" alt="Chicago Architecture River Cruise" style="height: 230px; object-fit: cover;">
              <div class="card-body p-4">
                <span class="badge bg-primary text-white mb-2 px-3 py-2 rounded-pill">Architecture & Tours</span>
                <h4 class="fw-bold mt-2 text-dark">River Architecture Cruises</h4>
                <p class="text-muted small">
                  Sail down the Chicago River on world-famous docent-led architecture boat tours, gazing up at the Willis Tower, Tribune Tower, and Wrigley Building.
                </p>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
              <img src="assets/destinations/chicago/chicago-2.png" class="card-img-top" alt="Millennium Park and Downtown" style="height: 230px; object-fit: cover;">
              <div class="card-body p-4">
                <span class="badge bg-info text-white mb-2 px-3 py-2 rounded-pill">Parks & Landmarks</span>
                <h4 class="fw-bold mt-2 text-dark">Millennium Park & "The Bean"</h4>
                <p class="text-muted small">
                  Marvel at Cloud Gate (The Bean), enjoy concerts at the Jay Pritzker Pavilion, and walk across to the internationally acclaimed Art Institute of Chicago.
                </p>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
              <img src="assets/destinations/chicago/chicago-3.png" class="card-img-top" alt="Magnificent Mile and Lakefront" style="height: 230px; object-fit: cover;">
              <div class="card-body p-4">
                <span class="badge bg-dark text-white mb-2 px-3 py-2 rounded-pill">Shopping & Lakefront</span>
                <h4 class="fw-bold mt-2 text-dark">The Magnificent Mile & Navy Pier</h4>
                <p class="text-muted small">
                  Indulge in premier shopping along Michigan Avenue, ride the Centennial Wheel on Navy Pier, and explore sandy beaches lining Lake Michigan.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================
         CHICAGO PACKAGES
         ============================================ -->
    <section class="packages-area">
      <div class="container my-3">
        <div class="packages-area__header">
          <p class="packages-area__subtitle">
            <span class="packages-area__subtitle-icon">
              <img src="/assets/icons/flight.svg" alt="" /> PACKAGES
            </span>
          </p>
          <h2 class="packages-area__title">Curated Chicago Holiday Packages</h2>
        </div>

        <div class="packages-area__cards">
          <!-- Card 1 -->
          <div class="packages-card">
            <div class="packages-card__image-wrapper">
              <img src="assets/destinations/chicago/chicago-h1.png" alt="Package" class="packages-card__image" />
              <span class="packages-card__badge">36% OFF</span>
            </div>
            <div class="packages-card__body">
              <div class="packages-card__tags">
                <span class="packages-card__tag">4 Nights</span>
                <span class="packages-card__tag packages-card__tag--flight">Flights + Hotel</span>
              </div>
              <div class="packages-card__route">
                <span class="packages-card__city">London (LHR)</span>
                <span class="packages-card__route-icon"><img src="assets/icons/returnArrow.svg" alt="Return" /></span>
                <span class="packages-card__city">Chicago (ORD)</span>
              </div>
              <h3 class="packages-card__name">The Drake Hotel Magnificent Mile</h3>
              <div class="packages-card__location">
                <span class="packages-card__location-icon"><i class="fa-solid fa-location-dot"></i></span>
                <span class="packages-card__location-text">Gold Coast / Mag Mile</span>
              </div>
              <div class="packages-card__footer">
                <div class="packages-card__price-block">
                  <span class="packages-card__price-label">from</span>
                  <span class="packages-card__price">£569</span>
                  <span class="packages-card__price-old">£889</span>
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
              <img src="assets/destinations/chicago/chicago-h2.png" alt="Package" class="packages-card__image" />
              <span class="packages-card__badge">Hot Deal</span>
            </div>
            <div class="packages-card__body">
              <div class="packages-card__tags">
                <span class="packages-card__tag">7 Nights</span>
                <span class="packages-card__tag packages-card__tag--flight">Flights + Car</span>
              </div>
              <div class="packages-card__route">
                <span class="packages-card__city">Manchester (MAN)</span>
                <span class="packages-card__route-icon"><img src="assets/icons/returnArrow.svg" alt="Return" /></span>
                <span class="packages-card__city">Chicago (ORD)</span>
              </div>
              <h3 class="packages-card__name">Great Lakes & Route 66 Fly-Drive</h3>
              <div class="packages-card__location">
                <span class="packages-card__location-icon"><i class="fa-solid fa-location-dot"></i></span>
                <span class="packages-card__location-text">Chicago & Lake Michigan Coast</span>
              </div>
              <div class="packages-card__footer">
                <div class="packages-card__price-block">
                  <span class="packages-card__price-label">from</span>
                  <span class="packages-card__price">£699</span>
                  <span class="packages-card__price-old">£999</span>
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
              <img src="assets/destinations/chicago/chicago-h3.png" alt="Package" class="packages-card__image" />
              <span class="packages-card__badge">Twin Centre</span>
            </div>
            <div class="packages-card__body">
              <div class="packages-card__tags">
                <span class="packages-card__tag">9 Nights</span>
                <span class="packages-card__tag packages-card__tag--flight">Multi-City</span>
              </div>
              <div class="packages-card__route">
                <span class="packages-card__city">London</span>
                <span class="packages-card__route-icon"><img src="assets/icons/returnArrow.svg" alt="Return" /></span>
                <span class="packages-card__city">Chicago & New York</span>
              </div>
              <h3 class="packages-card__name">Icons of the Midwest & Manhattan</h3>
              <div class="packages-card__location">
                <span class="packages-card__location-icon"><i class="fa-solid fa-location-dot"></i></span>
                <span class="packages-card__location-text">Chicago & NYC Skyline Combo</span>
              </div>
              <div class="packages-card__footer">
                <div class="packages-card__price-block">
                  <span class="packages-card__price-label">from</span>
                  <span class="packages-card__price">£769</span>
                  <span class="packages-card__price-old">£1,149</span>
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
              <img src="assets/destinations/chicago/chicago-h4.png" alt="Package" class="packages-card__image" />
              <span class="packages-card__badge">Riverfront</span>
            </div>
            <div class="packages-card__body">
              <div class="packages-card__tags">
                <span class="packages-card__tag">5 Nights</span>
                <span class="packages-card__tag packages-card__tag--flight">Direct Flights</span>
              </div>
              <div class="packages-card__route">
                <span class="packages-card__city">London (LHR)</span>
                <span class="packages-card__route-icon"><img src="assets/icons/returnArrow.svg" alt="Return" /></span>
                <span class="packages-card__city">Chicago (ORD)</span>
              </div>
              <h3 class="packages-card__name">LondonHouse Chicago, Curio Collection</h3>
              <div class="packages-card__location">
                <span class="packages-card__location-icon"><i class="fa-solid fa-location-dot"></i></span>
                <span class="packages-card__location-text">Downtown Riverwalk & The Loop</span>
              </div>
              <div class="packages-card__footer">
                <div class="packages-card__price-block">
                  <span class="packages-card__price-label">from</span>
                  <span class="packages-card__price">£639</span>
                  <span class="packages-card__price-old">£929</span>
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
                  Looking for Bespoke Chicago & Midwest Packages?
                </h2>
                <p class="dest-inquiry-left__desc">
                  Whether you are planning iconic architecture weekend breaks, Route 66 road trip kickoffs, or multi-city Midwest fly-drive tours, our specialists negotiate direct consolidator contracts not searchable on public web portals.
                </p>

                <div class="dest-inquiry-features">
                  <div class="dest-inquiry-feature-item">
                    <div class="dest-inquiry-feature-icon">
                      <i class="fa-solid fa-tags"></i>
                    </div>
                    <div class="dest-inquiry-feature-text">
                      <h6>Unpublished Flight Rates</h6>
                      <p>Save up to 30% on combined transatlantic flight, loop hotel, and car rental packages.</p>
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
                      <p>Chicago Architecture Center passes, Skydeck ledges, jazz club tables, and river cruises arranged seamlessly.</p>
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

                <?php
                    $form_name = 'Destination Inquiry';
                    include('_inquiry-form.php');
                ?>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- ============================================
         WHEN TO VISIT CHICAGO (SEASONALITY GUIDE)
         ============================================ -->
    <section class="py-5 bg-white">
      <div class="container py-2">
        <div class="text-center max-w-700 mx-auto mb-5">
          <h2 class="flight-next-section__title">Best Times to Travel to Chicago</h2>
          <p class="text-secondary mt-2">
            Plan according to crowd levels, seasonal riverwalk events, and open-air lakefront festivals.
          </p>
        </div>

        <div class="row g-4">
          <div class="col-12 col-md-4">
            <div class="season-card">
              <span class="season-tag season-tag--peak">High Season</span>
              <h4 class="fw-bold">Jun – Aug (Summer Vibrance)</h4>
              <p class="text-muted small">
                Chicago comes fully alive with sunny lakefront beaches, outdoor rooftop bars, open-air Millennium Park concerts, and world-class street festivals.
              </p>
              <ul class="list-unstyled small text-secondary mt-3">
                <li><i class="fa-solid fa-check text-primary me-2"></i> Warmest weather (~26°C–29°C)</li>
                <li><i class="fa-solid fa-check text-primary me-2"></i> Daily lake cruises & lively Riverwalk</li>
              </ul>
            </div>
          </div>

          <div class="col-12 col-md-4">
            <div class="season-card">
              <span class="season-tag season-tag--shoulder">Shoulder Season</span>
              <h4 class="fw-bold">Apr – May & Sep – Oct</h4>
              <p class="text-muted small">
                The preferred window for UK travelers. Crisp, clear autumn days with crisp lake breezes, manageable museum queues, and striking fall foliage.
              </p>
              <ul class="list-unstyled small text-secondary mt-3">
                <li><i class="fa-solid fa-check text-primary me-2"></i> Comfortable sightseeing temperatures (~18°C)</li>
                <li><i class="fa-solid fa-check text-primary me-2"></i> Great hotel & flight package rates</li>
              </ul>
            </div>
          </div>

          <div class="col-12 col-md-4">
            <div class="season-card">
              <span class="season-tag season-tag--value">Value Season</span>
              <h4 class="fw-bold">Nov – Mar (Winter Charm)</h4>
              <p class="text-muted small">
                Experience Christkindlmarket holiday markets and ice skating below Millennium Park's skyline, alongside the absolute lowest transatlantic airfares.
              </p>
              <ul class="list-unstyled small text-secondary mt-3">
                <li><i class="fa-solid fa-check text-primary me-2"></i> Unbeatable flight & 5-star hotel deals</li>
                <li><i class="fa-solid fa-check text-primary me-2"></i> Festive winter skyline displays</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================
         DISTINCT LOWER CTA (CHICAGO CONCIERGE)
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
                  <h4 class="m-0 fw-bold text-white">Chicago Travel Specialists On Call</h4>
                  <span class="small text-info">Instant quotes & unpublished airline consolidator rates</span>
                </div>
              </div>
              <h2 class="fw-bold text-white mb-2">Can't Find Your Ideal Dates Online?</h2>
              <p class="text-white-50 m-0" style="font-size: 0.95rem; line-height: 1.6;">
                Airlines often reserve exclusive Midwest consolidator and package fares away from public search engines. Connect directly with our Chicago route specialists to tailor your flights, riverfront hotels, and architectural passes.
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
    <script>
        document.getElementById('page_url').value = window.location.href;
    </script> 

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