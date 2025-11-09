// FUNÇÕES DE CARREGAMENTO DE ENDEREÇO (IBGE e ViaCEP)

async function carregarEstados() {
    const url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados";
    const selectEstado = document.getElementById("estado");

    if (!selectEstado) return;

    try {
        const resposta = await fetch(url);
        const dados = await resposta.json();

        dados.sort((a, b) => a.nome.localeCompare(b.nome));

        selectEstado.innerHTML = '<option value="">Selecione o estado</option>';
        dados.forEach(estado => {
            const option = document.createElement("option");
            option.value = estado.sigla;
            option.textContent = estado.nome;
            selectEstado.appendChild(option);
        });

    } catch (erro) {
        console.error("Erro ao carregar estados: ", erro);
    }
}

/**
 * Carrega a lista de cidades de um estado (UF) e popula o select #cidade.
 * @param {string} uf - A sigla do estado (UF).
 */

async function carregarCidades(uf) {
    const selectCidade = document.getElementById("cidade");

    if (!selectCidade) return;

    if (!uf) {
        selectCidade.innerHTML = '<option value="">Selecione a cidade</option>';
        return;
    }

    const url = `https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/municipios`;

    try {
        const resposta = await fetch(url);
        const dados = await resposta.json();

        selectCidade.innerHTML = '<option value="">Selecione a cidade</option>';

        dados.sort((a, b) => a.nome.localeCompare(b.nome));

        dados.forEach(cidade => {
            const option = document.createElement("option");
            option.value = cidade.nome;
            option.textContent = cidade.nome;
            selectCidade.appendChild(option);
        });

    } catch (erro) {
        console.error("Erro ao carregar cidades: ", erro);
    }
}


// Busca o endereço pelo CEP usando a API ViaCEP e preenche os campos.
async function buscarCEP() {
    const cepInput = document.getElementById("cep");
    const cep = cepInput.value.replace(/\D/g, '');

    if (cep.length !== 8) return;

    const url = `https://viacep.com.br/ws/${cep}/json/`;

    try {
        const resposta = await fetch(url);
        const dados = await resposta.json();

        if (dados.erro) {
            alert("CEP não encontrado");
            return;
        }

        document.getElementById("endereco").value = dados.logradouro || "";
        document.getElementById("bairro").value = dados.bairro || "";
        document.getElementById("estado").value = dados.uf || "";

        if (dados.uf) {
            await carregarCidades(dados.uf);
            document.getElementById("cidade").value = dados.localidade || "";
        }

    } catch (erro) {
        console.error("Erro ao buscar CEP:", erro);
    }
}

// FUNÇÕES DE VALIDAÇÃO

function validarEmail(email) {
    const padraoEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return padraoEmail.test(email);
}

function validarTelefone(telefone) {
    const padraoTelefone = /^\s*\(?\d{2}\)?\s*(\d{4,5}[-.\s]?\d{4})\s*$/;
    return padraoTelefone.test(telefone);
}

function validarDataNascimento(dataNascimento) {
    const dataAtual = new Date();
    const dataNascimentoDate = new Date(dataNascimento);
    const idadeMinima = 18;
    const idade = dataAtual.getFullYear() - dataNascimentoDate.getFullYear();
    return !isNaN(dataNascimentoDate) && idade >= idadeMinima;
}

function validarSenha(senha) {
    // Senha deve ter entre 8 e 20 caracteres, incluindo uma letra maiúscula e um número.
    const padraoSenha = /^(?=.*[A-Z])(?=.*\d)\S{8,20}$/;
    return padraoSenha.test(senha);
}

function confirmarSenha(senha, confirmarSenha) {
    return senha === confirmarSenha;
}

function validarNumero(valor) {
    const num = Number(valor);
    return Number.isInteger(num) && num > 0 && num <= 100000;
}

function validarCPF(cpf) {
    // Validação simplificada: apenas verifica se tem 11 dígitos numéricos
    const cpfLimpo = cpf.replace(/\D/g, '');
    return cpfLimpo.length === 11 && !/^(\d)\1+$/.test(cpfLimpo);
}

// FUNÇÕES DE ERROS

function mostrarErro(input, mensagem) {
    const small = input.parentElement.querySelector(".error-message");
    if (small) {
        small.innerText = mensagem;
        small.style.color = "red";
    }
    // Adiciona classe de erro no elemento pai para respeitar o CSS (mostra <small>)
    if (input.parentElement) {
        input.parentElement.classList.add('error');
    }
    input.style.borderColor = "red";
}

function limparErro(input) {
    const small = input.parentElement.querySelector(".error-message");
    if (small) {
        small.innerText = "";
    }
    // Remove a classe de erro do elemento pai para esconder a mensagem
    if (input.parentElement) {
        input.parentElement.classList.remove('error');
    }
    input.style.borderColor = "";
}

// LÓGICA PRINCIPAL (EVENT LISTENERS)

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form-cadastro");
    const estadoSelect = document.getElementById("estado");
    const cepInput = document.getElementById("cep");

    // Carregamento inicial de estados
    carregarEstados();

    // Event Listeners para CEP
    if (cepInput) {
        cepInput.addEventListener("blur", buscarCEP);
        cepInput.addEventListener("input", function () {
            const onlyDigits = this.value.replace(/\D/g, '');
            if (onlyDigits.length === 8) {
                buscarCEP();
            }
        });
    }

    // Event Listener para mudança de estado
    if (estadoSelect) {
        estadoSelect.addEventListener("change", function () {
            carregarCidades(this.value);
        });
    }

    // Configuração de validação em tempo real (blur/input)
    const camposParaValidacao = [
        { id: "nome", event: "blur", validator: (val) => val.trim().length >= 6, msg: "Nome completo (mínimo 6 caracteres)." },
        { id: "cpf", event: "input", validator: validarCPF, msg: "CPF inválido." },
        { id: "email", event: "input", validator: validarEmail, msg: "Email inválido." },
        { id: "telefone", event: "input", validator: validarTelefone, msg: "Telefone inválido." },
        { id: "data-nascimento", event: "input", validator: validarDataNascimento, msg: "Data de nascimento inválida (mínimo 18 anos)." },
        { id: "numero", event: "input", validator: validarNumero, msg: "Número inválido (1 a 100000)." },
        { id: "senha", event: "input", validator: validarSenha, msg: "Senha: 8-20 caracteres, 1 maiúscula, 1 número." },
        { id: "complemento", event: "input", validator: (val) => val.trim() !== "", msg: "Complemento é obrigatório." },
    ];

    camposParaValidacao.forEach(campo => {
        const input = document.getElementById(campo.id);
        if (input) {
            input.addEventListener(campo.event, function () {
                if (this.value.trim() === "") {
                    limparErro(this); // Não mostra erro se o campo estiver vazio, apenas no submit
                    return;
                }
                if (!campo.validator(this.value)) {
                    mostrarErro(this, campo.msg);
                } else {
                    limparErro(this);
                }
            });
        }
    });

    // Validação de confirmação de senha
    const senhaInput = document.getElementById("senha");
    const confirmarSenhaInput = document.getElementById("confirmar-senha");

    if (senhaInput && confirmarSenhaInput) {
        const validarConfirmacao = () => {
            if (confirmarSenhaInput.value.trim() === "") {
                limparErro(confirmarSenhaInput);
                return;
            }
            if (!confirmarSenha(senhaInput.value, confirmarSenhaInput.value)) {
                mostrarErro(confirmarSenhaInput, "As senhas não coincidem.");
            } else {
                limparErro(confirmarSenhaInput);
            }
        };
        senhaInput.addEventListener("input", validarConfirmacao);
        confirmarSenhaInput.addEventListener("input", validarConfirmacao);
    }

    // Event Listener para submissão do formulário
    if (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();

            let valido = true;

            // Limpa todos os erros antes de revalidar
            document.querySelectorAll("#form-cadastro input, #form-cadastro select").forEach(input => limparErro(input));

            // Lista de campos e suas validações
            const campos = [
                { input: document.getElementById("nome"), validator: (val) => val.trim().length >= 6, msg: "Nome completo (mínimo 6 caracteres)." },
                { input: document.getElementById("cpf"), validator: validarCPF, msg: "CPF inválido." },
                { input: document.getElementById("email"), validator: validarEmail, msg: "Email inválido." },
                { input: document.getElementById("telefone"), validator: validarTelefone, msg: "Telefone inválido." },
                { input: document.getElementById("data-nascimento"), validator: validarDataNascimento, msg: "Data de nascimento inválida (mínimo 18 anos)." },
                { input: document.getElementById("numero"), validator: validarNumero, msg: "Número inválido (1 a 100000)." },
                { input: document.getElementById("senha"), validator: validarSenha, msg: "Senha: 8-14 caracteres, 1 maiúscula, 1 número." },
                { input: document.getElementById("confirmar-senha"), validator: (val) => confirmarSenha(document.getElementById("senha").value, val), msg: "As senhas não coincidem." },
                { input: document.getElementById("complemento"), validator: (val) => val.trim() !== "", msg: "Complemento é obrigatório." },
                // Validação de campos de endereço (obrigatórios)
                { input: document.getElementById("cep"), validator: (val) => val.replace(/\D/g, '').length === 8, msg: "CEP inválido ou incompleto." },
                { input: document.getElementById("endereco"), validator: (val) => val.trim() !== "", msg: "Endereço é obrigatório." },
                { input: document.getElementById("bairro"), validator: (val) => val.trim() !== "", msg: "Bairro é obrigatório." },
                { input: document.getElementById("estado"), validator: (val) => val.trim() !== "", msg: "Estado é obrigatório." },
                { input: document.getElementById("cidade"), validator: (val) => val.trim() !== "", msg: "Cidade é obrigatória." },
            ];

            campos.forEach(campo => {
                if (campo.input && (!campo.input.value.trim() || !campo.validator(campo.input.value))) {
                    mostrarErro(campo.input, campo.msg);
                    valido = false;
                }
            });

            if (valido) {
                console.log("Formulário válido! Enviando...");
                form.submit();
            } else {
                console.log("Formulário contém erros. Corrija antes de enviar.");
            }
        });
    }
});