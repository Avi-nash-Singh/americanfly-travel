<?php
include('_config.php');

/* =========================================================
   SEARCH PARAMETERS
========================================================= */

$source      = isset($_GET['origin']) ? trim($_GET['origin']) : '';
$destination = isset($_GET['destination']) ? trim($_GET['destination']) : '';

$start_date  = isset($_GET['startDate']) ? trim($_GET['startDate']) : '';
$end_date    = isset($_GET['endDate']) ? trim($_GET['endDate']) : '';

$adult       = isset($_GET['adult']) ? (int)$_GET['adult'] : 1;
$child       = isset($_GET['child']) ? (int)$_GET['child'] : 0;
$class       = isset($_GET['class']) ? (int)$_GET['class'] : 2;


/* =========================================================
   CLASS NAME
========================================================= */

$class_names = [
    1 => 'Economy',
    2 => 'Business',
    3 => 'First Class',
    4 => 'Premium Economy'
];

$printclass = isset($class_names[$class])
    ? $class_names[$class]
    : 'Business';


/* =========================================================
   DATE VALIDATION
========================================================= */

$today = date('Y-m-d');

if (
    empty($source) ||
    empty($destination) ||
    empty($start_date) ||
    empty($end_date)
) {
    header("Location: index.php?err=1");
    exit;
}

if ($start_date < $today) {
    header("Location: index.php?err=3");
    exit;
}

if ($start_date > $end_date) {
    header("Location: index.php?err=4");
    exit;
}

if ($source === $destination) {
    header("Location: index.php?err=5");
    exit;
}


/* =========================================================
   DISPLAY DATES
========================================================= */

$display_start = date("D, d M Y", strtotime($start_date));
$display_end   = date("D, d M Y", strtotime($end_date));


/* =========================================================
   AIRPORTS
========================================================= */

$airport_from = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT * FROM airports WHERE Airport_Code = '" . mysqli_real_escape_string($conn, $source) . "' LIMIT 1"
    )
);

$airport_to = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT * FROM airports WHERE Airport_Code = '" . mysqli_real_escape_string($conn, $destination) . "' LIMIT 1"
    )
);


/* =========================================================
   AIRPORT LIST FOR MODIFY SEARCH
========================================================= */

$result_airports = $conn->query("SELECT * FROM airports ORDER BY Airport_Name ASC");


/* =========================================================
   FLIGHTS
========================================================= */

$source_safe      = mysqli_real_escape_string($conn, $source);
$destination_safe = mysqli_real_escape_string($conn, $destination);

$flights_sql = "
    SELECT *
    FROM flights
    WHERE source = '$source_safe'
      AND destination = '$destination_safe'
      AND start_date <= '$start_date'
      AND end_date >= '$start_date'
      AND class = '$class'
    ORDER BY adult_fare ASC
";

$flights_result = $conn->query($flights_sql);


/* =========================================================
   HELPER FUNCTIONS
========================================================= */

function getStops($flight)
{
    if ($flight['route'] === 'Direct') {
        return 'Non-Stop';
    }

    if (!empty($flight['route3'])) {
        return '3 Stops';
    }

    if (!empty($flight['route2'])) {
        return '2 Stops';
    }

    return '1 Stop';
}


function getStopCount($flight)
{
    if ($flight['route'] === 'Direct') {
        return 0;
    }

    if (!empty($flight['route3'])) {
        return 3;
    }

    if (!empty($flight['route2'])) {
        return 2;
    }

    return 1;
}


function getRouteText($flight)
{
    $routes = [];

    if (!empty($flight['route'])) {
        $routes[] = $flight['route'];
    }

    if (!empty($flight['route2'])) {
        $routes[] = $flight['route2'];
    }

    if (!empty($flight['route3'])) {
        $routes[] = $flight['route3'];
    }

    return implode(' • ', $routes);
}

?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Flight Search Results - American Fly
    </title>


    <!-- =====================================================
         BOOTSTRAP 5.0.2
    ====================================================== -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- =====================================================
         FONT AWESOME
    ====================================================== -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    >


    <!-- =====================================================
         SELECT2
    ====================================================== -->

    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet"
    >


    <!-- =====================================================
         FLATPICKR
    ====================================================== -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"
    >

    <link
        rel="stylesheet"
        href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css"
    >


    <!-- YOUR SITE CSS -->

    <link
        rel="stylesheet"
        href="css/index.css"
    >


    <style>

        /* =====================================================
           GLOBAL
        ====================================================== */

        body {
            background: #f5f8fc;
            color: #172033;
            font-family: Arial, Helvetica, sans-serif;
        }


        /* =====================================================
           RESULT HERO
        ====================================================== */

        .results-hero {
            position: relative;
            background:
                linear-gradient(
                    135deg,
                    rgba(7, 28, 51, .96),
                    rgba(12, 65, 100, .90)
                );
            padding: 55px 0 85px;
            padding-top: 11rem;
            overflow: hidden;
        }

        .results-hero::after {
            content: "";
            position: absolute;
            width: 450px;
            height: 450px;
            right: -150px;
            top: -200px;
            border-radius: 50%;
            background: rgba(255,255,255,.05);
        }

        .results-hero-content {
            position: relative;
            z-index: 2;
        }

        .results-hero h1 {
            color: #fff;
            font-size: 34px;
            font-weight: 800;
            /* margin-bottom: 10px; */
        }

        .results-hero-subtitle {
            color: rgba(255,255,255,.75);
            font-size: 15px;
        }


        /* =====================================================
           SEARCH SUMMARY
        ====================================================== */

        .search-summary {
            margin-top: -55px;
            position: relative;
            z-index: 20;
        }

        .search-summary-card {
            background: rgba(255,255,255,.98);
            border-radius: 18px;
            padding: 12px 25px;
            box-shadow: 0 15px 45px rgba(10,30,55,.13);
            border: 1px solid rgba(255,255,255,.8);
        }

        .summary-route {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .summary-airport {
            min-width: 70px;
        }

        .summary-airport-code {
            font-size: 25px;
            font-weight: 800;
            color: #14253d;
        }

        .summary-city {
            color: #7a8799;
            font-size: 12px;
            margin-top: 2px;
        }

        .summary-arrow {
            flex: 1;
            height: 1px;
            background: #dbe3ec;
            position: relative;
            text-align: center;
        }

        .summary-arrow i {
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #eaf7fc;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .summary-info {
            border-left: 1px solid #e6ebf1;
            padding-left: 25px;
        }

        .summary-label {
            display: block;
            font-size: 10px;
            color: #98a5b5;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .summary-value {
            display: block;
            font-size: 14px;
            color: #1a2738;
            font-weight: 700;
            margin-top: 4px;
        }


        /* =====================================================
           MODIFY BUTTON
        ====================================================== */

        .modify-search-btn {
            border: 1px solid #0284c7;
            background: #fff;
            color: #0284c7;
            border-radius: 9px;
            padding: 11px 17px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
            transition: .2s ease;
        }

        .modify-search-btn:hover {
            background: #0284c7;
            color: #fff;
        }


        /* =====================================================
           MAIN CONTENT
        ====================================================== */

        .results-section {
            padding: 35px 0 70px;
        }


        /* =====================================================
           FILTER SIDEBAR
        ====================================================== */

        .filter-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e7edf4;
            box-shadow: 0 8px 25px rgba(22,42,70,.05);
            overflow: hidden;
        }

        .filter-header {
            padding: 19px 20px;
            border-bottom: 1px solid #edf1f5;
            font-weight: 800;
            font-size: 16px;
        }

        .filter-body {
            padding: 20px;
        }

        .filter-title {
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            color: #657387;
            letter-spacing: .04em;
            margin-bottom: 13px;
        }

        .filter-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 11px;
            font-size: 14px;
            color: #445166;
        }

        .filter-option-left {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .filter-option input {
            accent-color: #0284c7;
        }

        .filter-divider {
            border: 0;
            border-top: 1px solid #edf1f5;
            margin: 20px 0;
        }


        /* =====================================================
           SORT BAR
        ====================================================== */

        .results-topbar {
            background: #fff;
            border: 1px solid #e7edf4;
            border-radius: 14px;
            padding: 14px 17px;
            margin-bottom: 17px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .results-count {
            font-size: 14px;
            color: #637084;
        }

        .results-count strong {
            color: #172033;
        }

        .sort-select {
            border: 1px solid #dce4ec;
            border-radius: 8px;
            padding: 8px 32px 8px 11px;
            font-size: 13px;
            color: #26354a;
            background-color: #fff;
        }


        /* =====================================================
           FLIGHT CARD
        ====================================================== */

        .flight-card {
            background: #fff;
            border: 1px solid #e4eaf1;
            border-radius: 18px;
            margin-bottom: 18px;
            overflow: hidden;
            box-shadow: 0 7px 25px rgba(20,40,65,.06);
            transition:
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease;
        }

        .flight-card:hover {
            transform: translateY(-2px);
            border-color: #d4e4ef;
            box-shadow: 0 13px 35px rgba(20,40,65,.10);
        }


        /* =====================================================
           CARD HEADER
        ====================================================== */

        .flight-card-header {
            padding: 6px 20px;
            border-bottom: 1px solid #edf1f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .airline-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .airline-logo {
            width: 48px;
            height: 48px;
            border: 1px solid #e8edf3;
            border-radius: 10px;
            background: #fff;
            padding: 6px;
            object-fit: contain;
        }

        .airline-name {
            font-size: 14px;
            font-weight: 800;
            color: #1c2a3c;
        }

        .airline-class {
            font-size: 11px;
            color: #8a96a7;
            margin-top: 3px;
        }

        .flight-badge {
            font-size: 11px;
            padding: 6px 9px;
            background: #edf9f3;
            color: #1c8b57;
            border-radius: 20px;
            font-weight: 700;
        }


        /* =====================================================
           CARD BODY
        ====================================================== */

        .flight-card-body {
            padding: 8px 20px;
        }

        .flight-row {
            display: grid;
            grid-template-columns: 120px minmax(100px, 1fr) 90px minmax(100px, 1fr) 120px;
            align-items: center;
            gap: 15px;
        }

        .flight-row + .flight-row {
            border-top: 1px dashed #e2e8ef;
            margin-top: 8px;
            padding-top: 8px;
        }

        .flight-location {
            text-align: center;
        }

        .flight-location:first-child {
            text-align: left;
        }

        .flight-location:last-child {
            text-align: right;
        }

        .airport-code {
            font-size: 22px;
            font-weight: 800;
            color: #16263b;
        }

        .airport-name {
            font-size: 11px;
            color: #8b97a8;
            margin-top: 3px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .route-middle {
            text-align: center;
        }

        .route-line {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #0284c7;
        }

        .route-line::before,
        .route-line::after {
            content: "";
            height: 1px;
            background: #cfdce7;
            flex: 1;
        }

        .route-plane {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #eaf7fc;
            color: #0284c7;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .route-text {
            margin-top: 6px;
            font-size: 11px;
            color: #7d899a;
        }

        .stops-text {
            font-size: 11px;
            color: #64748b;
            font-weight: 700;
            text-align: center;
        }


        /* =====================================================
           PRICE / ACTION AREA
        ====================================================== */

        .flight-card-footer {
            border-top: 1px solid #edf1f5;
            padding: 8px 20px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
        }

        .price-area {
            margin-right: auto;
        }

        .price-label {
            display: block;
            font-size: 10px;
            color: #9aa5b3;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: -8px
        }

        .price {
            font-size: 24px;
            font-weight: 800;
            color: #d83a2e;
            margin-top: 2px;
        }

        .price-per {
            font-size: 11px;
            color: #8995a5;
            font-weight: 600;
        }

        .phone-offer {
            font-size: 11px;
            color: #718096;
            margin-top: -5px;
        }

        .btn-enquire {
            background: linear-gradient(135deg,#0284c7,#06b6d4);
            border: none;
            color: #fff;
            border-radius: 9px;
            padding: 11px 18px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            transition: .2s ease;
        }

        .btn-enquire:hover {
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 7px 18px rgba(2,132,199,.25);
        }

        .btn-call {
            background: #fff;
            border: 1px solid #0284c7;
            color: #0284c7;
            border-radius: 9px;
            padding: 10px 17px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .btn-call:hover {
            background: #0284c7;
            color: #fff;
        }


        /* =====================================================
           EMPTY RESULTS
        ====================================================== */

        .no-results {
            background: #fff;
            border-radius: 18px;
            padding: 60px 30px;
            text-align: center;
            border: 1px solid #e7edf4;
        }

        .no-results i {
            font-size: 45px;
            color: #9ba8b7;
            margin-bottom: 15px;
        }


        /* =====================================================
           MODIFY MODAL
        ====================================================== */

        .modify-modal .modal-content {
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }

        .modify-modal .modal-header {
            background: linear-gradient(
                135deg,
                #09243e,
                #075d88
            );
            color: #fff;
            padding: 20px 24px;
            border: none;
        }

        .modify-modal .modal-title {
            font-size: 18px;
            font-weight: 800;
        }

        .modify-modal .btn-close {
            filter: brightness(0) invert(1);
        }

        .modify-modal .modal-body {
            padding: 25px;
            background: #f7f9fc;
        }

        .modify-field {
            background: #fff;
            border: 1px solid #e0e7ef;
            border-radius: 11px;
            padding: 11px 13px;
        }

        .modify-field label {
            display: block;
            font-size: 10px;
            text-transform: uppercase;
            color: #8a97a8;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .modify-field select,
        .modify-field input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
            font-weight: 600;
            color: #172033;
            background: transparent;
        }

        .modify-submit {
            width: 100%;
            border: none;
            background: linear-gradient(135deg,#0284c7,#06b6d4);
            color: #fff;
            border-radius: 11px;
            padding: 13px;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
        }


        /* =====================================================
           SELECT2
        ====================================================== */

        .modify-field .select2-container {
            width: 100% !important;
        }

        .modify-field .select2-selection--single {
            border: none !important;
            height: 24px !important;
        }

        .modify-field .select2-selection__rendered {
            padding-left: 0 !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            color: #172033 !important;
        }

        .modify-field .select2-selection__arrow {
            top: 0 !important;
        }

        .select2-dropdown {
            z-index: 99999 !important;
        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 1199px) {

            .flight-row {
                grid-template-columns:
                    90px
                    minmax(80px, 1fr)
                    70px
                    minmax(80px, 1fr)
                    90px;
                gap: 10px;
            }

            .airport-code {
                font-size: 20px;
            }

        }


        @media (max-width: 991px) {

            .results-hero {
                padding: 170px 0 70px;
            }

            .search-summary-card {
                padding: 18px;
            }

            .summary-info {
                border-left: none;
                padding-left: 0;
                margin-top: 15px;
                padding-top: 15px;
                border-top: 1px solid #edf1f5;
            }

            .filter-card {
                margin-bottom: 20px;
            }

            .flight-row {
                grid-template-columns:
                    80px
                    1fr
                    60px
                    1fr
                    80px;
            }

        }


        @media (max-width: 767px) {

            .results-hero h1 {
                font-size: 27px;
            }

            .search-summary {
                margin-top: -35px;
            }

            .summary-route {
                gap: 10px;
            }

            .summary-airport-code {
                font-size: 21px;
            }

            .summary-info {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 15px;
            }

            .summary-action {
                margin-top: 15px;
            }

            .summary-action button {
                width: 100%;
            }

            .results-topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .flight-card-header {
                padding: 14px;
            }

            .flight-card-body {
                padding: 18px 14px;
            }

            .flight-row {
                grid-template-columns:
                    65px
                    minmax(50px, 1fr)
                    45px
                    minmax(50px, 1fr)
                    65px;
                gap: 5px;
            }

            .airport-code {
                font-size: 17px;
            }

            .airport-name {
                font-size: 9px;
            }

            .route-text {
                font-size: 9px;
            }

            .stops-text {
                font-size: 9px;
            }

            .flight-card-footer {
                padding: 14px;
                flex-wrap: wrap;
            }

            .price-area {
                width: 100%;
                margin-bottom: 5px;
            }

            .btn-enquire,
            .btn-call {
                flex: 1;
            }

        }


        @media (max-width: 480px) {

            .results-hero {
                padding: 30px 0 55px;
                padding-top: 13rem;
            }

            .results-hero h1 {
                font-size: 23px;
            }

            .summary-route {
                display: grid;
                grid-template-columns: 1fr 35px 1fr;
            }

            .summary-airport:last-child {
                text-align: right;
            }

            .flight-card-header {
                align-items: flex-start;
            }

            .flight-badge {
                font-size: 9px;
            }

            .airline-logo {
                width: 42px;
                height: 42px;
            }

            .airline-name {
                font-size: 12px;
            }

            .flight-row {
                grid-template-columns:
                    55px
                    1fr
                    35px
                    1fr
                    55px;
            }

            .airport-code {
                font-size: 15px;
            }

            .route-plane {
                width: 24px;
                height: 24px;
                font-size: 10px;
            }

            .price {
                font-size: 21px;
            }

        }

        /* =========================================================
   FLIGHT SEARCH LOADER - MODAL
========================================================= */

.flight-loader {
    position: fixed;
    inset: 0;
    z-index: 999999;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 20px;

    background: rgba(3, 18, 32, 0.62);

    backdrop-filter: blur(7px);
    -webkit-backdrop-filter: blur(7px);

    opacity: 1;
    visibility: visible;

    transition:
        opacity .45s ease,
        visibility .45s ease;
}

.flight-loader.is-hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}


/* =========================================================
   MODAL CARD
========================================================= */

.flight-loader-card {
    position: relative;

    width: 100%;
    max-width: 520px;

    padding: 38px 40px 35px;

    border-radius: 24px;

    background:
        radial-gradient(
            circle at 50% 0%,
            rgba(6, 182, 212, .13),
            transparent 42%
        ),
        linear-gradient(
            145deg,
            #071d32,
            #092f4d 55%,
            #063b57
        );

    border: 1px solid rgba(255,255,255,.10);

    box-shadow:
        0 30px 80px rgba(0,0,0,.35),
        0 10px 30px rgba(0,0,0,.18);

    overflow: hidden;

    transform: translateY(0) scale(1);

    animation: loaderCardIn .45s cubic-bezier(.22,1,.36,1);
}


/* Decorative circles */

.flight-loader-card::before {
    content: "";

    position: absolute;

    width: 260px;
    height: 260px;

    border-radius: 50%;

    right: -130px;
    top: -150px;

    background: rgba(6,182,212,.07);
}


.flight-loader-card::after {
    content: "";

    position: absolute;

    width: 200px;
    height: 200px;

    border-radius: 50%;

    left: -110px;
    bottom: -120px;

    background: rgba(2,132,199,.08);
}


/* =========================================================
   CONTENT
========================================================= */

.flight-loader-content {
    position: relative;
    z-index: 2;

    text-align: center;
}


/* =========================================================
   LOGO
========================================================= */

.flight-loader-logo {
    width: 145px;
    max-width: 55%;
    height: auto;

    margin-bottom: 30px;

    animation:
        loaderLogoPulse 2s ease-in-out infinite;
}


/* =========================================================
   ROUTE
========================================================= */

.loader-route {
    display: flex;
    align-items: center;

    width: 100%;

    margin-bottom: 28px;
}


.loader-airport {
    width: 70px;
    flex-shrink: 0;
}


.loader-airport-code {
    display: block;

    color: #fff;

    font-size: 24px;
    line-height: 1;

    font-weight: 800;

    letter-spacing: .04em;
}


.loader-airport-label {
    display: block;

    color: rgba(255,255,255,.52);

    font-size: 9px;

    margin-top: 7px;

    text-transform: uppercase;

    letter-spacing: .08em;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;
}


/* =========================================================
   FLIGHT PATH
========================================================= */

.loader-flight-path {
    position: relative;

    height: 45px;

    flex: 1;

    margin: 0 10px;
}


/* Dashed route */

.loader-flight-path::before {
    content: "";

    position: absolute;

    left: 0;
    right: 0;

    top: 50%;

    height: 1px;

    background:
        repeating-linear-gradient(
            to right,
            rgba(255,255,255,.32) 0,
            rgba(255,255,255,.32) 7px,
            transparent 7px,
            transparent 14px
        );
}


/* =========================================================
   ANIMATED PLANE
========================================================= */

.loader-plane {
    position: absolute;

    top: 50%;
    left: 0;

    width: 38px;
    height: 38px;

    margin-top: -19px;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            135deg,
            #0284c7,
            #06b6d4
        );

    color: #fff;

    box-shadow:
        0 0 0 6px rgba(6,182,212,.10),
        0 8px 25px rgba(0,0,0,.25);

    animation:
        flyAcross 2.4s cubic-bezier(.45,.05,.55,.95) infinite;
}


.loader-plane i {
    font-size: 13px;
}


/* Plane glow */

.loader-plane::after {
    content: "";

    position: absolute;

    width: 70px;
    height: 70px;

    border-radius: 50%;

    background: rgba(6,182,212,.10);

    z-index: -1;

    animation:
        planeGlow 1.5s ease-in-out infinite;
}


/* =========================================================
   TEXT
========================================================= */

.flight-loader-title {
    color: #fff;

    font-size: 20px;

    font-weight: 700;

    margin: 0 0 8px;
}


.flight-loader-subtitle {
    color: rgba(255,255,255,.60);

    font-size: 12px;

    margin: 0 0 23px;

    min-height: 18px;

    transition: opacity .25s ease;
}


/* =========================================================
   PROGRESS BAR
========================================================= */

.loader-progress {
    width: 100%;

    height: 5px;

    background: rgba(255,255,255,.10);

    border-radius: 20px;

    overflow: hidden;

    margin-bottom: 11px;
}


.loader-progress-bar {
    width: 0;

    height: 100%;

    border-radius: inherit;

    background:
        linear-gradient(
            90deg,
            #0284c7,
            #06b6d4,
            #67e8f9
        );

    box-shadow:
        0 0 15px rgba(6,182,212,.45);

    animation:
        loaderProgress 3s linear forwards;
}


.loader-status {
    color: rgba(255,255,255,.40);

    font-size: 10px;

    letter-spacing: .02em;
}


/* =========================================================
   ANIMATIONS
========================================================= */

@keyframes loaderCardIn {

    from {
        opacity: 0;
        transform: translateY(15px) scale(.96);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}


@keyframes flyAcross {

    0% {
        left: 0;
        transform: translateX(0);
    }

    50% {
        left: 50%;
        transform: translateX(-50%);
    }

    100% {
        left: 100%;
        transform: translateX(-100%);
    }
}


@keyframes planeGlow {

    0%,
    100% {
        transform: scale(.75);
        opacity: .4;
    }

    50% {
        transform: scale(1.15);
        opacity: .9;
    }
}


        @keyframes loaderProgress {

            0% {
                width: 0%;
            }

            20% {
                width: 18%;
            }

            45% {
                width: 42%;
            }

            70% {
                width: 68%;
            }

            88% {
                width: 87%;
            }

            100% {
                width: 100%;
            }
        }


        @keyframes loaderLogoPulse {

            0%,
            100% {
                opacity: .85;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.035);
            }
        }


        /* =========================================================
        TABLET
        ========================================================= */

        @media (max-width: 767px) {

            .flight-loader-card {
                max-width: 460px;

                padding: 32px 28px 30px;

                border-radius: 21px;
            }

            .flight-loader-logo {
                width: 130px;

                margin-bottom: 26px;
            }

            .loader-airport {
                width: 60px;
            }

            .loader-airport-code {
                font-size: 21px;
            }

            .loader-flight-path {
                margin: 0 7px;
            }

        }


        /* =========================================================
        MOBILE
        ========================================================= */

        @media (max-width: 480px) {

            .flight-loader {
                padding: 15px;
            }

            .flight-loader-card {
                width: 100%;

                padding: 30px 20px 27px;

                border-radius: 20px;
            }

            .flight-loader-logo {
                width: 120px;

                margin-bottom: 25px;
            }

            .loader-airport {
                width: 52px;
            }

            .loader-airport-code {
                font-size: 19px;
            }

            .loader-airport-label {
                font-size: 8px;
            }

            .loader-flight-path {
                margin: 0 5px;
            }

            .loader-plane {
                width: 34px;
                height: 34px;

                margin-top: -17px;
            }

            .loader-plane i {
                font-size: 11px;
            }

            .flight-loader-title {
                font-size: 17px;
            }

            .flight-loader-subtitle {
                font-size: 11px;
            }

            .loader-status {
                font-size: 9px;
            }

        }

    </style>

</head>


<body>
<!-- =========================================================
     FLIGHT SEARCH LOADER MODAL
========================================================== -->

<div class="flight-loader" id="flightSearchLoader" aria-label="Searching for flights" >

    <div class="flight-loader-card">

        <div class="flight-loader-content">

            <!-- LOGO -->

            <img
                src="assets/logo.png"
                alt="American Fly"
                class="flight-loader-logo"
            >


            <!-- ROUTE -->

            <div class="loader-route">

                <div class="loader-airport">

                    <span class="loader-airport-code">
                        <?php echo htmlspecialchars($source); ?>
                    </span>

                    <span class="loader-airport-label">
                        <?php echo htmlspecialchars($airport_from['City'] ?? ''); ?>
                    </span>

                </div>


                <div class="loader-flight-path">

                    <div class="loader-plane">

                        <i class="fa-solid fa-plane"></i>

                    </div>

                </div>


                <div class="loader-airport">

                    <span class="loader-airport-code">
                        <?php echo htmlspecialchars($destination); ?>
                    </span>

                    <span class="loader-airport-label">
                        <?php echo htmlspecialchars($airport_to['City'] ?? ''); ?>
                    </span>

                </div>

            </div>


            <!-- MESSAGE -->

            <h2 class="flight-loader-title">
                Searching for the best flights
            </h2>


            <p
                class="flight-loader-subtitle"
                id="loaderStatus"
            >
                Checking available fares for your journey...
            </p>


            <!-- PROGRESS -->

            <div class="loader-progress">

                <div class="loader-progress-bar"></div>

            </div>


            <div class="loader-status">

                Please wait while we find the best available options

            </div>

        </div>

    </div>

</div>
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


<!-- =========================================================
     HERO
========================================================== -->

<section class="results-hero">

    <div class="container results-hero-content">

        <h1>Flight Search Results</h1>

        <div class="results-hero-subtitle">

            Find the best available fares for your journey.

        </div>

    </div>

</section>



<!-- =========================================================
     SEARCH SUMMARY
========================================================== -->

<section class="search-summary">

    <div class="container">

        <div class="search-summary-card">

            <div class="row align-items-center">

                <div class="col-lg-5">

                    <div class="summary-route">

                        <div class="summary-airport">

                            <div class="summary-airport-code">
                                <?php echo htmlspecialchars($source); ?>
                            </div>

                            <div class="summary-city">
                                <?php
                                echo htmlspecialchars(
                                    $airport_from['City'] ?? ''
                                );
                                ?>
                            </div>

                        </div>


                        <div class="summary-arrow">

                            <i class="fa-solid fa-plane"></i>

                        </div>


                        <div class="summary-airport">

                            <div class="summary-airport-code">
                                <?php echo htmlspecialchars($destination); ?>
                            </div>

                            <div class="summary-city">
                                <?php
                                echo htmlspecialchars(
                                    $airport_to['City'] ?? ''
                                );
                                ?>
                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-lg-5">

                    <div class="row summary-info">

                        <div class="col-6">

                            <span class="summary-label">
                                Departure
                            </span>

                            <span class="summary-value">
                                <?php echo $display_start; ?>
                            </span>

                        </div>


                        <div class="col-6">

                            <span class="summary-label">
                                Return
                            </span>

                            <span class="summary-value">
                                <?php echo $display_end; ?>
                            </span>

                        </div>


                        <div class="col-6 mt-3">

                            <span class="summary-label">
                                Travellers
                            </span>

                            <span class="summary-value">
                                <?php echo $adult; ?>
                                Adult<?php echo $adult > 1 ? 's' : ''; ?>

                                <?php if ($child > 0): ?>
                                    , <?php echo $child; ?>
                                    Child<?php echo $child > 1 ? 'ren' : ''; ?>
                                <?php endif; ?>
                            </span>

                        </div>


                        <div class="col-6 mt-3">

                            <span class="summary-label">
                                Cabin
                            </span>

                            <span class="summary-value">
                                <?php echo $printclass; ?>
                            </span>

                        </div>

                    </div>

                </div>


                <div class="col-lg-2 summary-action text-lg-end">

                    <button
                        type="button"
                        class="modify-search-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#modifySearchModal"
                    >

                        <i class="fa-solid fa-sliders me-1"></i>

                        Modify Search

                    </button>

                </div>

            </div>

        </div>

    </div>

</section>



<!-- =========================================================
     RESULTS
========================================================== -->

<section class="results-section">

    <div class="container">

        <div class="row g-4">


            <!-- =================================================
                 FILTERS
            ================================================== -->

            <div class="col-lg-3 d-none d-lg-block">

                <div class="filter-card">

                    <div class="filter-header">

                        <i class="fa-solid fa-filter me-2"></i>

                        Filter Flights

                    </div>


                    <div class="filter-body">


                        <!-- STOPS -->

                        <div class="filter-title">
                            Stops
                        </div>


                        <label class="filter-option">

                            <span class="filter-option-left">

                                <input
                                    type="checkbox"
                                    class="stop-filter"
                                    value="0"
                                >

                                Non-Stop

                            </span>

                        </label>


                        <label class="filter-option">

                            <span class="filter-option-left">

                                <input
                                    type="checkbox"
                                    class="stop-filter"
                                    value="1"
                                >

                                1 Stop

                            </span>

                        </label>


                        <label class="filter-option">

                            <span class="filter-option-left">

                                <input
                                    type="checkbox"
                                    class="stop-filter"
                                    value="2"
                                >

                                2 Stops

                            </span>

                        </label>


                        <label class="filter-option">

                            <span class="filter-option-left">

                                <input
                                    type="checkbox"
                                    class="stop-filter"
                                    value="3"
                                >

                                3 Stops

                            </span>

                        </label>


                        <hr class="filter-divider">


                        <!-- AIRLINES -->

                        <div class="filter-title">
                            Airlines
                        </div>


                        <?php

                        $airlines_filter = [];

                        if ($flights_result && $flights_result->num_rows > 0) {

                            while ($filter_flight = $flights_result->fetch_assoc()) {

                                $airline_code = $filter_flight['airline'];

                                if (!isset($airlines_filter[$airline_code])) {

                                    $airline_query = mysqli_query(
                                        $conn,
                                        "SELECT * FROM airlines
                                         WHERE Airline_Code = '" .
                                        mysqli_real_escape_string(
                                            $conn,
                                            $airline_code
                                        ) .
                                        "' LIMIT 1"
                                    );

                                    $airline_info = mysqli_fetch_assoc(
                                        $airline_query
                                    );

                                    $airlines_filter[$airline_code] =
                                        $airline_info['Airline_Name']
                                        ?? $airline_code;
                                }

                            }

                            /*
                             * Reset pointer for card loop.
                             */
                            mysqli_data_seek($flights_result, 0);
                        }


                        foreach ($airlines_filter as $code => $name):

                        ?>

                            <label class="filter-option">

                                <span class="filter-option-left">

                                    <input
                                        type="checkbox"
                                        class="airline-filter"
                                        value="<?php echo htmlspecialchars($code); ?>"
                                    >

                                    <?php echo htmlspecialchars($name); ?>

                                </span>

                            </label>

                        <?php endforeach; ?>


                    </div>

                </div>

            </div>



            <!-- =================================================
                 FLIGHT LIST
            ================================================== -->

            <div class="col-lg-9">


                <!-- TOP BAR -->

                <div class="results-topbar">

                    <div class="results-count">

                        Showing
                        <strong id="visibleFlightCount">
                            <?php
                            echo $flights_result
                                ? $flights_result->num_rows
                                : 0;
                            ?>
                        </strong>

                        flight option(s)

                    </div>


                    <select
                        id="sortFlights"
                        class="sort-select"
                    >

                        <option value="low">
                            Price: Low to High
                        </option>

                        <option value="high">
                            Price: High to Low
                        </option>

                    </select>

                </div>



                <!-- FLIGHT CARDS -->

                <div id="flightResults">


                <?php

                if ($flights_result && $flights_result->num_rows > 0):

                    while ($flight = $flights_result->fetch_assoc()):

                        $airline_code = $flight['airline'];

                        $airline_query = mysqli_query(
                            $conn,
                            "SELECT * FROM airlines
                             WHERE Airline_Code = '" .
                            mysqli_real_escape_string(
                                $conn,
                                $airline_code
                            ) .
                            "' LIMIT 1"
                        );

                        $airline_data = mysqli_fetch_assoc(
                            $airline_query
                        );


                        $airline_name =
                            $airline_data['Airline_Name']
                            ?? $airline_code;


                        $logo =
                            !empty($flight['logo'])
                            ? 'backend/uploads/' . $flight['logo']
                            : 'assets/logo.png';


                        $stops = getStops($flight);

                        $stop_count = getStopCount($flight);

                        $route_text = getRouteText($flight);

                ?>


                    <div
                        class="flight-card"
                        data-price="<?php echo (float)$flight['adult_fare']; ?>"
                        data-stops="<?php echo $stop_count; ?>"
                        data-airline="<?php echo htmlspecialchars($airline_code); ?>"
                    >


                        <!-- CARD HEADER -->

                        <div class="flight-card-header">


                            <div class="airline-info">

                                <img
                                    src="<?php echo htmlspecialchars($logo); ?>"
                                    alt="<?php echo htmlspecialchars($airline_name); ?>"
                                    class="airline-logo"
                                >


                                <div>

                                    <div class="airline-name">

                                        <?php
                                        echo htmlspecialchars(
                                            $airline_name
                                        );
                                        ?>

                                    </div>


                                    <div class="airline-class">

                                        <?php echo $printclass; ?>
                                        &nbsp; • &nbsp;
                                        Return Fare

                                    </div>

                                </div>

                            </div>


                            <div class="flight-badge">

                                <i class="fa-solid fa-check me-1"></i>

                                Available

                            </div>

                        </div>



                        <!-- CARD BODY -->

                        <div class="flight-card-body">


                            <!-- OUTBOUND -->

                            <div class="flight-row">


                                <div class="flight-location">

                                    <div class="airport-code">
                                        <?php echo htmlspecialchars($source); ?>
                                    </div>

                                    <div class="airport-name">

                                        <?php
                                        echo htmlspecialchars(
                                            $airport_from['City'] ?? ''
                                        );
                                        ?>

                                    </div>

                                </div>


                                <div class="route-middle">

                                    <div class="route-line">

                                        <span class="route-plane">

                                            <i class="fa-solid fa-plane"></i>

                                        </span>

                                    </div>

                                    <div class="route-text">

                                        <?php
                                        echo htmlspecialchars($route_text);
                                        ?>

                                    </div>

                                </div>


                                <div class="stops-text">

                                    <?php echo htmlspecialchars($stops); ?>

                                </div>


                                <div class="route-middle">

                                    <div class="route-line">

                                        <span class="route-plane">

                                            <i class="fa-solid fa-plane"></i>

                                        </span>

                                    </div>

                                    <div class="route-text">

                                        <?php echo $display_start; ?>

                                    </div>

                                </div>


                                <div class="flight-location">

                                    <div class="airport-code">
                                        <?php echo htmlspecialchars($destination); ?>
                                    </div>

                                    <div class="airport-name">

                                        <?php
                                        echo htmlspecialchars(
                                            $airport_to['City'] ?? ''
                                        );
                                        ?>

                                    </div>

                                </div>


                            </div>



                            <!-- RETURN -->

                            <div class="flight-row">


                                <div class="flight-location">

                                    <div class="airport-code">
                                        <?php echo htmlspecialchars($destination); ?>
                                    </div>

                                    <div class="airport-name">

                                        <?php
                                        echo htmlspecialchars(
                                            $airport_to['City'] ?? ''
                                        );
                                        ?>

                                    </div>

                                </div>


                                <div class="route-middle">

                                    <div class="route-line">

                                        <span class="route-plane">

                                            <i
                                                class="fa-solid fa-plane"
                                                style="transform:rotate(180deg)"
                                            ></i>

                                        </span>

                                    </div>

                                    <div class="route-text">

                                        <?php
                                        echo htmlspecialchars(
                                            $route_text
                                        );
                                        ?>

                                    </div>

                                </div>


                                <div class="stops-text">

                                    <?php echo htmlspecialchars($stops); ?>

                                </div>


                                <div class="route-middle">

                                    <div class="route-line">

                                        <span class="route-plane">

                                            <i
                                                class="fa-solid fa-plane"
                                                style="transform:rotate(180deg)"
                                            ></i>

                                        </span>

                                    </div>

                                    <div class="route-text">

                                        <?php echo $display_end; ?>

                                    </div>

                                </div>


                                <div class="flight-location">

                                    <div class="airport-code">
                                        <?php echo htmlspecialchars($source); ?>
                                    </div>

                                    <div class="airport-name">

                                        <?php
                                        echo htmlspecialchars(
                                            $airport_from['City'] ?? ''
                                        );
                                        ?>

                                    </div>

                                </div>


                            </div>


                        </div>



                        <!-- CARD FOOTER -->

                        <div class="flight-card-footer">


                            <div class="price-area">

                                <span class="price-label">
                                    From
                                </span>

                                <span class="price">

                                    £<?php
                                    echo number_format(
                                        (float)$flight['adult_fare'],
                                        2
                                    );
                                    ?>

                                </span>

                                <span class="price-per">
                                    /pp
                                </span>


                                <div class="phone-offer">

                                    Phone only offer

                                </div>

                            </div>



                            <a
                                href="flight-enquiry.php?flight=<?php echo urlencode($flight['id']); ?>&up=<?php echo urlencode($start_date); ?>&down=<?php echo urlencode($end_date); ?>"
                                class="btn-enquire"
                            >

                                <i class="fa-regular fa-paper-plane me-1"></i>

                                Enquire Now

                            </a>


                            <a
                                href="tel:02031375177"
                                class="btn-call"
                            >

                                <i class="fa-solid fa-phone me-1"></i>

                                Call Now

                            </a>


                        </div>


                    </div>


                <?php

                    endwhile;

                else:

                ?>

                    <div class="no-results">

                        <i class="fa-solid fa-plane-circle-exclamation"></i>

                        <h4>
                            No flights found
                        </h4>

                        <p class="text-muted mb-3">

                            We couldn't find flights matching your search.

                        </p>

                        <button
                            type="button"
                            class="modify-search-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#modifySearchModal"
                        >

                            Modify Search

                        </button>

                    </div>

                <?php endif; ?>


                </div>


                <div class="mt-3">

                    <p class="small text-muted mb-1">

                        * The price was updated within the last 24 hours
                        and is subject to availability.

                    </p>

                    <p class="small text-danger">

                        <strong>Note:</strong>
                        Due to constant changes in availability,
                        fares may not be available on the selected dates.

                    </p>

                </div>


            </div>

        </div>

    </div>

</section>



<!-- =========================================================
     MODIFY SEARCH MODAL
========================================================== -->

<div
    class="modal fade modify-modal"
    id="modifySearchModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header">

                <div>

                    <h5 class="modal-title">

                        Modify Your Search

                    </h5>

                    <small style="opacity:.7">

                        Update your flight details

                    </small>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>



            <form
                action="flight-search.php"
                method="get"
            >

                <div class="modal-body">

                    <div class="row g-3">


                        <!-- ORIGIN -->

                        <div class="col-md-6">

                            <div class="modify-field">

                                <label>
                                    From
                                </label>

                                <select
                                    name="origin"
                                    id="modifyOrigin"
                                    required
                                >

                                    <option value="">
                                        Select Origin
                                    </option>

                                    <?php

                                    $result_airports->data_seek(0);

                                    while ($airport = $result_airports->fetch_assoc()):

                                    ?>

                                        <option
                                            value="<?php echo htmlspecialchars($airport['Airport_Code']); ?>"
                                            <?php
                                            echo $airport['Airport_Code'] === $source
                                                ? 'selected'
                                                : '';
                                            ?>
                                        >

                                            <?php
                                            echo htmlspecialchars(
                                                $airport['Airport_Name']
                                            );
                                            ?>

                                            (<?php
                                            echo htmlspecialchars(
                                                $airport['Airport_Code']
                                            );
                                            ?>)

                                        </option>

                                    <?php endwhile; ?>

                                </select>

                            </div>

                        </div>



                        <!-- DESTINATION -->

                        <div class="col-md-6">

                            <div class="modify-field">

                                <label>
                                    To
                                </label>

                                <select
                                    name="destination"
                                    id="modifyDestination"
                                    required
                                >

                                    <option value="">
                                        Select Destination
                                    </option>

                                    <?php

                                    $result_airports->data_seek(0);

                                    while ($airport = $result_airports->fetch_assoc()):

                                    ?>

                                        <option
                                            value="<?php echo htmlspecialchars($airport['Airport_Code']); ?>"
                                            <?php
                                            echo $airport['Airport_Code'] === $destination
                                                ? 'selected'
                                                : '';
                                            ?>
                                        >

                                            <?php
                                            echo htmlspecialchars(
                                                $airport['Airport_Name']
                                            );
                                            ?>

                                            (<?php
                                            echo htmlspecialchars(
                                                $airport['Airport_Code']
                                            );
                                            ?>)

                                        </option>

                                    <?php endwhile; ?>

                                </select>

                            </div>

                        </div>



                        <!-- START DATE -->

                        <div class="col-md-6">

                            <div class="modify-field">

                                <label>
                                    Depart Date
                                </label>

                                <input
                                    type="text"
                                    id="modifyStartDateDisplay"
                                    value="<?php echo $start_date; ?>"
                                    readonly
                                >

                                <input
                                    type="hidden"
                                    name="startDate"
                                    id="modifyStartDate"
                                    value="<?php echo $start_date; ?>"
                                >

                            </div>

                        </div>



                        <!-- END DATE -->

                        <div class="col-md-6">

                            <div class="modify-field">

                                <label>
                                    Return Date
                                </label>

                                <input
                                    type="text"
                                    id="modifyEndDateDisplay"
                                    value="<?php echo $end_date; ?>"
                                    readonly
                                >

                                <input
                                    type="hidden"
                                    name="endDate"
                                    id="modifyEndDate"
                                    value="<?php echo $end_date; ?>"
                                >

                            </div>

                        </div>



                        <!-- ADULT -->

                        <div class="col-md-4">

                            <div class="modify-field">

                                <label>
                                    Adults
                                </label>

                                <select name="adult">

                                    <?php for ($i = 1; $i <= 10; $i++): ?>

                                        <option
                                            value="<?php echo $i; ?>"
                                            <?php
                                            echo $adult == $i
                                                ? 'selected'
                                                : '';
                                            ?>
                                        >

                                            <?php echo $i; ?>
                                            Adult<?php echo $i > 1 ? 's' : ''; ?>

                                        </option>

                                    <?php endfor; ?>

                                </select>

                            </div>

                        </div>



                        <!-- CHILD -->

                        <div class="col-md-4">

                            <div class="modify-field">

                                <label>
                                    Child
                                </label>

                                <select name="child">

                                    <?php for ($i = 0; $i <= 10; $i++): ?>

                                        <option
                                            value="<?php echo $i; ?>"
                                            <?php
                                            echo $child == $i
                                                ? 'selected'
                                                : '';
                                            ?>
                                        >

                                            <?php echo $i; ?>

                                            Child<?php echo $i != 1 ? 'ren' : ''; ?>

                                        </option>

                                    <?php endfor; ?>

                                </select>

                            </div>

                        </div>



                        <!-- CLASS -->

                        <div class="col-md-4">

                            <div class="modify-field">

                                <label>
                                    Class
                                </label>

                                <select name="class">

                                    <option
                                        value="1"
                                        <?php echo $class == 1 ? 'selected' : ''; ?>
                                    >
                                        Economy
                                    </option>

                                    <option
                                        value="4"
                                        <?php echo $class == 4 ? 'selected' : ''; ?>
                                    >
                                        Premium Economy
                                    </option>

                                    <option
                                        value="2"
                                        <?php echo $class == 2 ? 'selected' : ''; ?>
                                    >
                                        Business
                                    </option>

                                    <option
                                        value="3"
                                        <?php echo $class == 3 ? 'selected' : ''; ?>
                                    >
                                        First Class
                                    </option>

                                </select>

                            </div>

                        </div>



                        <div class="col-12 mt-4">

                            <button
                                type="submit"
                                class="modify-submit"
                            >

                                <i class="fa-solid fa-magnifying-glass me-2"></i>

                                Search Flights

                            </button>

                        </div>


                    </div>

                </div>

            </form>

        </div>

    </div>

</div>



<!-- =========================================================
     FOOTER
========================================================== -->

<?php include('_footer.php'); ?>



<!-- =========================================================
     SCRIPTS
========================================================== -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
></script>

<script
    src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"
></script>

<script
    src="https://cdn.jsdelivr.net/npm/flatpickr"
></script>



<script>

    // FLIGHT SEARCH LOADER
    (function () {

        const loader =
            document.getElementById('flightSearchLoader');

        const status =
            document.getElementById('loaderStatus');


        if (!loader) {
            return;
        }


        const messages = [

            'Checking available fares for your journey...',

            'Searching airlines and flight schedules...',

            'Comparing the best available prices...',

            'Finding the most suitable options for you...',

            'Almost there — preparing your flight results...'

        ];


        let messageIndex = 0;


        /* -----------------------------------------------------
        CHANGE STATUS MESSAGE
        ----------------------------------------------------- */

        const messageInterval = setInterval(function () {

            messageIndex++;

            if (messageIndex >= messages.length) {
                messageIndex = messages.length - 1;
            }


            if (status) {

                status.style.opacity = '0';


                setTimeout(function () {

                    status.textContent =
                        messages[messageIndex];

                    status.style.opacity = '1';

                }, 180);

            }

        }, 600);


        /* -----------------------------------------------------
        HIDE AFTER 3 SECONDS
        ----------------------------------------------------- */

        setTimeout(function () {

            clearInterval(messageInterval);

            loader.classList.add('is-hidden');


            setTimeout(function () {

                loader.remove();

            }, 500);

        }, 3000);

    })();

    $(document).ready(function () {


        /* =====================================================
        SELECT2
        ====================================================== */

        $('#modifyOrigin, #modifyDestination').select2({

            dropdownParent: $('#modifySearchModal'),

            width: '100%',

            placeholder: 'Select airport'

        });



        /* =====================================================
        DATE PICKERS
        ====================================================== */

        const startPicker = flatpickr(
            '#modifyStartDateDisplay',
            {

                dateFormat: 'Y-m-d',

                minDate: 'today',

                defaultDate:
                    '<?php echo $start_date; ?>',

                onChange: function (
                    selectedDates,
                    dateStr
                ) {

                    $('#modifyStartDate').val(
                        dateStr
                    );

                    endPicker.set(
                        'minDate',
                        new Date(
                            selectedDates[0].getTime()
                            + 86400000
                        )
                    );

                }

            }
        );


        const endPicker = flatpickr(
            '#modifyEndDateDisplay',
            {

                dateFormat: 'Y-m-d',

                minDate:
                    '<?php echo $end_date; ?>',

                defaultDate:
                    '<?php echo $end_date; ?>',

                onChange: function (
                    selectedDates,
                    dateStr
                ) {

                    $('#modifyEndDate').val(
                        dateStr
                    );

                }

            }
        );



        /* =====================================================
        SORT FLIGHTS
        ====================================================== */

        $('#sortFlights').on(
            'change',
            function () {

                const sortValue = $(this).val();

                const cards =
                    $('.flight-card').get();

                cards.sort(function (a, b) {

                    const priceA =
                        parseFloat(
                            $(a).data('price')
                        );

                    const priceB =
                        parseFloat(
                            $(b).data('price')
                        );

                    if (sortValue === 'high') {

                        return priceB - priceA;

                    }

                    return priceA - priceB;

                });


                $.each(
                    cards,
                    function (_, card) {

                        $('#flightResults')
                            .append(card);

                    }
                );

                applyFilters();

            }
        );



        /* =====================================================
        FILTERS
        ====================================================== */

        $('.stop-filter, .airline-filter')
            .on(
                'change',
                function () {

                    applyFilters();

                }
            );



        function applyFilters() {

            const selectedStops =
                $('.stop-filter:checked')
                    .map(function () {

                        return $(this).val();

                    })
                    .get();


            const selectedAirlines =
                $('.airline-filter:checked')
                    .map(function () {

                        return $(this).val();

                    })
                    .get();


            let visibleCount = 0;


            $('.flight-card').each(
                function () {

                    const card =
                        $(this);


                    const stops =
                        String(
                            card.data('stops')
                        );


                    const airline =
                        String(
                            card.data('airline')
                        );


                    const stopMatch =
                        selectedStops.length === 0 ||
                        selectedStops.includes(stops);


                    const airlineMatch =
                        selectedAirlines.length === 0 ||
                        selectedAirlines.includes(airline);


                    if (
                        stopMatch &&
                        airlineMatch
                    ) {

                        card.show();

                        visibleCount++;

                    } else {

                        card.hide();

                    }

                }
            );


            $('#visibleFlightCount')
                .text(visibleCount);

        }


    });

</script>


</body>

</html>