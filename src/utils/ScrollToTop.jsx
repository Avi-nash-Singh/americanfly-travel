import { useEffect } from 'react';
import { useLocation } from 'react-router-dom';

const ScrollToTop = () => {
  const location = useLocation();

  useEffect(() => {
    // Scroll to the top of the page on route changes
    window.scrollTo(0, 0);
  }, [location]);

  return null; // No need to render anything for this component
};

export default ScrollToTop;
