document.addEventListener("DOMContentLoaded", () => {
  const orderTotalElement = document.getElementById("order-total");
  const placeOrderBtn = document.getElementById("place-order-btn");
  const backgroundOverlay = document.querySelector('.background-overlay');

  const cartTotal = localStorage.getItem("cartTotal");
  
  if (cartTotal) {
    orderTotalElement.textContent = `$${cartTotal}`;
  } else {
    orderTotalElement.textContent = "$0.00";
  }

  placeOrderBtn.addEventListener("click", () => {
    const street = document.getElementById("street").value;
    const city = document.getElementById("city").value;
    const paymentMethod = document.getElementById("payment-method").value;

    if (street === "" || city === "") {
      alert("Please provide your full address.");
      return;
    }

    alert(`Thank you! Your order has been placed.\n
    Street: ${street}\n
    City: ${city}\n
    Payment Method: ${paymentMethod}\n
    Total: $${cartTotal}`);

    localStorage.removeItem("cart");
    localStorage.removeItem("cartTotal");

    window.location.href = "checkout.html";
  });
});
