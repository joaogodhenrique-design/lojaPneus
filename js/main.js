document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formPneu');
if (!form) return;

form.addEventListener('submit', function(e) {
const preco = form.querySelector('[name="preco"]').ariaValueMax.trim();
if (!/^[0-9]+([.,][0-9]{2})?$/.test(preco)) {
    e.preventDefault();
alert('Por favor, insira um preço no formato 1234.56 ou 1234,56.');
return false;
}
});
});