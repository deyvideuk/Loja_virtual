function getYear() {
    data = new Date();
    let ano = data.getFullYear();

    document.getElementById('current-year').textContent = ano;
}

window.onload = getYear; 