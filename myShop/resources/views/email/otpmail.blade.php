<!-- resources/views/emails/otp.blade.php -->
<!DOCTYPE html>
<html>

<body style="margin:0; padding:0; background-color:#0d0d0d; font-family: Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#0d0d0d; padding:40px 0;">
        <tr>
            <td align="center">
                <table width="420" cellpadding="0" cellspacing="0"
                    style="background-color:#161616; border-radius:10px; padding:32px; border:1px solid #262626;">
                    <tr>
                        <td align="center" style="padding-bottom:20px;">
                            <span style="color:#ffffff; font-size:20px; font-weight:bold;">Verify Your Identity</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#b3b3b3; font-size:14px; line-height:1.6; padding-bottom:24px;">
                            Use the code below to complete your sign-in. This code expires in {{ $expiryMinutes }}
                            minutes.
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-bottom:24px;">
                            <span
                                style="display:inline-block; background-color:#000000; color:#ffffff; font-size:32px; letter-spacing:8px; font-weight:bold; padding:16px 24px; border-radius:8px; border:1px solid #333333;">
                                {{ $otp }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#777777; font-size:12px; line-height:1.5;">
                            If you didn't request this code, you can safely ignore this email.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>