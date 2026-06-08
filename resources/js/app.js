import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// ── Máscaras de input ──────────────────────────────────────────────────────────

const cpfInput = document.getElementById('cpf');
if (cpfInput) {
    cpfInput.addEventListener('input', function () {
        const d = this.value.replace(/\D/g, '').slice(0, 11);
        if (d.length <= 3)       { this.value = d; return; }
        if (d.length <= 6)       { this.value = `${d.slice(0,3)}.${d.slice(3)}`; return; }
        if (d.length <= 9)       { this.value = `${d.slice(0,3)}.${d.slice(3,6)}.${d.slice(6)}`; return; }
        this.value = `${d.slice(0,3)}.${d.slice(3,6)}.${d.slice(6,9)}-${d.slice(9)}`;
    });
}

const telInput = document.getElementById('telefone');
if (telInput) {
    telInput.addEventListener('input', function () {
        const d = this.value.replace(/\D/g, '').slice(0, 11);
        if (!d.length)     { this.value = ''; return; }
        if (d.length <= 2) { this.value = `(${d}`; return; }
        if (d.length <= 6) { this.value = `(${d.slice(0,2)}) ${d.slice(2)}`; return; }
        // ≤10 dígitos → fixo (XX) XXXX-XXXX; 11 dígitos → celular (XX) XXXXX-XXXX
        if (d.length <= 10) { this.value = `(${d.slice(0,2)}) ${d.slice(2,6)}-${d.slice(6)}`; return; }
        this.value = `(${d.slice(0,2)}) ${d.slice(2,7)}-${d.slice(7)}`;
    });
}
