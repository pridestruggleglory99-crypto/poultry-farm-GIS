<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Farm Data</title>

    @vite('resources/css/app.css')

    <!-- FONT AWESOME -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

</head>

<body class="bg-gray-100 min-h-screen">

    <!-- =======================================
    HEADER
    ======================================== -->

    <div class="bg-white border-b border-gray-200">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4">

            <div class="
                flex
                flex-col
                gap-4
                sm:flex-row
                sm:items-center
                sm:justify-between
            ">

                <!-- TITLE -->
                <div>

                    <h1 class="
                        text-2xl
                        sm:text-3xl
                        font-black
                        text-gray-800
                    ">
                        Farm Data
                    </h1>

                    <p class="
                        text-sm
                        text-gray-500
                        mt-1
                    ">
                        Poultry farm database and information
                    </p>

                </div>

                <!-- ACTION -->
                <a
                    href="/databank"
                    class="
                        bg-gray-200
                        hover:bg-gray-300
                        text-gray-700
                        px-5 py-2.5
                        rounded-xl
                        font-medium
                        transition
                        w-full sm:w-auto
                        text-center
                    "
                >

                    <i class="fa-solid fa-arrow-left mr-2"></i>

                    Back

                </a>

            </div>

        </div>

    </div>

    <!-- =======================================
    CONTENT
    ======================================== -->

    <div class="max-w-7xl mx-auto p-4 sm:p-6">

        <!-- SEARCH + DOWNLOAD -->
        <div class="
            flex
            flex-col
            gap-4
            lg:flex-row
            lg:items-center
            lg:justify-between
            mb-6
        ">

            <!-- SEARCH -->
            <div class="relative w-full lg:max-w-md">

    <i class="
        fa-solid fa-magnifying-glass
        absolute
        left-4
        top-1/2
        -translate-y-1/2
        text-gray-400
    ">
    </i>

    <input
        type="text"
        id="searchInput"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search farm..."
        class="
            w-full
            border border-gray-300
            rounded-2xl
            pl-11 pr-4 py-3
            focus:outline-none
            focus:ring-2
            focus:ring-blue-500
            bg-white
        "
    >

</div>

            <!-- DOWNLOAD -->
            <a
                href="{{ route('databank.farms.download') }}"
                class="
                    bg-green-500
                    hover:bg-green-600
                    text-white
                    px-6 py-3
                    rounded-2xl
                    font-semibold
                    shadow-sm
                    transition
                    text-center
                    w-full lg:w-auto
                "
            >

                <i class="fa-solid fa-download mr-2"></i>

                Download Excel

            </a>

        </div>

        <!-- =======================================
        MOBILE CARD VIEW
        ======================================== -->

        <div class="grid gap-4 md:hidden">

    @foreach($farms as $farm)

        <div class="
            farm-card
            bg-white
            rounded-2xl
            p-5
            shadow-sm
            border border-gray-200
        ">

            <!-- NAME -->
            <div class="mb-4">

                <p class="
                    text-xs
                    uppercase
                    tracking-wide
                    text-gray-400
                    mb-1
                ">
                    Farm Name
                </p>

                <h3 class="
                    text-lg
                    font-bold
                    text-gray-800
                ">
                    {{ $farm->name }}
                </h3>

            </div>

            <!-- ADDRESS -->
            <div class="mb-4">

                <p class="
                    text-xs
                    uppercase
                    tracking-wide
                    text-gray-400
                    mb-1
                ">
                    Address
                </p>

                <p class="text-gray-600 text-sm">
                    {{ $farm->address }}
                </p>

            </div>

            <!-- PHONE -->
            <div>

                <p class="
                    text-xs
                    uppercase
                    tracking-wide
                    text-gray-400
                    mb-1
                ">
                    Phone
                </p>

                <p class="
                    text-blue-600
                    font-semibold
                ">
                    {{ $farm->phone }}
                </p>

            </div>

        </div>

    @endforeach

</div>

        <!-- =======================================
        DESKTOP TABLE
        ======================================== -->

        <div class="
            hidden md:block
            bg-white
            rounded-3xl
            shadow-sm
            border border-gray-200
            overflow-hidden
        ">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="
                                p-5
                                text-left
                                text-sm
                                font-semibold
                                text-gray-600
                            ">
                                Name
                            </th>

                            <th class="
                                p-5
                                text-left
                                text-sm
                                font-semibold
                                text-gray-600
                            ">
                                Address
                            </th>

                            <th class="
                                p-5
                                text-left
                                text-sm
                                font-semibold
                                text-gray-600
                            ">
                                Phone
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($farms as $farm)

                           <tr class="
    farm-row
    border-t
    hover:bg-gray-50
    transition
">

                                <!-- NAME -->
                                <td class="p-5">

                                    <div class="
                                        font-semibold
                                        text-gray-800
                                    ">
                                        {{ $farm->name }}
                                    </div>

                                </td>

                                <!-- ADDRESS -->
                                <td class="p-5 text-gray-600">

                                    {{ $farm->address }}

                                </td>

                                <!-- PHONE -->
                                <td class="p-5">

                                    <span class="
                                        bg-blue-50
                                        text-blue-600
                                        px-3 py-1
                                        rounded-xl
                                        text-sm
                                        font-medium
                                    ">
                                        {{ $farm->phone }}
                                    </span>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- =======================================
    AUTO SEARCH SUBMIT
    ======================================== -->

<script>

    const searchInput =
        document.getElementById(
            'searchInput'
        );

    searchInput.addEventListener(
        'keyup',
        function () {

            const keyword =
                this.value.toLowerCase();

            // =========================
            // MOBILE CARD
            // =========================
            document
                .querySelectorAll('.farm-card')
                .forEach(card => {

                    const text =
                        card.innerText.toLowerCase();

                    if (text.includes(keyword)) {

                        card.style.display = 'block';

                    } else {

                        card.style.display = 'none';
                    }

                });

            // =========================
            // DESKTOP TABLE
            // =========================
            document
                .querySelectorAll('.farm-row')
                .forEach(row => {

                    const text =
                        row.innerText.toLowerCase();

                    if (text.includes(keyword)) {

                        row.style.display = 'table-row';

                    } else {

                        row.style.display = 'none';
                    }

                });

        }
    );

</script>

</body>
</html>