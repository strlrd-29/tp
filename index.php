<?php

require_once 'config/connection.php';
$title = 'Cars - Home';

$sql = 'SELECT * FROM car';
$result = $connection->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
$immat = '';
$nPrice = 0;
$error = '';
$delete_error = '';

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['update'])) {
    $immat = $_POST['immat'];
    $nPrice = $_POST['nPrice'];
    $stmnt = $connection->prepare("UPDATE car SET priceByDay=:nPrice  WHERE immat=:immat;");
    try {
        $stmnt->execute(array('immat' => $immat, 'nPrice' => $nPrice));
        if (!$stmnt) {
            $error = 'Car not found!';
        } else if ($stmnt->rowCount() > 0) {
            $result = $connection->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $immat = '';
            $nPrice = 0;
        } else {
            $error = 'Registration number not found.';
        }
    } catch (PDOException $pe) {
        echo $pe->getMessage();
        $error = 'Registration number not found!';
    }
}

if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['delete']))) {
    $immat = $_POST['immat'];
    $stmnt = $connection->prepare("DELETE FROM car WHERE immat=:immat;");
    try {
        $stmnt->execute(array('immat' => $immat));
        if ($stmnt->rowCount() > 0) {
            $result = $connection->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $immat = '';
        } else {
            $delete_error = 'Registration number not found!';
        }
    } catch (PDOException $pe) {
        echo $pe->getMessage();
        $error = 'Registration number not found!';
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
    <tbody class="bg-gray-100">
        <?php while ($row = $result->fetch()) : ?>
            <tr class="h-10 border-b hover:bg-gray-200">
                <td class='cursor-pointer'><?php echo htmlspecialchars($row['immat']) ?></td>
                <td><?php echo htmlspecialchars($row['brand']) ?></td>
                <td><?php echo htmlspecialchars($row['model']) ?></td>
                <td><?php echo htmlspecialchars($row['priceByDay']) ?></td>

            </tr>
        <?php endwhile; ?>
    </tbody>


</table>
<div class="flex flex-col gap-8 pt-24">

    <form action="index.php" method="POST" class="p-4 border-2 border-gray-300 rounded-xl">

        <div class="">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="clientID">
                Registration Number
            </label>
            <input id='registration' type="text" class="mb-6 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="immat" placeholder="Registration Number" required value="<?php echo $immat ?>" />
            <div class="text-red-500"><?php echo $error; ?></div>
        </div>
        <div class="">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="clientID">
                New Price
            </label>
            <input type="number" min="0" class="mb-6 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="nPrice" placeholder="New price" required value="<?php echo $nPrice ?>" />
            <input type="hidden" name="update" />
        </div>
        <div class="">
            <input id='registration' type="submit" class="text-xl rounded-xl bg-orange-500 text-white hover:bg-white hover:text-orange-500 mx-auto p-2 hover:border-orange-500 border " value="Update">
        </div>

    </form>
    <form action="index.php" method="POST" class="p-4 border-2 border-gray-300 rounded-xl">

        <div class="">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="registration">
                Registration Number
            </label>
            <input id='registration2' type="text" class="mb-6 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="immat" placeholder="Registration Number" required value="<?php echo $immat ?>" />
            <input type="hidden" name="delete" />
            <div class="text-red-500 mb-2"><?php echo $delete_error; ?></div>
        </div>
        <div class="">
            <input type="submit" class="text-xl rounded-xl bg-red-500 text-white hover:bg-white hover:border-red-500 border hover:text-red-500 mx-auto p-2" value="Delete">
        </div>

    </form>
</div>
</div>
<script>
    document.addEventListener('click', function(e) {
        e = e || window.event;
        var target = e.target || e.srcElement,
            text = target.textContent || target.innerText;
        if (parseFloat(text) > 0) {
            document.getElementById('registration').value = text;
            document.getElementById('registration2').value = text;
        }
    }, false)
</script>
</body>
<?php include 'templates/footer.php' ?>

</html>