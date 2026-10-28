<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us - American Fly</title>
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
  </head>

  <body>
    <!-- ============================================
         (Header + Navbar)
         ============================================ -->
        <?php include('_nav.php'); ?>

    <!-- ============================================
         BANNER SECTION START
         ============================================ -->
    <section class="about-banner">
      <!-- Banner Background Image -->
      <img
        src="assets/banner/contact.png"
        alt="About Us Banner"
        class="about-banner__bg-image"
      />
      <!-- Banner Overlay -->
      <div class="about-banner__overlay"></div>

      <!-- Banner Content -->
      <div class="about-banner__content">
        <h1 class="about-banner__title">Contact Us</h1>
        <nav class="about-banner__breadcrumb">
          <a href="index.php" class="about-banner__breadcrumb-link">Home</a>
          <span class="about-banner__breadcrumb-separator">&#8250;</span>
          <span class="about-banner__breadcrumb-current">Contact Us</span>
        </nav>
      </div>
    </section>

    <!-- BANNER SECTION END -->

    <!-- ============================================
         CONTACT CONTENT SECTION START
         ============================================ -->
    <section class="contact-content">
      <div class="container">
        <div class="contact-content__wrapper">
          <!-- Contact Info Section -->
          <div class="contact-content__info">
            <h2 class="contact-content__title">Get In Touch</h2>
            <p class="contact-content__text">
              Have a question or need assistance? We're here to help! Fill out
              the form or reach out to us through any of the following channels.
            </p>

            <div class="contact-content__info-item">
              <div class="contact-content__info-icon">
                <img src="assets/icons/phone.svg" alt="Phone" />
              </div>
              <div class="contact-content__info-details">
                <h3>Phone</h3>
                <a href="tel:02031375177">0203 137 5177</a>
              </div>
            </div>

            <div class="contact-content__info-item">
              <div class="contact-content__info-icon">
                <img src="assets/icons/whatsapp.svg" alt="WhatsApp" />
              </div>
              <div class="contact-content__info-details">
                <h3>WhatsApp</h3>
                <a href="https://wa.me/07446512247" target="_blank">07446 512247</a>
              </div>
            </div>

            <div class="contact-content__info-item">
              <div class="contact-content__info-icon">
                <img src="assets/icons/email.svg" alt="Email" />
              </div>
              <div class="contact-content__info-details">
                <h3>Email</h3>
                <a href="mailto:info@americanfly.co.uk"
                  >info@americanfly.co.uk</a
                >
              </div>
            </div>

            <div class="contact-content__info-item">
              <div class="contact-content__info-icon">
                <img src="assets/icons/address.svg" alt="Location" />
              </div>
              <div class="contact-content__info-details">
                <h3>Address</h3>
                <p>450 Bath Road, West Drayton, England, UB7 0EB</p>
              </div>
            </div>

            <div class="contact-content__info-item">
              <div class="contact-content__info-icon">
                <img src="assets/icons/workinghour.svg" alt="Hours" />
              </div>
              <div class="contact-content__info-details">
                <h3>Working Hours</h3>
                <p>7 Days a Week: 8:00 AM - 11:30 PM</p>
              </div>
            </div>
          </div>
          <!-- Contact Info Section End -->

          <!-- Contact Form Section -->
          <div class="contact-content__form-wrapper">
            <h2 class="contact-content__title">Send Us a Message</h2>
            <form class="contact-content__form">
              <div class="contact-content__form-group">
                <label for="name">Full Name</label>
                <input
                  type="text"
                  id="name"
                  name="name"
                  placeholder="Enter your full name"
                  required
                />
              </div>

              <div class="contact-content__form-group">
                <label for="email">Email Address</label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  placeholder="Enter your email address"
                  required
                />
              </div>

              <div class="contact-content__form-group">
                <label for="phone">Phone Number</label>
                <input
                  type="tel"
                  id="phone"
                  name="phone"
                  placeholder="Enter your phone number"
                />
              </div>

              <div class="contact-content__form-group">
                <label for="subject">Subject</label>
                <input
                  type="text"
                  id="subject"
                  name="subject"
                  placeholder="Enter the subject"
                  required
                />
              </div>

              <div class="contact-content__form-group">
                <label for="message">Message</label>
                <textarea
                  id="message"
                  name="message"
                  rows="6"
                  placeholder="Enter your message"
                  required
                ></textarea>
              </div>

              <button type="submit" class="contact-content__submit-btn">
                Send Message
              </button>
            </form>
          </div>
          <!-- Contact Form Section End -->
        </div>
      </div>
    </section>
    <!-- CONTACT CONTENT SECTION END -->

    <!-- FOOTER SECTION -->
    <?php include '_footer.php'; ?>
    <!-- FOOTER BOTTOM SECTION END -->

    <!-- JavaScript -->
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
    </script>
    <script>
      (function () {
        function c() {
          var b = a.contentDocument || a.contentWindow.document;
          if (b) {
            var d = b.createElement("script");
            d.innerHTML =
              "window.__CF$cv$params={r:'a139f719dbf89e2e',t:'MTc4Mjc4ODg5Mw=='};var a=document.createElement('script');a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
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
    </script>
  </body>
</html>
