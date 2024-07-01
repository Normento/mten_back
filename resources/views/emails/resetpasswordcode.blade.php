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
    <div role="article" aria-roledescription="email" aria-label="Email de confirmation" lang="en">
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
                    <p style="font-size: 16px; line-height: 24px; color: #626262; margin: 0 0 24px;">Bonjour cher(e)
                        {{ $body->data['nom'] }},</p>
                    <p style="font-size: 16px; line-height: 24px; color: #626262; margin: 0 0 24px;">Vous avez récemment
                        demandé la réinitialisation de votre compte. <br> Pour procéder à cette réinitialisation,
                        veuillez utiliser le code de vérification suivant :</p>
                    <p style="font-size: 16px; line-height: 24px; color: #626262; margin: 0 0 24px;">Code de
                        réinitialisation : <b>{{ $body->data['code'] }}</b> <br> Veuillez utiliser ce code dans la
                        section dédiée sur la plateforme pour réinitialiser votre mot de passe ou effectuer toute
                        autre action nécessaire pour sécuriser votre compte. <br> Si vous n'avez pas demandé à
                        réinitialiser votre mot de passe, vous pouvez ignorer cet e-mail. <br> Nous vous remercions
                        pour votre confiance. <br> Cordialement,
                    </p>
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