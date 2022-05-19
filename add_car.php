<?php
require_once 'config/connection.php';
$title = "Cars - Add";

$data = [
    'immat' => '',
    'brand' => '',
    'model' => '',
    'priceByDay' => 0,
];

$errors = array('immat' => "", 'brand' => "", 'model' => "", 'priceByDay' => "");

$sql = '
    INSERT INTO car (immat, brand, model, priceByDay) VALUES (:immat, :brand, :model, :priceByDay);
';
$stmt = $connection->prepare($sql);



if (isset($_POST['submit'])) {
    if (isset($_POST['immat']) && isset($_POST['brand']) && isset($_POST['model']) && isset($_POST['priceByDay'])) {
        $data['immat'] = $_POST['immat'];
        $data['brand'] = $_POST['brand'];
        $data['model'] = $_POST['model'];
        $data['priceByDay'] = (float) $_POST['priceByDay'];
        try {
            $stmt->execute($data);
            $data['immat'] = '';
            $data['brand'] = '';
            $data['model'] = '';
            $data['priceByDay'] = 0;
        } catch (PDOException $e) {
            $errors['immat'] = "Registration number already exists";
        }
    } else if (empty($_POST['immat'])) {
        $errors['immat'] = "Registration number is required";
    } else if (empty($_POST['brand'])) {
        $errors['brand'] = "Brand is required";
    } else if (empty($_POST['model'])) {
        $errors['model'] = "Model is required";
    } else if (empty($_POST['priceByDay'])) {
        $errors['priceByDay'] = "Price is required";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php
include 'templates/header.php';
?>

<form action=<?php echo $_SERVER['PHP_SELF'] ?> class="full" method="POST">
    <div class="flex flex-wrap items-center justify-center mx-auto bg-white shadow-lg rounded-2xl p-3 w-1/2 mb-6">
        <div class="w-full px-3 mb-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="immat">
                Registration Number
            </label>
            <input maxlength="10" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="immat" type="text" name="immat" placeholder="Registration Number" value="<?php echo $data['immat'] ?>" />
            <div class="text-red-500"><?php echo $errors['immat']; ?></div>
        </div>
        <div class="w-full px-3 mb-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="brand">
                Car Brand
            </label>
            <input maxlength="20" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="brand" type="text" name="brand" placeholder="Car Brand" value="<?php echo $data['brand'] ?>" />
        </div>
        <div class="w-full px-3 mb-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="model">
                Car Model
            </label>
            <input required maxlength="20" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="model" type="text" name="model" placeholder="Car Model" value="<?php echo $data['model'] ?>" />
        </div>
        <div class="w-full px-3 mb-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="price">
                Car Price by Day
            </label>
            <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="priceByDay" type="number" min="0" name="priceByDay" placeholder="Car Price by Day" value="<?php echo $data['priceByDay'] ?>" />
        </div>
        <div class="mx-auto px-3 mt-3">
            <input type='submit' value='submit' name='submit' class='text-xl rounded-xl bg-orange-500 text-white hover:bg-white hover:text-orange-500 mx-auto p-2' />
        </div>
    </div>
</form>

</div>
</body>

<?php
include 'templates/footer.php';
?>

</html>