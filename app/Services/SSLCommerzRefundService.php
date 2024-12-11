<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SSLCommerzRefundService
{
    private $apiDomain;
    private $storeId;
    private $storePassword;
    private $isLocalhost;

    public function __construct()
    {
        $this->apiDomain = config('sslcommerz.apiDomain');
        $this->storeId = config('sslcommerz.apiCredentials.store_id');
        $this->storePassword = config('sslcommerz.apiCredentials.store_password');
        $this->isLocalhost = config('sslcommerz.connect_from_localhost');
    }

    public function initiateRefund($bankTranId, $refundAmount, $refundRemarks, $refeId = null, $format = 'json')
    {
        $endpoint = $this->apiDomain . config('sslcommerz.apiUrl.refund_payment');

        $queryParams = [
            'bank_tran_id' => $bankTranId,
            'refund_amount' => $refundAmount,
            'refund_remarks' => $refundRemarks,
            'store_id' => $this->storeId,
            'store_passwd' => $this->storePassword,
            'format' => $format
        ];

        if ($refeId) {
            $queryParams['refe_id'] = $refeId;
        }

        $response = Http::withOptions([
            'verify' => !$this->isLocalhost
        ])->get($endpoint, $queryParams);

        if ($response->successful()) {
            $data = $response->json();

            return [
                'status' => $data['status'] ?? null,
                'APIConnect' => $data['APIConnect'] ?? null,
                'bank_tran_id' => $data['bank_tran_id'] ?? null,
                'trans_id' => $data['trans_id'] ?? null,
                'refund_ref_id' => $data['refund_ref_id'] ?? null,
                'errorReason' => $data['errorReason'] ?? null
            ];
        }

        return [
            'status' => 'failed',
            'error' => 'Failed to connect with SSLCOMMERZ',
            'http_code' => $response->status()
        ];
    }
}
