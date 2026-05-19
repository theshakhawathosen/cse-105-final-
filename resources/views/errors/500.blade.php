<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>500 - Server Error</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif']
                    },
                    colors: {
                        base: '#0d0f14',
                        nav: '#111318',
                        card: '#13161e',
                        input: '#1a1e28',
                        hover: '#1e2232',
                        bdr: '#1f2333',
                        accent: '#3d7fff',
                        ahover: '#5a94ff',
                        prim: '#e8eaf0',
                        sec: '#7c8090',
                        hint: '#454860',
                        red: '#ff4d6a',
                        amber: '#f5a623'
                    }
                }
            }
        }
    </script>

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #0d0f14;
            overflow: hidden;
        }

        .glow {
            box-shadow: 0 0 60px rgba(255, 77, 106, .12);
        }

        .pulse-soft {
            animation: pulseSoft 2.4s ease-in-out infinite;
        }

        @keyframes pulseSoft {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.06);
                opacity: .8;
            }
        }

        .gradient-text {
            background: linear-gradient(135deg, #ffffff 10%, #ff4d6a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .rotate-gear {
            animation: rotateGear 8s linear infinite;
        }

        @keyframes rotateGear {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4">

    <!-- Background blur -->
    <div class="absolute w-96 h-96 bg-red/10 blur-[150px] rounded-full top-20 left-16"></div>
    <div class="absolute w-96 h-96 bg-accent/10 blur-[150px] rounded-full bottom-20 right-16"></div>

    <!-- Card -->
    <div class="relative z-10 max-w-xl w-full bg-card border border-bdr rounded-3xl p-10 text-center glow">

        <!-- Icon -->
        <div
            class="w-24 h-24 mx-auto rounded-3xl bg-red/10 border border-red/20 flex items-center justify-center pulse-soft mb-6">
            <i class="fa-solid fa-gears rotate-gear text-red text-4xl"></i>
        </div>

        <!-- Error code -->
        <h1 class="text-7xl font-bold gradient-text mb-3">500</h1>

        <h2 class="text-2xl font-semibold text-prim mb-3">
            Internal Server Error
        </h2>

        <p class="text-sec text-sm leading-7 max-w-md mx-auto mb-8">
            Something went wrong on our server while processing your request.
            Please try again later or return to the dashboard.
        </p>

        <!-- Status badge -->
        <div
            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red/10 border border-red/20 text-red text-xs font-semibold mb-8">
            <span class="w-2 h-2 rounded-full bg-red"></span>
            SERVER TEMPORARILY UNAVAILABLE
        </div>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <button onclick="location.reload()"
                class="px-6 py-3 rounded-xl bg-accent text-white font-medium hover:bg-ahover transition-all">
                <i class="fa-solid fa-rotate-right mr-2"></i>
                Retry
            </button>

            <a href="/"
                class="px-6 py-3 rounded-xl bg-input border border-bdr text-prim font-medium hover:border-accent hover:bg-hover transition-all">
                <i class="fa-solid fa-house mr-2"></i>
                Back to Home
            </a>
        </div>

        <!-- Footer -->
        <div class="mt-8 pt-6 border-t border-bdr text-xs text-hint">
            CSE-105 Batch Solution Hub • System Error Handler
        </div>
    </div>

</body>

</html>
