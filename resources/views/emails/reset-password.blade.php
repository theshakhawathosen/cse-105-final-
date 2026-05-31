<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Notification</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f4f6f9;padding:30px 15px;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" border="0"
                    style="max-width:600px;background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.08);">

                    <!-- Header -->
                    <tr>
                        <td align="center"
                            style="background:#2563eb;padding:30px 20px;color:#ffffff;">
                            <h1 style="margin:0;font-size:24px;font-weight:700;">
                                Password Reset Successful
                            </h1>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:40px 35px;color:#374151;line-height:1.7;">

                            <p style="margin-top:0;font-size:16px;">
                                Dear <strong>{{ $name }}</strong>,
                            </p>

                            <p style="font-size:15px;">
                                Your account password has been successfully reset. Please use the credentials below to access your account.
                            </p>

                            <!-- Credentials Box -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="margin:25px 0;background:#f8fafc;border:1px solid #e5e7eb;border-radius:10px;">
                                <tr>
                                    <td style="padding:25px;">

                                        <p style="margin:0 0 15px 0;">
                                            <strong>Email Address:</strong><br>
                                            <span style="color:#2563eb;">{{ $email }}</span>
                                        </p>

                                        <p style="margin:0 0 15px 0;">
                                            <strong>Temporary Password:</strong><br>
                                            <span style="font-size:18px;font-weight:bold;color:#dc2626;">
                                                {{ $password }}
                                            </span>
                                        </p>

                                        <p style="margin:0;">
                                            <strong>Login URL:</strong><br>
                                            <a href="{{ route('login') }}"
                                                style="color:#2563eb;text-decoration:none;">
                                                {{ route('login') }}
                                            </a>
                                        </p>

                                    </td>
                                </tr>
                            </table>

                            <!-- Security Notice -->
                            <div style="background:#fff7ed;border-left:4px solid #f59e0b;padding:15px 20px;margin:25px 0;">
                                <strong>Security Recommendation</strong>
                                <p style="margin:8px 0 0 0;font-size:14px;">
                                    For your account security, please log in and change your password immediately after accessing your account.
                                </p>
                            </div>

                            <p style="font-size:15px;">
                                If you did not request this password reset, please contact our support team immediately.
                            </p>

                            <!-- Button -->
                            <table cellpadding="0" cellspacing="0" border="0" style="margin:30px auto;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ route('login') }}"
                                            style="background:#2563eb;color:#ffffff;text-decoration:none;padding:14px 30px;border-radius:8px;font-weight:bold;display:inline-block;">
                                            Login to Your Account
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin-bottom:0;font-size:15px;">
                                Thank you,<br>
                                <strong>{{ env('APP_NAME') }}</strong>
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center"
                            style="background:#f9fafb;padding:25px;color:#6b7280;font-size:13px;border-top:1px solid #e5e7eb;">

                            <p style="margin:0 0 8px 0;">
                                Need help? Contact us at
                                <a href="mailto:{{ env('SUPPORT_EMAIL') }}"
                                    style="color:#2563eb;text-decoration:none;">
                                    {{ env('SUPPORT_EMAIL') }}
                                </a>
                            </p>

                            <p style="margin:0;">
                                © {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.
                            </p>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
