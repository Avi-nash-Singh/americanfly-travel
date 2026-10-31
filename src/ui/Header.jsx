import React from "react";
import Logo from "../assets/logo-new.png";
import Cert1 from "../assets/cert/tta.png";
import Cert2 from "../assets/cert/tta-trans.png";
import Cert3 from "../assets/cert/atol_logo_white.png";
import CallIcon from "../assets/callIcon.svg";
import PaymentBanner from "../assets/contact.png";
const header = () => {
  return (
    <>
      <div className="flight-sticky-wrapper" id="flightStickyWrapper">
        <header className="flight-header">
          <div className="container">
            <div className="flight-header__top-row">
              <div className="flight-header__logo-badges">
                <div className="flight-header__logo">
                  <a href="https://americanfly.co.uk" className="flight-header__logo-link">
                    <img
                      src={Logo}
                      alt="American Fly Logo"
                      className="flight-header__logo-img"
                    />
                  </a>
                </div>
              </div>
              <div className="flight-header__badges">
                <img
                  src={Cert1}
                  alt="Badge 1"
                  className="flight-header__badge-item"
                />
                <img
                  src={Cert2}
                  alt="Badge 2"
                  className="flight-header__badge-item"
                />
                <img
                  src={Cert3}
                  alt="Badge 3"
                  className="flight-header__badge-item"
                />
              </div>
              <div className="flight-header__contact-info">
                <img
                  src={CallIcon}
                  alt="Call Icon"
                  className="flight-header__call-icon"
                />
                <div className="flight-header__contact-text">
                  <span className="flight-header__contact-title">
                    Call Us for Exclusive Flight Deals
                  </span>
                  <span className="flight-header__contact-phone">
                    0203 137 5177
                  </span>
                  <span className="flight-header__contact-timing">
                    7 Days a Week · 8:00 AM - 11:30 PM
                  </span>
                </div>
              </div>
            </div>
          </div>
        </header>
        {/* <nav className="flight-navbar">
          <div className="container">
            <div className="flight-navbar__container d-flex align-items-center justify-content-between">
              <a
                href="#"
                className="flight-header__logo-link d-block d-md-none"
              >
                <img
                  src={Logo}
                  alt="American Fly Logo"
                  className="flight-header__logo-img"
                />
              </a>
              <button
                className="flight-navbar__toggle ms-auto"
                type="button"
                id="navbarToggleBtn"
              >
                <div className="flight-navbar__toggle-icon">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
              </button>

              <ul className="flight-navbar__menu-list" id="navbarMenuList">
                <li className="flight-navbar__menu-item">
                  <a
                    href="index.php"
                    className="flight-navbar__menu-link flight-navbar__menu-link--active"
                  >
                    Home
                  </a>
                </li>
                <li className="flight-navbar__menu-item">
                  <a href="about-us.php" className="flight-navbar__menu-link">
                    About Us
                  </a>
                </li>
                <li className="flight-navbar__menu-item flight-navbar__menu-item--has-dropdown">
                  <a href="#" className="flight-navbar__menu-link">
                    Destinations{" "}
                    <span className="flight-navbar__dropdown-arrow">▼</span>
                  </a>
                  <ul className="flight-navbar__dropdown">
                    <li className="flight-navbar__dropdown-item">
                      <a
                        href="destination-chicago.php"
                        className="flight-navbar__dropdown-link"
                      >
                        Chicago
                      </a>
                    </li>
                    <li className="flight-navbar__dropdown-item">
                      <a
                        href="destination-las-vegas.php"
                        className="flight-navbar__dropdown-link"
                      >
                        Las Vegas
                      </a>
                    </li>
                    <li className="flight-navbar__dropdown-item">
                      <a
                        href="destination-los-angeles.php"
                        className="flight-navbar__dropdown-link"
                      >
                        Los Angeles
                      </a>
                    </li>
                    <li className="flight-navbar__dropdown-item">
                      <a
                        href="destination-miami.php"
                        className="flight-navbar__dropdown-link"
                      >
                        Miami
                      </a>
                    </li>
                    <li className="flight-navbar__dropdown-item">
                      <a
                        href="destination-new-york.php"
                        className="flight-navbar__dropdown-link"
                      >
                        New York
                      </a>
                    </li>
                    <li className="flight-navbar__dropdown-item">
                      <a
                        href="destination-orlando.php"
                        className="flight-navbar__dropdown-link"
                      >
                        Orlando
                      </a>
                    </li>
                    <li className="flight-navbar__dropdown-item">
                      <a
                        href="destination-san-francisco.php"
                        className="flight-navbar__dropdown-link"
                      >
                        San Francisco
                      </a>
                    </li>
                    <li className="flight-navbar__dropdown-item">
                      <a
                        href="destination-washington-dc.php"
                        className="flight-navbar__dropdown-link"
                      >
                        Washington DC
                      </a>
                    </li>
                  </ul>
                </li>
                <li className="flight-navbar__menu-item">
                  <a href="car-hire.php" className="flight-navbar__menu-link">
                    Car Hire
                  </a>
                </li>
                <li className="flight-navbar__menu-item">
                  <a href="contact-us.php" className="flight-navbar__menu-link">
                    Contact Us
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav> */}
      </div>
    </>
  );
};

export default header;
