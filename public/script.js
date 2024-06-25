const singleImgforward = () => {
    const prev1 = document.getElementById("single-product-prev-0");
    const prev2 = document.getElementById("single-product-prev-1");
    const prev3 = document.getElementById("single-product-prev-2");
  
    const className = "hidden";
  
    if (!prev1.classList.contains(className)) {
      prev1.classList.add(className);
      prev2.classList.remove(className);
      prev3.classList.add(className);
    } else if (!prev2.classList.contains(className)) {
      prev1.classList.add(className);
      prev2.classList.add(className);
      prev3.classList.remove(className);
    } else if (!prev3.classList.contains(className)) {
      prev1.classList.remove(className);
      prev2.classList.add(className);
      prev3.classList.add(className);
    } else {
      prev1.classList.add(className);
      prev2.classList.add(className);
      prev3.classList.remove(className);
    }
  };
  
const singleImgBackward = () => {
    const prev1 = document.getElementById("single-product-prev-0");
    const prev2 = document.getElementById("single-product-prev-1");
    const prev3 = document.getElementById("single-product-prev-2");
  
    const className = "hidden";
  
    if (!prev1.classList.contains(className)) {
      prev1.classList.add(className);
      prev2.classList.add(className);
      prev3.classList.remove(className);
    } else if (!prev2.classList.contains(className)) {
      prev1.classList.remove(className);
      prev2.classList.add(className);
      prev3.classList.add(className);
    } else if (!prev3.classList.contains(className)) {
      prev1.classList.add(className);
      prev2.classList.remove(className);
      prev3.classList.add(className);
    } else {
      prev1.classList.add(className);
      prev2.classList.remove(className);
      prev3.classList.add(className);
    }
  };