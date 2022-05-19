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
            <a href='/rental' class="text-md font-normal hover:text-gray-900">
                Cars
            </a>
            <a href='/rental/clients' class="text-md font-normal  hover:text-gray-900">
                Clients
            </a>
            <a href='/rental/rentals' class="text-md font-normal  hover:text-gray-900">
                Rentals
            </a>
            <a href='/rental/search' class="text-md font-normal  hover:text-gray-900">
                Search
            </a>
        </div>
        <div class="flex items-center gap-4">
            <a href="/rental/add_car.php" class=" inline-block text-sm px-4 py-2 leading-none border rounded border-black hover:border-transparent hover:text-white hover:bg-gray-900 mt-4 lg:mt-0">Add New Car</a>
            <a href="/rental/add_client.php" class="inline-block text-sm px-4 py-2 leading-none border rounded border-black hover:border-transparent hover:text-white hover:bg-gray-900 mt-4 lg:mt-0">Add New Client</a>
            <a href="/rental/add_rental.php" class="inline-block text-sm px-4 py-2 leading-none border rounded border-black hover:border-transparent hover:text-white hover:bg-gray-900 mt-4 lg:mt-0">Add New Rental</a>
        </div>
    </nav>
    <div class="flex gap-12">