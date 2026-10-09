
<?php
include('_config.php');

function esc($value) {
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

/* =========================================================
   GET SELECTED FLIGHT DETAILS
========================================================= */

$flight_id = filter_input(INPUT_GET, 'flight', FILTER_VALIDATE_INT);
$start_date = trim($_GET['up'] ?? '');
$end_date   = trim($_GET['down'] ?? '');

$flight = null;
$airport_from = null;
$airport_to = null;
$airline_name = '';
$airline_logo = 'assets/logo.png';
$error = '';

$class_names = [
    1 => 'Economy',
    2 => 'Business',
    3 => 'First Class',
    4 => 'Premium Economy'
];

if ($flight_id && isset($conn)) {

    $stmt = $conn->prepare(
        "SELECT * FROM flights WHERE id = ? LIMIT 1"
    );

    if ($stmt) {
        $stmt->bind_param("i", $flight_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $flight = $result ? $result->fetch_assoc() : null;

        $stmt->close();
    }

    if ($flight) {

        /* Origin airport */ $stmt = $conn->prepare( "SELECT * FROM airports WHERE Airport_Code = ? LIMIT 1" ); if ($stmt) { $code = $flight['source']; $stmt->bind_param("s", $code); $stmt->execute(); $result = $stmt->get_result(); $airport_from = $result ? $result->fetch_assoc() : null; $stmt->close(); } /* Destination airport */ $stmt = $conn->prepare( "SELECT * FROM airports WHERE Airport_Code = ? LIMIT 1" ); if ($stmt) { $code = $flight['destination']; $stmt->bind_param("s", $code); $stmt->execute(); $result = $stmt->get_result(); $airport_to = $result ? $result->fetch_assoc() : null; $stmt->close(); }

        /* Airline information */
        if (!empty($flight['airline'])) {

            $stmt = $conn->prepare(
                "SELECT * FROM airlines WHERE Airline_Code = ? LIMIT 1"
            );

            if ($stmt) {
                $code = $flight['airline'];
                $stmt->bind_param("s", $code);
                $stmt->execute();

                $result = $stmt->get_result();
                $airline = $result ? $result->fetch_assoc() : null;

                $stmt->close();

                if ($airline) {
                    $airline_name = $airline['Airline_Name'] ?? $code;

                    if (!empty($flight['logo'])) {
                        $airline_logo =
                            'backend/uploads/' . $flight['logo'];
                    }
                }
            }
        }
    }
}

if (!$flight) {
    $error = 'We could not find the selected flight. Please return to the flight search results and choose a flight again.';
}

/* =========================================================
   FORM VALUES AND VALIDATION
========================================================= */

$values = [
    'title' => '',
    'first_name' => '',
    'last_name' => '',
    'email' => '',
    'phone' => '',
    'contact_method' => 'phone',
    'adults' => '1',
    'children' => '0',
    'infants' => '0',
    'message' => ''
];

$errors = [];
$submitted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    foreach ($values as $key => $default) {
        $values[$key] = trim((string)($_POST[$key] ?? $default));
    }

    if (!$flight) {
        $errors[] = 'Please select a valid flight from the results page.';
    }

    if ($values['first_name'] === '') {
        $errors[] = 'Please enter your first name.';
    }

    if ($values['last_name'] === '') {
        $errors[] = 'Please enter your last name.';
    }

    if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if ($values['phone'] === '') {
        $errors[] = 'Please enter your phone number.';
    }

    if (!in_array($values['adults'], array_map('strval', range(1, 9)), true)) {
        $errors[] = 'Please select a valid number of adults.';
    }

    if (!in_array($values['children'], array_map('strval', range(0, 9)), true)) {
        $errors[] = 'Please select a valid number of children.';
    }

    if (!in_array($values['infants'], array_map('strval', range(0, 9)), true)) {
        $errors[] = 'Please select a valid number of infants.';
    }

    if (!$errors) {
        /*
         * Email sending and database storage intentionally
         * have not been connected. Add your own handler here.
         */
        $submitted = true;
    }
}

function enquiryDate($date) {
    $parsed = DateTime::createFromFormat('!Y-m-d', $date);

    return $parsed && $parsed->format('Y-m-d') === $date
        ? $parsed->format('D, d M Y')
        : 'Not specified';
}

$departure_display = enquiryDate($start_date);
$return_display = enquiryDate($end_date);

$class_label = $flight
    ? ($class_names[(int)($flight['class'] ?? 0)] ?? 'Not specified')
    : '';

$stops_label = 'Non-stop';

if ($flight && ($flight['route'] ?? '') !== 'Direct') {
    if (!empty($flight['route3'])) {
        $stops_label = '3 stops';
    } elseif (!empty($flight['route2'])) {
        $stops_label = '2 stops';
    } else {
        $stops_label = '1 stop';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Flight Enquiry | American Fly</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    >

    <link rel="stylesheet" href="css/index.css">

    <style>
        :root {
            --af-navy: #071c33;
            --af-navy-light: #0c4164;
            --af-blue: #0284c7;
            --af-cyan: #06b6d4;
            --af-text: #172033;
            --af-muted: #7a8799;
            --af-border: #e5ebf2;
            --af-bg: #f5f8fc;
        }

        body {
            background: var(--af-bg);
            color: var(--af-text);
            font-family: Arial, Helvetica, sans-serif;
        }

        .enquiry-hero {
            position: relative;
            overflow: hidden;
            padding: 175px 0 35px;
            background: linear-gradient(
                135deg,
                rgba(7, 28, 51, .98),
                rgba(12, 65, 100, .94)
            );
        }

        .enquiry-hero::after {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            top: -190px;
            right: -100px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.13);
            box-shadow:
                0 0 0 35px rgba(255,255,255,.025),
                0 0 0 75px rgba(255,255,255,.02);
        }

        .enquiry-hero-content {
            position: relative;
            z-index: 1;
        }

        .enquiry-eyebrow {
            color: #67e8f9;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .12em;
            margin-bottom: 13px;
        }

        .enquiry-hero h1 {
            color: #fff;
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .enquiry-hero p {
            color: rgba(255,255,255,.74);
            max-width: 650px;
            line-height: 1.7;
            margin: 0;
        }

        .enquiry-breadcrumb {
            margin-top: 20px;
            font-size: 12px;
            color: rgba(255,255,255,.65);
        }

        .enquiry-breadcrumb a {
            color: #fff;
            text-decoration: none;
        }

        .enquiry-main {
            position: relative;
            z-index: 2;
            margin-top: -42px;
            padding-bottom: 65px;
        }

        .enquiry-panel {
            background: #fff;
            border: 1px solid rgba(20,40,65,.06);
            border-radius: 17px;
            box-shadow: 0 12px 35px rgba(20,40,65,.07);
            overflow: hidden;
        }

        .panel-heading {
            padding: 24px 26px;
            border-bottom: 1px solid var(--af-border);
        }

        .panel-heading h2 {
            font-size: 19px;
            font-weight: 800;
            margin: 0 0 6px;
        }

        .panel-heading p {
            color: var(--af-muted);
            font-size: 12px;
            margin: 0;
        }

        .panel-body {
            padding: 26px;
        }

        .selected-flight-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 18px 22px;
            background: linear-gradient(110deg, #f7fbfe, #fff);
            border-bottom: 1px solid var(--af-border);
        }

        .airline-detail {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .airline-detail img {
            width: 48px;
            height: 48px;
            padding: 5px;
            object-fit: contain;
            border: 1px solid var(--af-border);
            border-radius: 10px;
        }

        .airline-detail strong {
            display: block;
            font-size: 14px;
            font-weight: 800;
        }

        .airline-detail small {
            color: var(--af-muted);
            font-size: 11px;
        }

        .selected-badge {
            flex-shrink: 0;
            color: #16834b;
            background: #eaf8f0;
            padding: 7px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
        }

        .flight-route {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 100px minmax(0, 1fr);
            align-items: center;
            gap: 12px;
            padding: 25px 22px;
        }

        .route-point:last-child {
            text-align: right;
        }

        .route-code {
            font-size: 25px;
            font-weight: 800;
            line-height: 1.15;
        }

        .route-city {
            color: var(--af-muted);
            font-size: 12px;
            margin-top: 5px;
        }

        .route-date {
            font-size: 11px;
            font-weight: 700;
            margin-top: 10px;
        }

        .route-middle {
            color: var(--af-muted);
            font-size: 11px;
            text-align: center;
        }

        .route-line {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 8px;
            color: var(--af-blue);
        }

        .route-line::before,
        .route-line::after {
            content: "";
            height: 1px;
            background: #cfdae5;
            flex: 1;
        }

        .route-line i {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            background: #eaf7fc;
            border-radius: 50%;
        }

        .flight-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 20px;
            padding: 14px 22px;
            border-top: 1px solid var(--af-border);
            color: #566579;
            font-size: 12px;
        }

        .flight-meta i {
            color: var(--af-blue);
            margin-right: 6px;
        }

        .enquiry-section + .enquiry-section {
            border-top: 1px solid var(--af-border);
            margin-top: 27px;
            padding-top: 26px;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .section-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 8px;
            color: #08759d;
            background: #e7f8fc;
            font-size: 12px;
        }

        .form-label {
            color: #34465a;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 7px;
        }

        .form-control,
        .form-select {
            min-height: 46px;
            border: 1px solid #dce5ed;
            border-radius: 9px;
            padding: 11px 13px;
            font-size: 13px;
            color: var(--af-text);
            box-shadow: none !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--af-cyan);
        }

        textarea.form-control {
            min-height: 115px;
            resize: vertical;
        }

        .submit-enquiry {
            width: 100%;
            min-height: 49px;
            border: 0;
            border-radius: 9px;
            color: #fff;
            background: linear-gradient(135deg, var(--af-blue), var(--af-cyan));
            font-size: 13px;
            font-weight: 800;
            transition: .2s ease;
        }

        .submit-enquiry:hover {
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(2,132,199,.22);
        }

        .form-note {
            color: var(--af-muted);
            font-size: 11px;
            line-height: 1.6;
            margin: 12px 0 0;
        }

        .sidebar-card {
            padding: 24px;
            margin-bottom: 20px;
        }

        .sidebar-price {
            color: #d83a2e;
            font-size: 30px;
            font-weight: 800;
            margin: 7px 0 0;
        }

        .sidebar-label {
            color: var(--af-muted);
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .sidebar-note {
            color: var(--af-muted);
            font-size: 11px;
        }

        .sidebar-dark {
            color: #fff;
            background: linear-gradient(145deg, #071c33, #0c4164);
        }

        .sidebar-dark .sidebar-label,
        .sidebar-dark .sidebar-note {
            color: rgba(255,255,255,.68);
        }

        .sidebar-dark h3 {
            font-size: 16px;
            font-weight: 800;
            margin: 14px 0 6px;
        }

        .sidebar-phone {
            color: #a5f3fc;
            font-size: 19px;
            font-weight: 800;
            text-decoration: none;
        }

        .sidebar-phone:hover {
            color: #fff;
        }

        .information-title {
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .information-list {
            padding-left: 18px;
            margin: 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.7;
        }

        .information-list li + li {
            margin-top: 7px;
        }

        .alert {
            border-radius: 10px;
            font-size: 13px;
        }

        .success-panel {
            text-align: center;
            padding: 45px 25px;
        }

        .success-icon {
            width: 62px;
            height: 62px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #16834b;
            background: #eaf8f0;
            font-size: 25px;
        }

        .success-panel h2 {
            font-size: 24px;
            font-weight: 800;
        }

        .success-panel p {
            max-width: 520px;
            margin: 12px auto 22px;
            color: var(--af-muted);
            font-size: 13px;
            line-height: 1.7;
        }

        @media (max-width: 991.98px) {
            .enquiry-hero {
                padding-top: 155px;
                padding-bottom: 75px;
            }

            .enquiry-main {
                margin-top: -32px;
            }

            .enquiry-sidebar {
                margin-top: 0;
            }
        }

        @media (max-width: 767.98px) {
            .enquiry-hero {
                padding-top: 135px;
                padding-bottom: 65px;
            }

            .enquiry-hero h1 {
                font-size: 28px;
            }

            .panel-heading,
            .panel-body {
                padding: 20px;
            }

            .flight-route {
                grid-template-columns: minmax(0, 1fr) 60px minmax(0, 1fr);
                gap: 7px;
                padding: 22px 15px;
            }

            .route-code {
                font-size: 21px;
            }

            .route-city {
                font-size: 11px;
            }

            .route-date {
                font-size: 10px;
            }

            .flight-meta {
                padding: 13px 15px;
                gap: 10px 14px;
            }

            .selected-flight-header {
                padding: 15px;
            }

            .selected-badge {
                font-size: 10px;
            }

            .sidebar-card {
                padding: 21px;
            }
        }

        @media (max-width: 420px) {
            .flight-route {
                grid-template-columns: minmax(0, 1fr) 43px minmax(0, 1fr);
                gap: 5px;
            }

            .route-code {
                font-size: 19px;
            }

            .route-middle {
                font-size: 10px;
            }

            .selected-badge {
                max-width: 92px;
                text-align: center;
            }

            .airline-detail img {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>

<body>

<!-- (Header + Navbar) -->
    <div class="flight-sticky-wrapper" id="flightStickyWrapper">
      <!-- HEADER SECTION START -->
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
      <!-- NAVBAR SECTION START -->
      <?php include('_nav.php'); ?>
    </div>

<section class="enquiry-hero">
    <div class="container enquiry-hero-content">
        <div class="enquiry-eyebrow">
            <i class="fa-solid fa-paper-plane me-2"></i>
            American Fly · Flight support
        </div>

        <h1>Flight Enquiry</h1>

        <p>
            Share your details with our team.
            We'll be able to review your selected itinerary and discuss
            fare availability with you.
        </p>
    </div>
</section>

<main class="container enquiry-main">

    <?php if ($submitted): ?>

        <section class="enquiry-panel success-panel">
            <div class="success-icon">
                <i class="fa-solid fa-check"></i>
            </div>

            <h2>Thank you for your enquiry</h2>

            <p>
                Your details passed validation. The email and enquiry
                processing functions have not been connected yet, so
                no email has been sent and these details have not been
                saved. Connect your handler before using this form
                in production.
            </p>

            <a href="index.php" class="btn submit-enquiry d-inline-flex align-items-center justify-content-center" style="max-width:250px">
                Back to Flight Search
            </a>
        </section>

    <?php else: ?>

        <?php if ($errors): ?>
            <div class="alert alert-danger mb-4">
                <strong>Please review the following:</strong>
                <ul class="mb-0 mt-2">
                    <?php foreach ($errors as $message): ?>
                        <li><?= esc($message) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-warning mb-4">
                <?= esc($error) ?>
                <a href="index.php" class="alert-link">Search flights again</a>.
            </div>
        <?php endif; ?>

        <div class="row g-4">

            <div class="col-lg-8">

                <?php if ($flight): ?>
                    <section class="enquiry-panel mb-4">

                        <div class="selected-flight-header">
                            <div class="airline-detail">
                                <img
                                    src="<?= esc($airline_logo) ?>"
                                    alt="<?= esc($airline_name ?: 'Airline') ?>"
                                >

                                <div>
                                    <strong>
                                        <?= esc($airline_name ?: $flight['airline'] ?? 'Selected flight') ?>
                                    </strong>
                                    <small>
                                        <?= esc($class_label) ?> · Return fare
                                    </small>
                                </div>
                            </div>

                            <span class="selected-badge">
                                <i class="fa-solid fa-check me-1"></i>
                                Selected
                            </span>
                        </div>

                        <div class="flight-route">

                            <div class="route-point">
                                <div class="route-code">
                                    <?= esc($flight['source']) ?>
                                </div>

                                <div class="route-city">
                                    <?= esc($airport_from['City'] ?? $airport_from['Airport_Name'] ?? '') ?>
                                </div>

                                <div class="route-date">
                                    <i class="fa-regular fa-calendar me-1"></i>
                                    <?= esc($departure_display) ?>
                                </div>
                            </div>

                            <div class="route-middle">
                                <div class="route-line">
                                    <i class="fa-solid fa-plane"></i>
                                </div>
                                <?= esc($stops_label) ?>
                            </div>

                            <div class="route-point">
                                <div class="route-code">
                                    <?= esc($flight['destination']) ?>
                                </div>

                                <div class="route-city">
                                    <?= esc($airport_to['City'] ?? $airport_to['Airport_Name'] ?? '') ?>
                                </div>

                                <div class="route-date">
                                    <i class="fa-regular fa-calendar me-1"></i>
                                    <?= esc($return_display) ?>
                                </div>
                            </div>

                        </div>

                        <div class="flight-meta">
                            <span>
                                <i class="fa-solid fa-chair"></i>
                                <?= esc($class_label) ?>
                            </span>

                            <span>
                                <i class="fa-solid fa-route"></i>
                                <?= esc($stops_label) ?>
                            </span>

                            <span>
                                <i class="fa-solid fa-tag"></i>
                                Return fare
                            </span>
                        </div>

                    </section>
                <?php endif; ?>

                <section class="enquiry-panel">

                    <div class="panel-heading">
                        <h2>Tell us about your travel plans</h2>
                        <p>Fields marked with * are required.</p>
                    </div>

                    <div class="panel-body">

                    <form
                        method="post"
                        action="flight-enquiry.php?flight=<?= (int)($flight_id ?: 0) ?>&up=<?= urlencode($start_date) ?>&down=<?= urlencode($end_date) ?>"
                        id="flightEnquiryForm"
                        novalidate
                    >
                        <div class="enquiry-section">
                            <h3 class="section-title">
                                <!-- <span class="section-number">01</span> -->
                                Your Contact Details
                            </h3>

                            <div class="row g-3">

                                <!-- First Name -->
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">
                                        First Name *
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="first_name"
                                        name="first_name"
                                        autocomplete="given-name"
                                        required
                                        value="<?= esc($values['first_name']) ?>"
                                        placeholder="Enter your first name"
                                    >
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">
                                        Last Name *
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="last_name"
                                        name="last_name"
                                        autocomplete="family-name"
                                        required
                                        value="<?= esc($values['last_name']) ?>"
                                        placeholder="Enter your last name"
                                    >
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label">
                                        Email Address *
                                    </label>

                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        name="email"
                                        autocomplete="email"
                                        required
                                        value="<?= esc($values['email']) ?>"
                                        placeholder="you@example.com"
                                    >
                                </div>

                                <!-- Contact Number -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">
                                        Contact Number *
                                    </label>

                                    <input
                                        type="tel"
                                        class="form-control"
                                        id="phone"
                                        name="phone"
                                        autocomplete="tel"
                                        required
                                        value="<?= esc($values['phone']) ?>"
                                        placeholder="Enter your contact number"
                                    >
                                </div>

                                <!-- Security Question -->
                                <div class="col-md-6">
                                    <label for="security_answer" class="form-label">
                                        Security Question: 5 + 2 = ? *
                                    </label>

                                    <input
                                        type="number"
                                        class="form-control"
                                        id="security_answer"
                                        name="security_answer"
                                        required
                                        placeholder="Enter your answer"
                                    >
                                </div>

                            </div>
                        </div>

                        <div class="enquiry-section">
                            <button type="submit" class="btn submit-enquiry">
                                Submit Flight Enquiry
                                <i class="fa-solid fa-arrow-right ms-2"></i>
                            </button>

                            <p class="form-note">
                                <i class="fa-solid fa-lock me-1"></i>
                                Your contact details will be used to respond to your flight enquiry.
                            </p>
                        </div>
                    </form>


                    </div>
                </section>
            </div>

            <aside class="col-lg-4 enquiry-sidebar">

                <?php if ($flight): ?>
                    <section class="enquiry-panel sidebar-card sidebar-dark">
                        <div class="sidebar-label">Indicative fare</div>

                        <div class="sidebar-price" style="color:#fff">
                            £<?= number_format((float)($flight['adult_fare'] ?? 0), 2) ?>
                        </div>

                        <div class="sidebar-note">
                            Per person · Subject to availability
                        </div>

                        <hr style="border-color:rgba(255,255,255,.2);margin:20px 0">

                        <div class="sidebar-label">Need assistance?</div>

                        <h3>Talk to our flight specialists</h3>

                        <a class="sidebar-phone" href="tel:02031375177">
                            <i class="fa-solid fa-phone me-2"></i>
                            0203 137 5177
                        </a>

                        <div class="sidebar-note mt-2">
                            08:00 AM – 11:30 PM · 7 days a week
                        </div>
                    </section>
                <?php else: ?>
                    <section class="enquiry-panel sidebar-card sidebar-dark">
                        <div class="sidebar-label">American Fly support</div>
                        <h3>Speak to our flight specialists</h3>

                        <a class="sidebar-phone" href="tel:02031375177">
                            <i class="fa-solid fa-phone me-2"></i>
                            0203 137 5177
                        </a>
                    </section>
                <?php endif; ?>

                <section class="enquiry-panel sidebar-card">
                    <h3 class="information-title">
                        <i class="fa-solid fa-circle-info me-2" style="color:#0284c7"></i>
                        Important information
                    </h3>

                    <ul class="information-list">
                        <li>All fares are subject to availability and confirmation.</li>
                        <li>The displayed fare may change before a booking is confirmed.</li>
                        <li>Flight times, baggage allowance and stopovers should be confirmed with our team.</li>
                        <li>Please ask about applicable booking fees, cancellation charges and date-change conditions before confirming a booking.</li>
                    </ul>
                </section>

            </aside>

        </div>
    <?php endif; ?>

</main>

<?php include('_footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('flightEnquiryForm');

    if (!form) return;

    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');
        }
    });
});
</script>

</body>
</html>