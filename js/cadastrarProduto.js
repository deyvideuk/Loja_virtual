// cadastrarProduto.js

// Atualiza o ano no rodapé
function getYear() {
    const ano = new Date().getFullYear();
    const el = document.getElementById("current-year");
    if (el) el.textContent = ano;
}

document.addEventListener("DOMContentLoaded", () => {
    getYear();

    // Seletores (IDs ajustados para bater com seu HTML)
    const form = document.getElementById("form-cadastro");
    const nomeDoProduto = document.getElementById("nomeProduto");
    const precoDoProduto = document.getElementById("precoProduto");
    const quantidadeDoProduto = document.getElementById("quantidadeProduto"); // corresponde ao HTML
    const descricaoDoProduto = document.getElementById("descricaoProduto");   // corresponde ao HTML

    if (!form) {
        console.error("Form não encontrado: verifique id='form-cadastro' no HTML.");
        return;
    }

    // ===== Helpers UI =====
    function ensureErrorElement(input) {
        if (!input) return null;
        let small = input.parentElement && input.parentElement.querySelector(".error-message");
        if (!small && input.parentElement) {
            small = document.createElement("small");
            small.className = "error-message";
            small.style.display = "none";
            input.parentElement.appendChild(small);
        }
        return small;
    }

    function addInputErrorClass(input) {
        input.classList.add("input-error");
    }
    function removeInputErrorClass(input) {
        input.classList.remove("input-error");
    }

    function mostrarErro(input, mensagem) {
        if (!input) return;
        const small = ensureErrorElement(input);
        if (small) {
            small.innerText = mensagem;
            small.style.display = "block";
            small.style.color = "red";
        }
        addInputErrorClass(input);
    }

    function limparErro(input) {
        if (!input) return;
        const small = input.parentElement && input.parentElement.querySelector(".error-message");
        if (small) {
            small.innerText = "";
            small.style.display = "none";
        }
        removeInputErrorClass(input);
    }

    // ===== Validações =====
    function validarNomeProduto(nome) {
        return /^[A-Za-zÀ-ÖØ-öø-ÿ\s]{6,}$/.test(nome);
    }

    function parsePrecoToFloat(raw) {
        if (typeof raw !== "string") raw = String(raw || "");
        const cleaned = raw.replace(/[^\d.,-]/g, "").replace(/\./g, "").replace(",", ".");
        const n = parseFloat(cleaned);
        return isNaN(n) ? null : n;
    }

    function validarPrecoProduto(precoRaw) {
        const valor = parsePrecoToFloat(precoRaw);
        return valor !== null && valor >= 5.0 && valor <= 1000.0;
    }

    function validarQuantidadeEstoque(quantidadeRaw) {
        const v = parseInt(quantidadeRaw, 10);
        return !isNaN(v) && v > 0 && v <= 1000;
    }

    function validarDescricao(descricao) {
        const tamanho = (descricao || "").length;
        return tamanho >= 20 && tamanho <= 3000;
    }

    // ===== Debounce util =====
    let debounceTimer;
    function debounce(fn, wait = 150) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(fn, wait);
    }

    // ===== Validação em tempo real =====
    form.addEventListener("input", () => {
        debounce(() => {
            const nome = nomeDoProduto ? nomeDoProduto.value.trim() : "";
            const preco = precoDoProduto ? precoDoProduto.value.trim() : "";
            const quantidade = quantidadeDoProduto ? quantidadeDoProduto.value.trim() : "";
            const descricao = descricaoDoProduto ? descricaoDoProduto.value.trim() : "";

            if (nomeDoProduto) {
                if (!validarNomeProduto(nome)) {
                    mostrarErro(nomeDoProduto, "Por favor, insira um nome válido (mínimo 6 letras).");
                } else {
                    limparErro(nomeDoProduto);
                }
            }

            if (precoDoProduto) {
                if (!validarPrecoProduto(preco)) {
                    mostrarErro(precoDoProduto, "O preço deve estar entre R$ 5,00 e R$ 1000,00.");
                } else {
                    limparErro(precoDoProduto);
                }
            }

            if (quantidadeDoProduto) {
                if (!validarQuantidadeEstoque(quantidade)) {
                    mostrarErro(quantidadeDoProduto, "A quantidade deve estar entre 1 e 1000 unidades.");
                } else {
                    limparErro(quantidadeDoProduto);
                }
            }

            if (descricaoDoProduto) {
                if (!validarDescricao(descricao)) {
                    mostrarErro(descricaoDoProduto, "A descrição deve ter entre 20 e 3000 caracteres.");
                } else {
                    limparErro(descricaoDoProduto);
                }
            }
        }, 150);
    });

    // ===== Validação no submit =====
    form.addEventListener("submit", (e) => {
        const nome = nomeDoProduto ? nomeDoProduto.value.trim() : "";
        const preco = precoDoProduto ? precoDoProduto.value.trim() : "";
        const quantidade = quantidadeDoProduto ? quantidadeDoProduto.value.trim() : "";
        const descricao = descricaoDoProduto ? descricaoDoProduto.value.trim() : "";

        const tudoValido =
            validarNomeProduto(nome) &&
            validarPrecoProduto(preco) &&
            validarQuantidadeEstoque(quantidade) &&
            validarDescricao(descricao);

        if (!tudoValido) {
            e.preventDefault();
            if (nomeDoProduto && !validarNomeProduto(nome)) mostrarErro(nomeDoProduto, "Nome inválido.");
            if (precoDoProduto && !validarPrecoProduto(preco)) mostrarErro(precoDoProduto, "Preço inválido.");
            if (quantidadeDoProduto && !validarQuantidadeEstoque(quantidade)) mostrarErro(quantidadeDoProduto, "Quantidade inválida.");
            if (descricaoDoProduto && !validarDescricao(descricao)) mostrarErro(descricaoDoProduto, "Descrição inválida.");
            alert("Corrija os campos destacados antes de enviar.");
        }
    });
});
