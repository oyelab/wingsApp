<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class PathaoWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // 1. Validate the request signature
        $signature = $request->header('X-PATHAO-Signature');
        $webhookSecret = 'wings@12345!'; // Use the webhook secret provided by Pathao

        if ($signature !== $webhookSecret) {
            return response()->json(['message' => 'Invalid Signature'], 403);
        }

        // 2. Retrieve and log the request payload
        $payload = $request->all();
        Log::info('Pathao Webhook Payload:', $payload);

        // 3. Process the webhook data
        $consignmentId = $payload['consignment_id'] ?? null;
        $merchantOrderId = $payload['merchant_order_id'] ?? null;
        $orderStatus = $payload['order_status'] ?? null;
        $orderStatusSlug = $payload['order_status_slug'] ?? null;
        $updatedAt = $payload['updated_at'] ?? null;

        // Handle the webhook based on the order status
        if ($orderStatusSlug === 'Delivered') {
            // Perform an action when the order is delivered
            $this->handleDeliveredOrder($consignmentId, $merchantOrderId, $updatedAt);
        } elseif ($orderStatusSlug === 'Return') {
            // Handle return order status
            $reason = $payload['reason'] ?? 'No reason provided';
            $this->handleReturnedOrder($consignmentId, $merchantOrderId, $reason);
        } elseif ($orderStatusSlug === 'Partial_Delivery') {
            // Handle partial payment
            $collectedAmount = $payload['collected_amount'] ?? 0;
            $this->handlePartialDelivery($consignmentId, $merchantOrderId, $collectedAmount);
        }

        // 4. Return a response to acknowledge receipt of the webhook
        return response()->json(['status' => 'Webhook received successfully'], 200);
    }

    // 5. Custom methods to handle specific statuses (optional)
    private function handleDeliveredOrder($consignmentId, $merchantOrderId, $updatedAt)
    {
        // Update order status in the database for Delivered status
        Log::info("Order $merchantOrderId delivered on $updatedAt");
        // Further logic to update the order status in your system
    }

    private function handleReturnedOrder($consignmentId, $merchantOrderId, $reason)
    {
        // Handle the return process
        Log::info("Order $merchantOrderId was returned. Reason: $reason");
        // Further logic to handle the return status
    }

    private function handlePartialDelivery($consignmentId, $merchantOrderId, $collectedAmount)
    {
        // Process partial payment
        Log::info("Order $merchantOrderId received partial payment of $collectedAmount");
        // Further logic for partial delivery updates
    }
    
}
