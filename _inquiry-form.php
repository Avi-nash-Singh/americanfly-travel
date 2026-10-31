
<form
    method="post"
    action="https://script.google.com/macros/s/AKfycbylLx1ziaTlcCnzoG6MkCYfnjh7cF12VbZf9h2OE2gZmoAm0xH6KK6dqyoeDE91fwM/exec"
    target="googleSheetResponseFrame"
    id="flightEnquiryForm"
    novalidate
>
    <!-- Google Sheets fields -->
    <input type="hidden" name="formGoogleSheetName" value="AmericanFly Lead Sheet">
    <input type="hidden" name="formName" value="<?= htmlspecialchars($form_name, ENT_QUOTES, 'UTF-8') ?>">
    <input type="hidden" name="page_url" id="page_url" value="">

    <!-- Honeypot: genuine visitors should leave this empty -->
    <div
        aria-hidden="true"
        style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;"
    >
        <label for="website_url">Leave this field empty</label>
        <input
            type="text"
            id="website_url"
            name="honeypot"
            tabindex="-1"
            autocomplete="off"
        >
    </div>

    <!-- Full Name -->
    <div class="dest-form-field">
        <label class="dest-form-label" for="inqName">Full Name *</label>
        <div class="dest-form-input-wrap">
            <i class="fa-solid fa-user dest-form-icon"></i>
            <input
                type="text"
                id="inqName"
                name="first_name"
                class="dest-form-input"
                placeholder="e.g. John Smith"
                autocomplete="name"
                required
            >
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
                autocomplete="tel"
                required
            >
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
                autocomplete="email"
                required
            >
        </div>
    </div>

    <!-- Mandatory consent -->
    <div class="dest-form-consent">
        <input
            type="checkbox"
            id="inqConsent"
            name="contact_consent"
            value="yes"
            required
            checked
        >
        <label for="inqConsent">
            I agree to be contacted by an American Fly specialist via phone,
            email, or WhatsApp regarding this inquiry. *
        </label>
    </div>

    <!-- Form status -->
    <p id="formStatus" role="status" aria-live="polite"></p>

    <!-- Submit -->
    <button type="submit" class="dest-form-btn" id="submitEnquiry">
        <i class="fa-solid fa-paper-plane"></i>
        <span>Get Free Quote</span>
    </button>
</form>

<!-- Hidden iframe receives the Google Apps Script response -->
<iframe
    name="googleSheetResponseFrame"
    id="googleSheetResponseFrame"
    title="Form submission response"
    style="display:none;"
></iframe>

<script>
(function () {
    const form = document.getElementById('flightEnquiryForm');
    const honeypot = document.getElementById('website_url');
    const pageUrl = document.getElementById('page_url');
    const status = document.getElementById('formStatus');
    const submitButton = document.getElementById('submitEnquiry');
    const responseFrame = document.getElementById('googleSheetResponseFrame');

    let submitting = false;
    let submissionStarted = false;
    let redirectTimer = null;

    // Capture the full URL of the current destination page.
    pageUrl.value = window.location.href;

    // Validate required fields and run the client-side honeypot check.
    form.addEventListener('submit', function (event) {
        pageUrl.value = window.location.href;

        if (!form.checkValidity()) {
            event.preventDefault();
            form.reportValidity();
            return;
        }

        // Honeypot filled: block submission.
        if (honeypot.value.trim() !== '') {
            event.preventDefault();
            status.textContent = 'Unable to submit this form. Please try again.';
            return;
        }

        if (submitting) {
            event.preventDefault();
            return;
        }

        submitting = true;
        submissionStarted = true;
        submitButton.disabled = true;
        submitButton.querySelector('span').textContent = 'Submitting...';
        status.textContent = 'Submitting your enquiry. Please wait.';

        // Prevent a false redirect if no response arrives.
        redirectTimer = window.setTimeout(function () {
            if (submissionStarted) {
                submitting = false;
                submitButton.disabled = false;
                submitButton.querySelector('span').textContent = 'Get Free Quote';
                status.textContent =
                    'We could not confirm submission. Please try again.';
            }
        }, 15000);
    });

    // Google Apps Script loads its response in the hidden iframe.
    responseFrame.addEventListener('load', function () {
        if (!submissionStarted) return;

        submissionStarted = false;

        if (redirectTimer) {
            window.clearTimeout(redirectTimer);
        }

        // The iframe load event does not prove Google Sheets saved the lead.
        // This assumes the Apps Script endpoint returns a response on success.
        window.location.href = 'thank-you.php';
    });
})();
</script>
