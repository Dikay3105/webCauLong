function delProductCart(cartID, productID, variantID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var string= cartID+"_"+productID+"_"+variantID;
            document.getElementById(string).remove();
            var totalprice = document.querySelectorAll('.total-price');
            var mes = parseInt(JSON.parse(this.responseText));
            totalprice.forEach(function(element) {
                element.innerHTML=Math.floor(mes).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
            });
        }
    };

    // Gửi yêu cầu AJAX đến tệp PHP để xử lý
    xhttp.open("GET", "addCart.php?productID=" + productID + "&variantID=" + variantID + "&cartID=" + cartID + "&action=delete", true);
    xhttp.send();
}

function ChangeQuantityProductCart(cartID, productID, variantID, quantity) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var totalprice = document.querySelectorAll('.total-price');
            var mes = parseInt(JSON.parse(this.responseText));
            totalprice.forEach(function(element) {
                element.innerHTML=Math.floor(mes).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
            });
            generateCart();
        }
    };

    // Gửi yêu cầu AJAX đến tệp PHP để xử lý
    xhttp.open("GET", "addCart.php?productID=" + productID + "&variantID=" + variantID + "&cartID=" + cartID + "&quantity=" + quantity + "&action=quantity", true);
    xhttp.send();
}
