<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo ao sistema</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f4; padding: 30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
                    <tr>
                        <td style="background-color: #1e40af; padding: 24px 32px;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 22px;">Confecção TA</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 32px;">
                            <h2 style="color: #1e293b; margin-top: 0;">Bem-vindo à equipe, {{ $funcionario->usuario->name }}!</h2>
                            <p style="color: #475569;">Seu cadastro foi realizado com sucesso no sistema de gestão da <strong>Confecção TA</strong>.</p>

                            <div style="background-color: #f1f5f9; border-radius: 6px; padding: 20px; margin: 20px 0;">
                                <p style="margin: 0 0 8px; color: #1e293b;"><strong>📋 Seus dados:</strong></p>
                                <p style="margin: 4px 0; color: #475569;"><strong>Cargo:</strong> {{ $funcionario->cargo->nome }}</p>
                                <p style="margin: 4px 0; color: #475569;"><strong>Data de admissão:</strong> {{ $funcionario->data_admissao->format('d/m/Y') }}</p>
                                <p style="margin: 4px 0; color: #475569;"><strong>E-mail de acesso:</strong> {{ $funcionario->usuario->email }}</p>
                            </div>

                            <p style="color: #475569;">Acesse o sistema através do link abaixo e faça login com seu e-mail cadastrado:</p>

                            <div style="text-align: center; margin: 24px 0;">
                                <a href="{{ config('app.url') }}/login"
                                   style="background-color: #1e40af; color: #ffffff; padding: 12px 32px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block;">
                                    Acessar o Sistema
                                </a>
                            </div>

                            <p style="color: #64748b; font-size: 14px;">Em caso de dúvidas, fale com seu gestor.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f8fafc; padding: 16px 32px; text-align: center;">
                            <p style="color: #94a3b8; font-size: 12px; margin: 0;">© {{ date('Y') }} Confecção TA. Todos os direitos reservados.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
