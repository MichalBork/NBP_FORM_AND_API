document.addEventListener('DOMContentLoaded', () => {
    fetch('/get-currencies')
        .then(response => response.json())
        .then(data => {
            const table = document.getElementById('currency-table');

            data.data.forEach(currency => {
                const row = document.createElement('tr');


                const nameCell = document.createElement('td');
                nameCell.textContent = currency.name;
                row.appendChild(nameCell);

                const codeCell = document.createElement('td');
                codeCell.textContent = currency.code;
                row.appendChild(codeCell);

                const dateCell = document.createElement('td');
                const date = new Date(currency.date * 1000);
                const formattedDate = `${date.getDate().toString().padStart(2, '0')}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getFullYear()}`;
                dateCell.textContent = formattedDate;
                row.appendChild(dateCell);

                const buyCell = document.createElement('td');
                buyCell.textContent = currency.buy_value / 100;
                row.appendChild(buyCell);

                const sellCell = document.createElement('td');
                sellCell.textContent = currency.sell_value / 100;
                row.appendChild(sellCell);

                table.appendChild(row);
            });
        })
        .catch(error => {
            console.log(error);
        });
});



