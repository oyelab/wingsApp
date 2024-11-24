// Function to calculate the shipping price
async function calculateShippingPrice() {
    const recipientCity = document.getElementById('recipient_city').value;
    const recipientZone = document.getElementById('recipient_zone').value;
    const quantityElement = document.getElementById('quantity'); // Ensure this element exists in your DOM

    let quantity = 1; // Default to 1 if quantity is not provided
    if (quantityElement) {
        quantity = parseInt(quantityElement.value) || 1; // Fallback to 1 if quantity is invalid
    }

    if (recipientCity && recipientZone) {
        try {
            const response = await fetch('/calculate-shipping', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    recipient_city: recipientCity,
                    recipient_zone: recipientZone,
                    quantity: quantity
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();
            const shipping = data.data.final_price || 0; // Safely access the delivery_fee from the response

            // Update the DOM with the shipping value
            document.getElementById('shipping').textContent = `৳ ${shipping.toFixed(2)}`;
            document.getElementById('hidden_shipping_charge').value = shipping.toFixed(2);

            // Recalculate totals with the new shipping value
            calculateCartSummary(shipping);

        } catch (error) {
            console.error("Error calculating shipping price:", error);
        }
    } else {
        // If city/zone not selected, set default shipping and recalculate
        const defaultShipping = 120;
        document.getElementById('shipping').textContent = `৳ ${defaultShipping.toFixed(2)}`;
        document.getElementById('hidden_shipping_charge').value = defaultShipping.toFixed(2);
        calculateCartSummary(defaultShipping);
    }
}

// Function to calculate cart summary
function calculateCartSummary(shipping) {
    let subtotal = 0;
    let discount = 0;
    const cartItems = @json($cartItems); // PHP data passed to JS
    const voucherDiscountPercentage = @json($voucherDiscount); // Voucher percentage

    // Calculate subtotal and discount
    cartItems.forEach(item => {
        const quantity = item.quantity;
        const offerPrice = item.offerPrice ? item.offerPrice : item.price; // Use offer price if available
        subtotal += item.price * quantity; // Regular price * quantity
        discount += (item.price - offerPrice) * quantity; // Discounted amount
    });

    const totalBeforeVoucher = subtotal - discount;

    // Calculate voucher discount
    const voucherDiscountAmount = (totalBeforeVoucher * voucherDiscountPercentage) / 100;

    // Calculate final total with shipping
    const total = totalBeforeVoucher - voucherDiscountAmount + shipping;

    // Update the DOM elements
    document.getElementById('subtotal').textContent = `৳ ${subtotal.toFixed(2)}`;
    document.getElementById('discount').textContent = discount > 0 ? `৳ ${discount.toFixed(2)}` : '';
    document.getElementById('voucher').textContent = voucherDiscountAmount > 0 ? `৳ ${voucherDiscountAmount.toFixed(2)}` : '';
    document.getElementById('total').textContent = `৳ ${total.toFixed(2)}`;
    
    // Hide rows if no discount or voucher
    document.getElementById('discount').closest('.item').style.display = discount > 0 ? '' : 'none';
    document.getElementById('voucher').closest('.item').style.display = voucherDiscountAmount > 0 ? '' : 'none';

    // Update hidden voucher input
    document.getElementById('voucherInput').value = voucherDiscountAmount > 0 ? voucherDiscountAmount.toFixed(2) : '';

    // Call updatePayable to set the payable amount based on the payment method
    updatePayable(total, shipping);
}

// Function to update payable amount based on payment method
function updatePayable(total, shipping) {
    const selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;

    let payable = total; // Default to total
    if (selectedPaymentMethod === 'COD') {
        // For COD, only shipping charge is payable
        payable = shipping;
    }

    document.getElementById('payable').textContent = `৳ ${payable.toFixed(2)}`;
}

// Event listeners for payment method changes
document.querySelectorAll('input[name="payment_method"]').forEach(input => {
    input.addEventListener('click', () => {
        const total = parseFloat(document.getElementById('total').textContent.replace('৳ ', '')) || 0;
        const shipping = parseFloat(document.getElementById('hidden_shipping_charge').value) || 0;
        updatePayable(total, shipping);
    });
});

// Initial calculations on page load
document.addEventListener("DOMContentLoaded", () => calculateShippingPrice());
