<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Vérifiez votre adresse email pour Nexus Stock</title>
    <style type="text/css">
        /* Client-specific Styles */
        #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
        body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
        /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop experience. */
        .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
        /* Forces Hotmail to display normal line spacing. */
        #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
        img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;}
        a img {border:none;}
        .image_fix {display:block;}
        p {margin: 0px 0px 10px 0px !important;}
        table td {border-collapse: collapse;}
        table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
        a {color: #FF8C00; text-decoration: none;} /* Orange pour les liens */

        /* Styles généraux */
        body, #backgroundTable {
            background-color:#f0f0f0;
            font-family: Arial, Helvetica, sans-serif;
            font-size:14px;
            color:#333333;
        }
        h1, h2, h3, h4, h5, h6 {
            color: #444444;
            line-height: 100%;
            margin:0;
            padding:0;
        }
        h1 {font-size:24px;}
        h2 {font-size:20px;}
        h3 {font-size:18px;}
        h4 {font-size:16px;}
        .container-padding {
            padding: 20px;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            font-size: 16px;
            color: #ffffff;
            background-color: #FF8C00; /* Orange */
            border-radius: 5px;
            text-decoration: none;
            mso-padding-alt: 0px; /* Outlook hack */
        }
        .button a {
            color: #ffffff;
            display: block;
            padding: 12px 25px;
            text-decoration: none;
        }
        .footer {
            font-size: 12px;
            color: #888888;
            padding-top: 20px;
        }

        /* Responsive Styles */
        @media only screen and (max-width: 600px) {
            table[class="body"], table[class="outer-table"] {
                width: 100% !important;
            }
            td[class="container-padding"] {
                padding: 10px !important;
            }
            table[class="button-table"] {
                width: 100% !important;
            }
            .button {
                width: 100% !important;
                padding: 0px !important;
            }
            .button a {
                padding: 12px 0px !important;
                text-align: center !important;
            }
        }
    </style>
</head>
<body style="margin:0; padding:0; -webkit-text-size-adjust:none; background-color:#f0f0f0;">
    <table border="0" cellpadding="0" cellspacing="0" id="backgroundTable" style="background-color:#f0f0f0;" width="100%">
        <tr>
            <td align="center" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" class="outer-table" width="600" style="width:600px; max-width:600px; background-color:#ffffff; border-radius: 8px; overflow: hidden; margin-top: 20px; margin-bottom: 20px;">
                    <tr>
                        <td align="center" class="container-padding" style="background-color: #FF8C00; padding: 20px; color: #ffffff;">
                            <h1 style="color:#ffffff; margin:0; padding:0;">Nexus Stock</h1>
                        </td>
                    </tr>
                    <tr>
                        <td class="container-padding" style="padding: 20px;">
                            <p style="margin-bottom: 20px;">Bonjour <strong>{{ $first_name. " " . $last_name }}</strong>,</p>

                            <p style="margin-bottom: 20px;">Votre compte a été créé par un administrateur pour <strong>Nexus Stock</strong>. Voici vos informations de connexion initiales :</p>

                            <p style="margin-bottom: 20px; font-weight: bold; font-size: 16px; color: #444;">
                                Mot de passe temporaire : <span style="color: #FF8C00; font-weight: bold; font-style: italic">{{ $password }}</span>
                            </p>

                            <p style="margin-bottom: 20px;">Avant de pouvoir utiliser pleinement votre compte, veuillez vérifier votre adresse email en cliquant sur le bouton ci-dessous :</p>

                            <table border="0" cellpadding="0" cellspacing="0" class="button-table" width="100%">
                                <tr>
                                    <td align="center" style="padding: 20px 0;">
                                        <div class="button" style="background-color: #FF8C00; border-radius: 5px;">
                                            <a href="{{ $verification_url }}" target="_blank" style="color: #ffffff; text-decoration: none; display: inline-block; padding: 12px 25px; border-radius: 5px;">Vérifier mon adresse email</a>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin-bottom: 20px;">Nous vous recommandons fortement de changer ce mot de passe dès votre première connexion.</p>

                            <p style="margin-bottom: 20px;">Si vous n'avez pas créé de compte ou si vous ne reconnaissez pas cet e-mail, veuillez l'ignorer.</p>

                            <p>Cordialement,<br/>L'équipe Nexus Stock</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" class="container-padding footer" style="padding: 20px; border-top: 1px solid #eeeeee;">
                            <p style="margin:0;">&copy; {{ date('Y') }} Nexus Stock. Tous droits réservés.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
