<?php
require("./config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment</title>
</head>
<body>
    <form action="submit.php" method="POST">
        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key = <?php echo $publishableKey;?>
            data-amount = "1000"
            data-name = "vehicle parking"
            data-desc = "vehicle parking desc"
            data-currency = "usd"
            >
        </script>
    </form>
</body>
</html>