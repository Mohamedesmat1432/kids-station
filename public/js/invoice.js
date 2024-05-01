function printOrderKids(id, lang) {
    let winPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    window.axios.get(`/${lang}/invoice-kids/${id}`)
        .then(function(response) {
            winPrint.document.write(response.data);
            setTimeout(() => {
                winPrint.print();
                winPrint.close();
            }, 1000);
            winPrint.focus();
        })
        .catch(function(error) {
            console.log(error);
        });
}

function printProductOrder(id, lang) {
    let winPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    window.axios.get(`/${lang}/invoice-product/${id}`)
        .then(function(response) {
            winPrint.document.write(response.data);
            setTimeout(() => {
                winPrint.print();
                winPrint.close();
            }, 1000);
            winPrint.focus();
        })
        .catch(function(error) {
            console.log(error);
        });
}
