<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Measurement Images</title>

    @vite('resources/css/app.css')

    <!-- FONT AWESOME -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

</head>

<body class="bg-gray-100 min-h-screen">

<!-- =======================================
NAVBAR
======================================== -->

<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <div class="h-16 flex items-center justify-between">

            <!-- LOGO -->
            <div>

                <h1 class="
                    text-lg
                    sm:text-2xl
                    font-black
                    text-gray-800
                ">
                    Poultry GIS
                </h1>

                <p class="
                    hidden sm:block
                    text-xs
                    text-gray-500
                ">
                    Poultry Farm Monitoring System
                </p>

            </div>

            <!-- MENU -->
            <div class="flex items-center gap-2">

                <a
                    href="/"
                    class="
                        px-3 sm:px-4
                        py-2
                        rounded-xl
                        text-gray-600
                        hover:bg-gray-100
                        transition
                        text-sm
                    "
                >
                    Dashboard
                </a>

                <a
                    href="/databank"
                    class="
                        px-3 sm:px-4
                        py-2
                        rounded-xl
                        bg-blue-500
                        text-white
                        shadow-sm
                        text-sm
                    "
                >
                    Databank
                </a>

            </div>

        </div>

    </div>

</nav>

<!-- =======================================
CONTENT
======================================== -->

<div class="max-w-7xl mx-auto p-4 sm:p-6">

    <!-- HEADER -->
    <div class="
        flex
        flex-col
        lg:flex-row
        gap-4
        lg:items-center
        lg:justify-between
        mb-8
    ">

        <div>

            <h1 class="
                text-2xl
                sm:text-4xl
                font-black
                text-gray-800
            ">
                Measurement Images
            </h1>

            <p class="text-gray-500 mt-2">
                AI building segmentation and measurements
            </p>

        </div>

        <a
            href="/databank"
            class="
                bg-gray-200
                hover:bg-gray-300
                text-gray-700
                px-5 py-3
                rounded-2xl
                font-semibold
                transition
                text-center
                w-full lg:w-auto
            "
        >

            <i class="fa-solid fa-arrow-left mr-2"></i>

            Back

        </a>

    </div>

    <!-- SEARCH + ACTION -->
<div class="
    flex
    flex-col
    lg:flex-row
    gap-4
    lg:items-center
    lg:justify-between
    mb-8
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
            placeholder="Search measurement..."
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

    <!-- BUTTONS -->
    <div class="flex flex-col sm:flex-row gap-3">

        <!-- DOWNLOAD DATA -->
        <a
            href="{{ route('databank.measurement.downloadData') }}"
            class="
                inline-flex
                items-center
                justify-center
                gap-2
                bg-blue-500
                hover:bg-blue-600
                text-white
                px-5 py-3
                rounded-2xl
                font-semibold
                transition
            "
        >

            <i class="fa-solid fa-file-excel"></i>

            Download All Data

        </a>

        <!-- DOWNLOAD IMAGES -->
        <a
            href="{{ route('databank.measurement.downloadImages') }}"
            class="
                inline-flex
                items-center
                justify-center
                gap-2
                bg-green-500
                hover:bg-green-600
                text-white
                px-5 py-3
                rounded-2xl
                font-semibold
                transition
            "
        >

            <i class="fa-solid fa-download"></i>

            Download All Images

        </a>

    </div>

</div>

    <!-- GRID -->
    <div
        id="measurementGrid"
        class="
            grid
            grid-cols-1
            lg:grid-cols-2
            gap-6
        "
    >

        @foreach($farms as $farm)

            <div
                class="
                    measurement-card
                    bg-white
                    rounded-3xl
                    shadow-sm
                    border border-gray-200
                    overflow-hidden
                "
            >

                <!-- IMAGE -->
                <div class="relative">

                    <img
                        src="/measurement/{{ basename($farm->screenshot) }}"
                        class="
                            w-full
                            h-64
                            sm:h-80
                            object-cover
                        "
                    >

                    <div class="
                        absolute
                        top-4
                        left-4
                        bg-black/60
                        text-white
                        px-4 py-2
                        rounded-xl
                        text-sm
                        font-semibold
                        backdrop-blur-sm
                    ">
                        AI Measurement
                    </div>

                </div>

                <!-- CONTENT -->
                <div class="p-5 sm:p-6">

                    <!-- TITLE -->
                    <div class="mb-5">

                        <h3 class="
                            text-xl
                            sm:text-2xl
                            font-black
                            text-gray-800
                        ">
                            {{ $farm->name }}
                        </h3>

                        <p class="
                            text-gray-500
                            text-sm
                            mt-1
                        ">
                            Measurement Results
                        </p>

                    </div>

                    <!-- TABLE -->
                    <div class="
                        overflow-x-auto
                        border border-gray-200
                        rounded-2xl
                    ">

                        <table class="w-full text-sm">

                            <thead class="bg-gray-100">

                                <tr>

                                    <th class="p-3 text-left">
                                        Object
                                    </th>

                                    <th class="p-3 text-left">
                                        Length
                                    </th>

                                    <th class="p-3 text-left">
                                        Width
                                    </th>

                                    <th class="p-3 text-left">
                                        Area
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($farm->measurements as $m)

                                    <tr class="border-t">

                                        <td class="p-3">
                                            {{ $m->object_name }}
                                        </td>

                                        <td class="p-3">
                                            {{ $m->length }} m
                                        </td>

                                        <td class="p-3">
                                            {{ $m->width }} m
                                        </td>

                                        <td class="p-3 font-semibold text-blue-600">
                                            {{ $m->area }} m²
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    <!-- BUTTON -->
                    <a
                        href="/measurement/{{ basename($farm->screenshot) }}"
                        download
                        class="
                            mt-5
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            w-full
                            bg-green-500
                            hover:bg-green-600
                            text-white
                            px-5 py-3
                            rounded-2xl
                            font-semibold
                            transition
                        "
                    >

                        <i class="fa-solid fa-download"></i>

                        Download Image

                    </a>

                </div>

            </div>

        @endforeach

    </div>

</div>

<!-- =======================================
SEARCH SCRIPT
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

            document
                .querySelectorAll('.measurement-card')
                .forEach(card => {

                    const text =
                        card.innerText.toLowerCase();

                    if (text.includes(keyword)) {

                        card.style.display = 'block';

                    } else {

                        card.style.display = 'none';
                    }

                });

        }
    );

</script>

</body>
</html>