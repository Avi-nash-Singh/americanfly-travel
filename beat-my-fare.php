    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Beat My Fare | American Fly</title>

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
                        
            /* ============================================
            BEAT MY FARE FORM
            ============================================ */

            .bmf-section {
                padding: 65px 0 75px;
                background: #f5f7fa;
                font-family: var(--fontPrimary);
            }

            .bmf-heading {
                max-width: 750px;
                margin: 0 auto 38px;
            }

            .bmf-eyebrow {
                display: inline-block;
                color: var(--primaryLight);
                font-size: 13px;
                font-weight: 700;
                letter-spacing: 2px;
                margin-bottom: 10px;
            }

            .bmf-heading h2 {
                color: var(--primaryColor);
                font-size: 34px;
                font-weight: 800;
                margin-bottom: 12px;
            }

            .bmf-heading p {
                color: #6c757d;
                font-size: 15px;
                line-height: 1.7;
                margin: 0;
            }

            .bmf-form-card {
                max-width: 1050px;
                margin: 0 auto;
                padding: 38px;
                background: #fff;
                border-radius: 14px;
                border: 1px solid #e9edf2;
                box-shadow: 0 8px 30px rgba(30, 49, 70, 0.07);
            }

            .bmf-form-header {
                display: flex;
                align-items: center;
                gap: 15px;
                padding-bottom: 25px;
                margin-bottom: 30px;
                border-bottom: 1px solid #edf0f3;
            }

            .bmf-form-header-icon {
                width: 52px;
                height: 52px;
                min-width: 52px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: var(--primaryColor);
                color: #fff;
                border-radius: 10px;
                font-size: 21px;
            }

            .bmf-form-header h3 {
                font-size: 21px;
                font-weight: 750;
                color: var(--primaryColor);
                margin: 0 0 5px;
            }

            .bmf-form-header p {
                font-size: 13px;
                color: #777;
                margin: 0;
            }

            .bmf-field {
                width: 100%;
            }

            .bmf-field label {
                display: block;
                font-size: 14px;
                font-weight: 650;
                color: #26384a;
                margin-bottom: 9px;
            }

            .bmf-field label span {
                color: #dc3545;
            }

            .bmf-input-wrap {
                position: relative;
                display: flex;
                align-items: center;
            }

            .bmf-input-wrap > i {
                position: absolute;
                left: 15px;
                color: #8492a0;
                font-size: 14px;
                pointer-events: none;
            }

            .bmf-input-wrap input,
            .bmf-input-wrap select {
                width: 100%;
                height: 49px;
                padding: 10px 14px 10px 43px;
                border: 1px solid #dce2e8;
                border-radius: 7px;
                outline: none;
                background-color: #fff;
                color: #26384a;
                font-family: var(--fontPrimary);
                font-size: 14px;
                transition: var(--transitionFast);
            }

            .bmf-input-wrap input::placeholder {
                color: #a4adb6;
            }

            .bmf-input-wrap input:focus,
            .bmf-input-wrap select:focus {
                border-color: var(--primaryColor);
                box-shadow: 0 0 0 3px rgba(30, 49, 70, 0.09);
            }

            .bmf-input-wrap select {
                cursor: pointer;
                appearance: auto;
            }

            .bmf-consent {
                display: flex;
                align-items: flex-start;
                gap: 10px;
                margin-top: 30px;
            }

            .bmf-consent input {
                margin-top: 4px;
                accent-color: var(--primaryColor);
                cursor: pointer;
            }

            .bmf-consent label {
                color: #66717d;
                font-size: 13px;
                line-height: 1.6;
                cursor: pointer;
            }

            .bmf-submit-wrap {
                text-align: center;
                margin-top: 28px;
            }

            .bmf-submit-btn {
                min-width: 220px;
                min-height: 50px;
                padding: 12px 28px;
                border: none;
                border-radius: 7px;
                background: var(--primaryColor);
                color: #fff;
                font-size: 15px;
                font-weight: 700;
                cursor: pointer;
                transition: var(--transitionNormal);
            }

            .bmf-submit-btn:hover:not(:disabled) {
                background: #730000;
                transform: translateY(-2px);
            }

            .bmf-submit-btn i {
                margin-right: 8px;
            }

            .bmf-submit-btn:disabled {
                opacity: 0.7;
                cursor: not-allowed;
                transform: none;
            }

            .bmf-secure-note {
                text-align: center;
                color: #89939d;
                font-size: 12px;
                margin: 14px 0 0;
            }

            .bmf-secure-note i {
                margin-right: 5px;
                color: #29966b;
            }

            .bmf-form-status {
                display: none;
                text-align: center;
                font-size: 13px;
                margin: 18px 0 0;
                color: #26384a;
            }

            .bmf-form-status:not(:empty) {
                display: block;
            }

            /* Honeypot */
            .bmf-honeypot {
                position: absolute !important;
                left: -10000px !important;
                top: auto !important;
                width: 1px !important;
                height: 1px !important;
                overflow: hidden !important;
            }

            /* Flatpickr */
            .bmf-section .flatpickr-calendar {
                border-radius: 9px;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            }

            .bmf-section .flatpickr-day.selected,
            .bmf-section .flatpickr-day.startRange,
            .bmf-section .flatpickr-day.endRange {
                background: var(--primaryColor);
                border-color: var(--primaryColor);
            }

            .bmf-section .flatpickr-day.today {
                border-color: var(--primaryLight);
            }

            /* Responsive */
            @media (max-width: 767px) {
                .bmf-section {
                    padding: 45px 0;
                }

                .bmf-heading h2 {
                    font-size: 27px;
                }

                .bmf-form-card {
                    padding: 23px 17px;
                }

                .bmf-form-header h3 {
                    font-size: 18px;
                }

                .bmf-submit-btn {
                    width: 100%;
                }
            }

        </style>
    </head>

    <body>
        <!-- (Header + Navbar) -->
        <?php include('_nav.php'); ?>

        <!-- ============================================
            BEAT MY FARE BANNER
            ============================================ -->
        <section class="about-banner">
        <img
            src="assets/banner/beatmyfare.png"
            alt="About Us Banner"
            class="about-banner__bg-image"
        />
        <div class="about-banner__overlay"></div>
        <div class="about-banner__content">
            <h1 class="about-banner__title">Beat My Fare</h1>
            <nav class="about-banner__breadcrumb">
            <a href="index.php" class="about-banner__breadcrumb-link">Home</a>
            <span class="about-banner__breadcrumb-separator">›</span>
            <span class="about-banner__breadcrumb-current">Beat My Fare</span>
            </nav>
        </div>
        </section>

                
        <!-- ============================================
            BEAT MY FARE ENQUIRY FORM
        ============================================ -->
        <section class="bmf-section">
            <div class="container">

                <!-- <div class="bmf-heading text-center">
                    <span class="bmf-eyebrow">AMERICAN FLY SPECIAL FARES</span>
                    <h2>Let Us Beat Your Flight Fare</h2>
                    <p>
                        Share your travel details and the fare you have received.
                        Our flight specialists will try to find you a better deal.
                    </p>
                </div> -->

                <div class="bmf-form-card">

                    <div class="bmf-form-header">
                        <div class="bmf-form-header-icon">
                            <i class="fa-solid fa-plane-departure"></i>
                        </div>
                        <div>
                            <h3>Request Your Best Fare</h3>
                            <p>Fill in the details below to get started.</p>
                        </div>
                    </div>

                    <?php
                        $form_name = 'Beat My Fare';
                    ?>

                    <form
                        method="post"
                        action="https://script.google.com/macros/s/AKfycbylLx1ziaTlcCnzoG6MkCYfnjh7cF12VbZf9h2OE2gZmoAm0xH6KK6dqyoeDE91fwM/exec"
                        target="googleSheetResponseFrame"
                        id="beatMyFareForm"
                        novalidate
                    >

                        <!-- Google Sheets fields -->
                        <input type="hidden" name="formGoogleSheetName"
                            value="AmericanFly Lead Sheet">

                        <input type="hidden" name="formName"
                            value="Beat My Fare Inquiry">

                        <input type="hidden" name="page_url" id="bmf_page_url" value="">

                        <!-- Honeypot -->
                        <div aria-hidden="true"
                            class="bmf-honeypot">
                            <label for="bmf_website">Leave this field empty</label>
                            <input
                                type="text"
                                id="bmf_website"
                                name="honeypot"
                                tabindex="-1"
                                autocomplete="off"
                            >
                        </div>

                        <div class="row g-4">

                            <!-- Name -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="bmf-field">
                                    <label for="bmf_name">
                                        Your Name <span>*</span>
                                    </label>
                                    <div class="bmf-input-wrap">
                                        <i class="fa-solid fa-user"></i>
                                        <input
                                            type="text"
                                            id="bmf_name"
                                            name="first_name"
                                            placeholder="Enter your full name"
                                            autocomplete="name"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="bmf-field">
                                    <label for="bmf_email">
                                        Email Address <span>*</span>
                                    </label>
                                    <div class="bmf-input-wrap">
                                        <i class="fa-solid fa-envelope"></i>
                                        <input
                                            type="email"
                                            id="bmf_email"
                                            name="email"
                                            placeholder="Enter your email"
                                            autocomplete="email"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>

                            <!-- Contact -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="bmf-field">
                                    <label for="bmf_phone">
                                        Contact Number <span>*</span>
                                    </label>
                                    <div class="bmf-input-wrap">
                                        <i class="fa-solid fa-phone"></i>
                                        <input
                                            type="tel"
                                            id="bmf_phone"
                                            name="phone"
                                            placeholder="Enter contact number"
                                            autocomplete="tel"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>

                            <!-- Destination -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="bmf-field">
                                    <label for="bmf_destination">
                                        Destination <span>*</span>
                                    </label>
                                    <div class="bmf-input-wrap">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <input
                                            type="text"
                                            id="bmf_destination"
                                            name="destination"
                                            placeholder="Where are you travelling?"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>

                            
                            <!-- Departure Date -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="bmf-field">
                                    <label for="bmf_departure">
                                        Departure Date <span>*</span>
                                    </label>

                                    <div class="bmf-input-wrap">
                                        <i class="fa-regular fa-calendar"></i>
                                        <input
                                            type="text"
                                            id="bmf_departure"
                                            name="start_date"
                                            placeholder="Select departure date"
                                            autocomplete="off"
                                            required
                                            readonly
                                        >
                                    </div>
                                </div>
                            </div>

                            <!-- Return Date -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="bmf-field">
                                    <label for="bmf_return">
                                        Return Date <span>*</span>
                                    </label>

                                    <div class="bmf-input-wrap">
                                        <i class="fa-regular fa-calendar-check"></i>
                                        <input
                                            type="text"
                                            id="bmf_return"
                                            name="end_date"
                                            placeholder="Select return date"
                                            autocomplete="off"
                                            required
                                            readonly
                                        >
                                    </div>
                                </div>
                            </div>

                            <!-- Adults -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="bmf-field">
                                    <label for="bmf_adults">
                                        Number of Adults <span>*</span>
                                    </label>
                                    <div class="bmf-input-wrap">
                                        <i class="fa-solid fa-users"></i>
                                        <select
                                            id="bmf_adults"
                                            name="adult(s)"
                                            required
                                        >
                                            <option value="1" selected>1 Adult</option>
                                            <option value="2">2 Adults</option>
                                            <option value="3">3 Adults</option>
                                            <option value="4">4 Adults</option>
                                            <option value="5">5 Adults</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Adult Quote -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="bmf-field">
                                    <label for="bmf_quote">
                                        Adult Quote <span>*</span>
                                    </label>
                                    <div class="bmf-input-wrap">
                                        <i class="fa-solid fa-sterling-sign"></i>
                                        <input
                                            type="text"
                                            id="bmf_quote"
                                            name="adult_quote"
                                            placeholder="Enter your current fare"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Consent -->
                        <div class="bmf-consent">
                            <input
                                type="checkbox"
                                id="bmf_consent"
                                name="contact_consent"
                                value="yes"
                                required
                                checked
                            >
                            <label for="bmf_consent">
                                I agree to be contacted by an American Fly specialist
                                via phone, email, or WhatsApp regarding this enquiry. *
                            </label>
                        </div>

                        <!-- Status -->
                        <p
                            id="bmf_form_status"
                            class="bmf-form-status"
                            role="status"
                            aria-live="polite"
                        ></p>

                        <!-- Submit -->
                        <div class="bmf-submit-wrap">
                            <button
                                type="submit"
                                class="bmf-submit-btn"
                                id="bmf_submit"
                            >
                                <i class="fa-solid fa-paper-plane"></i>
                                <span>Beat My Fare</span>
                            </button>
                        </div>

                        <p class="bmf-secure-note">
                            <i class="fa-solid fa-lock"></i>
                            Your information is safe and secure with us.
                        </p>

                    </form>

                </div>
            </div>
        </section>


        <!-- ============================================
            FLIGHT SPECIALISTS CTA
        ============================================ -->
        <section class="py-5 bg-white">
            <div class="container">
                <div class="dest-concierge-cta">
                    <div class="row align-items-center g-4">

                        <div class="col-12 col-lg-7">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <img
                                    src="assets/cards/ny.png"
                                    alt="Flight Specialist"
                                    class="concierge-agent-avatar"
                                >
                                <div>
                                    <h4 class="m-0 fw-bold text-white">
                                        Dedicated Flight Specialists On Call
                                    </h4>
                                    <span class="small text-info">
                                        Competitive fares & exclusive flight deals
                                    </span>
                                </div>
                            </div>

                            <h2 class="fw-bold text-white mb-2">
                                Need Help Finding a Better Flight Deal?
                            </h2>

                            <p class="text-white-50 m-0"
                            style="font-size:0.95rem;line-height:1.6;">
                                Let our experienced flight specialists help you
                                find competitive airfares, flexible travel options
                                and exclusive deals tailored to your journey.
                            </p>
                        </div>

                        <div class="col-12 col-lg-5 text-lg-end">
                            <div class="d-flex flex-column flex-sm-row
                                        justify-content-lg-end gap-3">

                                <a href="tel:02031375177"
                                class="dest-cta-btn-call">
                                    <i class="fa-solid fa-phone"></i>
                                    <span>0203 137 5177</span>
                                </a>

                                <a href="https://wa.me/447446512247"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="dest-cta-btn-whatsapp">
                                    <i class="fa-brands fa-whatsapp fs-5"></i>
                                    <span>WhatsApp Quote</span>
                                </a>

                            </div>

                            <div class="mt-3 text-white-50 small">
                                <i class="fa-solid fa-clock me-1 text-info"></i>
                                Speak with our specialists today
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>


        <!-- Hidden iframe for Google Apps Script -->
        <iframe
            name="googleSheetResponseFrame"
            id="googleSheetResponseFrame"
            title="Form submission response"
            style="display:none;"
        ></iframe>


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
            (function () {

                const form = document.getElementById('beatMyFareForm');

                if (!form) return;

                const honeypot = document.getElementById('bmf_website');
                const pageUrl = document.getElementById('bmf_page_url');
                const status = document.getElementById('bmf_form_status');
                const submitButton = document.getElementById('bmf_submit');
                const responseFrame = document.getElementById('googleSheetResponseFrame');

                const originalButtonText = 'Beat My Fare';

                let submitting = false;
                let submissionStarted = false;
                let redirectTimer = null;

                // Capture current page URL
                pageUrl.value = window.location.href;

                // Initialize return date picker first
                const returnPicker = flatpickr('#bmf_return', {
                    dateFormat: 'd M Y',
                    minDate: 'today',
                    allowInput: false,
                    disableMobile: true
                });

                // Initialize departure date picker
                const departurePicker = flatpickr('#bmf_departure', {
                    dateFormat: 'd M Y',
                    minDate: 'today',
                    allowInput: false,
                    disableMobile: true,

                    onChange: function (selectedDates) {

                        if (selectedDates.length) {

                            // Return date cannot be before departure
                            returnPicker.set('minDate', selectedDates[0]);

                            // Clear return date if it is now invalid
                            if (
                                returnPicker.selectedDates.length &&
                                returnPicker.selectedDates[0] < selectedDates[0]
                            ) {
                                returnPicker.clear();
                            }

                        } else {
                            returnPicker.set('minDate', 'today');
                        }
                    }
                });

                // Form submission
                form.addEventListener('submit', function (event) {

                    pageUrl.value = window.location.href;

                    // Prevent duplicate submissions
                    if (submitting) {
                        event.preventDefault();
                        return;
                    }

                    // Validate all required fields
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        form.reportValidity();
                        return;
                    }

                    // Honeypot validation
                    if (honeypot.value.trim() !== '') {
                        event.preventDefault();

                        status.textContent =
                            'Unable to submit this enquiry. Please try again.';

                        return;
                    }

                    // Validate departure and return dates
                    const departure = departurePicker.selectedDates[0];
                    const returnDate = returnPicker.selectedDates[0];

                    if (returnDate && departure && returnDate < departure) {

                        event.preventDefault();

                        status.textContent =
                            'Return date cannot be earlier than departure date.';

                        return;
                    }

                    // Start submission
                    submitting = true;
                    submissionStarted = true;

                    submitButton.disabled = true;

                    submitButton.innerHTML =
                        '<i class="fa-solid fa-spinner fa-spin"></i>' +
                        '<span>Submitting...</span>';

                    status.textContent =
                        'Submitting your enquiry. Please wait...';

                    // Fallback if no iframe response arrives
                    redirectTimer = window.setTimeout(function () {

                        if (submissionStarted) {

                            submissionStarted = false;
                            submitting = false;

                            submitButton.disabled = false;

                            submitButton.innerHTML =
                                '<i class="fa-solid fa-paper-plane"></i>' +
                                '<span>' + originalButtonText + '</span>';

                            status.textContent =
                                'We could not confirm your submission. Please try again.';
                        }

                    }, 15000);

                    // Allow normal form submission to Google Apps Script.
                });

                // Google Sheets iframe response
                responseFrame.addEventListener('load', function () {

                    if (!submissionStarted) return;

                    submissionStarted = false;

                    if (redirectTimer) {
                        window.clearTimeout(redirectTimer);
                    }

                    window.location.href = 'thank-you.php';

                });

            })();
        </script>

    </body>
    </html>