@extends('layouts.app')
@section('titulo', 'Novo Pedido')

@section('conteudo')
<div class="max-w-3xl" x-data="pedidoForm()">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('pedidos.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-xl font-bold text-gray-800">Novo Pedido</h2>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <form method="POST" action="{{ route('pedidos.store') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cliente <span class="text-red-500">*</span></label>
                <select name="cliente_id" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('cliente_id') border-red-500 @enderror">
                    <option value="">Selecione o cliente</option>
                    @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nome }}</option>
                    @endforeach
                </select>
                @error('cliente_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Observações</label>
                <textarea name="observacoes" rows="2" placeholder="Observações adicionais..."
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('observacoes') }}</textarea>
            </div>

            {{-- Itens do pedido --}}
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-sm font-semibold text-gray-700">Itens do Pedido</h3>
                    <button type="button" @click="adicionarItem()"
                            class="text-sm text-blue-600 hover:underline">+ Adicionar Item</button>
                </div>

                @error('itens')<p class="text-xs text-red-600 mb-2">{{ $message }}</p>@enderror

                <div class="space-y-3">
                    <template x-for="(item, idx) in itens" :key="idx">
                        <div class="grid grid-cols-12 gap-2 items-end p-3 bg-gray-50 rounded-lg">
                            <div class="col-span-5">
                                <label class="block text-xs text-gray-500 mb-1">Produto</label>
                                <select :name="'itens[' + idx + '][produto_id]'" x-model="item.produto_id"
                                        @change="atualizarPreco(idx)"
                                        class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Selecione</option>
                                    @foreach($produtos as $produto)
                                    <option value="{{ $produto->id }}" data-preco="{{ $produto->preco_venda }}">{{ $produto->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs text-gray-500 mb-1">Qtd</label>
                                <input type="number" :name="'itens[' + idx + '][quantidade]'" x-model="item.quantidade"
                                       @input="calcularSubtotal(idx)" min="1"
                                       class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs text-gray-500 mb-1">Preço Unit.</label>
                                <input type="number" :name="'itens[' + idx + '][preco_unitario]'" x-model="item.preco_unitario"
                                       @input="calcularSubtotal(idx)" step="0.01"
                                       class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs text-gray-500 mb-1">Subtotal</label>
                                <p class="px-2 py-1.5 text-sm font-medium text-gray-800" x-text="'R$ ' + (item.subtotal || 0).toFixed(2).replace('.', ',')"></p>
                            </div>
                            <div class="col-span-1 text-right">
                                <button type="button" @click="removerItem(idx)" class="text-red-500 hover:text-red-700">✕</button>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="mt-4 text-right">
                    <p class="text-sm text-gray-500">Total do pedido:</p>
                    <p class="text-2xl font-bold text-blue-700" x-text="'R$ ' + totalGeral.toFixed(2).replace('.', ',')"></p>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('pedidos.index') }}" class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                <x-btn-primary>Criar Pedido</x-btn-primary>
            </div>
        </form>
    </div>
</div>

<script>
function pedidoForm() {
    const produtos = @json($produtos->map(fn($p) => ['id' => $p->id, 'preco' => (float)$p->preco_venda]));

    return {
        itens: [{ produto_id: '', quantidade: 1, preco_unitario: 0, subtotal: 0 }],
        get totalGeral() {
            return this.itens.reduce((acc, i) => acc + (i.subtotal || 0), 0);
        },
        adicionarItem() {
            this.itens.push({ produto_id: '', quantidade: 1, preco_unitario: 0, subtotal: 0 });
        },
        removerItem(idx) {
            if (this.itens.length > 1) this.itens.splice(idx, 1);
        },
        atualizarPreco(idx) {
            const produto = produtos.find(p => p.id == this.itens[idx].produto_id);
            if (produto) this.itens[idx].preco_unitario = produto.preco;
            this.calcularSubtotal(idx);
        },
        calcularSubtotal(idx) {
            const item = this.itens[idx];
            item.subtotal = (item.quantidade || 0) * (item.preco_unitario || 0);
        }
    }
}
</script>
@endsection
