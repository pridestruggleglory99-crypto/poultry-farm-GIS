<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Databank</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FONT AWESOME -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

</head>

<body class="bg-gray-100 min-h-screen overflow-x-hidden">

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
    HERO
    ======================================== -->

    <section class="max-w-7xl mx-auto px-4 sm:px-6 pt-6 sm:pt-10">

        <div class="
            relative
            overflow-hidden
            rounded-3xl
            bg-gradient-to-br
            from-slate-900
            via-slate-800
            to-slate-900
        ">

            <!-- DECOR -->
            <div class="
                absolute
                -top-20
                -right-20
                w-72
                h-72
                bg-blue-500/20
                rounded-full
                blur-3xl
            ">
            </div>

            <!-- CONTENT -->
            <div class="
                relative
                z-10
                p-6
                sm:p-10
                lg:p-14
            ">

                <div class="
                    grid
                    lg:grid-cols-2
                    gap-10
                    items-center
                ">

                    <!-- LEFT -->
                    <div>

                        <div class="
                            inline-flex
                            items-center
                            gap-2
                            bg-white/10
                            border border-white/10
                            px-4 py-2
                            rounded-full
                            text-blue-200
                            text-xs sm:text-sm
                            mb-5
                        ">

                            <i class="fa-solid fa-database"></i>

                            Poultry Farm Databank

                        </div>

                        <h1 class="
                            text-3xl
                            sm:text-4xl
                            lg:text-5xl
                            font-black
                            leading-tight
                            text-white
                        ">

                            Centralized GIS &
                            Poultry Farm Database

                        </h1>

                        <p class="
                            text-gray-300
                            text-sm
                            sm:text-base
                            lg:text-lg
                            mt-5
                            leading-relaxed
                        ">

                            Manage farm data,
                            original satellite imagery,
                            and AI measurement results
                            inside one integrated system.

                        </p>

                        <!-- BUTTON -->
                        <div class="
                            flex
                            flex-col
                            sm:flex-row
                            gap-3
                            mt-8
                        ">

                            <a
                                href="{{ route('databank.farms') }}"
                                class="
                                    bg-blue-500
                                    hover:bg-blue-600
                                    text-white
                                    px-6 py-3
                                    rounded-2xl
                                    font-semibold
                                    text-center
                                    transition
                                "
                            >
                                Open Databank
                            </a>

                            <a
                                href="/"
                                class="
                                    bg-white/10
                                    hover:bg-white/20
                                    border border-white/10
                                    text-white
                                    px-6 py-3
                                    rounded-2xl
                                    font-semibold
                                    text-center
                                    transition
                                "
                            >
                                Back to Dashboard
                            </a>

                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="hidden lg:block">

                        <div class="
                            bg-white/5
                            border border-white/10
                            backdrop-blur-xl
                            rounded-3xl
                            p-8
                        ">

                            <div class="grid grid-cols-2 gap-5">

                                <div class="
                                    bg-white/5
                                    rounded-2xl
                                    p-5
                                ">

                                    <div class="
                                        w-14 h-14
                                        rounded-2xl
                                        bg-blue-500
                                        flex items-center justify-center
                                        text-white text-2xl
                                        mb-4
                                    ">
                                        <i class="fa-solid fa-database"></i>
                                    </div>

                                    <h3 class="text-white font-bold text-lg">
                                        Farm Database
                                    </h3>

                                </div>

                                <div class="
                                    bg-white/5
                                    rounded-2xl
                                    p-5
                                ">

                                    <div class="
                                        w-14 h-14
                                        rounded-2xl
                                        bg-green-500
                                        flex items-center justify-center
                                        text-white text-2xl
                                        mb-4
                                    ">
                                        <i class="fa-solid fa-image"></i>
                                    </div>

                                    <h3 class="text-white font-bold text-lg">
                                        Original Images
                                    </h3>

                                </div>

                                <div class="
                                    bg-white/5
                                    rounded-2xl
                                    p-5
                                    col-span-2
                                ">

                                    <div class="
                                        w-14 h-14
                                        rounded-2xl
                                        bg-red-500
                                        flex items-center justify-center
                                        text-white text-2xl
                                        mb-4
                                    ">
                                        <i class="fa-solid fa-ruler-combined"></i>
                                    </div>

                                    <h3 class="text-white font-bold text-lg">
                                        AI Measurements
                                    </h3>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- =======================================
    STATS
    ======================================== -->

    <section class="max-w-7xl mx-auto px-4 sm:px-6 mt-6">

        <div class="
            grid
            grid-cols-2
            lg:grid-cols-3
            gap-3
        ">

            <!-- CARD -->
            <div class="
                bg-white
                rounded-2xl
                p-4 sm:p-5
                border border-gray-200
                shadow-sm
            ">

                <div class="
                    flex
                    flex-col
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                    gap-4
                ">

                    <div>

                        <p class="text-gray-500 text-xs sm:text-sm">
                            Total Farms
                        </p>

                        <h3 class="
                            text-2xl
                            sm:text-3xl
                            font-black
                            text-gray-800
                            mt-2
                        ">
                            {{ $farmsCount ?? 0 }}
                        </h3>

                    </div>

                    <div class="
                        w-12 h-12
                        sm:w-14 sm:h-14
                        rounded-2xl
                        bg-blue-100
                        text-blue-600
                        flex items-center justify-center
                        text-xl sm:text-2xl
                    ">
                        <i class="fa-solid fa-warehouse"></i>
                    </div>

                </div>

            </div>

            <!-- CARD -->
            <div class="
                bg-white
                rounded-2xl
                p-4 sm:p-5
                border border-gray-200
                shadow-sm
            ">

                <div class="
                    flex
                    flex-col
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                    gap-4
                ">

                    <div>

                        <p class="text-gray-500 text-xs sm:text-sm">
                            Original Images
                        </p>

                        <h3 class="
                            text-2xl
                            sm:text-3xl
                            font-black
                            text-gray-800
                            mt-2
                        ">
                            {{ $originalCount ?? 0 }}
                        </h3>

                    </div>

                    <div class="
                        w-12 h-12
                        sm:w-14 sm:h-14
                        rounded-2xl
                        bg-green-100
                        text-green-600
                        flex items-center justify-center
                        text-xl sm:text-2xl
                    ">
                        <i class="fa-solid fa-image"></i>
                    </div>

                </div>

            </div>

            <!-- CARD -->
            <div class="
                bg-white
                rounded-2xl
                p-4 sm:p-5
                border border-gray-200
                shadow-sm
            ">

                <div class="
                    flex
                    flex-col
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                    gap-4
                ">

                    <div>

                        <p class="text-gray-500 text-xs sm:text-sm">
                            Measurements
                        </p>

                        <h3 class="
                            text-2xl
                            sm:text-3xl
                            font-black
                            text-gray-800
                            mt-2
                        ">
                            {{ $measurementCount ?? 0 }}
                        </h3>

                    </div>

                    <div class="
                        w-12 h-12
                        sm:w-14 sm:h-14
                        rounded-2xl
                        bg-red-100
                        text-red-600
                        flex items-center justify-center
                        text-xl sm:text-2xl
                    ">
                        <i class="fa-solid fa-ruler-combined"></i>
                    </div>

                </div>

            </div>

        

        </div>

    </section>

    <!-- =======================================
    MENU
    ======================================== -->

    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-8 sm:py-10">

        <div class="
            grid
            md:grid-cols-2
            xl:grid-cols-3
            gap-6
        ">

            <!-- CARD -->
            <a
                href="{{ route('databank.farms') }}"
                class="
                    group
                    bg-white
                    rounded-3xl
                    p-6 sm:p-7
                    border border-gray-200
                    shadow-sm
                    hover:shadow-xl
                    hover:-translate-y-1
                    transition
                "
            >

                <div class="
                    w-16 h-16
                    rounded-2xl
                    bg-blue-100
                    text-blue-600
                    flex items-center justify-center
                    text-3xl
                ">
                    <i class="fa-solid fa-database"></i>
                </div>

                <h3 class="
                    text-2xl
                    font-black
                    text-gray-800
                    mt-6
                ">
                    Farm Data
                </h3>

                <p class="
                    text-gray-500
                    mt-3
                    leading-relaxed
                    text-sm sm:text-base
                ">
                    View and download poultry farm datasets.
                </p>

            </a>

            <!-- CARD -->
            <a
                href="{{ route('databank.original') }}"
                class="
                    group
                    bg-white
                    rounded-3xl
                    p-6 sm:p-7
                    border border-gray-200
                    shadow-sm
                    hover:shadow-xl
                    hover:-translate-y-1
                    transition
                "
            >

                <div class="
                    w-16 h-16
                    rounded-2xl
                    bg-green-100
                    text-green-600
                    flex items-center justify-center
                    text-3xl
                ">
                    <i class="fa-solid fa-image"></i>
                </div>

                <h3 class="
                    text-2xl
                    font-black
                    text-gray-800
                    mt-6
                ">
                    Original Images
                </h3>

                <p class="
                    text-gray-500
                    mt-3
                    leading-relaxed
                    text-sm sm:text-base
                ">
                    Access raw satellite screenshots before AI processing.
                </p>

            </a>

            <!-- CARD -->
            <a
                href="{{ route('databank.measurement') }}"
                class="
                    group
                    bg-white
                    rounded-3xl
                    p-6 sm:p-7
                    border border-gray-200
                    shadow-sm
                    hover:shadow-xl
                    hover:-translate-y-1
                    transition
                "
            >

                <div class="
                    w-16 h-16
                    rounded-2xl
                    bg-red-100
                    text-red-600
                    flex items-center justify-center
                    text-3xl
                ">
                    <i class="fa-solid fa-ruler-combined"></i>
                </div>

                <h3 class="
                    text-2xl
                    font-black
                    text-gray-800
                    mt-6
                ">
                    AI Measurements
                </h3>

                <p class="
                    text-gray-500
                    mt-3
                    leading-relaxed
                    text-sm sm:text-base
                ">
                    Segmentation and building measurement results.
                </p>

            </a>

        </div>

    </section>

</body>
</html>