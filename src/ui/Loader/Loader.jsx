import React from 'react'
import './loader.css';
import plane from "./4820.gif"
const Loader = () => {
  return (
    <>
    <div class= 'cover-loader'>
    <div class="loader">
    <div class="plane">
      <img src={plane} class="plane-img" alt=''/>
    </div>
    <div class="earth-wrapper">
      <div class="earth"></div>
    </div>  
  </div>
  </div>
  </>  )
}

export default Loader
