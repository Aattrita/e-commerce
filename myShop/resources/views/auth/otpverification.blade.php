<!-- resources/views/auth/otp-verification.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #0d0d0d;
            color: #ffffff;
            font-family: 'Segoe UI', Arial, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .otp-card {
            background-color: #161616;
            border: 1px solid #262626;
            border-radius: 12px;
            padding: 40px 36px;
            width: 100%;
            max-width: 380px;
            text-align: center;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
        }

        .otp-card h2 {
            font-size: 22px;
            margin-bottom: 8px;
        }

        .otp-card p {
            color: #999999;
            font-size: 13px;
            margin-bottom: 28px;
            line-height: 1.5;
        }

        .otp-card p span {
            color: #ffffff;
            font-weight: 500;
        }

        .otp-inputs {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 20px;
        }

        .otp-inputs input {
            width: 100%;
            aspect-ratio: 1 / 1;
            background-color: #000000;
            border: 1px solid #333333;
            border-radius: 8px;
            color: #ffffff;
            font-size: 20px;
            text-align: center;
            outline: none;
            transition: border-color 0.2s;
        }

        .otp-inputs input:focus {
            border-color: #ffffff;
        }

        .error-text {
            color: #ff6b6b;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .status-text {
            color: #6bffb8;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .verify-btn {
            width: 100%;
            padding: 12px;
            background-color: #ffffff;
            color: #0d0d0d;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .verify-btn:hover {
            opacity: 0.85;
        }

        .resend-row {
            margin-top: 20px;
            font-size: 13px;
            color: #999999;
        }

        .resend-row button {
            background: none;
            border: none;
            color: #ffffff;
            text-decoration: underline;
            cursor: pointer;
            font-size: 13px;
        }

        .resend-row button:disabled {
            color: #555555;
            cursor: not-allowed;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="otp-card">
        <h2>Enter Verification Code</h2>
        <p>We sent a 6-digit code to <span>{{ $email }}</span></p>

        @if ($errors->any())
        <div class="error-text">{{ $errors->first('otp') }}</div>
        @endif

        @if (session('status'))
        <div class="status-text">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('otp.verify') }}" id="otpForm">
            @csrf
            <div class="otp-inputs">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-box" autofocus>
                <input type="text" maxlength="1" inputmode="numeric" class="otp-box">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-box">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-box">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-box">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-box">
            </div>
            <input type="hidden" name="otp" id="otpHidden">
            <button type="submit" class="verify-btn">Verify</button>
        </form>

        <div class="resend-row">
            Didn't get the code?
            <form method="POST" action="{{ route('otp.resend') }}" style="display:inline;">
                @csrf
                <button type="submit">Resend</button>
            </form>
        </div>
    </div>

    <script>
        // Auto-advance between OTP boxes and sync into the hidden combined field
        const boxes = document.querySelectorAll('.otp-box');
        const hidden = document.getElementById('otpHidden');

        boxes.forEach((box, i) => {
            box.addEventListener('input', () => {
                box.value = box.value.replace(/[^0-9]/g, '');
                if (box.value && i < boxes.length - 1) {
                    boxes[i + 1].focus();
                }
                updateHidden();
            });

            box.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !box.value && i > 0) {
                    boxes[i - 1].focus();
                }
            });
        });

        function updateHidden() {
            hidden.value = Array.from(boxes).map(b => b.value).join('');
        }
    </script>

</body>

</html>