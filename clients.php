<?php

require_once 'config/connection.php';
$title = 'Clients - Home';

$sql = 'SELECT * FROM client';
$result = $connection->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);

$error = '';

if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    $clientid = $_POST['clientid'];
    $stmnt = $connection->prepare("DELETE FROM client WHERE idClient=:clientid;");
    try {
        $stmnt->execute(array('clientid' => $clientid));
        if ($stmnt->rowCount() > 0) {
            $result = $connection->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $clientid = '';
        } else {
            $error = 'Client ID not found!';
        }
    } catch (PDOException $pe) {
        echo $pe->getMessage();
        $error = 'Client ID not found!';
    }
}

?>


<!DOCTYPE html>
<html>

<?php include 'templates/header.php' ?>
<table class='text-black text-center mt-10' style="width: 65vw;">
    <thead class="h-12 bg-gray-200 border">
        <tr>
            <th>Client ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone number</th>
            <th>Street</th>
            <th>City</th>
            <th>Job</th>
        </tr>
    </thead>
    <tbody class="bg-gray-100">
        <?php while ($row = $result->fetch()) : ?>
            <tr class="h-10 border-b hover:bg-gray-200">
                <td class='cursor-pointer'><?php echo htmlspecialchars($row['idClient']) ?></td>
                <td><?php echo htmlspecialchars($row['fName']) ?></td>
                <td><?php echo htmlspecialchars($row['lName']) ?></td>
                <td><?php echo htmlspecialchars($row['phone']) ?></td>
                <td><?php echo htmlspecialchars($row['street']) ?></td>
                <td><?php echo htmlspecialchars($row['city']) ?></td>
                <td><?php echo htmlspecialchars($row['job']) ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<div class="flex flex-col gap-8 pt-24">
    <form action="clients.php" method="POST" class="p-4 border-2 border-gray-300 rounded-xl">
        <div class="">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="clientID">
                Client ID
            </label>
            <input id='clientid' type="text" id='clientID' class="mb-6 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="clientid" placeholder="Client ID" required />
            <div class="text-red-500 mb-2"><?php echo $error; ?></div>
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
            document.getElementById('clientid').value = text;
        }
    }, false)
</script>
</body>
<?php include 'templates/footer.php' ?>

</html>