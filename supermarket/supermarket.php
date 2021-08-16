<?php
if (isset($_POST['enterProducts'])) {
    $table = drawInputTable($_POST['number']);
}

if (isset($_POST['calculateProducts'])) {
    $resultTable = drawResultTable($_POST['number']);
}

function drawResultTable($number)
{
    $table =    "<table class='table table-dark table-bordered'>
                    <thead>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>SubTotal</th>
                    </thead>
                    <tbody>";
    $total = 0;
    for ($i = 0; $i < $number; $i++) {
        $subtotal = calculateSubTotal($_POST['productPrice' . $i], $_POST['productQuantity' . $i]);
        $total += $subtotal;
        $discount = calculateDiscount($total) * $total;
        $totalAfterDiscount = $total - $discount;
        $delivery = calculateDelivery($_POST['city']);
        $netTotal = $delivery + $totalAfterDiscount;
        $table .=                       "<tr>
                                            <td>{$_POST['productName' .$i]}</td>
                                            <td>" . $_POST['productPrice' . $i] . "</td>
                                            <td>{$_POST['productQuantity' .$i]}</td>
                                            <td>$subtotal</td>
                                        </tr>";
    }

    $table .=                           "<tr>
                                                <th colspan=2> Client Name </th>
                                                <td colspan=2> {$_POST['name']} </td>
                                        </tr>
                                        <tr>
                                                <th colspan=2> City </th>
                                                <td colspan=2> {$_POST['city']} </td>
                                        </tr>
                                        <tr>
                                                <th colspan=2> Total </th>
                                                <td colspan=2> $total  EGP</td>
                                        </tr>
                                        <tr>
                                                <th colspan=2> Discount </th>
                                                <td colspan=2> $discount EGP </td>
                                        </tr>
                                        <tr>
                                                <th colspan=2> Total After Discount </th>
                                                <td colspan=2> $totalAfterDiscount EGP </td>
                                        </tr>
                                        <tr>
                                                <th colspan=2> Delivery </th>
                                                <td colspan=2> $delivery EGP </td>
                                        </tr>
                                        <tr > 
                                                <th colspan=2  class='text-danger'> Net Total </th>
                                                <td colspan=2  class='text-danger'> $netTotal EGP </td>
                                        </tr>
                </tbody>
                </table>";
    return $table;
}

function calculateDelivery($city)
{
    if ($city == 'Giza') {
        return 30;
    } elseif ($city == 'Cairo') {
        return 0;
    } elseif ($city == 'Alex') {
        return 50;
    } else {
        return 100;
    }
}

function calculateDiscount($total)
{
    if ($total < 1000) {
        return 0;
    } elseif ($total >= 1000 and $total < 3000) {
        return 0.1;
    } elseif ($total >= 3000 and $total < 4500) {
        return 0.15;
    } else {
        return 0.2;
    }
}

function calculateSubTotal($price, $quantity)
{
    return $price * $quantity;
}

function drawInputTable($number)
{
    $table =    "<table class='table table-dark'>
                    <thead>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </thead>
                    <tbody>";
    for ($i = 0; $i < $number; $i++) {
        $table .=   "<tr>
                                            <td><input type='text' class='form-control' name='productName$i' ></td>
                                            <td><input type='number' class='form-control' name='productPrice$i' ></td>
                                            <td><input type='number' class='form-control' name='productQuantity$i' ></td>
                                        </tr>";
    }
    $table .=       "</tbody>
                </table>
                <button class='btn btn-outline-dark' name='calculateProducts'> Calculate </button>";
    return $table;
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>SuperMarekt</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center text-dark h1"> SuperMarket </div>
            <div class="col-6 offset-3">
                <form method="post">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId" value="<?php if (isset($_POST['name'])) {
                                                                                                                                        echo $_POST['name'];
                                                                                                                                    } ?>">
                    </div>
                    <div class="form-group">
                        <label for="">City</label>
                        <select name="city" class="form-control" id="">
                            <option <?php if (isset($_POST['city']) && $_POST['city'] == 'Cairo') {
                                        echo 'selected';
                                    } ?> value="Cairo">Cairo</option>
                            <option <?php if (isset($_POST['city']) && $_POST['city'] == 'Giza') {
                                        echo 'selected';
                                    } ?> value="Giza">Giza</option>
                            <option <?php if (isset($_POST['city']) && $_POST['city'] == 'Alex') {
                                        echo 'selected';
                                    } ?> value="Alex">Alex</option>
                            <option <?php if (isset($_POST['city']) && $_POST['city'] == 'Others') {
                                        echo 'selected';
                                    } ?> value="Others">Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Number Of Products</label>
                        <input type="number" name="number" id="" class="form-control" placeholder="" aria-describedby="helpId" value="<?php if (isset($_POST['number'])) {
                                                                                                                                            echo $_POST['number'];
                                                                                                                                        } ?>">
                    </div>
                    <div class="form-group">
                        <button name="enterProducts" class="btn btn-outline-dark "> Enter Products </button>
                    </div>
                    <?php
                    if (isset($table)) {
                        echo $table;
                    }
                    if (isset($resultTable)) {
                        echo $resultTable;
                    }
                    ?>
                </form>

            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>