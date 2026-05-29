        <style>
            .custom-alert {
                position: fixed;
                bottom: 30px;
                /* স্ক্রিনের একটু ওপরের দিকে সুন্দর দেখাবে */
                right: 30px;
                display: flex;
                align-items: flex-start;
                gap: 15px;
                background: #111318;
                /* আপনার ডার্ক থিমের সাথে ম্যাচিং ব্যাকগ্রাউন্ড */
                border-radius: 12px;
                padding: 16px 20px;
                min-width: 300px;
                max-width: 400px;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3), 0 8px 10px -6px rgba(0, 0, 0, 0.3);
                z-index: 9999;
                animation: slideIn 0.3s ease-out;
            }

            /* Success Theme */
            .alert-success {
                border-left: 4px solid #29d68e;
            }

            .alert-success .alert-icon {
                color: #29d68e;
            }

            /* Error Theme */
            .alert-error {
                border-left: 4px solid #f87171;
            }

            .alert-error .alert-icon {
                color: #f87171;
            }

            /* Content Styling */
            .alert-icon {
                font-size: 1.25rem;
                margin-top: 2px;
            }

            .alert-content {
                flex-grow: 1;
            }

            .alert-title {
                margin: 0;
                font-weight: 600;
                font-size: 0.95rem;
                color: #ffffff;
            }

            .alert-desc {
                margin: 4px 0 0 0;
                display: block;
                color: #9ca3af;
                font-size: 0.85rem;
                line-height: 1.4;
            }

            /* Close Button */
            .close-btn {
                background: none;
                border: none;
                color: #6b7280;
                cursor: pointer;
                font-size: 0.85rem;
                padding: 0;
                margin-top: 2px;
                transition: color 0.2s;
            }

            .close-btn:hover {
                color: #ffffff;
            }

            /* এনিমেশন প্রবেশ করার জন্য */
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }

                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes slideOut {
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }

                from {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        </style>
        {{-- Success Alert --}}
        @if (session('success'))
            <div class="custom-alert alert-success" id="successAlert">
                <div class="alert-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="alert-content">
                    <p class="alert-title">Success!</p>
                    <small class="alert-desc">{{ session('success') }}</small>
                </div>
                <button class="close-btn" onclick="this.parentElement.remove()">✕</button>
            </div>
            <script>
                setTimeout(() => {
                    const alert = document.getElementById("successAlert");
                    alert.style.animation = 'slideOut 0.5s ease';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 400)
                }, 2000);

                let audio = new Audio("{{ asset('audio/notification.mp3') }}");
                audio.play();
            </script>
        @endif

        {{-- Error Alert --}}
        @if (session('error'))
            <div class="custom-alert alert-error" id="errorAlert">
                <div class="alert-icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="alert-content">
                    <p class="alert-title">Error!</p>
                    <small class="alert-desc">{{ session('error') }}</small>
                </div>
                <button class="close-btn" onclick="this.parentElement.remove()">✕</button>
            </div>
            <script>
                setTimeout(() => {
                    const alert = document.getElementById("errorAlert");
                    alert.style.animation = 'slideOut 0.5s ease';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 400)
                }, 2000);

                let audio = new Audio("{{ asset('audio/error.mp3') }}");
                audio.play();
            </script>
        @endif

