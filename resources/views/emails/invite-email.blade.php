<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no">
    <title>Welcome to Your CSE-105 Solution Hub</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        /* Reset & Base */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body, html { width: 100% !important; height: 100%; margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table { border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { border: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
        a { text-decoration: none; }

        /* Email Body Background */
        .email-bg { background-color: #f0fdf4; font-family: 'Georgia', 'Times New Roman', serif; }

        /* Responsive */
        @media only screen and (max-width: 620px) {
            .email-wrapper { width: 100% !important; padding: 10px !important; }
            .email-card { border-radius: 16px !important; }
            .header-td { padding: 36px 24px 28px !important; }
            .header-title { font-size: 26px !important; line-height: 1.3 !important; }
            .body-td { padding: 32px 24px !important; }
            .greeting { font-size: 20px !important; }
            .intro-text { font-size: 15px !important; }
            .credentials-table { padding: 20px !important; }
            .cta-btn { padding: 15px 30px !important; font-size: 16px !important; }
            .benefits-table td { display: block !important; width: 100% !important; padding: 8px 0 !important; }
            .footer-td { padding: 24px 20px !important; }
        }
    </style>
</head>

<body class="email-bg" style="margin:0; padding:0; background-color:#f0fdf4; font-family: 'Georgia', 'Times New Roman', serif;">

<!-- Preheader (hidden) -->
<div style="display:none; font-size:1px; color:#f0fdf4; line-height:1px; max-height:0px; max-width:0px; opacity:0; overflow:hidden;">
    Your student account at {{ env('APP_NAME') }} is ready. Access your portal now and start your learning journey.
</div>

<!-- Outer Wrapper -->
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f0fdf4;">
    <tr>
        <td align="center" style="padding: 32px 16px;" class="email-wrapper">

            <!-- Email Card -->
            <table role="presentation" width="100%" style="max-width:600px;" cellpadding="0" cellspacing="0" border="0" class="email-card">

                <!-- ═══════════════════════════════════════ -->
                <!-- HEADER                                   -->
                <!-- ═══════════════════════════════════════ -->
                <tr>
                    <td style="background: linear-gradient(135deg, #14532d 0%, #166534 40%, #16a34a 100%); border-radius: 20px 20px 0 0; padding: 48px 40px 40px; text-align: center; position: relative; overflow: hidden;" class="header-td">

                        <!-- Decorative circles -->
                        <div style="position:absolute; top:-30px; right:-30px; width:140px; height:140px; border-radius:50%; background:rgba(255,255,255,0.06); pointer-events:none;"></div>
                        <div style="position:absolute; bottom:-20px; left:-20px; width:100px; height:100px; border-radius:50%; background:rgba(255,255,255,0.05); pointer-events:none;"></div>

                        <!-- Icon Badge -->
                        <table role="presentation" cellpadding="0" cellspacing="0" border="0" align="center" style="margin-bottom:20px;">
                            <tr>
                                <td style="background:rgba(255,255,255,0.15); border-radius:50%; width:72px; height:72px; text-align:center; vertical-align:middle; border: 2px solid rgba(255,255,255,0.3);">
                                    <span style="font-size:32px; line-height:68px; display:inline-block;">🎓</span>
                                </td>
                            </tr>
                        </table>

                        <!-- Institution Name -->
                        <p style="font-family: 'Georgia', serif; font-size:12px; font-weight:400; letter-spacing:3px; text-transform:uppercase; color:rgba(255,255,255,0.7); margin-bottom:12px;">
                            {{ env('APP_NAME') }}
                        </p>

                        <!-- Main Title -->
                        <h1 style="font-family: 'Georgia', serif; font-size:30px; font-weight:700; color:#ffffff; line-height:1.25; margin:0 0 12px; letter-spacing:-0.5px;" class="header-title">
                            Welcome to Your<br>Learning Portal
                        </h1>

                        <!-- Subtitle -->
                        <p style="font-family: Arial, sans-serif; font-size:15px; color:rgba(255,255,255,0.82); margin:0; line-height:1.5;">
                            Your student account has been created successfully
                        </p>

                        <!-- Success Badge -->
                        <table role="presentation" cellpadding="0" cellspacing="0" border="0" align="center" style="margin-top:24px;">
                            <tr>
                                <td style="background:rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.35); border-radius:50px; padding:8px 20px;">
                                    <span style="font-family: Arial, sans-serif; font-size:13px; color:#ffffff; font-weight:600; letter-spacing:0.5px;">
                                        ✓ &nbsp;Account Active &amp; Ready
                                    </span>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>

                <!-- ═══════════════════════════════════════ -->
                <!-- MAIN BODY                               -->
                <!-- ═══════════════════════════════════════ -->
                <tr>
                    <td style="background:#ffffff; padding: 44px 40px;" class="body-td">

                        <!-- Greeting -->
                        <h2 style="font-family: 'Georgia', serif; font-size:22px; font-weight:700; color:#14532d; margin:0 0 16px; line-height:1.3;" class="greeting">
                            Hello, {{ $name }} 👋
                        </h2>

                        <!-- Intro -->
                        <p style="font-family: Arial, sans-serif; font-size:15px; color:#374151; line-height:1.75; margin:0 0 10px;" class="intro-text">
                            We're delighted to welcome you to <strong style="color:#15803d;">{{ env('APP_NAME')}} </strong>'s online learning platform. Your account has been set up and is ready for you to explore.
                        </p>
                        <p style="font-family: Arial, sans-serif; font-size:15px; color:#374151; line-height:1.75; margin:0 0 32px;" class="intro-text">
                            Through this portal, you'll have seamless access to everything you need for your academic journey:
                        </p>

                        <!-- Access List -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:36px;">
                            <tr>
                                <td style="padding:0 0 10px;">
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f0fdf4; border-radius:12px; padding:20px 24px; border-left: 4px solid #16a34a;">
                                        <tr>
                                            <td>
                                                <table role="presentation" cellpadding="0" cellspacing="6" border="0">
                                                    <tr>
                                                        <td style="font-family: Arial, sans-serif; font-size:14px; color:#166534; line-height:2; padding-right:20px;">
                                                            📚 &nbsp;Online Classes &amp; Lectures<br>
                                                            📋 &nbsp;Course Materials &amp; Resources<br>
                                                            📅 &nbsp;Attendance Records
                                                        </td>
                                                        <td style="font-family: Arial, sans-serif; font-size:14px; color:#166534; line-height:2;">
                                                            📊 &nbsp;Exam Results &amp; Grades<br>
                                                            📈 &nbsp;Learning Progress Tracker<br>
                                                            🔔 &nbsp;Notifications &amp; Announcements
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <!-- ─── Divider ─── -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:32px;">
                            <tr>
                                <td style="border-top: 1.5px solid #e5e7eb;"></td>
                            </tr>
                        </table>

                        <!-- Section: Login Credentials -->
                        <h3 style="font-family: 'Georgia', serif; font-size:17px; font-weight:700; color:#111827; margin:0 0 16px; letter-spacing:-0.2px;">
                            🔐 Your Login Credentials
                        </h3>

                        <!-- Credentials Card -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
                            <tr>
                                <td style="background: linear-gradient(145deg, #f9fafb, #f3f4f6); border-radius:14px; padding:28px 28px; border:1.5px solid #e5e7eb;" class="credentials-table">

                                    <!-- Row: Name -->
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:16px;">
                                        <tr>
                                            <td style="width:36px; vertical-align:top; padding-top:2px;">
                                                <div style="width:32px; height:32px; background:#dcfce7; border-radius:8px; text-align:center; line-height:32px; font-size:15px;">👤</div>
                                            </td>
                                            <td style="padding-left:12px;">
                                                <p style="font-family:Arial,sans-serif; font-size:11px; text-transform:uppercase; letter-spacing:1px; color:#9ca3af; margin:0 0 3px;">Student Name</p>
                                                <p style="font-family:Arial,sans-serif; font-size:15px; font-weight:700; color:#111827; margin:0;">{{ $name }}</p>
                                            </td>
                                        </tr>
                                    </table>

                                    <!-- Divider -->
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:16px;">
                                        <tr><td style="border-top:1px solid #e9ecef;"></td></tr>
                                    </table>

                                    <!-- Row: Email -->
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:16px;">
                                        <tr>
                                            <td style="width:36px; vertical-align:top; padding-top:2px;">
                                                <div style="width:32px; height:32px; background:#dcfce7; border-radius:8px; text-align:center; line-height:32px; font-size:15px;">✉️</div>
                                            </td>
                                            <td style="padding-left:12px;">
                                                <p style="font-family:Arial,sans-serif; font-size:11px; text-transform:uppercase; letter-spacing:1px; color:#9ca3af; margin:0 0 3px;">Email Address</p>
                                                <p style="font-family:Arial,sans-serif; font-size:15px; font-weight:700; color:#111827; margin:0; word-break:break-all;">{{ $email }}</p>
                                            </td>
                                        </tr>
                                    </table>

                                    <!-- Divider -->
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:16px;">
                                        <tr><td style="border-top:1px solid #e9ecef;"></td></tr>
                                    </table>

                                    <!-- Row: Password -->
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="width:36px; vertical-align:top; padding-top:2px;">
                                                <div style="width:32px; height:32px; background:#dcfce7; border-radius:8px; text-align:center; line-height:32px; font-size:15px;">🔑</div>
                                            </td>
                                            <td style="padding-left:12px;">
                                                <p style="font-family:Arial,sans-serif; font-size:11px; text-transform:uppercase; letter-spacing:1px; color:#9ca3af; margin:0 0 3px;">Temporary Password</p>
                                                <p style="font-family:'Courier New', Courier, monospace; font-size:16px; font-weight:700; color:#15803d; margin:0; background:#f0fdf4; display:inline-block; padding:4px 10px; border-radius:6px; border:1px dashed #86efac; letter-spacing:1.5px;">{{ $password }}</p>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                        </table>

                        <!-- Security Notice -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:36px;">
                            <tr>
                                <td style="background:#fffbeb; border-radius:10px; padding:16px 20px; border-left:4px solid #f59e0b;">
                                    <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="vertical-align:top; padding-right:10px; font-size:18px; line-height:1.4;">⚠️</td>
                                            <td>
                                                <p style="font-family:Arial,sans-serif; font-size:13px; font-weight:700; color:#92400e; margin:0 0 4px;">Security Notice</p>
                                                <p style="font-family:Arial,sans-serif; font-size:13px; color:#78350f; margin:0; line-height:1.6;">
                                                    For your account security, please <strong>change your password immediately</strong> after your first login. Use a strong, unique password that you don't use elsewhere.
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <!-- CTA Button -->
                        <table role="presentation" cellpadding="0" cellspacing="0" border="0" align="center" style="margin: 0 auto 40px;">
                            <tr>
                                <td style="border-radius:12px; background: linear-gradient(135deg, #16a34a, #15803d); box-shadow: 0 6px 20px rgba(22,163,74,0.4);">
                                    <!--[if mso]>
                                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ route('login') }}" style="height:56px;v-text-anchor:middle;width:260px;" arcsize="15%" stroke="f" fillcolor="#16a34a">
                                        <w:anchorlock/>
                                        <center style="color:#ffffff;font-family:Arial,sans-serif;font-size:17px;font-weight:bold;">Access CSE-105 Solution Hub →</center>
                                    </v:roundrect>
                                    <![endif]-->
                                    <a href="{{ route('login') }}" style="display:inline-block; padding:17px 44px; font-family:Arial,sans-serif; font-size:17px; font-weight:700; color:#ffffff; text-decoration:none; border-radius:12px; letter-spacing:0.3px; mso-hide:all;" class="cta-btn">
                                        Access CSE-105 Solution Hub &nbsp;→
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <!-- ─── Divider ─── -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:32px;">
                            <tr>
                                <td style="border-top: 1.5px solid #e5e7eb;"></td>
                            </tr>
                        </table>

                        <!-- Benefits Section -->
                        <h3 style="font-family:'Georgia',serif; font-size:17px; font-weight:700; color:#111827; margin:0 0 20px; text-align:center; letter-spacing:-0.2px;">
                            Everything You Need, In One Place
                        </h3>

                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:36px;" class="benefits-table">
                            <tr>
                                <!-- Benefit 1 -->
                                <td width="33.3%" style="vertical-align:top; padding:6px;" class="benefit-cell">
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="background:#f0fdf4; border-radius:12px; padding:18px 14px; text-align:center; border:1px solid #bbf7d0;">
                                                <div style="font-size:26px; margin-bottom:8px;">📅</div>
                                                <p style="font-family:Arial,sans-serif; font-size:12px; font-weight:700; color:#15803d; margin:0; line-height:1.4;">View<br>Attendance</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <!-- Benefit 2 -->
                                <td width="33.3%" style="vertical-align:top; padding:6px;" class="benefit-cell">
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="background:#f0fdf4; border-radius:12px; padding:18px 14px; text-align:center; border:1px solid #bbf7d0;">
                                                <div style="font-size:26px; margin-bottom:8px;">📊</div>
                                                <p style="font-family:Arial,sans-serif; font-size:12px; font-weight:700; color:#15803d; margin:0; line-height:1.4;">Check<br>Results</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <!-- Benefit 3 -->
                                <td width="33.3%" style="vertical-align:top; padding:6px;" class="benefit-cell">
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="background:#f0fdf4; border-radius:12px; padding:18px 14px; text-align:center; border:1px solid #bbf7d0;">
                                                <div style="font-size:26px; margin-bottom:8px;">💻</div>
                                                <p style="font-family:Arial,sans-serif; font-size:12px; font-weight:700; color:#15803d; margin:0; line-height:1.4;">Online<br>Classes</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <!-- Benefit 4 -->
                                <td width="33.3%" style="vertical-align:top; padding:6px;" class="benefit-cell">
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="background:#f0fdf4; border-radius:12px; padding:18px 14px; text-align:center; border:1px solid #bbf7d0;">
                                                <div style="font-size:26px; margin-bottom:8px;">📈</div>
                                                <p style="font-family:Arial,sans-serif; font-size:12px; font-weight:700; color:#15803d; margin:0; line-height:1.4;">Track<br>Progress</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <!-- Benefit 5 -->
                                <td width="33.3%" style="vertical-align:top; padding:6px;" class="benefit-cell">
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="background:#f0fdf4; border-radius:12px; padding:18px 14px; text-align:center; border:1px solid #bbf7d0;">
                                                <div style="font-size:26px; margin-bottom:8px;">🔔</div>
                                                <p style="font-family:Arial,sans-serif; font-size:12px; font-weight:700; color:#15803d; margin:0; line-height:1.4;">Important<br>Notifications</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <!-- Benefit 6 -->
                                <td width="33.3%" style="vertical-align:top; padding:6px;" class="benefit-cell">
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="background:#f0fdf4; border-radius:12px; padding:18px 14px; text-align:center; border:1px solid #bbf7d0;">
                                                <div style="font-size:26px; margin-bottom:8px;">📚</div>
                                                <p style="font-family:Arial,sans-serif; font-size:12px; font-weight:700; color:#15803d; margin:0; line-height:1.4;">Course<br>Materials</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <!-- Support Section -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td style="background:#f8fafc; border-radius:12px; padding:22px 24px; text-align:center; border:1px solid #e2e8f0;">
                                    <p style="font-family:Arial,sans-serif; font-size:13px; color:#6b7280; margin:0 0 6px;">
                                        Having trouble logging in or need assistance?
                                    </p>
                                    <p style="font-family:Arial,sans-serif; font-size:14px; font-weight:600; color:#374151; margin:0;">
                                        Contact our support team at &nbsp;<a href="mailto:{{ env('SUPPORT_EMAIL') }}" style="color:#16a34a; text-decoration:underline; font-weight:700;">{{ env('SUPPORT_EMAIL') }}</a>
                                    </p>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>

                <!-- ═══════════════════════════════════════ -->
                <!-- FOOTER                                  -->
                <!-- ═══════════════════════════════════════ -->
                <tr>
                    <td style="background: linear-gradient(135deg, #14532d, #166534); border-radius: 0 0 20px 20px; padding: 32px 40px; text-align:center;" class="footer-td">

                        <!-- Logo / Institution mark -->
                        <table role="presentation" cellpadding="0" cellspacing="0" border="0" align="center" style="margin-bottom:16px;">
                            <tr>
                                <td style="background:rgba(255,255,255,0.12); border-radius:10px; padding:10px 20px; border:1px solid rgba(255,255,255,0.2);">
                                    <span style="font-family:'Georgia',serif; font-size:14px; font-weight:700; color:#ffffff; letter-spacing:0.5px;">🎓 {{ env('APP_NAME')}} </span>
                                </td>
                            </tr>
                        </table>

                        <p style="font-family:Arial,sans-serif; font-size:12px; color:rgba(255,255,255,0.6); margin:0 0 8px; line-height:1.6;">
                            This is an automated message. Please do not reply directly to this email.
                        </p>
                        <p style="font-family:Arial,sans-serif; font-size:12px; color:rgba(255,255,255,0.5); margin:0;">
                            © {{ env('APP_NAME') }} All Rights Reserved.
                        </p>

                    </td>
                </tr>

            </table>
            <!-- /Email Card -->

            <!-- Bottom spacer note -->
            <p style="font-family:Arial,sans-serif; font-size:11px; color:#9ca3af; text-align:center; margin:20px 0 0; line-height:1.6;">
                You received this email because an account was created for you at {{ env('APP_NAME')}} .<br>
                If you believe this was sent in error, please contact <a href="mailto:{{ env('SUPPORT_EMAIL') }}" style="color:#16a34a;">{{ env('SUPPORT_EMAIL') }}</a>.
            </p>

        </td>
    </tr>
</table>

</body>
</html>
