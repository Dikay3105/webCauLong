function getUserID(user) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../Controllers/UserController.php',
            method: 'POST',
            data: { action: 'get', user },
            dataType: 'JSON',
            success: order => resolve(order),
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