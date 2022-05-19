<?php
require_once 'config/connection.php';
$title = "Rentals - Add";


$data = [
    'idClient' => '',
    'immat' => '',
    'locDate' => '',
    'sDate' => '',
    'eDate' => '',
    'rentalType' => ''
];

$error = "";

$sql = 'INSERT INTO rental (locDate, sDate, eDate, rentalType, immat, idClient) VALUES (:locDate, :sDate, :eDate, :rentalType, :immat, :idClient);';
$stmt = $connection->prepare($sql);



if (isset($_POST['submit'])) {
    if (isset($_POST['idClient']) && isset($_POST['immat']) && isset($_POST['locDate']) && isset($_POST['sDate']) && isset($_POST['eDate']) && isset($_POST['rentalType'])) {
        $data['idClient'] = $_POST['idClient'];
        $data['immat'] = $_POST['immat'];
        $locDate = strtotime($_POST['locDate']);
        $data['locDate'] = date('Y-m-d', $locDate);
        $sDate = strtotime($_POST['sDate']);
        $data['sDate'] = date('Y-m-d', $sDate);
        $eDate = strtotime($_POST['eDate']);
        $data['eDate'] = date('Y-m-d', $eDate);
        // $data['sDate'] = strtotime($_POST['sDate']);
        // $data['eDate'] = strtotime($_POST['eDate']);
        $data['rentalType'] = $_POST['rentalType'];
        try {
            $stmt->execute($data);
            $data['idClient'] = '';
            $data['immat'] = '';
            $data['locDate'] = '';
            $data['sDate'] = '';
            $data['eDate'] = '';
            $data['rentalType'] = '';
            echo '<div style="bottom: 70px;" class="success_animation
                absolute right-1/2 w-1/4 bg-green-500 text-white text-center p-2 rounded-lg
            ">
                <strong>Success!</strong>
            </div>';
        } catch (PDOException $e) {
            echo $e->getMessage();
            $error = "Client id  or car immat number is not valid";
        }
    } else {
        $error = "Please fill all the fields";
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
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="clientID">
                Client ID
            </label>
            <input maxlength="10" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="clientID" type="text" name="idClient" placeholder="Please enter a clientID" value="<?php echo $data['idClient'] ?>" />
            <div class="text-red-500"><?php echo $error; ?></div>
        </div>
        <div class="w-full px-3 mb-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="immat">
                Registration Number
            </label>
            <input maxlength="20" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="immat" type="text" name="immat" placeholder="Please enter a registration number" value="<?php echo $data['immat'] ?>" />
        </div>
        <div class="w-full px-3 mb-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="locDate">
                Location Date
            </label>
            <input required maxlength="20" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="locDate" type="date" name="locDate" placeholder="Location Date" value="<?php echo $data['locDate'] ?>" />
        </div>
        <div class="w-full px-3 mb-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sDate">
                Start Date
            </label>
            <input required maxlength="20" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="sDate" type="date" name="sDate" placeholder="Start Date" value="<?php echo $data['sDate'] ?>" />
        </div>
        <div class="w-full px-3 mb-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="eDate">
                End Date
            </label>
            <input required maxlength="20" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="eDate" type="date" name="eDate" placeholder="End Date" value="<?php echo $data['eDate'] ?>" />
        </div>
        <div class="w-full px-3 mb-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="rentalType">
                Rental Type
            </label>
            <select name='rentalType' id="rentalType" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="WD">With Driver</option>
                <option value="ND">Without Driver</option>
            </select>
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