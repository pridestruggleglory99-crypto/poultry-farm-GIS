<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Original Images</title>

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
            gap-4
            sm:flex-row
            sm:items-center
            sm:justify-between
            mb-6
        ">

            <div>

                <h1 class="
                    text-2xl
                    sm:text-3xl
                    font-black
                    text-gray-800
                ">
                    Original Images
                </h1>

                <p class="
                    text-sm
                    text-gray-500
                    mt-1
                ">
                    Poultry farm satellite screenshots
                </p>

            </div>

            <!-- BACK -->
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
                    text-center
                    w-full sm:w-auto
                "
            >

                <i class="fa-solid fa-arrow-left mr-2"></i>

                Back

            </a>

        </div>

        <!-- SEARCH + DOWNLOAD -->
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
            placeholder="Search image..."
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

    <!-- DOWNLOAD ALL -->
    <a
        href="{{ route('databank.original.downloadAll') }}"
        class="
            inline-flex
            items-center
            justify-center
            gap-2
            bg-green-500
            hover:bg-green-600
            text-white
            px-6 py-3
            rounded-2xl
            font-semibold
            shadow-sm
            transition
            w-full lg:w-auto
        "
    >

        <i class="fa-solid fa-download"></i>

        Download All Images

    </a>

</div>

        <!-- =======================================
        IMAGE GRID
        ======================================== -->

        <div class="
            grid
            grid-cols-1
            sm:grid-cols-2
            lg:grid-cols-3
            gap-6
        ">

            @foreach($farms as $farm)

                <div
                    class="
                        image-card
                        bg-white
                        rounded-3xl
                        overflow-hidden
                        shadow-sm
                        border border-gray-200
                        hover:shadow-xl
                        transition
                        duration-300
                    "
                    data-name="{{ strtolower($farm->name) }}"
                    data-address="{{ strtolower($farm->address) }}"
                >

                    <!-- IMAGE -->
                    <div class="relative overflow-hidden">

                        <img
                            src="/{{ $farm->screenshot }}"
                            class="
                                w-full
                                h-60
                                object-cover
                                hover:scale-105
                                transition
                                duration-500
                            "
                        >

                        <!-- LABEL -->
                        <div class="
                            absolute
                            top-4
                            left-4
                            bg-black/60
                            text-white
                            text-xs
                            px-3 py-1
                            rounded-full
                            backdrop-blur-sm
                        ">

                            Original Image

                        </div>

                    </div>

                    <!-- CONTENT -->
                    <div class="p-5">

                        <h3 class="
                            text-xl
                            font-bold
                            text-gray-800
                            line-clamp-1
                        ">
                            {{ $farm->name }}
                        </h3>

                        <p class="
                            text-gray-500
                            text-sm
                            mt-2
                            line-clamp-2
                            min-h-[40px]
                        ">
                            {{ $farm->address }}
                        </p>

                        <!-- BUTTON -->
                        <a
                            href="/{{ $farm->screenshot }}"
                            download
                            class="
                                mt-5
                                w-full
                                inline-flex
                                items-center
                                justify-center
                                gap-2
                                bg-blue-500
                                hover:bg-blue-600
                                text-white
                                px-4 py-3
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
                    .querySelectorAll('.image-card')
                    .forEach(card => {

                        const name =
                            card.dataset.name || '';

                        const address =
                            card.dataset.address || '';

                        if (
                            name.includes(keyword) ||
                            address.includes(keyword)
                        ) {

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