<?php
// include database configuration file
include 'dbConfig.php';

// initializ shopping cart class
include 'Cart.php';
$cart = new Cart;

// redirect to home if cart is empty
if($cart->total_items() <= 0){
    header("Location: index.php");
}

// set customer ID in session
$_SESSION['sessCustomerID'] = 1;

// get customer details by session customer ID
$query = $db->query("SELECT * FROM customers WHERE id = ".$_SESSION['sessCustomerID']);
$custRow = $query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pagar</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{width: 100%;padding: 50px;}
    .table{width: 65%;float: left;}
    .shipAddr{width: 30%;float: left;margin-left: 30px;}
    .footBtn{width: 95%;float: left;}
    .orderBtn {float: right;}
    </style>
</head>
<body>
<div class="container">
    <h1>Vista previa del pedido</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->total_items() > 0){
            //get cart items from session
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
        ?>
        <tr>
            <td><?php echo $item["name"]; ?></td>
            <td><?php echo '$'.$item["price"].''; ?></td>
            <td><?php echo $item["qty"]; ?></td>
            <td><?php echo '$'.$item["subtotal"].''; ?></td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="4"><p>No hay artículos en su carrito......</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo '$'.$cart->total().''; ?></strong></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
    <div class="shipAddr">
        <h4>Detalles de envío</h4>
        <p><?php echo $custRow['name']; ?></p>
        <p><?php echo $custRow['email']; ?></p>
        <p><?php echo $custRow['phone']; ?></p>
        <p><?php echo $custRow['address']; ?></p>
    </div>
    <div class="footBtn">
        <a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Seguir comprando</a>
        <a href="cartAction.php?action=placeOrder" class="btn btn-success orderBtn">Realizar pedido <i class="glyphicon glyphicon-menu-right"></i></a>
    </div>
</div>
</body>
</html>