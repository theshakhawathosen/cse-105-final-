<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 - Page Not Found</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
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
                        red: '#ff4d6a'
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
            box-shadow: 0 0 60px rgba(61, 127, 255, .12);
        }

        .floating {
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .gradient-text {
            background: linear-gradient(135deg, #e8eaf0 30%, #3d7fff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4">

    <!-- Background blur -->
    <div class="absolute w-96 h-96 bg-accent/10 blur-[140px] rounded-full top-20 left-20"></div>
    <div class="absolute w-96 h-96 bg-accent/10 blur-[140px] rounded-full bottom-20 right-20"></div>

    <!-- Main card -->
    <div class="relative z-10 max-w-xl w-full bg-card border border-bdr rounded-3xl p-10 text-center glow">

        <!-- Icon -->
        <div
            class="w-24 h-24 mx-auto rounded-3xl bg-accent/10 border border-accent/20 flex items-center justify-center floating mb-6">
            <i class="fa-solid fa-triangle-exclamation text-accent text-4xl"></i>
        </div>

        <!-- 404 -->
        <h1 class="text-7xl font-bold gradient-text mb-3">404</h1>

        <h2 class="text-2xl font-semibold text-prim mb-3">
            Page Not Found
        </h2>

        <p class="text-sec text-sm leading-7 max-w-md mx-auto mb-8">
            The page you are looking for doesn’t exist, was removed,
            or the URL might be incorrect.
        </p>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="/"
                class="px-6 py-3 rounded-xl bg-accent text-white font-medium hover:bg-ahover transition-all">
                <i class="fa-solid fa-house mr-2"></i>
                Back to Home
            </a>

            <button onclick="history.back()"
                class="px-6 py-3 rounded-xl bg-input border border-bdr text-prim font-medium hover:border-accent hover:bg-hover transition-all">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                Go Back
            </button>
        </div>

        <!-- Footer text -->
        <div class="mt-8 pt-6 border-t border-bdr text-xs text-hint">
            CSE-105 Batch Solution Hub
        </div>
    </div>

</body>

</html>
