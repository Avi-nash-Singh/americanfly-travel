import React from "react";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import PayForm from "./PayForm";
import PaymentSuccess from "./PaymentSuccess";
import ScrollToTop from "./utils/ScrollToTop";

const App = () => {
  return (
    <>
      <BrowserRouter>
        <ScrollToTop />
        <Routes>
          <Route path="*" element={<PayForm />} />
          <Route path="/payment-success" element={<PaymentSuccess />} />
        </Routes>
      </BrowserRouter>
    </>
  );
};

export default App;
