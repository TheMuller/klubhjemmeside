<html>
<body>
<b>THIS IS A TEST PAYMENT GATEWAY</b><br>Price = <?php echo  $_GET["amount"];?><br>
<a href ="<?php echo $_GET["acceptReturnUrl"]."?merchant=".$_GET["merchant"]."&amount=".$_GET["amount"]."&orderid=".$_GET["orderid"];?>" >PAY</a>

<hr>THE LOG( Information being passed to Payment Gateway) --><br><br>
<?php
    $query = http_build_query($_GET) . "\n";
    echo $query."<br><br><br><br>";
    var_dump($_GET);
?>
</body>
</html>
