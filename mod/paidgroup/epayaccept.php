<html>
<body>
<b>THIS IS A TEST PAYMENT GATEWAY</b><br>Price = <?php echo  $_GET["amount"];?><br>
<a href ="<?php echo $_GET["acceptReturnUrl"];?>" >PAY</a>

<hr>THE LOG( Information being passed to Payment Gateway) --><br><br>
<?php
    var_dump($_GET);
?>
</body>
</html>
