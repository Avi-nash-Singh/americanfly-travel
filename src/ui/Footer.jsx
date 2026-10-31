import React from 'react'
import Logo from "../assets/logo-new.png"

const Footer = () => {
  return (
    <>

    <footer className="footer">
      <div className="footer__main">
        <div className="container">

          <div className="footer__top">

            <div className="footer__brand">
              <a href="https://americanfly.co.uk" className="footer__logo">
                <img src={Logo} alt="AmericanFly.co.uk" className="footer__logo-img" />
              </a>



              <div className="footer__contact">
                <div className="footer__contact-item">
                  <i className="fa-solid fa-headset"></i>
                  <div>
                    <span>Need help? Our travel experts are here for you.</span>
                  </div>
                </div>

                <div className="footer__contact-item">
                  <i className="fa-solid fa-phone"></i>
                  <div>
                    <span>Call us</span>
                    <a href="tel:02031375177">0203 137 5177</a>
                  </div>
                </div>

                <div className="footer__contact-item">
                  <i className="fa-brands fa-whatsapp"></i>
                  <div>
                    <span>WhatsApp us</span>
                    <a href="https://wa.me/447446512247">07446512247</a>
                  </div>
                </div>

                <div className="footer__contact-item">
                  <i className="fa-solid fa-envelope"></i>
                  <div>
                    <span>Email us</span>
                    <a href="mailto:info@americanfly.co.uk">info@americanfly.co.uk</a>
                  </div>
                </div>
              </div>
            </div>

            <div className="footer__links">
              <h4>Company</h4>
              <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about-us.php">About Us</a></li>
                <li><a href="privacy-policy.php">Privacy Policy</a></li>
                <li><a href="terms-and-conditions.php">Terms &amp; Conditions</a></li>
                <li><a href="contact-us.php">Contact Us</a></li>
              </ul>
            </div>

            <div className="footer__links">
              <h4>Flights</h4>
              <ul>
                <li><a href="#">USA Flights</a></li>
                <li><a href="#">Business Class</a></li>
                <li><a href="#">Premium Economy</a></li>
                <li><a href="#">Economy Class</a></li>
                <li><a href="#">Multi-City Flights</a></li>
              </ul>
            </div>

            <div className="footer__links">
              <h4>Holidays</h4>
              <ul>
                <li><a href="#">USA Holidays</a></li>
                <li><a href="#">Canada Holidays</a></li>
                <li><a href="#">Caribbean Holidays</a></li>
                <li><a href="#">Europe Holidays</a></li>
                <li><a href="#">Worldwide Holidays</a></li>
              </ul>
            </div>

            <div className="footer__links">
              <h4>Car Hire</h4>
              <ul>
                <li><a href="#">USA Car Hire</a></li>
                <li><a href="#">Canada Car Hire</a></li>
                <li><a href="#">Airport Transfers</a></li>
                <li><a href="#">Self Drive</a></li>
                <li><a href="#">Popular Destinations</a></li>
              </ul>
            </div>

            <div className="footer__links">
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

      <div className="footer__trust">
        <div className="container">
          <div className="footer__trust-grid">

            <div className="footer__trust-item">
              <i className="fa-solid fa-shield-halved"></i>
              <div>
                <h5>ATOL Protected</h5>
                <p>Your money is safe</p>
              </div>
            </div>

            <div className="footer__trust-item">
              <i className="fa-solid fa-plane"></i>
              <div>
                <h5>Great Value Fares</h5>
                <p>Best deals, always</p>
              </div>
            </div>

            <div className="footer__trust-item">
              <i className="fa-solid fa-headset"></i>
              <div>
                <h5>Dedicated Support</h5>
                <p>Real people, real help</p>
              </div>
            </div>

            <div className="footer__trust-item">
              <i className="fa-solid fa-car-side"></i>
              <div>
                <h5>Car Hire Worldwide</h5>
                <p>Drive your adventure</p>
              </div>
            </div>

            <div className="footer__trust-item">
              <i className="fa-solid fa-earth-americas"></i>
              <div>
                <h5>Trusted Travel Partner</h5>
                <p>Your journey, our priority</p>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div style={{"background": "#04172f"}}>
        <div className="container">

          <div className="footer__copyright">
            <p>&copy; 2026 AmericanFly.co.uk. All rights reserved.</p>
          </div>
        </div>
      </div>
    </footer>
    </>
  )
}

export default Footer