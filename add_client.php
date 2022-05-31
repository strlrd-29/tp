<?php
require_once 'config/connection.php';
$title = "Clients - Add";

$data = [
    'idClient' => '',
    'fname' => '',
    'lname' => '',
    'phone' => '',
    'street' => '',
    'city' => '',
    'job' => ''
];



$errors = array('fname' => "", 'lname' => "", 'phone' => "", 'street' => "", 'street' => '', 'city' => '', 'job' => '', 'idClient' => '');


$sql = '
    INSERT INTO client (idClient, fName, lName, phone, street, city, job) VALUES (:idClient, :fname, :lname, :phone, :street, :city, :job);
';
$stmt = $connection->prepare($sql);



if (isset($_POST['submit'])) {
    if (isset($_POST['idClient']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['phone']) && isset($_POST['street']) && isset($_POST['city']) && isset($_POST['job'])) {
        $data['idClient'] = $_POST['idClient'];
        $data['fname'] = $_POST['fname'];
        $data['lname'] = $_POST['lname'];
        $data['phone'] = $_POST['phone'];
        $data['street'] = $_POST['street'];
        $data['city'] = $_POST['city'];
        $data['job'] = $_POST['job'];
        try {
            $stmt->execute($data);
            $data['idClient'] = '';
            $data['fname'] = '';
            $data['lname'] = '';
            $data['phone'] = '';
            $data['street'] = '';
            $data['city'] = '';
            $data['job'] = '';
        } catch (PDOException $e) {
            $errors['idClient'] = "Client ID already exists";
        }
    } else if (empty($_POST['fname'])) {
        $errors['immat'] = "Registration number is required";
    } else if (empty($_POST['brand'])) {
        $errors['brand'] = "Brand is required";
    } else if (empty($_POST['model'])) {
        $errors['model'] = "Model is required";
    } else if (empty($_POST['priceByDay'])) {
        $errors['priceByDay'] = "Price is required";
    } else if (empty($_POST['idClient'])) {
        $errors['idClient'] = "Client id is required";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php
include 'templates/header.php';
?>

<form action=<?php echo $_SERVER['PHP_SELF'] ?> class="full mt-4" method="POST">
    <div class="flex flex-wrap items-center justify-center mx-auto bg-white shadow-lg rounded-2xl p-3 w-1/2 mb-6">
        <div class="w-full px-3 mb-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="idClient">
                Client ID
            </label>
            <input maxlength="10" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="idClient" type="text" name="idClient" placeholder="Client ID" value="<?php echo $data['idClient'] ?>" />
            <div class="text-red-500"><?php echo $errors['idClient']; ?></div>
        </div>
        <div class="w-full px-3 mb-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fname">
                First Name
            </label>
            <input maxlength="10" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="fname" type="text" name="fname" placeholder="First Name" value="<?php echo $data['fname'] ?>" />
            <!-- <div class="text-red-500"><?php echo $errors['fname']; ?></div> -->
        </div>
        <div class="w-full px-3 mb-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="lname">
                Last Name
            </label>
            <input maxlength="20" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="lname" type="text" name="lname" placeholder="Last Name" value="<?php echo $data['lname'] ?>" />
        </div>
        <div class="w-full px-3 mb-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                Phone Number
            </label>
            <input required maxlength="20" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="phone" type="text" name="phone" placeholder="Phone Number" value="<?php echo $data['phone'] ?>">
        </div>
        <div class="w-full px-3 mb-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="street">
                Street
            </label>
            <input required maxlength="20" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="street" type="text" name="street" placeholder="Street" value="<?php echo $data['street'] ?>" />
        </div>
        <div class="w-full px-3 mb-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                City
            </label>
            <input required maxlength="20" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="city" type="text" name="city" placeholder="City" value="<?php echo $data['city'] ?>" />
        </div>
        <div class="w-full px-3 mb-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="job">
                Job
            </label>
            <input required maxlength="20" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="job" type="text" name="job" placeholder="Job" value="<?php echo $data['job'] ?>" />
        </div>

        <div class="mx-auto px-3 mt-3">
            <input type='submit' value='submit' name='submit' class='border hover:border-orange-500 text-xl rounded-xl bg-orange-500 text-white hover:bg-white hover:text-orange-500 mx-auto p-2' />
        </div>
    </div>
</form>
</div>
</body>

<?php
include 'templates/footer.php';
?>

</html>