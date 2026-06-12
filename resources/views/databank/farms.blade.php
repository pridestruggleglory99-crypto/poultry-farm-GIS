<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Farm Data</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- FONT AWESOME -->
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
/>

<style>

    .content-wide {
        width: 100%;
        max-width: 1600px;
        margin-left: auto;
        margin-right: auto;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    @media (min-width: 640px) {

        .content-wide {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

    }

    @media (min-width: 1024px) {

        .content-wide {
            padding-left: 2rem;
            padding-right: 2rem;
        }

    }

    /* TABLE */
    .farm-table {
        table-layout: fixed;
        width: 100%;
    }

    .farm-table td,
    .farm-table th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .farm-table .col-name {
        width: 18%;
    }

    .farm-table .col-address {
        width: 35%;
        white-space: normal;
    }

    .farm-table .col-phone {
        width: 15%;
    }

    .farm-table .col-district {
        width: 15%;
    }

    .farm-table .col-maps {
        width: 10%;
    }

    /* MOBILE CARD */
    .card-field {
        display: grid;
        grid-template-columns: 72px 1fr;
        column-gap: 10px;
        align-items: start;
        padding: 7px 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .card-field:last-of-type {
        border-bottom: none;
    }

    .card-label {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #9ca3af;
        padding-top: 1px;
        line-height: 1.4;
    }

    .card-value {
        font-size: 14px;
        color: #374151;
        line-height: 1.5;
        word-break: break-word;
    }

</style>
 

</head>

<x-back-to-top/>

<body class="bg-gray-100 min-h-screen">

 
<!-- HEADER -->
<div class="bg-white border-b border-gray-200">

    <div class="content-wide py-4">

        <div class="
            flex
            flex-col
            gap-4
            sm:flex-row
            sm:items-center
            sm:justify-between
        ">

            <div>

                <h1 class="text-2xl sm:text-3xl font-black text-gray-800">
                    Farm Data
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Poultry farm database and information
                </p>

            </div>

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
                    text-sm
                "
            >

                <i class="fa-solid fa-arrow-left mr-2"></i>

                Back

            </a>

        </div>

    </div>

</div>

<!-- CONTENT -->
<div class="content-wide py-4 sm:py-6">

    <!-- SEARCH + FILTER + DOWNLOAD -->
    <div class="
        flex
        flex-col
        gap-3
        lg:flex-row
        lg:items-center
        lg:justify-between
        mb-6
    ">

        <!-- LEFT -->
        <div class="flex flex-col sm:flex-row gap-3 w-full lg:max-w-4xl">

            <!-- SEARCH -->
            <div class="relative flex-1">

                <i class="
                    fa-solid fa-magnifying-glass
                    absolute
                    left-4
                    top-1/2
                    -translate-y-1/2
                    text-gray-400
                "></i>

                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search farm..."
                    class="
                        w-full
                        border border-gray-300
                        rounded-2xl
                        pl-11 pr-4 py-3
                        focus:outline-none
                        focus:ring-2
                        focus:ring-blue-500
                        bg-white text-sm
                    "
                >

            </div>

            <!-- FILTER -->
            <select
                id="districtFilter"
                class="
                    border border-gray-300
                    rounded-2xl
                    px-4 py-3
                    bg-white
                    focus:outline-none
                    focus:ring-2
                    focus:ring-blue-500
                    text-sm
                    w-full sm:w-60
                "
            >

                <option value="">
                    All Kecamatan
                </option>

                @foreach($districts as $district)

                    <option value="{{ strtolower($district) }}">
                        {{ $district }}
                    </option>

                @endforeach

            </select>

            <!-- RESET -->
            <button
                type="button"
                id="resetFilterBtn"
                class="
                    bg-gray-200
                    hover:bg-gray-300
                    text-gray-700
                    px-5 py-3
                    rounded-2xl
                    font-medium
                    transition
                    text-sm
                    whitespace-nowrap
                "
            >

                Reset

            </button>

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
                text-sm
            "
        >

            <i class="fa-solid fa-download mr-2"></i>

            Download Excel

        </a>

    </div>

    <!-- MOBILE -->
    <div class="grid gap-3 md:hidden">

        @foreach($farms as $farm)

            <div
                class="
                    farm-card
                    bg-white
                    rounded-2xl
                    shadow-sm
                    border border-gray-200
                    overflow-hidden
                "
                data-search="{{ strtolower($farm->name . ' ' . $farm->address . ' ' . $farm->phone . ' ' . $farm->district) }}"
                data-district="{{ strtolower($farm->district) }}"
            >

                <div class="px-4 pt-4 pb-3 border-b border-gray-100">

                    <h3 class="font-bold text-gray-800 text-base leading-snug">
                        {{ $farm->name }}
                    </h3>

                </div>

                <div class="px-4 py-1">

                    <div class="card-field">

                        <span class="card-label">
                            Address
                        </span>

                        <span class="card-value">
                            {{ $farm->address }}
                        </span>

                    </div>

                    <div class="card-field">

                        <span class="card-label">
                            Phone
                        </span>

                        <span class="card-value font-semibold text-blue-600">
                            {{ $farm->phone }}
                        </span>

                    </div>

                    <div class="card-field">

                        <span class="card-label">
                            Kecamatan
                        </span>

                        <span class="card-value font-medium">
                            {{ $farm->district ?? '—' }}
                        </span>

                    </div>

                </div>

                <div class="px-4 pb-4 pt-3">

                    <a
                        href="{{ $farm->google_maps }}"
                        target="_blank"
                        class="
                            inline-flex
                            items-center
                            gap-2
                            bg-green-500
                            hover:bg-green-600
                            text-white
                            px-4 py-2
                            rounded-xl
                            text-sm
                            font-medium
                            transition
                        "
                    >

                        <i class="fa-solid fa-location-dot"></i>

                        Open in Google Maps

                    </a>

                </div>

            </div>

        @endforeach

    </div>

    <!-- DESKTOP -->
    <div class="
        hidden
        md:block
        bg-white
        rounded-3xl
        shadow-sm
        border border-gray-200
        overflow-hidden
    ">

        <div class="overflow-x-auto">

            <table class="farm-table">

                <thead class="bg-gray-50 border-b border-gray-200">

                    <tr>

                        <th class="
                            p-5
                            text-left
                            text-xs
                            font-semibold
                            text-gray-500
                            uppercase
                            tracking-wide
                            col-name
                        ">
                            Name
                        </th>

                        <th class="
                            p-5
                            text-left
                            text-xs
                            font-semibold
                            text-gray-500
                            uppercase
                            tracking-wide
                            col-address
                        ">
                            Address
                        </th>

                        <th class="
                            p-5
                            text-left
                            text-xs
                            font-semibold
                            text-gray-500
                            uppercase
                            tracking-wide
                            col-phone
                        ">
                            Phone
                        </th>

                        <th class="
                            p-5
                            text-left
                            text-xs
                            font-semibold
                            text-gray-500
                            uppercase
                            tracking-wide
                            col-district
                        ">
                            Kecamatan
                        </th>

                        <th class="
                            p-5
                            text-center
                            text-xs
                            font-semibold
                            text-gray-500
                            uppercase
                            tracking-wide
                            col-maps
                        ">
                            Google Maps
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($farms as $farm)

                        <tr
                            class="
                                farm-row
                                border-t
                                border-gray-100
                                hover:bg-gray-50
                                transition
                            "
                            data-district="{{ strtolower($farm->district) }}"
                        >

                            <td class="p-5 col-name">

                                <span class="font-semibold text-gray-800">
                                    {{ $farm->name }}
                                </span>

                            </td>

                            <td class="p-5 text-gray-600 col-address">
                                {{ $farm->address }}
                            </td>

                            <td class="p-5 col-phone">

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

                            <td class="p-5 col-district">

                                <span class="
                                    inline-block
                                    bg-gray-100
                                    text-gray-700
                                    px-3 py-1
                                    rounded-xl
                                    text-sm
                                    font-medium
                                ">
                                    {{ $farm->district ?? '—' }}
                                </span>

                            </td>

                            <td class="p-5 text-center col-maps">

                                <a
                                    href="{{ $farm->google_maps }}"
                                    target="_blank"
                                    class="
                                        inline-flex
                                        items-center
                                        justify-center
                                        w-10 h-10
                                        rounded-xl
                                        bg-green-50
                                        text-green-600
                                        hover:bg-green-100
                                        transition
                                    "
                                >

                                    <i class="fa-solid fa-location-dot"></i>

                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- SCRIPT -->
<script>

    const searchInput =
        document.getElementById('searchInput');

    const districtFilter =
        document.getElementById('districtFilter');

    const resetFilterBtn =
        document.getElementById('resetFilterBtn');

    function filterData() {

        const keyword =
            searchInput.value.toLowerCase();

        const district =
            districtFilter.value.toLowerCase();

        // MOBILE
        document.querySelectorAll('.farm-card')
            .forEach(card => {

                const search =
                    card.dataset.search;

                const cardDistrict =
                    (card.dataset.district || '').toLowerCase();

                const matchSearch =
                    search.includes(keyword);

                const matchDistrict =
                    district === '' ||
                    cardDistrict === district;

                card.style.display =
                    matchSearch && matchDistrict
                        ? ''
                        : 'none';

            });

        // DESKTOP
        document.querySelectorAll('.farm-row')
            .forEach(row => {

                const search =
                    row.innerText.toLowerCase();

                const rowDistrict =
                    (row.dataset.district || '').toLowerCase();

                const matchSearch =
                    search.includes(keyword);

                const matchDistrict =
                    district === '' ||
                    rowDistrict === district;

                row.style.display =
                    matchSearch && matchDistrict
                        ? 'table-row'
                        : 'none';

            });

    }

    searchInput.addEventListener('input', filterData);

    districtFilter.addEventListener('change', filterData);

    resetFilterBtn.addEventListener('click', () => {

        searchInput.value = '';

        districtFilter.value = '';

        filterData();

    });

</script>
 

</body>
</html>