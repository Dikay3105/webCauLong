function getOrderTransaction(id_transaction) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../Controllers/OrderTransactionController.php',
            method: 'POST',
            data: { action: 'get-cthd', id_transaction },
            dataType: 'JSON',
            success: cthd => resolve(cthd),
            error: (xhr, status, error) => reject(error)
        })
    })
}

function addOrderTransaction(proID, varID, total_amonut, quantity) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../../../Controllers/OrderTransactionController.php',
            method: 'POST',
            data: { action: 'add-order', proID, varID, total_amonut, quantity },
            dataType: 'JSON',
            success: cthd => resolve(cthd),
            error: (xhr, status, error) => reject(error)
        })
    })
}

function checkOrderDetails(id) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: '../Controllers/OrderTransactionController.php',
            method: 'POST',
            data: { action: 'check-order', id },
            dataType: 'JSON',
            success: function(response) {
                //console.log('Response from server:', response);
                if (response === 1) {
                    resolve(true);
                } else {
                    resolve(false);
                }
            },
            error: function(error) {
                reject(error);
            }
        });
    });
}