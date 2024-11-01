<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Create Order</h2>

        @if(session('response'))
            <div class="alert alert-info">
                <strong>Response:</strong> {{ session('response') }}
            </div>
        @endif

        <form action="{{ route('create.order') }}" method="POST">
            @csrf  <!-- Laravel CSRF token for security -->
            <div class="form-group">
                <label for="store_id">Store ID</label>
                <input type="text" class="form-control" id="store_id" name="store_id" required>
            </div>
            <div class="form-group">
                <label for="merchant_order_id">Merchant Order ID (optional)</label>
                <input type="text" class="form-control" id="merchant_order_id" name="merchant_order_id">
            </div>
            <div class="form-group">
                <label for="recipient_name">Recipient Name</label>
                <input type="text" class="form-control" id="recipient_name" name="recipient_name" required>
            </div>
            <div class="form-group">
                <label for="recipient_phone">Recipient Phone</label>
                <input type="text" class="form-control" id="recipient_phone" name="recipient_phone" required>
            </div>
            <div class="form-group">
                <label for="recipient_address">Recipient Address</label>
                <input type="text" class="form-control" id="recipient_address" name="recipient_address" required>
            </div>
            <div class="form-group">
                <label for="recipient_city">Recipient City</label>
                <input type="text" class="form-control" id="recipient_city" name="recipient_city" required>
            </div>
            <div class="form-group">
                <label for="recipient_zone">Recipient Zone</label>
                <input type="text" class="form-control" id="recipient_zone" name="recipient_zone" required>
            </div>
            <div class="form-group">
                <label for="recipient_area">Recipient Area</label>
                <input type="text" class="form-control" id="recipient_area" name="recipient_area" required>
            </div>
            <div class="form-group">
                <label for="delivery_type">Delivery Type</label>
                <input type="text" class="form-control" id="delivery_type" name="delivery_type" required>
            </div>
            <div class="form-group">
                <label for="item_type">Item Type</label>
                <input type="text" class="form-control" id="item_type" name="item_type" required>
            </div>
            <div class="form-group">
                <label for="special_instruction">Special Instruction</label>
                <input type="text" class="form-control" id="special_instruction" name="special_instruction">
            </div>
            <div class="form-group">
                <label for="item_quantity">Item Quantity</label>
                <input type="number" class="form-control" id="item_quantity" name="item_quantity" required>
            </div>
            <div class="form-group">
                <label for="item_weight">Item Weight (kg)</label>
                <input type="number" class="form-control" id="item_weight" name="item_weight" required>
            </div>
            <div class="form-group">
                <label for="amount_to_collect">Amount to Collect</label>
                <input type="number" class="form-control" id="amount_to_collect" name="amount_to_collect" required>
            </div>
            <div class="form-group">
                <label for="item_description">Item Description</label>
                <textarea class="form-control" id="item_description" name="item_description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Order</button>
        </form>
    </div>
</body>
</html>
