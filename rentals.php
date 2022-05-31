<?php

require_once 'config/connection.php';
$title = 'Rentals - Home';

$sql = 'SELECT * FROM rental';
$result = $connection->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);

$rentalID = '';
$lDate = '';
$error = '';
$delete_error = '';


if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['update'])) {
    $rentalID = $_POST['rentalID'];
    $lDate = $_POST['lDate'];
    $stmnt = $connection->prepare("UPDATE rental SET eDate=:lDate  WHERE rentalID=:rentalID;");
    try {
        $stmnt->execute(array('rentalID' => $rentalID, 'lDate' => $lDate));
        if (!$stmnt) {
            $error = 'Rental not found!';
        } else if ($stmnt->rowCount() > 0) {
            $result = $connection->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $rentalID = '';
            $lDate = '';
        } else {
            $error = 'Rental ID not found.';
        }
    } catch (PDOException $pe) {
        echo $pe->getMessage();
        $error = 'Rental ID not found!';
    }
}

if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['delete']))) {
    $rentalid = $_POST['rentalid'];
    $stmnt = $connection->prepare("DELETE FROM rental WHERE rentalID=:rentalid;");
    try {
        $stmnt->execute(array('rentalid' => $rentalid));
        if ($stmnt->rowCount() > 0) {
            $result = $connection->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $rentalID = '';
        } else {
            $delete_error = 'Rental ID not found!';
        }
    } catch (PDOException $pe) {
        echo $pe->getMessage();
        $error = 'Rental ID not found!';
    }
}

?>


<!DOCTYPE html>
<html>

<?php include 'templates/header.php' ?>
<table class='text-black text-center mt-12' style="width:65vw;">
    <thead class="h-12 bg-gray-200 border">
        <tr>
            <th>Rental ID</th>
            <th>Location Date</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Rental Type</th>
            <th>Registration number</th>
            <th>Client ID</th>
        </tr>
    </thead>
    <tbody class="bg-gray-100">
        <?php while ($row = $result->fetch()) : ?>
            <tr class="h-10 border-b hover:bg-gray-200">
                <td class='cursor-pointer'><?php echo htmlspecialchars($row['rentalID']) ?></td>
                <td><?php echo htmlspecialchars($row['locDate']) ?></td>
                <td><?php echo htmlspecialchars($row['sDate']) ?></td>
                <td><?php echo htmlspecialchars($row['eDate']) ?></td>
                <td><?php
                    if ($row['rentalType'] == "WD") {
                        echo "With Driver";
                    } else {
                        echo "No Driver";
                    }
                    ?></td>
                <td><?php echo htmlspecialchars($row['immat']) ?></td>
                <td><?php echo htmlspecialchars($row['idClient']) ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>


</table>
<div class="flex flex-col gap-8 pt-24">

    <form action="rentals.php" method="POST" class="p-4 border-2 border-gray-300 rounded-xl">

        <div class="">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="rentalid">
                Rental ID
            </label>
            <input id='rentalid' type="text" class="mb-6 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="rentalID" placeholder="Rental ID" required value="<?php echo $rentalID ?>" />
            <div class="text-red-500 mb-2"><?php echo $error; ?></div>
        </div>
        <div class="">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="clientID">
                New End Date
            </label>
            <input type="date" min="0" class="mb-6 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="lDate" placeholder="End Date" required value="<?php echo $lDate ?>" />
            <input type="hidden" name="update" />
        </div>
        <div class="">
            <input type="submit" class="text-xl rounded-xl bg-orange-500 text-white hover:bg-white hover:border-orange-500 border hover:text-orange-500 mx-auto p-2" value="Update">
        </div>

    </form>

    <form action="rentals.php" method="POST" class="p-4 border-2 border-gray-300 rounded-xl">
        <div class="">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="rentalid2">
                Rental ID
            </label>
            <input type="text" id='rentalid2' class="mb-6 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="rentalid" placeholder="Rental ID" required />
            <div class="text-red-500 mb-2"><?php echo $delete_error; ?></div>
            <input type="hidden" name="delete" />
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
            document.getElementById('rentalid').value = text;
            document.getElementById('rentalid2').value = text;
        }

    }, false)
</script>
</body>
<?php include 'templates/footer.php' ?>

</html>