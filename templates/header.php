<head>
    <title>
        <?php echo $title; ?>
    </title>
    <link href='styles/output.css' type='text/css' rel='stylesheet' />
    <link rel="icon" type="image/png" sizes="32x32" href="../rental/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../rental/icons/favicon-16x16.png">
    <style>
        body {
            background-color: #fff;
            color: #fea32b;
        }
    </style>

</head>

<body class="relative min-h-screen items-center flex flex-col mx-auto justify-between">
    <nav class="sticky top-0 bg-white w-full flex px-8 mx-auto items-center justify-between py-4 shadow-lg">
        <div class="flex items-center gap-8">
            <a href='/rental'>
                <img src='./icons/car.svg' alt='logo' class='h-8 w-8' />
            </a>
            <a id="rental" href='/rental' class="text-md font-normal hover:text-gray-900">
                Cars
            </a>
            <a id="clients" href='/rental/clients' class="text-md font-normal  hover:text-gray-900">
                Clients
            </a>
            <a id="rentals" href='/rental/rentals' class="text-md font-normal  hover:text-gray-900">
                Rentals
            </a>
            <a id="search" href='/rental/search' class="text-md font-normal  hover:text-gray-900">
                Search
            </a>
        </div>
        <div class="flex items-center gap-4">
            <a id="add_car" href="/rental/add_car.php" class=" inline-block text-sm px-4 py-2 leading-none border rounded border-black hover:border-transparent hover:text-white hover:bg-gray-900 mt-4 lg:mt-0">Add New Car</a>
            <a id="add_client" href="/rental/add_client.php" class="inline-block text-sm px-4 py-2 leading-none border rounded border-black hover:border-transparent hover:text-white hover:bg-gray-900 mt-4 lg:mt-0">Add New Client</a>
            <a id="add_rental" href="/rental/add_rental.php" class="inline-block text-sm px-4 py-2 leading-none border rounded border-black hover:border-transparent hover:text-white hover:bg-gray-900 mt-4 lg:mt-0">Add New Rental</a>
        </div>
    </nav>
    <script>
        var path = document.location.pathname;
        console.log(path);
        if (path == '/rental/') {
            var home = document.getElementById('rental');
            home.classList.add('text-gray-900', 'text-semibold');
        } else if (path == '/rental/clients') {
            var clients = document.getElementById('clients');
            clients.classList.add('text-gray-900', 'text-semibold');
        } else if (path == '/rental/rentals') {
            var rentals = document.getElementById('rentals');
            rentals.classList.add('text-gray-900', 'text-semibold');
        } else if (path == '/rental/search') {
            var search = document.getElementById('search');
            search.classList.add('text-gray-900', 'text-semibold');
        } else if (path == '/rental/add_car.php') {
            var add_car = document.getElementById('add_car');
            add_car.classList.add('border-transparent', 'text-white', 'bg-gray-900');
        } else if (path == '/rental/add_client.php') {
            var add_client = document.getElementById('add_client');
            add_client.classList.add('border-transparent', 'text-white', 'bg-gray-900');
        } else if (path == '/rental/add_rental.php') {
            var add_rental = document.getElementById('add_rental');
            add_rental.classList.add('border-transparent', 'text-white', 'bg-gray-900');
        }
    </script>
    <div class="flex gap-12">