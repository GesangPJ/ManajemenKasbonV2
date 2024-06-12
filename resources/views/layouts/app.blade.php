<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


        <!--non jquery styling Regular Datatables CSS-->
        <link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">
        <!-- Tailwind CSS -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <!-- DataTables CSS
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">-->


        <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
        <link href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/scroller/2.4.3/css/scroller.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/searchpanes/2.3.1/css/searchPanes.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <style>
            /* Overrides for Tailwind CSS */

            /* Form fields */
            .dataTables_wrapper select,
            .dataTables_wrapper .dataTables_filter input {
                color: #4a5568;
                /* text-gray-700 */
                padding-left: 1rem;
                /* pl-4 */
                padding-right: 1rem;
                /* pr-4 */
                padding-top: .5rem;
                /* pt-2 */
                padding-bottom: .5rem;
                /* pb-2 */
                line-height: 1.25;
                /* leading-tight */
                border-width: 2px;
                border-radius: .25rem;
                border-color: #edf2f7;
                /* border-gray-200 */
                background-color: #edf2f7;
                /* bg-gray-200 */
            }

            /* Row Hover */
            table.dataTable.hover tbody tr:hover,
            table.dataTable.display tbody tr:hover {
                background-color: #b7b9bb79;
                color: white; /* corrected from text-white; */
                /* bg-indigo-100 */
            }

            /* Pagination Buttons */
            .dataTables_wrapper .dataTables_paginate .paginate_button {
                font-weight: 700;
                /* font-bold */
                border-radius: .25rem;
                /* rounded */
                border: 1px solid transparent;
                /* border border-transparent */
            }

            /* Pagination Buttons - Current selected */
            .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                color: #fff !important;
                /* text-white */
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
                /* shadow */
                font-weight: 700;
                /* font-bold */
                border-radius: .25rem;
                /* rounded */
                background: #044cb8 !important;
                /* bg-indigo-500 */
                border: 1px solid transparent;
                /* border border-transparent */
            }

            /* Pagination Buttons - Hover */
            .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
                color: #fff !important;
                /* text-white */
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
                /* shadow */
                font-weight: 700;
                /* font-bold */
                border-radius: .25rem;
                /* rounded */
                background: #099cc9 !important;
                /* bg-indigo-500 */
                border: 1px solid transparent;
                /* border border-transparent */
            }

            /* Add padding to bottom border */
            table.dataTable.no-footer {
                border-bottom: 1px solid #e2e8f0;
                /* border-b-1 border-gray-300 */
                margin-top: 0.75em;
                margin-bottom: 0.75em;
            }

            /* Change color of responsive icon */
            table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
            table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
                background-color: #099cc9 !important;
                /* bg-indigo-500 */
            }
        </style>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
