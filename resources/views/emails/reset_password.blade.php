<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #0f172a;
            color: #e2e8f0;
            padding: 40px 20px;
        }
        .container {
            max-width: 560px;
            margin: 0 auto;
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 16px;
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #3b82f6, #9333ea);
            padding: 32px;
            text-align: center;
        }
        .header-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            background: rgba(255,255,255,0.15);
            border-radius: 12px;
            margin-bottom: 12px;
        }
        .header h1 {
            color: #ffffff;
            font-size: 22px;
            font-weight: 700;
        }
        .body {
            padding: 32px;
        }
        .greeting {
            font-size: 16px;
            color: #cbd5e1;
            margin-bottom: 16px;
        }
        .message {
            font-size: 14px;
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 28px;
        }
        .btn-container {
            text-align: center;
            margin-bottom: 28px;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #3b82f6, #9333ea);
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
        }
        .divider {
            border: none;
            border-top: 1px solid #334155;
            margin: 24px 0;
        }
        .url-box {
            background-color: #0f172a;
            border: 1px solid #334155;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 12px;
            color: #64748b;
            word-break: break-all;
        }
        .url-box a {
            color: #60a5fa;
            text-decoration: none;
        }
        .warning {
            background-color: rgba(251, 191, 36, 0.08);
            border: 1px solid rgba(251, 191, 36, 0.2);
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 12px;
            color: #fbbf24;
            margin-top: 20px;
        }
        .footer {
            background-color: #0f172a;
            padding: 20px 32px;
            text-align: center;
            font-size: 12px;
            color: #475569;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="header">
        <div class="header-icon">
            <!-- lock icon inline SVG -->
            <svg width="28" height="28" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h1>WhoTouchedIt</h1>
    </div>

    <!-- Body -->
    <div class="body">
        <p class="greeting">Bonjour {{ $user->name ?? $user->prenom ?? 'utilisateur' }},</p>
        <p class="message">
            Vous recevez cet email car nous avons reçu une demande de réinitialisation du mot de passe pour votre compte.<br><br>
            Cliquez sur le bouton ci-dessous pour choisir un nouveau mot de passe. Ce lien est valable <strong style="color:#e2e8f0;">60 minutes</strong>.
        </p>

        <div class="btn-container">
            <a href="{{ url('/password/reset/' . $token . '?email=' . urlencode($email)) }}" class="btn">
                Réinitialiser mon mot de passe
            </a>
        </div>

        <hr class="divider">

        <p style="font-size:13px; color:#64748b; margin-bottom:10px;">
            Si le bouton ne fonctionne pas, copiez ce lien dans votre navigateur :
        </p>
        <div class="url-box">
            <a href="{{ url('/password/reset/' . $token . '?email=' . urlencode($email)) }}">
                {{ url('/password/reset/' . $token . '?email=' . urlencode($email)) }}
            </a>
        </div>

        <div class="warning">
            ⚠️ Si vous n'êtes pas à l'origine de cette demande, ignorez cet email. Votre mot de passe restera inchangé.
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; {{ date('Y') }} WhoTouchedIt — Accès restreint, usage interne uniquement.</p>
    </div>
</div>
</body>
</html>
