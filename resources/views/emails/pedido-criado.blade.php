<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Recebido</title>
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
                            <h2 style="color: #1e293b; margin-top: 0;">Pedido #{{ $pedido->id }} recebido!</h2>
                            <p style="color: #475569;">Olá, <strong>{{ $pedido->cliente->nome }}</strong>!</p>
                            <p style="color: #475569;">Seu pedido foi recebido e está em análise. Confira abaixo o resumo:</p>

                            <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse: collapse; margin: 20px 0;">
                                <thead>
                                    <tr style="background-color: #f1f5f9;">
                                        <th style="text-align: left; color: #1e293b; border-bottom: 2px solid #e2e8f0;">Produto</th>
                                        <th style="text-align: center; color: #1e293b; border-bottom: 2px solid #e2e8f0;">Qtd</th>
                                        <th style="text-align: right; color: #1e293b; border-bottom: 2px solid #e2e8f0;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pedido->itens as $item)
                                    <tr>
                                        <td style="color: #475569; border-bottom: 1px solid #e2e8f0;">{{ $item->produto->nome }}</td>
                                        <td style="text-align: center; color: #475569; border-bottom: 1px solid #e2e8f0;">{{ $item->quantidade }}</td>
                                        <td style="text-align: right; color: #475569; border-bottom: 1px solid #e2e8f0;">R$ {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" style="text-align: right; color: #1e293b; font-weight: bold; padding-top: 12px;">Total:</td>
                                        <td style="text-align: right; color: #1e40af; font-weight: bold; font-size: 18px; padding-top: 12px;">R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div style="background-color: #f1f5f9; border-radius: 6px; padding: 12px 16px; margin-top: 16px;">
                                <p style="margin: 0; color: #475569;"><strong>Status:</strong> Pendente</p>
                                <p style="margin: 6px 0 0; color: #475569;"><strong>Data:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                            </div>

                            <p style="color: #64748b; font-size: 14px; margin-top: 24px;">Em caso de dúvidas, entre em contato conosco.</p>
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
