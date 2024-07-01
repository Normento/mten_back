<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $body->title }}</title>
    <style>
        /* Mettez vos styles CSS ici */
    </style>
</head>

<body style="margin: 0; padding: 0; font-family: 'Montserrat', sans-serif; background-color: #eceff1;">
    <div role="article" aria-roledescription="email" aria-label="Email de confirmation de création de compte" lang="en">
        <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
            style="font-family: 'Montserrat', sans-serif;">
            <tr>
                <td align="center" style="padding: 48px; text-align: center; background-color: #eceff1;">
                    <a href="{{ config('app.url') }}" style="text-decoration: none; color: #000;">
                        {{ config('app.name') }}
                    </a>
                </td>
            </tr>
            <tr>
                <td style="padding: 48px; background-color: #ffffff;">
                    <p style="font-size: 24px; font-weight: 600; color: #263238; margin: 0 0 24px;">{{ $body->intro }}
                    </p>
                    <p style="font-size: 16px; line-height: 24px; color: #626262; margin: 0 0 24px;">Bonjour {{
                        $body->corpus }},</p>
                    <p style="font-size: 16px; line-height: 24px; color: #626262; margin: 0 0 24px;">Votre compte a été
                        créé avec succès.</p>
                    <p style="font-size: 16px; line-height: 24px; color: #626262; margin: 0 0 24px;">Vous pouvez
                        désormais vous connecter en utilisant les informations suivantes :</p>
                    <ul style="list-style: none; padding: 0; margin: 0 0 24px;">
                        <li><strong>Email :</strong> {{ $body->data['email'] }}</li>
                        <li><strong>Mot de passe :</strong> {{ $body->data['password'] }}</li>
                    </ul>
                    <p style="font-size: 16px; line-height: 24px; color: #626262; margin: 0 0 24px;">Merci de nous aider
                        à sécuriser votre compte.</p>
                </td>
            </tr>
            <tr>
                <td align="center" style="background-color: #eceff1;">
                    <p style="font-size: 14px; color: #000;">&copy; {{ date('Y') }} {{ config('app.name') }}. Tous
                        droits réservés.</p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>