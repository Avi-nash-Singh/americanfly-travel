import { useRef, useState } from "react";
import Footer from "./ui/Footer";
import Header from "./ui/header";
// import Loader from "./ui/Loader/Loader";
// import "./PaymentPage.css";

export default function PaymentPage() {
  const [form, setForm] = useState({
    firstName: "",
    lastName: "",
    email: "",
    amount: "",
    phone: "",
  });

  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");
  const paymentInProgress = useRef(false);

  const handleChange = (e) => {
    setForm((prev) => ({
      ...prev,
      [e.target.name]: e.target.value,
    }));
    setError("");
  };

  const handlePayment = async (e) => {
    e.preventDefault();
    if (paymentInProgress.current) return;
    if (
      !form.firstName.trim() ||
      !form.lastName.trim() ||
      !form.email.trim() ||
      !form.amount
    ) {
      setError("Please fill in all required fields.");
      return;
    }

    if (Number(form.amount) <= 0 || !Number.isFinite(Number(form.amount))) {
      setError("Please enter a valid payment amount.");
      return;
    }
    paymentInProgress.current = true;
    setLoading(true);
    setError("");

    try {
      const res = await fetch(
        "https://payments.americanfly.co.uk/payment-api/create-payment-link.php",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(form),
        },
      );

      const data = await res.json();

      if (!res.ok) {
        throw new Error(data.message || "Unable to create payment link.");
      }

      if (data.payment_link?.url) {
        window.location.href = data.payment_link.url;
        return;
      }

      throw new Error(data.message || "Payment link could not be generated.");
    } catch (err) {
      console.error("Payment Error:", err);
      setError(err.message || "Something went wrong. Please try again.");
    } finally {
      paymentInProgress.current = false;
      setLoading(false);
    }
  };

  return (
    <>
      {loading && (
        <div className="payment-loading-overlay">
          <div className="payment-loading-content">
            {/* <Loader /> */}
            <h3>Processing Your Payment</h3>
            <p>Please wait. Do not refresh or close this page.</p>
          </div>
        </div>
      )}

      <Header />

      {/* Payment Banner */}
      <section className="payment-hero">
        <div className="payment-hero__overlay"></div>

        <div className="container payment-hero__container">
          <div className="payment-hero__content">
            <span className="payment-hero__eyebrow">AMERICAN FLY</span>

            <h1>Secure Online Payment</h1>

            <p>
              Complete your payment quickly and securely using our trusted
              online payment service.
            </p>

            <div className="payment-hero__breadcrumb">
              <span>Home</span>
              <i className="fa fa-angle-right"></i>
              <span>Payment</span>
            </div>
          </div>
        </div>
      </section>

      {/* Payment Section */}
      <section className="payment-section">
        <div className="container">
          {/* <div className="payment-section__heading">
            <span className="payment-section__subtitle">
              SIMPLE & SECURE
            </span>

            <h2>Make Your Payment</h2>

            <p>
              Enter your details below to proceed with your
              payment.
            </p>
          </div> */}

          <div className="row payment-layout">
            {/* Payment Form */}
            <div className="col-lg-8 col-md-12">
              <div className="payment-card">
                <div className="payment-card__header">
                  <div className="payment-card__icon">
                    <i className="fa fa-credit-card"></i>
                  </div>

                  <div>
                    <h3>Payment Details</h3>
                    <p>Please provide your billing information.</p>
                  </div>
                </div>

                <form onSubmit={handlePayment}>
                  <div className="payment-form__section-title">
                    <span>01</span>
                    <h4>Personal Information</h4>
                  </div>

                  <div className="row">
                    <div className="col-sm-6">
                      <div className="payment-field">
                        <label htmlFor="firstName">
                          First Name <span>*</span>
                        </label>

                        <div className="payment-input">
                          <i className="fa fa-user"></i>
                          <input
                            id="firstName"
                            type="text"
                            name="firstName"
                            value={form.firstName}
                            onChange={handleChange}
                            placeholder="Enter your first name"
                            autoComplete="given-name"
                            required
                          />
                        </div>
                      </div>
                    </div>

                    <div className="col-sm-6">
                      <div className="payment-field">
                        <label htmlFor="lastName">
                          Last Name <span>*</span>
                        </label>

                        <div className="payment-input">
                          <i className="fa fa-user"></i>
                          <input
                            id="lastName"
                            type="text"
                            name="lastName"
                            value={form.lastName}
                            onChange={handleChange}
                            placeholder="Enter your last name"
                            autoComplete="family-name"
                            required
                          />
                        </div>
                      </div>
                    </div>

                    <div className="col-sm-6">
                      <div className="payment-field">
                        <label htmlFor="email">
                          Email Address <span>*</span>
                        </label>

                        <div className="payment-input">
                          <i className="fa fa-envelope"></i>
                          <input
                            id="email"
                            type="email"
                            name="email"
                            value={form.email}
                            onChange={handleChange}
                            placeholder="Enter your email address"
                            autoComplete="email"
                            required
                          />
                        </div>
                      </div>
                    </div>

                    <div className="col-sm-6">
                      <div className="payment-field">
                        <label htmlFor="phone">
                          Mobile Number
                          <small>(Optional)</small>
                        </label>

                        <div className="payment-input">
                          <i className="fa fa-phone"></i>
                          <input
                            id="phone"
                            type="tel"
                            name="phone"
                            value={form.phone}
                            onChange={handleChange}
                            placeholder="Enter your mobile number"
                            autoComplete="tel"
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="payment-form__divider"></div>

                  <div className="payment-form__section-title">
                    <span>02</span>
                    <h4>Payment Information</h4>
                  </div>

                  <div className="row">
                    <div className="col-md-7">
                      <div className="payment-field">
                        <label htmlFor="amount">
                          Payment Amount <span>*</span>
                        </label>

                        <div className="payment-input payment-input--amount">
                          <span className="payment-currency">£</span>
                          <input
                            id="amount"
                            type="number"
                            name="amount"
                            value={form.amount}
                            onChange={handleChange}
                            placeholder="Enter amount"
                            min="0.01"
                            step="0.01"
                            required
                          />
                          <span className="payment-currency-label">GBP</span>
                        </div>

                        <small className="payment-field__hint">
                          Enter the amount you wish to pay in GBP.
                        </small>
                      </div>
                    </div>
                  </div>

                  {error && (
                    <div className="payment-error" role="alert">
                      <i className="fa fa-exclamation-circle"></i>
                      {error}
                    </div>
                  )}

                  <div className="payment-form__bottom">
                    <button
                      type="submit"
                      className="payment-submit"
                      disabled={loading}
                    >
                      <span>
                        {loading
                          ? "Processing Payment..."
                          : "Proceed to Payment"}
                      </span>

                      {!loading && <i className="fa fa-arrow-right"></i>}
                    </button>

                    <p>
                      <i className="fa fa-lock"></i>
                      Your information is protected by secure payment
                      processing.
                    </p>
                  </div>
                </form>
              </div>
            </div>

            {/* Right Sidebar */}
            <div className="col-lg-4 col-md-12">
              <aside className="payment-sidebar">
                <div className="payment-sidebar__top">
                  <div className="payment-sidebar__shield">
                    <i className="fa fa-shield"></i>
                  </div>

                  <h3>Safe & Secure Payments</h3>

                  <p>
                    Your payment details are handled through our online payment
                    service.
                  </p>
                </div>

                <div className="payment-sidebar__features">
                  <div className="payment-feature">
                    <div className="payment-feature__icon">
                      <i className="fa fa-lock"></i>
                    </div>

                    <div>
                      <h4>Secure Transactions</h4>
                      <p>
                        Protected payment processing for your peace of mind.
                      </p>
                    </div>
                  </div>

                  <div className="payment-feature">
                    <div className="payment-feature__icon">
                      <i className="fa fa-bolt"></i>
                    </div>

                    <div>
                      <h4>Quick & Easy</h4>
                      <p>Complete your payment in just a few simple steps.</p>
                    </div>
                  </div>

                  <div className="payment-feature">
                    <div className="payment-feature__icon">
                      <i className="fa fa-headphones"></i>
                    </div>

                    <div>
                      <h4>Customer Assistance</h4>
                      <p>
                        Our team is available if you need any payment-related
                        assistance.
                      </p>
                    </div>
                  </div>
                </div>

                <div className="payment-sidebar__contact">
                  <span>NEED ASSISTANCE?</span>

                  <h3>We're Here to Help</h3>

                  <p>Have questions about your payment? Speak with our team.</p>

                  <a href="tel:02031375177">
                    <i className="fa fa-phone"></i>
                    0203 137 5177
                  </a>

                  <a href="mailto:info@americanfly.co.uk">
                    <i className="fa fa-envelope"></i>
                    info@americanfly.co.uk
                  </a>
                </div>
              </aside>
            </div>
          </div>
        </div>
      </section>

      <Footer />
    </>
  );
}
