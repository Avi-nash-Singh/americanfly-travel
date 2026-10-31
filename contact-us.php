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
    <style>
/* =========================================
   CONTACT DETAILS SECTION
========================================= */

.contact-content {
  padding: 70px 0;
  background: #f8fafc;
}

.contact-details-header,
.contact-map-heading {
  text-align: center;
  max-width: 720px;
  margin: 0 auto 40px;
}

.contact-content__title {
  font-size: 32px;
  font-weight: 700;
  color: #142b4a;
  margin-bottom: 15px;
}

.contact-content__text {
  font-size: 16px;
  line-height: 1.8;
  color: #64748b;
  margin-bottom: 0;
}

.contact-details-grid {
  display: grid;
  grid-template-columns: repeat(5, minmax(0, 1fr));
  gap: 20px;
}

.contact-detail-card {
  background: #ffffff;
  border: 1px solid #e8edf3;
  border-radius: 14px;
  padding: 30px 18px;
  text-align: center;
  min-width: 0;
  box-shadow: 0 5px 20px rgba(20, 43, 74, 0.04);
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  overflow-wrap: anywhere;
}

.contact-detail-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 28px rgba(20, 43, 74, 0.09);
}

.contact-detail-icon {
  width: 64px;
  height: 64px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #6f7d94;
  border-radius: 50%;
  margin: 0 auto 18px;
}

.contact-detail-icon img {
  width: 30px;
  height: 30px;
  object-fit: contain;
}

.contact-detail-card h3 {
  font-size: 18px;
  font-weight: 700;
  color: #142b4a;
  margin-bottom: 12px;
}

.contact-detail-card a,
.contact-detail-card p {
  font-size: 14px;
  line-height: 1.7;
  color: #64748b;
  margin: 0;
}

.contact-detail-card a {
  text-decoration: none;
  transition: color 0.2s ease;
}

.contact-detail-card a:hover {
  color: #e8a12a;
}

/* =========================================
   GOOGLE MAP SECTION
========================================= */

.contact-map-section {
  padding: 20px 0 80px;
  background: #ffffff;
}

.contact-map-heading {
  margin-bottom: 30px;
}

.contact-map {
  width: 100%;
  height: 430px;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 8px 30px rgba(20, 43, 74, 0.10);
}

.contact-map iframe {
  width: 100%;
  height: 100%;
  border: 0;
  display: block;
}

.contact-map-link {
  text-align: center;
  margin-top: 25px;
}

.contact-map-link a {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  padding: 13px 25px;
  border-radius: 6px;
  background: #142b4a;
  color: #ffffff;
  font-size: 15px;
  font-weight: 600;
  text-decoration: none;
  transition: background 0.25s ease;
}

.contact-map-link a:hover {
  background: #e8a12a;
  color: #142b4a;
}

/* =========================================
   RESPONSIVE DESIGN
========================================= */

@media (max-width: 1199px) {
  .contact-details-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }
}

@media (max-width: 767px) {
  .contact-content {
    padding: 50px 0;
  }

  .contact-details-header,
  .contact-map-heading {
    margin-bottom: 28px;
  }

  .contact-content__title {
    font-size: 27px;
  }

  .contact-details-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 14px;
  }

  .contact-detail-card {
    padding: 24px 12px;
  }

  .contact-detail-icon {
    width: 54px;
    height: 54px;
  }

  .contact-detail-icon img {
    width: 26px;
    height: 26px;
  }

  .contact-detail-card h3 {
    font-size: 16px;
  }

  .contact-detail-card a,
  .contact-detail-card p {
    font-size: 13px;
  }

  .contact-map-section {
    padding: 10px 0 55px;
  }

  .contact-map {
    height: 320px;
    border-radius: 12px;
  }
}

@media (max-width: 420px) {
  .contact-details-grid {
    grid-template-columns: 1fr;
  }
}

    </style>
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


<!-- CONTACT DETAILS SECTION START -->
<section class="contact-content">
  <div class="container">
    <div class="contact-details-header">
      <h2 class="contact-content__title">Get In Touch</h2>
      <p class="contact-content__text">
        Have a question or need assistance? Contact our team through any
        of the following channels. We're here to help!
      </p>
    </div>

    <div class="contact-details-grid">

      <!-- Phone -->
      <div class="contact-detail-card">
        <div class="contact-detail-icon">
          <img src="assets/icons/phone.svg" alt="Phone" />
        </div>
        <h3>Call Us</h3>
        <a href="tel:02031375177">0203 137 5177</a>
      </div>

      <!-- WhatsApp -->
      <div class="contact-detail-card">
        <div class="contact-detail-icon">
          <img src="assets/icons/whatsapp.svg" alt="WhatsApp" />
        </div>
        <h3>WhatsApp</h3>
        <a
          href="https://wa.me/447446512247"
          target="_blank"
          rel="noopener noreferrer"
        >
          07446 512247
        </a>
      </div>

      <!-- Email -->
      <div class="contact-detail-card">
        <div class="contact-detail-icon">
          <img src="assets/icons/email.svg" alt="Email" />
        </div>
        <h3>Email Us</h3>
        <a href="mailto:info@americanfly.co.uk">
          info@americanfly.co.uk
        </a>
      </div>

      <!-- Address -->
      <div class="contact-detail-card">
        <div class="contact-detail-icon">
          <img src="assets/icons/address.svg" alt="Location" />
        </div>
        <h3>Our Office</h3>
        <p>450 Bath Road, West Drayton, England, UB7 0EB</p>
      </div>

      <!-- Working Hours -->
      <div class="contact-detail-card">
        <div class="contact-detail-icon">
          <img src="assets/icons/workinghour.svg" alt="Working Hours" />
        </div>
        <h3>Working Hours</h3>
        <p>7 Days a Week</p>
        <p>8:00 AM – 11:30 PM</p>
      </div>

    </div>
  </div>
</section>
<!-- CONTACT DETAILS SECTION END -->


<!-- GOOGLE MAP SECTION START -->
<section class="contact-map-section">
  <div class="container">
    <div class="contact-map-heading">
      <h2 class="contact-content__title">Find Us on the Map</h2>
      <p class="contact-content__text">
        Visit American Fly at our office in West Drayton, England.
      </p>
    </div>

    <div class="contact-map">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2484.676835442794!2d-0.4864735741464976!3d51.48244591252694!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4876719aa0ad6f9b%3A0x423547a094781b12!2s450%20Bath%20Rd%2C%20Longford%2C%20Heathrow%2C%20West%20Drayton%20UB7%200EB%2C%20UK!5e0!3m2!1sen!2sin!4v1793287128493!5m2!1sen!2sin"
        title="American Fly office location on Google Maps"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        allowfullscreen
      ></iframe>
    </div>

    <div class="contact-map-link">
      <a
        href="https://www.google.com/maps/place/450+Bath+Rd,+Longford,+Heathrow,+West+Drayton+UB7+0EB,+UK/@51.4824459,-0.4864736,17z/data=!3m1!4b1!4m6!3m5!1s0x4876719aa0ad6f9b:0x423547a094781b12!8m2!3d51.4825604!4d-0.4845398!16s%2Fg%2F11c74fjtqy?entry=ttu&g_ep=EgoyMDI2MTAyMC4wIKXMDSoASAFQAw%3D%3D"
        target="_blank"
        rel="noopener noreferrer"
      >
        Get Directions
        <i class="fa-solid fa-arrow-up-right-from-square"></i>
      </a>
    </div>
  </div>
</section>
<!-- GOOGLE MAP SECTION END -->
<<<<<<< HEAD
=======
```
>>>>>>> d28c13b2ff562c5a9b561af5ed1b4ba0d1b28ac3
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
