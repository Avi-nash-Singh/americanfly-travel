<!doctype html>
<?php 
  include('_config.php'); 

  // Query airport/city locations
  $sql = "SELECT * FROM airports";
  $sql_from = "SELECT * FROM airports WHERE Country_Code = 'GB'";

  $result = $conn->query($sql_from);
  $result1 = $conn->query($sql);
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Worldwide Car Hire & Rental Deals | American Fly</title>

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

    <style>
      /* ========================================================
         INFINITE LOGO TICKER / CAROUSEL
         ======================================================== */
      .brand-strip {
        background: #ffffff;
        border-top: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
        padding: 24px 0;
        overflow: hidden;
      }
      .logo-ticker-container {
        position: relative;
        width: 100%;
        overflow: hidden;
        mask-image: linear-gradient(to right, transparent 0%, black 8%, black 92%, transparent 100%);
        -webkit-mask-image: linear-gradient(to right, transparent 0%, black 8%, black 92%, transparent 100%);
      }
      .logo-ticker-track {
        display: flex;
        width: max-content;
        animation: scrollLogos 24s linear infinite;
      }
      .logo-ticker-track:hover {
        animation-play-state: paused;
      }
      .brand-logo-item {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 8px 18px;
        margin: 0 12px;
        height: 60px;
        min-width: 130px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
      }
      .brand-logo-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
      }
      .brand-logo-item img {
        max-height: 38px;
        max-width: 110px;
        width: auto;
        height: auto;
        object-fit: contain;
      }
      @keyframes scrollLogos {
        0% {
          transform: translateX(0);
        }
        100% {
          transform: translateX(-50%);
        }
      }

      /* ========================================================
         CAR CATEGORY CARDS (EDGE-TO-EDGE UPPER IMAGE BOX)
         ======================================================== */
      .car-category-card {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
      }
      .car-category-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 32px rgba(15, 23, 42, 0.12);
      }
      .car-image-container {
        position: relative;
        width: 100%;
        height: 230px;
        background-color: #f1f5f9;
        overflow: hidden;
      }
      .car-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
        transition: transform 0.4s ease;
      }
      .car-category-card:hover .car-image-container img {
        transform: scale(1.05);
      }
      .car-type-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        border-radius: 50px;
        padding: 6px 14px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        z-index: 2;
      }
      .car-body-content {
        padding: 22px 24px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
      }
      .car-spec-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin: 16px 0 20px;
        background: #f8fafc;
        padding: 12px 14px;
        border-radius: 12px;
        border: 1px solid #f1f5f9;
      }
      .car-spec-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.83rem;
        color: #475569;
        font-weight: 500;
      }
      .car-spec-item i {
        color: #0284c7;
        font-size: 0.95rem;
      }
      .car-perks-list {
        list-style: none;
        padding: 0;
        margin: 0 0 22px;
        font-size: 0.82rem;
        color: #64748b;
      }
      .car-perks-list li {
        margin-bottom: 6px;
        display: flex;
        align-items: center;
      }
      .car-perks-list li i {
        color: #10b981;
        margin-right: 8px;
        font-size: 0.75rem;
      }
      .car-booking-btn {
        margin-top: auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #0284c7;
        color: #ffffff;
        font-weight: 600;
        font-size: 0.94rem;
        padding: 12px 20px;
        border-radius: 12px;
        text-decoration: none;
        transition: background-color 0.2s ease, transform 0.15s ease;
        border: none;
      }
      .car-booking-btn:hover {
        background: #0369a1;
        color: #ffffff;
        transform: translateY(-2px);
      }
    </style>
  </head>

  <body>
    <!-- (Header + Navbar) -->
    <?php include('_nav.php'); ?>

    <!-- ============================================
         DISTINCT CAR HIRE HERO & SEARCH ISLAND
         ============================================ -->
    <section class="about-banner">
      <!-- Banner Background Image -->
      <img
        src="assets/banner/carhire.png"
        alt="About Us Banner"
        class="about-banner__bg-image"
      />
      <!-- Banner Overlay -->
      <div class="about-banner__overlay"></div>

      <!-- Banner Content -->
      <div class="about-banner__content">
        <h1 class="about-banner__title">Car Hire</h1>
        <nav class="about-banner__breadcrumb">
          <a href="index.php" class="about-banner__breadcrumb-link">Home</a>
          <span class="about-banner__breadcrumb-separator">›</span>
          <span class="about-banner__breadcrumb-current">Car Hire</span>
        </nav>
      </div>
    </section>

    <!-- ============================================
         TRUSTED RENTAL PARTNERS (INFINITE SCROLLING TICKER)
         ============================================ -->
    <div class="brand-strip">
      <div class="container-fluid px-0">
        <div class="text-center mb-3">
          <span class="text-uppercase fw-bold text-muted small" style="letter-spacing: 1px;">
            Trusted Global Car Rental Suppliers
          </span>
        </div>

        <div class="logo-ticker-container">
          <div class="logo-ticker-track">
            <!-- Set 1 (Original logos)[cite: 1] -->
            <div class="brand-logo-item">
              <img src="assets/car-hire/slider/rental1.png" alt="Alamo Rent A Car" />
            </div>
            <div class="brand-logo-item">
              <img src="assets/car-hire/slider/rental2.png" alt="National Car Rental" />
            </div>
            <div class="brand-logo-item">
              <img src="assets/car-hire/slider/rental3.png" alt="Avis Car Rental" />
            </div>
            <div class="brand-logo-item">
              <img src="assets/car-hire/slider/rental4.png" alt="Enterprise Rent-A-Car" />
            </div>
            <div class="brand-logo-item">
              <img src="assets/car-hire/slider/rental5.png" alt="Sixt Rent a Car" />
            </div>
            <div class="brand-logo-item">
              <img src="assets/car-hire/slider/rental6.png" alt="Firefly Car Rental" />
            </div>

            <!-- Set 2 (Duplicate for continuous loop)[cite: 1] -->
            <div class="brand-logo-item">
              <img src="assets/car-hire/slider/rental1.png" alt="Alamo Rent A Car" />
            </div>
            <div class="brand-logo-item">
              <img src="assets/car-hire/slider/rental2.png" alt="National Car Rental" />
            </div>
            <div class="brand-logo-item">
              <img src="assets/car-hire/slider/rental3.png" alt="Avis Car Rental" />
            </div>
            <div class="brand-logo-item">
              <img src="assets/car-hire/slider/rental4.png" alt="Enterprise Rent-A-Car" />
            </div>
            <div class="brand-logo-item">
              <img src="assets/car-hire/slider/rental5.png" alt="Sixt Rent a Car" />
            </div>
            <div class="brand-logo-item">
              <img src="assets/car-hire/slider/rental6.png" alt="Firefly Car Rental" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ============================================
         QUICK STATS / ADVANTAGES STRIP
         ============================================ -->
    <div class="dest-stats-strip">
      <div class="container">
        <div class="row g-3">
          <div class="col-6 col-lg-3">
            <div class="dest-stat-card">
              <div class="dest-stat-card__icon"><i class="fa-solid fa-gas-pump"></i></div>
              <div>
                <div class="dest-stat-card__val">Fair Fuel Policies</div>
                <div class="dest-stat-card__lbl">Full-to-Full Standard</div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <div class="dest-stat-card">
              <div class="dest-stat-card__icon"><i class="fa-solid fa-credit-card"></i></div>
              <div>
                <div class="dest-stat-card__val">Zero Hidden Fees</div>
                <div class="dest-stat-card__lbl">Taxes & Surcharges Included</div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <div class="dest-stat-card">
              <div class="dest-stat-card__icon"><i class="fa-solid fa-headset"></i></div>
              <div>
                <div class="dest-stat-card__val">24/7 Roadside Assist</div>
                <div class="dest-stat-card__lbl">Emergency Support Included</div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <div class="dest-stat-card">
              <div class="dest-stat-card__icon"><i class="fa-solid fa-ban"></i></div>
              <div>
                <div class="dest-stat-card__val">Free Cancellations</div>
                <div class="dest-stat-card__lbl">Up to 48h Before Pick-up</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>    

    <!-- ============================================
         CAR FLEET & VEHICLE CATEGORIES (FULL BOX COVER IMAGE)
         ============================================ -->
    <section class="py-5" style="background: #f8fafc;">
      <div class="container py-2">
        <div class="text-center max-w-700 mx-auto mb-5">
          <p class="gallery-section__subtitle">
            <span class="gallery-section__subtitle-icon">
              <img src="/assets/icons/flight.svg" alt="" /> GLOBAL VEHICLE FLEET
            </span>
          </p>
          <h2 class="flight-next-section__title">Find the Perfect Vehicle for Your Journey</h2>
          <p class="text-secondary mt-2">
            From agile city cars and spacious family SUVs to premium executive sedans and multi-passenger minivans.
          </p>
        </div>

        <div class="row g-4">
          <!-- Car 1: Economy / Compact -->
          <div class="col-12 col-md-6 col-lg-4">
            <div class="car-category-card">
              <div class="car-image-container">
                <span class="car-type-badge bg-primary text-white">Economy</span>
                <img src="assets/car-hire/car1.png" alt="Economy Car Hire" />
              </div>
              <div class="car-body-content">
                <h4 class="fw-bold mb-1 text-dark">Compact & Economy</h4>
                <p class="text-muted small mb-0">e.g. Ford Fiesta, VW Polo, or similar</p>

                <div class="car-spec-grid">
                  <div class="car-spec-item"><i class="fa-solid fa-users"></i> 4-5 Seats</div>
                  <div class="car-spec-item"><i class="fa-solid fa-suitcase"></i> 2 Bags</div>
                  <div class="car-spec-item"><i class="fa-solid fa-gear"></i> Manual / Auto</div>
                  <div class="car-spec-item"><i class="fa-solid fa-snowflake"></i> A/C Climate</div>
                </div>

                <ul class="car-perks-list">
                  <li><i class="fa-solid fa-circle-check"></i> Great fuel efficiency for city trips</li>
                  <li><i class="fa-solid fa-circle-check"></i> Easy street parking & maneuverability</li>
                  <li><i class="fa-solid fa-circle-check"></i> Collision Damage Waiver included</li>
                </ul>

                <a href="https://www.flexibleautos.com/whitelabel/?deeplink=6AD6A40F" target="_blank" class="car-booking-btn">
                  <span>Select Category</span>
                  <i class="fa-solid fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Car 2: Midsize / Intermediate Sedan -->
          <div class="col-12 col-md-6 col-lg-4">
            <div class="car-category-card">
              <div class="car-image-container">
                <span class="car-type-badge bg-info text-white">Popular</span>
                <img src="assets/car-hire/car2.png" alt="Intermediate Sedan" />
              </div>
              <div class="car-body-content">
                <h4 class="fw-bold mb-1 text-dark">Midsize & Intermediate</h4>
                <p class="text-muted small mb-0">e.g. Toyota Corolla, Hyundai Elantra, or similar</p>

                <div class="car-spec-grid">
                  <div class="car-spec-item"><i class="fa-solid fa-users"></i> 5 Seats</div>
                  <div class="car-spec-item"><i class="fa-solid fa-suitcase"></i> 3 Bags</div>
                  <div class="car-spec-item"><i class="fa-solid fa-gear"></i> Automatic</div>
                  <div class="car-spec-item"><i class="fa-solid fa-snowflake"></i> Dual-Zone A/C</div>
                </div>

                <ul class="car-perks-list">
                  <li><i class="fa-solid fa-circle-check"></i> Comfortable highway cruising comfort</li>
                  <li><i class="fa-solid fa-circle-check"></i> Apple CarPlay & Android Auto standard</li>
                  <li><i class="fa-solid fa-circle-check"></i> Generous rear passenger legroom</li>
                </ul>

                <a href="https://www.flexibleautos.com/whitelabel/?deeplink=6AD6A40F" target="_blank" class="car-booking-btn">
                  <span>Select Category</span>
                  <i class="fa-solid fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Car 3: Full-Size SUV -->
          <div class="col-12 col-md-6 col-lg-4">
            <div class="car-category-card">
              <div class="car-image-container">
                <span class="car-type-badge bg-dark text-white">Family Favorite</span>
                <img src="assets/car-hire/car3.png" alt="Full-Size SUV" />
              </div>
              <div class="car-body-content">
                <h4 class="fw-bold mb-1 text-dark">Standard & Full-Size SUV</h4>
                <p class="text-muted small mb-0">e.g. Ford Explorer, Jeep Grand Cherokee, or similar</p>

                <div class="car-spec-grid">
                  <div class="car-spec-item"><i class="fa-solid fa-users"></i> 5-7 Seats</div>
                  <div class="car-spec-item"><i class="fa-solid fa-suitcase"></i> 4-5 Bags</div>
                  <div class="car-spec-item"><i class="fa-solid fa-gear"></i> Automatic 4x4 / AWD</div>
                  <div class="car-spec-item"><i class="fa-solid fa-snowflake"></i> Climate Control</div>
                </div>

                <ul class="car-perks-list">
                  <li><i class="fa-solid fa-circle-check"></i> Elevated driving position & highway safety</li>
                  <li><i class="fa-solid fa-circle-check"></i> Perfect for national park road trips</li>
                  <li><i class="fa-solid fa-circle-check"></i> Massive luggage trunk capacity</li>
                </ul>

                <a href="https://www.flexibleautos.com/whitelabel/?deeplink=6AD6A40F" target="_blank" class="car-booking-btn">
                  <span>Select Category</span>
                  <i class="fa-solid fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Car 4: Minivan / People Carrier -->
          <div class="col-12 col-md-6 col-lg-4">
            <div class="car-category-card">
              <div class="car-image-container">
                <span class="car-type-badge bg-warning text-dark">Group Travel</span>
                <img src="assets/car-hire/car4.png" alt="Minivan Car Rental" />
              </div>
              <div class="car-body-content">
                <h4 class="fw-bold mb-1 text-dark">Minivan & People Carrier</h4>
                <p class="text-muted small mb-0">e.g. Chrysler Pacifica, Dodge Grand Caravan, or similar</p>

                <div class="car-spec-grid">
                  <div class="car-spec-item"><i class="fa-solid fa-users"></i> 7-8 Seats</div>
                  <div class="car-spec-item"><i class="fa-solid fa-suitcase"></i> 5 Bags</div>
                  <div class="car-spec-item"><i class="fa-solid fa-gear"></i> Automatic</div>
                  <div class="car-spec-item"><i class="fa-solid fa-snowflake"></i> Rear A/C Vents</div>
                </div>

                <ul class="car-perks-list">
                  <li><i class="fa-solid fa-circle-check"></i> Automatic sliding doors for easy access</li>
                  <li><i class="fa-solid fa-circle-check"></i> Fold-flat stow 'n go seat configuration</li>
                  <li><i class="fa-solid fa-circle-check"></i> Ideal for multi-family theme park getaways</li>
                </ul>

                <a href="https://www.flexibleautos.com/whitelabel/?deeplink=6AD6A40F" target="_blank" class="car-booking-btn">
                  <span>Select Category</span>
                  <i class="fa-solid fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Car 5: Premium & Luxury Sedan -->
          <div class="col-12 col-md-6 col-lg-4">
            <div class="car-category-card">
              <div class="car-image-container">
                <span class="car-type-badge bg-secondary text-white">Premium</span>
                <img src="assets/car-hire/car5.png" alt="Luxury Sedan Rental" />
              </div>
              <div class="car-body-content">
                <h4 class="fw-bold mb-1 text-dark">Premium & Executive</h4>
                <p class="text-muted small mb-0">e.g. Mercedes-Benz C-Class, BMW 3/5 Series, or similar</p>

                <div class="car-spec-grid">
                  <div class="car-spec-item"><i class="fa-solid fa-users"></i> 5 Seats</div>
                  <div class="car-spec-item"><i class="fa-solid fa-suitcase"></i> 3 Bags</div>
                  <div class="car-spec-item"><i class="fa-solid fa-gear"></i> Automatic</div>
                  <div class="car-spec-item"><i class="fa-solid fa-snowflake"></i> Premium Climate</div>
                </div>

                <ul class="car-perks-list">
                  <li><i class="fa-solid fa-circle-check"></i> High-grade leather interior & acoustic quiet</li>
                  <li><i class="fa-solid fa-circle-check"></i> Advanced driver assistance & navigation</li>
                  <li><i class="fa-solid fa-circle-check"></i> Prestigious styling for business & comfort</li>
                </ul>

                <a href="https://www.flexibleautos.com/whitelabel/?deeplink=6AD6A40F" target="_blank" class="car-booking-btn">
                  <span>Select Category</span>
                  <i class="fa-solid fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Car 6: Convertible / Open Top -->
          <div class="col-12 col-md-6 col-lg-4">
            <div class="car-category-card">
              <div class="car-image-container">
                <span class="car-type-badge bg-danger text-white">Coastal Drive</span>
                <img src="assets/car-hire/car6.png" alt="Convertible Car Rental" />
              </div>
              <div class="car-body-content">
                <h4 class="fw-bold mb-1 text-dark">Convertible & Sports</h4>
                <p class="text-muted small mb-0">e.g. Ford Mustang Convertible, Chevy Camaro, or similar</p>

                <div class="car-spec-grid">
                  <div class="car-spec-item"><i class="fa-solid fa-users"></i> 4 Seats</div>
                  <div class="car-spec-item"><i class="fa-solid fa-suitcase"></i> 2 Bags</div>
                  <div class="car-spec-item"><i class="fa-solid fa-gear"></i> Automatic</div>
                  <div class="car-spec-item"><i class="fa-solid fa-sun"></i> Power Soft Top</div>
                </div>

                <ul class="car-perks-list">
                  <li><i class="fa-solid fa-circle-check"></i> Unobstructed panoramic sunshine driving</li>
                  <li><i class="fa-solid fa-circle-check"></i> Icon of Pacific Coast Highway & Florida routes</li>
                  <li><i class="fa-solid fa-circle-check"></i> Premium audio sound system equipped</li>
                </ul>

                <a href="https://www.flexibleautos.com/whitelabel/?deeplink=6AD6A40F" target="_blank" class="car-booking-btn">
                  <span>Select Category</span>
                  <i class="fa-solid fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================
         2-COLUMN CUSTOM CAR INQUIRY SECTION
         ============================================ -->
    <section class="dest-split-inquiry">
      <div class="container">
        <div class="dest-inquiry-box">
          <div class="row g-0 align-items-stretch">
            
            <!-- LEFT: Car Hire Specialists & Value Props -->
            <div class="col-12 col-lg-7">
              <div class="dest-inquiry-left">
                <span class="dest-inquiry-left__badge">
                  <i class="fa-solid fa-headset"></i> Dedicated Fly-Drive Desk
                </span>
                <h2 class="dest-inquiry-left__title">
                  Need a Bespoke Car Rental or One-Way Fly-Drive?
                </h2>
                <p class="dest-inquiry-left__desc">
                  Planning cross-country route drops, requiring additional child seats, young driver packages, or combining long-term vehicle hire with transatlantic flights? Our specialists secure consolidator car hire agreements directly.
                </p>

                <div class="dest-inquiry-features">
                  <div class="dest-inquiry-feature-item">
                    <div class="dest-inquiry-feature-icon">
                      <i class="fa-solid fa-tags"></i>
                    </div>
                    <div class="dest-inquiry-feature-text">
                      <h6>Zero Excess Coverage</h6>
                      <p>Avoid expensive airport desk charges with pre-arranged comprehensive damage waiver options.</p>
                    </div>
                  </div>

                  <div class="dest-inquiry-feature-item">
                    <div class="dest-inquiry-feature-icon">
                      <i class="fa-solid fa-arrows-split-up-and-left"></i>
                    </div>
                    <div class="dest-inquiry-feature-text">
                      <h6>Reduced One-Way Drop Fees</h6>
                      <p>Pick up in San Francisco and drop off in Los Angeles or Las Vegas with negotiated minimal drop surcharges.</p>
                    </div>
                  </div>

                  <div class="dest-inquiry-feature-item">
                    <div class="dest-inquiry-feature-icon">
                      <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div class="dest-inquiry-feature-text">
                      <h6>Free Additional Drivers</h6>
                      <p>Many negotiated packages include free second driver allowances for relaxed road-trip sharing.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- RIGHT: Compact Request Form -->
            <div class="col-12 col-lg-5">
              <div class="dest-inquiry-right">
                <div class="dest-inquiry-form-header">
                  <h3 class="dest-inquiry-form-title">Request a Car Hire Quote</h3>
                  <p class="dest-inquiry-form-subtitle">Customized availability & quotes sent directly to you</p>
                </div>

                <?php
                    $form_name = 'Car Hire Inquiry';
                    include('_inquiry-form.php');
                ?>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- ============================================
         CAR HIRE ESSENTIAL TIPS & GUIDELINES
         ============================================ -->
    <section class="py-5 bg-white">
      <div class="container py-2">
        <div class="text-center max-w-700 mx-auto mb-5">
          <h2 class="flight-next-section__title">Helpful International Driving Tips</h2>
          <p class="text-secondary mt-2">
            Important requirements and travel checks before you pick up your rental car abroad.
          </p>
        </div>

        <div class="row g-4">
          <div class="col-12 col-md-4">
            <div class="season-card">
              <span class="season-tag season-tag--peak">Documentation</span>
              <h4 class="fw-bold">License & IDP</h4>
              <p class="text-muted small">
                UK photocard driving licenses are accepted across all major US rental suppliers. Ensure your license has at least 6 months validity from the pickup date.
              </p>
              <ul class="list-unstyled small text-secondary mt-3">
                <li><i class="fa-solid fa-check text-primary me-2"></i> Full valid photocard driving license</li>
                <li><i class="fa-solid fa-check text-primary me-2"></i> Passport identification for main driver</li>
              </ul>
            </div>
          </div>

          <div class="col-12 col-md-4">
            <div class="season-card">
              <span class="season-tag season-tag--shoulder">Security Deposit</span>
              <h4 class="fw-bold">Credit Card Hold</h4>
              <p class="text-muted small">
                Main drivers require a physical credit card issued in their own name for the refundable security deposit bond at the rental collection desk.
              </p>
              <ul class="list-unstyled small text-secondary mt-3">
                <li><i class="fa-solid fa-check text-primary me-2"></i> Visa or MasterCard credit cards accepted</li>
                <li><i class="fa-solid fa-check text-primary me-2"></i> Full release of hold upon return</li>
              </ul>
            </div>
          </div>

          <div class="col-12 col-md-4">
            <div class="season-card">
              <span class="season-tag season-tag--value">Age Policies</span>
              <h4 class="fw-bold">Drivers 21 to 24</h4>
              <p class="text-muted small">
                Most rental companies require drivers to be 21+. Drivers aged 21-24 can book with our tailored young-driver packages to minimise local surcharge fees.
              </p>
              <ul class="list-unstyled small text-secondary mt-3">
                <li><i class="fa-solid fa-check text-primary me-2"></i> Young driver package specials available</li>
                <li><i class="fa-solid fa-check text-primary me-2"></i> Standard minimum age 25 for full waiver</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================
         DISTINCT LOWER CTA (CONCIERGE DESK)
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
                  <h4 class="m-0 fw-bold text-white">Car Rental & Fly-Drive Specialists On Call</h4>
                  <span class="small text-info">Instant quotes & unpublished consolidator inventory</span>
                </div>
              </div>
              <h2 class="fw-bold text-white mb-2">Have Custom Fleet or Cross-Country Requirements?</h2>
              <p class="text-white-50 m-0" style="font-size: 0.95rem; line-height: 1.6;">
                Specialty multi-van convoys, luxury sports models, and flexible one-way drops often require broker intervention. Speak with our flight & car specialists today.
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
  </body>
</html>