{{-- resources/views/emails/password-reset-otp.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 480px; margin: 0 auto; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .header { background: #2563eb; padding: 24px; text-align: center; }
        .header h1 { color: white; margin: 0; font-size: 22px; }
        .body { padding: 32px; text-align: center; }
        .otp-box { background: #f0f4ff; border: 2px dashed #2563eb; border-radius: 10px; padding: 20px; margin: 24px 0; }
        .otp { font-size: 42px; font-weight: bold; letter-spacing: 12px; color: #1d4ed8; font-family: monospace; }
        .note { color: #6b7280; font-size: 13px; margin-top: 16px; }
        .footer { background: #f9fafb; padding: 16px; text-align: center; color: #9ca3af; font-size: 12px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>🔐 Password Reset</h1>
    </div>
    <div class="body">
        <p style="color: #374151; font-size: 16px;">আপনার Password Reset এর জন্য OTP কোড:</p>
        <div class="otp-box">
            <div class="otp">{{ $otp }}</div>
        </div>
        <p class="note">⏰ এই OTP <strong>১০ মিনিট</strong> এর মধ্যে ব্যবহার করুন।</p>
        <p class="note" style="color: #ef4444;">যদি আপনি এই request না করে থাকেন, তাহলে এই email ignore করুন।</p>
    </div>
    <div class="footer">
        এই email টি স্বয়ংক্রিয়ভাবে পাঠানো হয়েছে। Reply করবেন না।
    </div>
</div>
</body>
</html>