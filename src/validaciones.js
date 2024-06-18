document.addEventListener('DOMContentLoaded', function() {
    const cardNumber = document.getElementById('card-number');
    const expirationDate = document.getElementById('expiration-date');
    const securityCode = document.getElementById('security-code');
    const cardHolder = document.getElementById('card-holder');
    const form = document.querySelector('form');

    cardNumber.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').slice(0, 19);
    });

    expirationDate.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9\/]/g, '').slice(0, 5);
        if (this.value.length === 2 && !this.value.includes('/')) {
            this.value = this.value + '/';
        }
    });

    securityCode.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').slice(0, 3);
    });

    cardHolder.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
    });

    form.addEventListener('submit', function(event) {
        const [month, year] = expirationDate.value.split('/').map(Number);
        const currentDate = new Date();
        const currentYear = currentDate.getFullYear() % 100; // Obtener los últimos dos dígitos del año actual
        const currentMonth = currentDate.getMonth() + 1; // Obtener el mes actual (0-indexed)

        if (!month || !year || month < 1 || month > 12) {
            alert('Fecha de expiración no válida');
            event.preventDefault();
            return;
        }

        if (year < currentYear || (year === currentYear && month < currentMonth)) {
            alert('Fecha de expiración no válida');
            event.preventDefault();
            return;
        }

        if (cardNumber.value.length < 13 || cardNumber.value.length > 19) {
            alert('Número de tarjeta no válido');
            event.preventDefault();
            return;
        }

        if (securityCode.value.length < 3 || securityCode.value.length > 4) {
            alert('Código de seguridad no válido');
            event.preventDefault();
            return;
        }
    });
});
