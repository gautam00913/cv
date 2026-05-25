<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.new_contact_message') }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #00796b;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
            color: #374151;
        }
        .info-row {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }
        .info-label {
            font-weight: 600;
            color: #888888;
            font-size: 14px;
            margin-bottom: 4px;
        }
        .info-value {
            color: #111827;
            font-size: 16px;
        }
        .message-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        .message-label {
            font-weight: 600;
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 8px;
        }
        .message-content {
            color: #374151;
            line-height: 1.6;
            white-space: pre-wrap;
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ __('messages.new_contact_message') }}</h1>
        </div>
        <div class="content">
            <div class="info-row">
                <div class="info-label">{{ __('messages.full_name') }}</div>
                <div class="info-value">{{ $data['full_name'] }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">{{ __('messages.email') }}</div>
                <div class="info-value">{{ $data['email'] }}</div>
            </div>
            @if(isset($data['phone']) && $data['phone'])
            <div class="info-row">
                <div class="info-label">{{ __('messages.phone') }}</div>
                <div class="info-value">{{ $data['phone'] }}</div>
            </div>
            @endif
            <div class="info-row">
                <div class="info-label">{{ __('messages.subject') }}</div>
                <div class="info-value">{{ $data['subject'] }}</div>
            </div>
            <div class="message-box">
                <div class="message-label">{{ __('messages.message') }}</div>
                <div class="message-content">{{ $data['message'] }}</div>
            </div>
        </div>
        <div class="footer">
            <p>{{ __('messages.message_from_online_portfolio') }} <a href="{{ route('home') }}" style="text-decoration: underline; color: #009688;" target="_blank" rel="noopener noreferrer">{{ route('home') }}</a>.</p>
        </div>
    </div>
</body>
</html>