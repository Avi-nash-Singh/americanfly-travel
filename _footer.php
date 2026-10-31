<style>
  
/* ==========================================
   AMERICAN FLY FOOTER
   Clean navy layout - no background image
========================================== */

.footer {
  --footer-bg: #031b38;
  --footer-cyan: #00b9f2;
  background: #031b38;
  color: #fff;
  font-family: inherit;
  overflow: hidden;
  position: relative;
}

.footer .container {
  width: 100%;
  max-width: 1400px;
  margin-inline: auto;
  padding-inline: 30px;
}

/* MAIN SECTION */

.footer__main {
  padding: 30px 0 24px;
  background: linear-gradient(110deg, #03172f, #06264a 55%, #031b38);
}

.footer__top {
  display: grid;
  grid-template-columns: minmax(205px, 1.65fr) repeat(5, minmax(0, 1fr));
  gap: 25px;
  align-items: start;
}

/* BRAND */

.footer__brand {
  min-width: 0;
  padding-right: 20px;
  border-right: 1px solid rgba(0, 185, 242, .22);
}

.footer__logo {
  display: inline-block;
  max-width: 100%;
}

.footer__logo-img {
  display: block;
  width: 235px;
  max-width: 100%;
  height: 94px;
  object-fit: contain;
  object-position: left center;
}

.footer__tagline {
  margin: 3px 0 18px;
  color: #b8cbe0;
  font-size: 10px;
  letter-spacing: 2.6px;
}

.footer__contact {
  display: flex;
  flex-direction: column;
  gap: 11px;
}

.footer__contact-item {
  display: flex;
  align-items: flex-start;
  gap: 11px;
  min-width: 0;
}

.footer__contact-item > i {
  flex: 0 0 20px;
  width: 20px;
  margin-top: 3px;
  color: var(--footer-cyan);
  font-size: 17px;
  text-align: center;
}

.footer__contact-item div {
  display: flex;
  flex-direction: column;
  gap: 2px;
  min-width: 0;
}

.footer__contact-item span {
  color: #c1d0e1;
  font-size: 10px;
  line-height: 1.45;
}

.footer__contact-item a {
  color: #fff;
  font-size: 12px;
  font-weight: 700;
  text-decoration: none;
  overflow-wrap: anywhere;
}

.footer__contact-item a:hover {
  color: var(--footer-cyan);
}

/* NAVIGATION COLUMNS */

.footer__links {
  min-width: 0;
}

.footer__links h4 {
  position: relative;
  display: block;
  width: fit-content;
  max-width: 100%;
  margin: 17px 0 20px;
  padding-bottom: 12px;
  color: #fff;
  font-size: 11px;
  font-weight: 800;
  line-height: 1.35;
  text-transform: uppercase;
}

.footer__links h4::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 26px;
  height: 4px;
  background: var(--footer-cyan);
}

.footer__links:nth-child(2) h4::after,
.footer__links:nth-child(4) h4::after,
.footer__links:nth-child(6) h4::after {
  background: #ff294b;
}

.footer__links ul {
  display: flex;
  flex-direction: column;
  gap: 11px;
  margin: 0;
  padding: 0;
  list-style: none;
}

.footer__links li {
  margin: 0;
  padding: 0;
}

.footer__links li a {
  display: inline-block;
  color: #c3d1e2;
  font-size: 10px;
  line-height: 1.5;
  text-decoration: none;
  overflow-wrap: anywhere;
  transition: color .2s ease;
}

.footer__links li a:hover {
  color: var(--footer-cyan);
}

/* TRUST STRIP */

.footer__trust {
  background: #04172f;
  border-top: 1px solid rgba(255, 255, 255, .06);
  border-bottom: 1px solid rgba(0, 185, 242, .55);
}

.footer__trust-grid {
  display: grid;
  grid-template-columns: repeat(5, minmax(0, 1fr));
  align-items: center;
  padding: 19px 0;
}

.footer__trust-item {
  display: flex;
  align-items: center;
  gap: 12px;
  min-width: 0;
  padding: 0 16px;
  border-right: 1px solid rgba(0, 185, 242, .3);
}

.footer__trust-item:first-child {
  padding-left: 0;
}

.footer__trust-item:last-child {
  padding-right: 0;
  border-right: 0;
}

.footer__trust-item > i {
  flex: 0 0 auto;
  color: var(--footer-cyan);
  font-size: 29px;
}

.footer__trust-item h5 {
  margin: 0 0 4px;
  color: #fff;
  font-size: 10px;
  font-weight: 800;
  line-height: 1.4;
}

.footer__trust-item p {
  margin: 0;
  color: #c0cee0;
  font-size: 9px;
  line-height: 1.5;
}

/* BOTTOM INFORMATION */

.footer__bottom {
  padding: 20px 0 12px;
  background: #031a35;
}

.footer__bottom-grid {
  display: grid;
  grid-template-columns: minmax(130px, .85fr) minmax(230px, 1.3fr) minmax(0, 2fr);
  gap: 20px;
  align-items: center;
}

.footer__certifications {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  gap: 12px;
  min-width: 0;
  min-height: 65px;
  padding-right: 16px;
  border-right: 1px solid rgba(0, 185, 242, .3);
}

.footer__cert-logo {
  display: block;
  width: auto;
  max-width: 48%;
  height: 52px;
  object-fit: contain;
}

.footer__payments {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: center;
  gap: 10px;
  min-width: 0;
  min-height: 65px;
  padding-right: 16px;
  border-right: 1px solid rgba(255, 255, 255, .3);
}

.footer__secure {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  color: #d4dfed;
  font-size: 10px;
}

.footer__secure i {
  color: #fff;
  font-size: 15px;
}

.footer__cards-img {
  display: block;
  width: 100%;
  max-width: 220px;
  max-height: 34px;
  object-fit: contain;
  object-position: left center;
}

.footer__summary {
  min-width: 0;
}

.footer__summary p {
  margin: 0 0 8px;
  color: #b8c9dd;
  font-size: 9px;
  line-height: 1.55;
}

.footer__summary p:last-child {
  margin-bottom: 0;
}

.footer__summary a {
  color: var(--footer-cyan);
  text-decoration: none;
}

.footer__summary a:hover {
  text-decoration: underline;
}

/* COPYRIGHT */

.footer__copyright {
  /* margin-top: 12px; */
  padding-top: 10px;
  border-top: 1px solid rgba(255, 255, 255, .08);
}

.footer__copyright p {
  margin: 0;
  color: #a9bed5;
  font-size: 9px;
}

/* ==========================================
   TABLET
========================================== */

@media (max-width: 1100px) {
  .footer .container {
    padding-inline: 22px;
  }

  .footer__top {
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 28px 22px;
  }

  .footer__brand {
    grid-column: 1 / -1;
    padding: 0 0 22px;
    border-right: 0;
    border-bottom: 1px solid rgba(0, 185, 242, .25);
  }

  .footer__contact {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 13px 20px;
  }

  .footer__trust-item {
    padding-inline: 10px;
    gap: 8px;
  }

  .footer__trust-item > i {
    font-size: 24px;
  }

  .footer__bottom-grid {
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }

  .footer__summary {
    grid-column: 1 / -1;
    padding-top: 14px;
    border-top: 1px solid rgba(255, 255, 255, .08);
  }
}

/* ==========================================
   MOBILE
========================================== */

@media (max-width: 600px) {
  .footer .container {
    padding-inline: 18px;
  }

  .footer__main {
    padding: 25px 0;
  }

  .footer__top {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 25px 18px;
  }

  .footer__brand {
    grid-column: 1 / -1;
  }

  .footer__logo-img {
    width: 220px;
    height: 60px;
  }

  .footer__tagline {
    font-size: 9px;
    letter-spacing: 2px;
  }

  .footer__contact {
    grid-template-columns: 1fr;
    gap: 12px;
  }

  .footer__links h4 {
    margin-top: 0;
    margin-bottom: 17px;
    font-size: 10px;
  }

  .footer__links ul {
    gap: 10px;
  }

  .footer__links li a {
    font-size: 11px;
  }

  .footer__trust-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    padding: 8px 0;
  }

  .footer__trust-item {
    min-height: 72px;
    padding: 12px 8px;
    border-right: 0;
  }

  .footer__trust-item:nth-child(odd) {
    padding-left: 0;
  }

  .footer__trust-item:last-child {
    grid-column: 1 / -1;
  }

  .footer__trust-item h5 {
    font-size: 10px;
  }

  .footer__trust-item p {
    font-size: 9px;
  }

  .footer__bottom-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }

  .footer__certifications {
    min-height: auto;
    padding: 0 0 14px;
    border-right: 0;
    border-bottom: 1px solid rgba(0, 185, 242, .25);
  }

  .footer__payments {
    min-height: auto;
    padding: 0 0 14px;
    border-right: 0;
    border-bottom: 1px solid rgba(0, 185, 242, .25);
  }

  .footer__summary {
    grid-column: auto;
    padding-top: 0;
    border-top: 0;
  }

  .footer__summary p {
    font-size: 10px;
  }
}

/* EXTRA SMALL SCREENS */

@media (max-width: 360px) {
  .footer .container {
    padding-inline: 14px;
  }

  .footer__top {
    column-gap: 12px;
  }

  .footer__links h4 {
    font-size: 9px;
  }

  .footer__links li a {
    font-size: 10px;
  }

  .footer__trust-item {
    gap: 6px;
  }

  .footer__trust-item > i {
    font-size: 21px;
  }
}
  
/* ==========================================
   FOOTER TYPOGRAPHY - NORMAL FONT SIZES
   Add this at the END of your CSS
========================================== */

/* Main navigation headings */
.footer__links h4 {
  font-size: 14px;
  line-height: 1.5;
  margin-bottom: 22px;
}

/* Navigation links */
.footer__links li a {
  font-size: 13px;
  line-height: 1.6;
}

/* Brand tagline */
.footer__tagline {
  font-size: 12px;
  line-height: 1.6;
  letter-spacing: 2px;
}

/* Contact information */
.footer__contact-item span {
  font-size: 12px;
  line-height: 1.6;
}

.footer__contact-item a {
  font-size: 14px;
  line-height: 1.5;
}

/* Trust strip headings and descriptions */
.footer__trust-item h5 {
  font-size: 13px;
  line-height: 1.5;
}

.footer__trust-item p {
  font-size: 12px;
  line-height: 1.5;
}

/* Secure payment label */
.footer__secure {
  font-size: 12px;
}

/* Company information */
.footer__summary p {
  font-size: 12px;
  line-height: 1.7;
}

/* Copyright */
.footer__copyright p {
  font-size: 12px;
  line-height: 1.6;
}

/* Tablet */
@media (max-width: 1100px) {
  .footer__links h4 {
    font-size: 14px;
  }

  .footer__links li a {
    font-size: 13px;
  }

  .footer__trust-item h5 {
    font-size: 12px;
  }

  .footer__trust-item p {
    font-size: 11px;
  }
}

/* Mobile */
@media (max-width: 600px) {
  .footer__links h4 {
    font-size: 14px;
    margin-bottom: 16px;
  }

  .footer__links li a {
    font-size: 13px;
  }

  .footer__contact-item span {
    font-size: 12px;
  }

  .footer__contact-item a {
    font-size: 14px;
  }

  .footer__trust-item h5 {
    font-size: 12px;
  }

  .footer__trust-item p {
    font-size: 11px;
  }

  .footer__summary p {
    font-size: 12px;
  }

  .footer__copyright p {
    font-size: 12px;
  }
}

  </style>
<footer class="footer">
  <!-- Main footer -->
  <div class="footer__main">
    <div class="container">

      <div class="footer__top">

        <!-- Brand and contact -->
        <div class="footer__brand">
          <a href="index.php" class="footer__logo">
            <img src="assets/logo-new.png" alt="AmericanFly.co.uk" class="footer__logo-img">
          </a>

          <!-- <p class="footer__tagline">YOUR JOURNEY. OUR PRIORITY</p> -->

          <div class="footer__contact">
            <div class="footer__contact-item">
              <i class="fa-solid fa-headset"></i>
              <div>
                <span>Need help? Our travel experts are here for you.</span>
              </div>
            </div>

            <div class="footer__contact-item">
              <i class="fa-solid fa-phone"></i>
              <div>
                <span>Call us</span>
                <a href="tel:02031375177">0203 137 5177</a>
              </div>
            </div>

            <div class="footer__contact-item">
              <i class="fa-brands fa-whatsapp"></i>
              <div>
                <span>WhatsApp us</span>
                <a href="https://wa.me/447446512247">07446512247</a>
              </div>
            </div>

            <div class="footer__contact-item">
              <i class="fa-solid fa-envelope"></i>
              <div>
                <span>Email us</span>
                <a href="mailto:info@americanfly.co.uk">info@americanfly.co.uk</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Company -->
        <div class="footer__links">
          <h4>Company</h4>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about-us.php">About Us</a></li>
            <li><a href="privacy-policy.php">Privacy Policy</a></li>
            <li><a href="terms-and-conditions.php">Terms &amp; Conditions</a></li>
            <li><a href="contact-us.php">Contact Us</a></li>
          </ul>
        </div>

        <!-- Flights -->
        <div class="footer__links">
          <h4>Flights</h4>
          <ul>
            <li><a href="#">USA Flights</a></li>
            <li><a href="#">Business Class</a></li>
            <li><a href="#">Premium Economy</a></li>
            <li><a href="#">Economy Class</a></li>
            <li><a href="#">Multi-City Flights</a></li>
          </ul>
        </div>

        <!-- Holidays -->
        <div class="footer__links">
          <h4>Holidays</h4>
          <ul>
            <li><a href="#">USA Holidays</a></li>
            <li><a href="#">Canada Holidays</a></li>
            <li><a href="#">Caribbean Holidays</a></li>
            <li><a href="#">Europe Holidays</a></li>
            <li><a href="#">Worldwide Holidays</a></li>
          </ul>
        </div>

        <!-- Car hire -->
        <div class="footer__links">
          <h4>Car Hire</h4>
          <ul>
            <li><a href="#">USA Car Hire</a></li>
            <li><a href="#">Canada Car Hire</a></li>
            <li><a href="#">Airport Transfers</a></li>
            <li><a href="#">Self Drive</a></li>
            <li><a href="#">Popular Destinations</a></li>
          </ul>
        </div>

        <!-- Top destinations -->
        <div class="footer__links">
          <h4>Top Destinations</h4>
          <ul>
            <li><a href="#">New York</a></li>
            <li><a href="#">Los Angeles</a></li>
            <li><a href="#">Orlando</a></li>
            <li><a href="#">Miami</a></li>
            <li><a href="#">San Francisco</a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>

  <!-- Trust features -->
  <div class="footer__trust">
    <div class="container">
      <div class="footer__trust-grid">

        <div class="footer__trust-item">
          <i class="fa-solid fa-shield-halved"></i>
          <div>
            <h5>ATOL Protected</h5>
            <p>Your money is safe</p>
          </div>
        </div>

        <div class="footer__trust-item">
          <i class="fa-solid fa-plane"></i>
          <div>
            <h5>Great Value Fares</h5>
            <p>Best deals, always</p>
          </div>
        </div>

        <div class="footer__trust-item">
          <i class="fa-solid fa-headset"></i>
          <div>
            <h5>Dedicated Support</h5>
            <p>Real people, real help</p>
          </div>
        </div>

        <div class="footer__trust-item">
          <i class="fa-solid fa-car-side"></i>
          <div>
            <h5>Car Hire Worldwide</h5>
            <p>Drive your adventure</p>
          </div>
        </div>

        <div class="footer__trust-item">
          <i class="fa-solid fa-earth-americas"></i>
          <div>
            <h5>Trusted Travel Partner</h5>
            <p>Your journey, our priority</p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Legal, certifications and payments -->
  <div style="background: #04172f;">
    <div class="container">

      <div class="footer__copyright">
        <p>&copy; 2026 AmericanFly.co.uk. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
<!-- WhatsAPP Widget Start -->
  <a href="https://api.whatsapp.com/send?phone=447446512247&text=Hi%20%F0%9F%91%8B%20I%E2%80%99m%20interested%20in%20booking%20a%20trip."
    class="nz-wa-float"
    target="_blank">
    <i class="fa-brands fa-whatsapp"></i>
  </a>
<!-- WhatsAPP Widget End  -->
     <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/66cd98b5ea492f34bc0a8992/1i69hp1jq';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
