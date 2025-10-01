<!DOCTYPE html>
<html lang="en">
<head>
    <title>Processing...</title>
    <script>
        function submitForm() {
            document.getElementById('authorizeForm').submit();
        }
    </script>
</head>
<body onload="submitForm();">

@php
    // Normally, you'd fetch these from .env for security
    $loginID        = "28u8EBP5se";
    $transactionKey = "4e2gM7t85Mr6FEuy";

    // Donation amount passed from controller (default 0.00 if missing)
    $amount      = $amount ?? request()->get('amount', 0);
    $description = "Invoice Payment";

    $label    = "Submit Donations";
    $testMode = "false";
    $url      = "https://secure.authorize.net/gateway/transact.dll";

    // Generate invoice, sequence, timestamp
    $invoice   = date('Y-m-d H:i:s');
    $sequence  = rand(1, 1000);
    $timeStamp = time();

    // Generate fingerprint
    if (version_compare(PHP_VERSION, '5.1.2') >= 0) {
        $fingerprint = hash_hmac("md5", $loginID . "^" . $sequence . "^" . $timeStamp . "^" . $amount . "^", $transactionKey);
    } else {
        $fingerprint = bin2hex(mhash(MHASH_MD5, $loginID . "^" . $sequence . "^" . $timeStamp . "^" . $amount . "^", $transactionKey));
    }
@endphp

<form method="post" id="authorizeForm" action="{{ $url }}">
    <input type="hidden" name="x_login" value="{{ $loginID }}">
    <input type="hidden" name="x_amount" value="{{ $amount }}">
    <input type="hidden" name="x_description" value="{{ $description }}">
    <input type="hidden" name="x_invoice_num" value="{{ $invoice }}">
    <input type="hidden" name="x_fp_sequence" value="{{ $sequence }}">
    <input type="hidden" name="x_fp_timestamp" value="{{ $timeStamp }}">
    <input type="hidden" name="x_fp_hash" value="{{ $fingerprint }}">
    <input type="hidden" name="x_test_request" value="{{ $testMode }}">
    <input type="hidden" name="x_show_form" value="PAYMENT_FORM">
</form>

<p align="center" style="font-size:25px;">
    <strong>
        Your donation options are being transferred to Authorize.net.<br>
        Please wait a few seconds and don't press stop or the back button of your browser,<br>
        or your donation will be cancelled.
    </strong>
</p>

</body>
</html>
