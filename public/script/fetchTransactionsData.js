document.addEventListener('DOMContentLoaded', () => {
    createTableWithTransactions();
    fetchListOfCurrencyForSelect();
});


function createTableWithTransactions() {
    fetch('/get-transactions')
        .then(response => response.json())
        .then(data => {
            const table = document.getElementById('transactions-table');

            data.data.forEach(item => {
                const row = document.createElement('tr');


                const selectedCurrencyCell = document.createElement('td');
                selectedCurrencyCell.textContent = item.selected_currency;
                row.appendChild(selectedCurrencyCell);

                const selectedAmountCell = document.createElement('td');
                selectedAmountCell.textContent = item.selected_currency_amount / 100;
                row.appendChild(selectedAmountCell);

                const targetCurrencyCell = document.createElement('td');
                targetCurrencyCell.textContent = item.target_currency;
                row.appendChild(targetCurrencyCell);

                const targetAmountCell = document.createElement('td');
                targetAmountCell.textContent = item.target_currency_amount / 100;
                row.appendChild(targetAmountCell);

                const dateCell = document.createElement('td');
                const date = new Date(item.date * 1000); // Konwersja czasu UNIX na datę
                const formattedDate = `${date.getDate().toString().padStart(2, '0')}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getFullYear()}`;
                dateCell.textContent = formattedDate;
                row.appendChild(dateCell);

                table.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Wystąpił błąd podczas pobierania danych:', error);
        });
}

function fetchListOfCurrencyForSelect() {
    fetch('/get-available-currency-codes')
        .then(response => response.json())
        .then(data => {
            const expectedCurrency = document.getElementById('expectedCurrency');
            const selectedCurrency = document.getElementById('selectedCurrency');

            data.data.forEach(currency => {
                const option = document.createElement('option');
                option.value = currency.code;
                option.textContent = currency.code;

                expectedCurrency.appendChild(option.cloneNode(true));
                selectedCurrency.appendChild(option);
            });
        })
        .catch(error => {
            console.log(error);
        });
}

function sendRequestWithNewTransaction() {

    let body = JSON.stringify({
        "selectedCurrency": document.getElementById("selectedCurrency").value,
        "selectedCurrencyAmount": document.getElementById("selectedCurrencyAmount").value * 100,
        "expectedCurrency": document.getElementById("expectedCurrency").value
    });

    fetch('/add-transaction', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: body
    }).then(response => response.json())
        .then(data => {
            createTableWithTransactions();

        })

}
const sendRequestButton = document.getElementById('sendTransaction');
sendRequestButton.addEventListener('click', () => {
    sendRequestWithNewTransaction();
});
