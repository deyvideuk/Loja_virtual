

// mensagens de erro
var msg = document.getElementById('msg');

// FUNÇÕES DE CARREGAMENTO DE ENDEREÇO (IBGE e ViaCEP)

async function carregarEstados() {
    const url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados";
    const selectEstado = document.getElementById("estadoUsuario");

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
 * Carrega a lista de cidades de um estado (UF) e popula o select #cidadeUsuario.
 * @param {string} uf - A sigla do estado (UF).
 */
async function carregarCidades(uf) {
    const selectCidade = document.getElementById("cidadeUsuario");

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
        msg.innerHTML = "Erro ao carregar cidades: ";
    }
}

// Busca o endereço pelo CEP usando a API ViaCEP e preenche os campos.
async function buscarCEP() {
    const cepInput = document.getElementById("cepUsuario");
    const cep = cepInput.value.replace(/\D/g, '');

    if (cep.length !== 8) return;

    const url = `https://viacep.com.br/ws/${cep}/json/`;

    try {
        const resposta = await fetch(url);
        const dados = await resposta.json();

        if (dados.erro) {
            msg.innerHTML = "CEP não encontrado";
            return;
        }

        document.getElementById("enderecoUsuario").value = dados.logradouro || "";
        document.getElementById("bairroUsuario").value = dados.bairro || "";
        document.getElementById("estadoUsuario").value = dados.uf || "";

        if (dados.uf) {
            await carregarCidades(dados.uf);
            document.getElementById("cidadeUsuario").value = dados.localidade || "";
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
    const cpfLimpo = cpf.replace(/\D/g, '');
    return cpfLimpo.length === 11 && !/^(\d)\1+$/.test(cpfLimpo);
}

// FUNÇÕES DE ERROS

function mostrarErro(input, mensagem) {
    let alerta = document.getElementById('msg');

    // alerta.classList.remove('alert-warning');
    alerta.classList.remove('alert-warning');
    alerta.innerHTML = mensagem;
    
}

function limparErro(input) {
    const small = input.parentElement.querySelector(".error-message");
    if (small) small.innerText = "";
    if (input.parentElement) input.parentElement.classList.remove('error');
    input.style.borderColor = "";
}

// LÓGICA PRINCIPAL (EVENT LISTENERS)

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form-cadastro");
    const estadoSelect = document.getElementById("estadoUsuario");
    const cepInput = document.getElementById("cepUsuario");

    carregarEstados();

    if (cepInput) {
        cepInput.addEventListener("blur", buscarCEP);
        cepInput.addEventListener("input", function () {
            const onlyDigits = this.value.replace(/\D/g, '');
            if (onlyDigits.length === 8) buscarCEP();
        });
    }

    if (estadoSelect) {
        estadoSelect.addEventListener("change", function () {
            carregarCidades(this.value);
        });
    }

    // Validação em tempo real
    const camposParaValidacao = [
        { id: "nomeUsuario", event: "blur", validator: (val) => val.trim().length >= 6, msg: "Nome completo (mínimo 6 caracteres)." },
        { id: "cpfUsuario", event: "input", validator: validarCPF, msg: "CPF inválido." },
        { id: "emailUsuario", event: "input", validator: validarEmail, msg: "Email inválido." },
        { id: "telefoneUsuario", event: "input", validator: validarTelefone, msg: "Telefone inválido." },
        { id: "dataUsuario", event: "input", validator: validarDataNascimento, msg: "Idade mínima: 18 anos." },
        { id: "numeroUsuario", event: "input", validator: validarNumero, msg: "Número inválido." },
        { id: "senhaUsuario", event: "input", validator: validarSenha, msg: "Senha: 8-20 caracteres, 1 maiúscula e 1 número." },
        { id: "complementoUsuario", event: "input", validator: (val) => val.trim() !== "", msg: "Complemento obrigatório." },
    ];

    camposParaValidacao.forEach(campo => {
        const input = document.getElementById(campo.id);
        if (input) {
            input.addEventListener(campo.event, function () {
                if (this.value.trim() === "") {
                    limparErro(this);
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

    // Confirmação de senha
    const senhaInput = document.getElementById("senhaUsuario");
    const confirmarSenhaInput = document.getElementById("confirmarSenha");

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

    // Envio do formulário
    // if (form) {
    //     form.addEventListener("submit", async (event) => {
    //         event.preventDefault();
    //         let valido = true;

    //         msg.innerHTML = ""; // limpa mensagens gerais

    //         document.querySelectorAll("#form-cadastro input, #form-cadastro select")
    //             .forEach(input => limparErro(input));

    //         const campos = [
    //             { input: document.getElementById("nomeUsuario"), validator: (val) => val.trim().length >= 6, msg: "Nome completo (mínimo 6 caracteres)." },
    //             { input: document.getElementById("cpfUsuario"), validator: validarCPF, msg: "CPF inválido." },
    //             { input: document.getElementById("emailUsuario"), validator: validarEmail, msg: "Email inválido." },
    //             { input: document.getElementById("telefoneUsuario"), validator: validarTelefone, msg: "Telefone inválido." },
    //             { input: document.getElementById("dataUsuario"), validator: validarDataNascimento, msg: "Data inválida (mínimo 18 anos)." },
    //             { input: document.getElementById("numeroUsuario"), validator: validarNumero, msg: "Número inválido." },
    //             { input: document.getElementById("senhaUsuario"), validator: validarSenha, msg: "Senha inválida." },
    //             { input: document.getElementById("confirmarSenha"), validator: (val) => confirmarSenha(document.getElementById("senhaUsuario").value, val), msg: "As senhas não coincidem." },
    //             { input: document.getElementById("complementoUsuario"), validator: (val) => val.trim() !== "", msg: "Complemento é obrigatório." },
    //             { input: document.getElementById("cepUsuario"), validator: (val) => val.replace(/\D/g, '').length === 8, msg: "CEP inválido." },
    //             { input: document.getElementById("enderecoUsuario"), validator: (val) => val.trim() !== "", msg: "Endereço obrigatório." },
    //             { input: document.getElementById("bairroUsuario"), validator: (val) => val.trim() !== "", msg: "Bairro obrigatório." },
    //             { input: document.getElementById("estadoUsuario"), validator: (val) => val.trim() !== "", msg: "Estado obrigatório." },
    //             { input: document.getElementById("cidadeUsuario"), validator: (val) => val.trim() !== "", msg: "Cidade obrigatória." },
    //         ];

    //         campos.forEach(campo => {
    //             if (campo.input && (!campo.input.value.trim() || !campo.validator(campo.input.value))) {
    //                 mostrarErro(campo.input, campo.msg);
    //                 valido = false;
    //             }
    //         });

    //         if (!valido) {
    //             msg.innerHTML = "<span style='color:red;'>⚠️ Corrija os erros antes de enviar.</span>";
    //             return;
    //         }

    //         const dados = Object.fromEntries(new FormData(form));

    //         try {
    //             const resposta = await fetch("http://localhost:3000/api/usuarios", {
    //                 method: "POST",
    //                 headers: { "Content-Type": "application/json" },
    //                 body: JSON.stringify(dados),
    //             });

    //             const resultado = await resposta.json();

    //             if (!resposta.ok) {
    //                 // Mostra mensagem de erro vinda do backend
    //                 msg.innerHTML = `<span style='color:red;'>${resultado.erro || "Erro ao cadastrar usuário!"}</span>`;
    //                 return;
    //             }

    //             msg.innerHTML = "<span style='color:green;'>Cadastro realizado com sucesso!</span>";
    //             form.reset();

    //         } catch (erro) {
    //             console.error("Erro no envio:", erro);
    //             msg.innerHTML = "<span style='color:red;'>Erro de conexão com o servidor. Tente novamente.</span>";
    //         }
    //     });
    // }
});
