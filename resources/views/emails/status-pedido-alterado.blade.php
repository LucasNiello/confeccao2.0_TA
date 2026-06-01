<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Status do Pedido Atualizado</title>
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
                            <h2 style="color: #1e293b; margin-top: 0;">Atualização do Pedido #{{ $pedido->id }}</h2>
                            <p style="color: #475569;">Olá, <strong>{{ $pedido->cliente->nome }}</strong>!</p>
                            <p style="color: #475569;">O status do seu pedido foi atualizado:</p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 20px 0;">
                                <tr>
                                    <td width="48%" style="background-color: #fef2f2; border-radius: 6px; padding: 16px; text-align: center;">
                                        <p style="margin: 0; color: #94a3b8; font-size: 12px; text-transform: uppercase;">Status anterior</p>
                                        <p style="margin: 8px 0 0; color: #dc2626; font-weight: bold; font-size: 16px;">
                                            {{ match($statusAnterior) {
                                                'pendente' => 'Pendente',
                                                'em_producao' => 'Em Produção',
                                                'concluido' => 'Concluído',
                                                'cancelado' => 'Cancelado',
                                                default => $statusAnterior
                                            } }}
                                        </p>
                                    </td>
                                    <td width="4%" style="text-align: center; color: #94a3b8; font-size: 24px;">→</td>
                                    <td width="48%" style="background-color: #f0fdf4; border-radius: 6px; padding: 16px; text-align: center;">
                                        <p style="margin: 0; color: #94a3b8; font-size: 12px; text-transform: uppercase;">Novo status</p>
                                        <p style="margin: 8px 0 0; color: #16a34a; font-weight: bold; font-size: 16px;">{{ $pedido->statusLabel() }}</p>
                                    </td>
                                </tr>
                            </table>

                            <div style="background-color: #f1f5f9; border-radius: 6px; padding: 12px 16px;">
                                <p style="margin: 0; color: #475569;"><strong>Total do pedido:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>
                                <p style="margin: 6px 0 0; color: #475569;"><strong>Atualizado em:</strong> {{ now()->format('d/m/Y H:i') }}</p>
                            </div>
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
