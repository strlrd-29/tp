<?php

require_once 'config/connection.php';
$title = 'Cars - Home';

$sql = 'SELECT * FROM car';
$result = $connection->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
$brand = '';
$model = '';
$price = 1000;
$error = '';
$price_error = '';


if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['normal'])) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $stmnt = $connection->prepare("SELECT * FROM car WHERE brand=:brand AND model=:model;");
    try {
        $stmnt->execute(array('brand' => $brand, 'model' => $model));
        if (!$stmnt) {
            $error = 'Car not found!';
        } else if ($stmnt->rowCount() > 0) {
            $result = $stmnt;
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $brand = '';
            $model = '';
        } else {
            $error = 'Car brand or model not found.';
        }
    } catch (PDOException $pe) {
        echo $pe->getMessage();
        $error = 'Oops an error occurred!';
    }
}

if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['stored']))) {
    $price = $_POST['price'];
    $sql = 'CALL getCarsByPrice(:price)';
    $stmnt = $connection->prepare($sql);
    try {
        $stmnt->execute(array('price' => $price));
        if (!$stmnt) {
            $price_error = 'Car not found!';
        } else if ($stmnt->rowCount() > 0) {
            $result = $stmnt;
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $price = 1000;
        } else {
            $price_error = 'Car price not found.';
        }
    } catch (PDOException $pe) {
        echo $pe->getMessage();
        $price_error = 'Oops an error occurred!';
    }
}


?>


<!DOCTYPE html>
<html>

<?php include 'templates/header.php' ?>
<table class='text-black text-center mt-10' style="width: 65vw;">
    <thead class="h-12 bg-gray-200 border">
        <tr>
            <th>Registration Number</th>
            <th>Car Brand</th>
            <th>Car Model</th>
            <th>Car Price</th>
        </tr>
    </thead>
    <tbody class="bg-gray-100 h-fit">
        <?php if ($result->rowCount() > 0) : ?>
            <?php while ($row = $result->fetch()) : ?>
                <tr class="h-10 border-b hover:bg-gray-200">
                    <td><?php echo htmlspecialchars($row['immat']) ?></td>
                    <td><?php echo htmlspecialchars($row['brand']) ?></td>
                    <td><?php echo htmlspecialchars($row['model']) ?></td>
                    <td><?php echo htmlspecialchars($row['priceByDay']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else : ?>
            <tr>
                <td colspan="4">No cars found!</td>
            </tr>
        <?php endif; ?>
    </tbody>


</table>
<div class="flex flex-col gap-8 pt-24">

    <form action="search.php" method="POST" class="p-4 border-2 border-gray-300 rounded-xl">

        <div class="">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="brand">
                Brand
            </label>
            <input type="text" id="brand" class="mb-6 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="brand" placeholder="Brand" required value="<?php echo $brand ?>" />
            <div class="text-red-500 mb-2"><?php echo $error; ?></div>
        </div>
        <div class="">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="model">
                Model
            </label>
            <input type="text" id="model" class="mb-6 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="model" placeholder="Model" required value="<?php echo $model ?>" />
        </div>
        <input type="hidden" name="normal" />
        <input type="submit" class="text-xl rounded-xl bg-orange-500 text-white hover:bg-white hover:text-orange-500 mx-auto p-2 hover:border-orange-500 border" value="Search">

    </form>
    <form action="search.php" method="POST" class="p-4 border-2 border-gray-300 rounded-xl">

        <div class="">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="locPrice">
                Location Price
            </label>
            <input type="number" min='0' id="locPrice" class="mb-6 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="price" placeholder="Location Price" required value="<?php echo $price ?>" />
            <div class="text-red-500 mb-2"><?php echo $price_error; ?></div>
        </div>
        <input type="hidden" name="stored" />
        <input type="submit" class="text-xl rounded-xl bg-orange-500 text-white hover:bg-white hover:text-orange-500 mx-auto p-2 hover:border-orange-500 border" value="Search">

    </form>
</div>
</div>
</body>
<?php include 'templates/footer.php' ?>

</html>