<!doctype html>
<html lang="en">

<head>
    <!-- ============================================================
       SEO META TAGS
  ============================================================ -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Login to CSE-105 Batch Portal — access notices, assignments, lab reports, routines, and more for CSE-105 students." />
    <meta name="keywords" content="CSE-105, batch portal, student login, assignment, lab report, notice, routine" />
    <meta name="author" content="CSE-105 Batch" />
    <meta name="robots" content="index, follow" />

    <!-- Open Graph / Social Sharing -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="CSE-105 Batch Portal — Login" />
    <meta property="og:description"
        content="Login to access CSE-105 batch resources: notices, assignments, lab reports, routines, and more." />
    <meta property="og:image" content="https://via.placeholder.com/1200x630?text=CSE-105+Portal" />

    <title>Login — CSE-105 Batch Portal</title>

    <!-- ============================================================
       EXTERNAL FONTS & ICONS
  ============================================================ -->
    <!-- Poppins from Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Font Awesome 6 Free -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- ============================================================
       INLINE STYLES
  ============================================================ -->
    <style>
        /* ─── CSS RESET & BASE ─────────────────────────────────── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* ─── CSS VARIABLES (Design Tokens) ────────────────────── */
        :root {
            --bg-base: #0d0f14;
            /* deepest background */
            --bg-card: #13161e;
            /* card surface */
            --bg-input: #1a1e28;
            /* input background */
            --border-subtle: #242836;
            /* subtle border */
            --border-focus: #3d7fff;
            /* focus ring / accent */
            --text-primary: #e8eaf0;
            /* main text */
            --text-secondary: #7c8090;
            /* muted / helper text */
            --text-hint: #484c5c;
            /* placeholder */
            --accent: #3d7fff;
            /* brand blue */
            --accent-hover: #5a94ff;
            /* hover state */
            --accent-glow: rgba(61, 127, 255, 0.18);
            /* glow layer */
            --google: #ea4335;
            --facebook: #1877f2;
            --github: #e8eaf0;
            --danger: #ff4d6a;
            /* error red */
            --success: #29d68e;
            /* success green */
            --radius-sm: 6px;
            --radius-md: 10px;
            --radius-lg: 16px;
            --transition: 0.2s ease;
            --font: "Poppins", sans-serif;
        }

        /* ─── BODY & LAYOUT ─────────────────────────────────────── */
        html,
        body {
            height: 100%;
        }

        body {
            font-family: var(--font);
            background-color: var(--bg-base);
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1.5rem;

            /* Subtle noise-like radial gradient for depth */
            background-image:
                radial-gradient(ellipse 80% 60% at 20% -10%,
                    rgba(61, 127, 255, 0.08) 0%,
                    transparent 60%),
                radial-gradient(ellipse 60% 50% at 85% 110%,
                    rgba(61, 127, 255, 0.05) 0%,
                    transparent 55%);
        }

        /* ─── CARD ───────────────────────────────────────────────── */
        .card {
            width: 100%;
            max-width: 420px;
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-lg);
            padding: 2.5rem 2rem;
            position: relative;
            overflow: hidden;
        }

        /* Thin top accent line */
        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg,
                    transparent,
                    var(--accent),
                    transparent);
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        }

        /* ─── LOGO / BRAND ───────────────────────────────────────── */
        .brand {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: var(--accent-glow);
            border: 1px solid rgba(61, 127, 255, 0.3);
            margin-bottom: 1rem;
        }

        .brand-icon i {
            font-size: 1.4rem;
            color: var(--accent);
        }

        .brand h1 {
            font-size: 1.25rem;
            font-weight: 600;
            letter-spacing: -0.02em;
            color: var(--text-primary);
            line-height: 1.3;
        }

        .brand p {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-top: 0.3rem;
            font-weight: 400;
        }

        /* ─── FORM LABEL ─────────────────────────────────────────── */
        .field {
            margin-bottom: 1.1rem;
        }

        .field label {
            display: block;
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 0.45rem;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        /* ─── INPUT WRAPPER (icon + input side by side) ──────────── */
        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        /* Left icon inside the input box */
        .input-wrap .input-icon {
            position: absolute;
            left: 14px;
            color: var(--text-hint);
            font-size: 0.9rem;
            pointer-events: none;
            transition: color var(--transition);
        }

        /* The actual <input> element */
        .input-wrap input {
            width: 100%;
            background: var(--bg-input);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-md);
            color: var(--text-primary);
            font-family: var(--font);
            font-size: 0.9rem;
            font-weight: 400;
            padding: 0.75rem 2.8rem 0.75rem 2.8rem;
            /* space for icons both sides */
            outline: none;
            transition:
                border-color var(--transition),
                background var(--transition),
                box-shadow var(--transition);
        }

        /* Placeholder style */
        .input-wrap input::placeholder {
            color: var(--text-hint);
            font-size: 0.85rem;
        }

        /* Focus state */
        .input-wrap input:focus {
            border-color: var(--border-focus);
            background: #1e2333;
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        /* Icon color follows focus */
        .input-wrap input:focus+.input-icon-after,
        .input-wrap:focus-within .input-icon {
            color: var(--accent);
        }

        /* Password toggle button (right side) */
        .toggle-pass {
            position: absolute;
            right: 13px;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-hint);
            font-size: 0.85rem;
            padding: 0;
            transition: color var(--transition);
            display: flex;
            align-items: center;
        }

        .toggle-pass:hover {
            color: var(--text-secondary);
        }

        /* ─── VALIDATION ERROR MESSAGE ───────────────────────────── */
        .error-msg {
            display: none;
            /* hidden by default; shown via JS class */
            font-size: 0.73rem;
            color: var(--danger);
            margin-top: 0.35rem;
            align-items: center;
            gap: 5px;
            font-weight: 400;
        }

        .error-msg i {
            font-size: 0.75rem;
            flex-shrink: 0;
        }

        /* Show the error message */
        .error-msg.visible {
            display: flex;
        }

        /* Red border on invalid input */
        .field.invalid .input-wrap input {
            border-color: var(--danger);
            box-shadow: 0 0 0 3px rgba(255, 77, 106, 0.12);
        }

        /* ─── FORGOT PASSWORD ────────────────────────────────────── */
        .forgot {
            text-align: right;
            margin-top: -0.4rem;
            margin-bottom: 1.3rem;
        }

        .forgot a {
            font-size: 0.75rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: color var(--transition);
        }

        .forgot a:hover {
            color: var(--accent-hover);
        }

        /* ─── LOGIN BUTTON ───────────────────────────────────────── */
        .btn-login {
            width: 100%;
            padding: 0.8rem;
            background: var(--accent);
            border: none;
            border-radius: var(--radius-md);
            color: #fff;
            font-family: var(--font);
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.02em;
            transition:
                background var(--transition),
                transform var(--transition),
                box-shadow var(--transition);
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            background: var(--accent-hover);
            box-shadow: 0 6px 24px rgba(61, 127, 255, 0.3);
            transform: translateY(-1px);
        }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: none;
        }

        /* Loading spinner (shown by JS during submit) */
        .btn-login .spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            margin-right: 8px;
        }

        .btn-login.loading .spinner {
            display: inline-block;
        }

        .btn-login.loading .btn-text {
            opacity: 0.7;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ─── DIVIDER ─────────────────────────────────────────────── */
        .divider {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            margin: 1.4rem 0;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--border-subtle);
        }

        .divider span {
            font-size: 0.72rem;
            color: var(--text-hint);
            white-space: nowrap;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        /* ─── SOCIAL LOGIN BUTTONS ────────────────────────────────── */
        .social-grid {
            display: flex;
            gap: 0.7rem;
        }

        .btn-social {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0.65rem 0.5rem;
            background: var(--bg-input);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-md);
            color: var(--text-secondary);
            font-family: var(--font);
            font-size: 0.78rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition:
                background var(--transition),
                border-color var(--transition),
                color var(--transition),
                transform var(--transition);
        }

        .btn-social:hover {
            background: #1e2333;
            color: var(--text-primary);
            transform: translateY(-1px);
        }

        /* Specific brand icon colors on hover */
        .btn-social.google:hover {
            border-color: rgba(234, 67, 53, 0.45);
        }

        .btn-social.facebook:hover {
            border-color: rgba(24, 119, 242, 0.45);
        }

        .btn-social.github:hover {
            border-color: rgba(232, 234, 240, 0.25);
        }

        .btn-social .fab {
            font-size: 0.95rem;
        }

        .btn-social.google .fab {
            color: var(--google);
        }

        .btn-social.facebook .fab {
            color: var(--facebook);
        }

        .btn-social.github .fab {
            color: var(--github);
        }

        /* ─── REGISTER LINK ───────────────────────────────────────── */
        .register-link {
            text-align: center;
            margin-top: 1.6rem;
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .register-link a {
            color: var(--accent-hover);
            text-decoration: none;
            font-weight: 500;
            margin-left: 4px;
            transition: color var(--transition);
        }

        .register-link a:hover {
            color: #fff;
        }

        /* ─── FOOTER NOTE ─────────────────────────────────────────── */
        .footer-note {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.7rem;
            color: var(--text-hint);
        }

        /* ─── RESPONSIVE ──────────────────────────────────────────── */
        @media (max-width: 480px) {
            .card {
                padding: 2rem 1.4rem;
            }

            /* Stack social buttons vertically on very small screens */
            .social-grid {
                flex-direction: column;
            }

            .btn-social {
                justify-content: center;
            }
        }

        /* ─── FADE-IN ANIMATION ───────────────────────────────────── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeUp 0.45s ease both;
        }
    </style>
</head>

<body>
    <!-- ============================================================
       LOGIN CARD
  ============================================================ -->
    <main class="card" role="main" aria-label="CSE-105 Login Form">
        <!-- ── Brand / Logo ── -->
        <div class="brand">
            <div class="brand-icon" aria-hidden="true">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <h1>CSE-105 Batch Portal</h1>
            <p>Sign in to access your batch resources</p>
        </div>

        <!-- ── Login Form ── -->
        <form id="loginForm" method="POST" action="{{ route('loginPost') }}">
            @csrf
            @method('POST')
            <!-- Email Field -->
            <div class="field" id="fieldEmail">
                <label for="email">Email Address</label>
                <div class="input-wrap">
                    <!-- Left icon: email -->
                    <i class="fa-regular fa-envelope input-icon" aria-hidden="true"></i>
                    <input type="email" id="email" name="email" placeholder="you@university.edu"
                        autocomplete="email" required aria-describedby="emailError" value="{{ old('email') }}" />
                </div>
                <!-- Validation error message (shown by JS) -->
                @error('email')
                    <span class="error-msg visible" id="emailError" role="alert">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="field" id="fieldPassword">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <!-- Left icon: lock -->
                    <i class="fa-solid fa-lock input-icon" aria-hidden="true"></i>
                    <input type="password" id="password" name="password" placeholder="Enter your password"
                        autocomplete="current-password" required aria-describedby="passwordError" />
                    <!-- Right icon: toggle password visibility -->
                    <button type="button" class="toggle-pass" id="togglePass" aria-label="Toggle password visibility">
                        <i class="fa-regular fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
                <!-- Validation error message (shown by JS) -->
                <span class="error-msg" id="passwordError" role="alert">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Password must be at least 6 characters.
                </span>
            </div>

            <!-- Forgot Password Link -->
            <div class="forgot">
                <a href="#" aria-label="Reset your password">Forgot password?</a>
            </div>

            <!-- Login Submit Button -->
            <button type="submit" class="btn-login" id="loginBtn" aria-label="Sign in to CSE-105 Portal">
                <span class="spinner" aria-hidden="true"></span>
                <span class="btn-text">Sign In</span>
            </button>
        </form>
        <!-- /form -->

        <!-- ── Divider ── -->
        <div class="divider" aria-hidden="true">
            <span>or continue with</span>
        </div>

        <!-- ── Social Login Buttons ── -->
        <div class="social-grid" role="group" aria-label="Social login options">
            <a href="#" class="btn-social google" role="button" aria-label="Sign in with Google">
                <i class="fab fa-google" aria-hidden="true"></i>
                Google
            </a>

            <a href="#" class="btn-social facebook" role="button" aria-label="Sign in with Facebook">
                <i class="fab fa-facebook-f" aria-hidden="true"></i>
                Facebook
            </a>

            <a href="#" class="btn-social github" role="button" aria-label="Sign in with GitHub">
                <i class="fab fa-github" aria-hidden="true"></i>
                GitHub
            </a>
        </div>

        <!-- ── Register Link ── -->
        <div class="register-link">
            New Member?
            <a href="register.html" aria-label="Create a new CSE-105 account">Register here</a>
        </div>
    </main>
    <!-- /card -->

    <!-- ── Footer Note ── -->
    <p class="footer-note" style="position: fixed; bottom: 1rem; left: 0; right: 0">
        &copy; 2025 CSE-105 Batch Portal. All rights reserved.
    </p>

    <!-- ============================================================
       INLINE JAVASCRIPT
       All validation + UI interaction logic is here.
  ============================================================ -->
    <script>
        // ── Element References ───────────────────────────────────────
        const form = document.getElementById("loginForm");
        const emailInput = document.getElementById("email");
        const passInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eyeIcon");
        const togglePass = document.getElementById("togglePass");
        const loginBtn = document.getElementById("loginBtn");

        // Field wrapper divs (for adding/removing .invalid class)
        const fieldEmail = document.getElementById("fieldEmail");
        const fieldPassword = document.getElementById("fieldPassword");

        // Error message spans
        const emailError = document.getElementById("emailError");
        const passError = document.getElementById("passwordError");

        // ── Helper: Validate email format ───────────────────────────
        function isValidEmail(val) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val.trim());
        }

        // ── Live validation: clear error once user starts correcting ─
        emailInput.addEventListener("input", function() {
            if (isValidEmail(this.value)) {
                fieldEmail.classList.remove("invalid");
                emailError.classList.remove("visible");
            }
        });

        passInput.addEventListener("input", function() {
            if (this.value.length >= 6) {
                fieldPassword.classList.remove("invalid");
                passError.classList.remove("visible");
            }
        });

        // ── Password toggle visibility ───────────────────────────────
        togglePass.addEventListener("click", function() {
            const isHidden = passInput.type === "password";

            // Switch input type
            passInput.type = isHidden ? "text" : "password";

            // Swap icon between eye and eye-slash
            eyeIcon.classList.toggle("fa-eye", !isHidden);
            eyeIcon.classList.toggle("fa-eye-slash", isHidden);
        });
    </script>
</body>

</html>
