window.onload = function() {
    handleAddTransaction();
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('control') == 'checkDonHang') {
        console.log(username);
        if(username === 'unknown'){
            handleSearchByPhone();
        }
        else{
            handleCustomerOrder();
        }

        filterEndUserOrderStatus();
        handleAllCustomerOrder();
        renderCustomerOrderDetail();
        loadMiniForm();
        handleDeleteTransaction();
    }
    if (urlParams.get('control') == 'DetailOrder') {
        listDelete();
        renderReOrder();
    }
};

function searchTransactionsByPhone(phoneNumber) {   
    $.ajax({
        url: '../Controllers/TransactionController.php',
        method: 'POST',
        data: { action: 'findPhone', phoneNumber },
        dataType: 'JSON',
        success: data => {
            let html = '';
            // //Xử lý kết quả thành công
            if (data && data.length > 0) {
                data.forEach((item) => {
                    html+=`
                    <tr class="order-item__product-list">
                    <td class="order-item" data-transaction-id="${item.transactionID}">
                        <a href="#" class="order-link">${item.transactionID}</a>
                    </td>
                    <td>${item.FormatDate}</td>
                    <td class="order-check" data-transaction-id="${item.check}">${item.check}</td>
                    <td>${item.transport}</td>
                    <td>${item.total}</td>
                    <td class="delete-button"><img class="svg-inline" src="../View/images/delete.png" data-src="../View/images/delete.png"></td>
                    </tr>
                    `
                });      
            }       
            $('#showlist').html(html);
        },
    })
}

function handleSearchByPhone(){
    // Sử dụng hàm khi cần tìm kiếm
    $('.btn-search').on('click', function() {
        // Lấy số điện thoại từ trường nhập
        var TransactionID = $('.tra-cuu').val();

        // Kiểm tra nếu số điện thoại không rỗng
        if (TransactionID.trim() !== '') {
            // Gọi hàm searchTransactionsByPhone để tìm kiếm
            searchTransactionsByPhone(TransactionID);
        }
    }) 
}

function getOrder(id) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../Controllers/TransactionController.php',
            method: 'POST',
            data: { action: 'get', id },
            dataType: 'JSON',
            success: order => resolve(order),
            error: (xhr, status, error) => reject(error)
        })
    })
}

function getAllCustomerOrder(ma_kh) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../Controllers/TransactionController.php',
            method: 'GET',
            data: { action: 'get-all-customer-order', ma_kh },
            dataType: 'JSON',
            success: orders => resolve(orders),
            error: (xhr, status, error) => reject(error)
        })
    })
}

async function AllCustomerOrder() {
    const user = username;
    const customerId = await getUserID(user);
    const search = $('.order-filter__item.active').find('input').val();
    const orders = await getAllCustomerOrder(customerId);
    let olist = ''
    let filteredOrders = [];

    if (search === 'Chưa xác nhận') {
        filteredOrders = orders.filter(item => item.check === 'Chưa xác nhận');
    } else if (search === 'Đã xác nhận') {
        filteredOrders = orders.filter(item => item.check === 'Đã xác nhận');
    } else {
        filteredOrders = orders; // Hiển thị tất cả đơn hàng nếu không có tìm kiếm hoặc tìm kiếm không phù hợp
    }

    if (filteredOrders.length > 0) {
        filteredOrders.forEach((item) => {
            olist += `
                <tr class="order-item__product-list">
                <td class="order-item" data-transaction-id="${item.transactionID}">
                    <a href="#" class="order-link">${item.transactionID}</a>
                </td>
                <td>${item.FormatDate}</td>
                <td class="order-check" data-transaction-id="${item.check}">${item.check}</td>
                <td>${item.transport}</td>
                <td>${item.total}</td>
                <td class="delete-button"><img class="svg-inline" src="../View/images/delete.png" data-src="../View/images/delete.png"></td>
                </tr>
            ` 
        });
    } else {
        olist += `<div class="order-empty"><h3>Chưa có đơn hàng</h3><img src="server/src/assets/images/order-empty.png"></div>`
    }
    $('#showlist').html(olist);

    $('#combobox__right').html(`
        <div class="order__container">
            <div class="order-filter">
                <a class="order-filter__item ${search === '' ? 'active' : ''}">
                    <span>Tất cả</span>
                    <input type="hidden" value="" >
                </a>
                <a class="order-filter__item ${search === 'Chưa xác nhận' ? 'active' : ''}">
                    <span>Chưa xác nhận</span>
                    <input type="hidden" value="Chưa xác nhận" >
                </a>
                <a class="order-filter__item ${search === 'Đã xác nhận' ? 'active' : ''}">
                    <span>Đã xác nhận</span>
                    <input type="hidden" value="Đã xác nhận" >
                </a>
            </div>
        </div>
    `)
}

function filterEndUserOrderStatus() {  
    $(document).on('click', '.order-filter__item', function() {
        $(this).siblings().removeClass('active')
        $(this).addClass('active')
        // $("#currentpage").val(1)
        AllCustomerOrder();
    })
}

function handleAllCustomerOrder() {
    AllCustomerOrder();
    $(document).on('keyup',function() {
        var traCuuValue = $('.tra-cuu').val().trim(); // Lấy giá trị của phần tử .tra-cuu và loại bỏ các khoảng trắng

        // Kiểm tra xem giá trị của phần tử .tra-cuu có trống không
        if (traCuuValue === '') {
            AllCustomerOrder(); // Nếu trống, gọi hàm AllCustomerOrder()
        }
    });
}

function getCustomerOrder(ma_kh, search) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../Controllers/TransactionController.php',
            method: 'GET',
            data: { action: 'get-customer-order', ma_kh, search },
            dataType: 'JSON',
            success: orders => resolve(orders),
            error: (xhr, status, error) => reject(error)
        })
    })
}

async function CustomerOrder() {
    const user = username;
    //console.log(user);
    const customerId = await getUserID(user);
    console.log(customerId);
    const search = $('.tra-cuu').val();
    console.log(search);
    const orders = await getCustomerOrder(customerId, search);
    console.log(orders);
    let olist = ''

    if (orders && orders.length > 0) {
        orders.forEach((item) => {
            
            olist += `
                <tr class="order-item__product-list">
                <td class="order-item" data-transaction-id="${item.transactionID}">
                    <a href="#" class="order-link">${item.transactionID}</a>
                </td>
                <td>${item.FormatDate}</td>
                <td class="order-check" data-transaction-id="${item.check}">${item.check}</td>
                <td>${item.transport}</td>
                <td>${item.total}</td>
                <td class="delete-button"><img class="svg-inline" src="../View/images/delete.png" data-src="../View/images/delete.png"></td>
                </tr>
            `        
        });
    } else {
        olist = '<div class="order-empty"><h3>Chưa có đơn hàng</h3><img src="server/src/assets/images/order-empty.png"></div>'
    }
    $('#showlist').html(olist);
}

function handleCustomerOrder() {
    $('.btn-search').on('click', function() {
        $(this).siblings().not($(this)).removeClass('active')
        $(this).addClass('active')
        CustomerOrder()
    })
}

function renderCustomerOrderDetail() {
    $(document).on('click', '.order-link', async function() {
        try {
            const orderId = $(this).closest('tr').find('.order-item').data('transaction-id');
            //console.log(orderId);
            const order = await getOrder(orderId);
            // console.log(order);
            const orderDetails = await getOrderTransaction(orderId);
            //console.log(orderDetails);
            //const address = await getThongTinNhanHang(order.ma_ttnh)
            let html = ''

            orderDetails.forEach((orderDetail, index) => {
                console.log(orderDetail)
                html += `
                        <div class="order-details">
                            <div class="product-info">
                                <img width="80px" height="80px" src='../View/images/product/${orderDetail.productID}/${orderDetail.color}/${orderDetail.productID}.1.png'>
                                    <div>
                                        <h2>${orderDetail.name}</h2>
                                    </div>
                            </div>
                            <div class="price-info">
                                <span>x</span>
                                <span>${orderDetail.quantity}</span>
                                <span class="info-3">${orderDetail.price} đ</span>
                            </div>
                        </div>
                        <div class="total-amount">
                            <h3>Giá tổng: ${orderDetail.total_amonut}</h3>
                        </div>
                        `
                index !== orderDetails.length - 1 ? html += '<div class="line"></div>' : ''
            })

            $('#order-detail-modal').html(html);
            $('#order-detail-receive').html(`
                <div class="order-detail_address">
                    <h2>Thông tin nhận hàng</h2>
                    <div class="order-detail__address-info">
                        <div class="order-detail__address-info-item">
                            <label>Người nhận:</label>
                            <span>${order.name_receiver}</span>
                        </div>
                        <div class="order-detail__address-info-item">
                            <label>Số điện thoại:</label>
                            <span>${order.phone_receiver}</span>
                        </div>
                        <div class="order-detail__address-info-item">
                            <label>Địa chỉ:</label>
                            <span>${order.address}</span>

                        </div>
                        ${order.note ? `
                            <div class="order-detail__address-info-item">
                                <label>Ghi chú:</label>
                                <span>${order.note}</span>
                            </div>
                        ` : ''}
                    </div>
                </div>
                `)
        } catch (error) {
            console.log(error)
            alert('Có lỗi xảy ra, vui lòng thử lại sau!')
        }
    })
}

function loadMiniForm(){
    $(document).ready(function() {
        $(document).on('click', '.order-link', function(e) {
            e.preventDefault();
            var orderId = $(this).closest('tr').find('.order-item').data('transaction-id');
            // console.log(orderId);
            // var chk = checkOrderDetails(orderId);
            // console.log(chk);
            checkOrderDetails(orderId)
                .then(function(hasDetails) {
                    //console.log('Has Details:', hasDetails); // Log kết quả chi tiết đơn hàng
                    if (hasDetails) {
                        $('.order-form').show();
                        $('.overlay').show();
                    } 
                    // else {
                    //     alert('Không có chi tiết đơn hàng cho mã này.');
                    // }
                })
});
    
        $('.close-button').click(function() {
            $('.order-form').hide();
            $('.overlay').hide();
        });
        if ($('.order-form').is(':visible')) {
            $('.overlay').show(); // Hiển thị overlay
        } else {
            $('.overlay').hide(); // Ẩn overlay
        }
    });
    
}

function deleteTransaction(status,id) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../Controllers/TransactionController.php',
            method: 'POST',
            data: { action: 'delete', status, id },
            dataType: 'JSON',
            success: del => resolve(del),
            error: (xhr, status, error) => reject(error)
        })
    })
}

function handleDeleteTransaction() {
    $(document).on("click", ".delete-button", function () {
        var id = $(this).closest('tr').find('.order-item').data('transaction-id');
        var tinh_trang = $(this).closest('tr').find('.order-check').data('transaction-id');
        if(tinh_trang === 'Chưa xác nhận'){
            deleteTransaction(0,id);
            AllCustomerOrder();
        }
        else {
            alert("Không thể xoá");
        }
        
    })
}

function listDelete() {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../Controllers/TransactionController.php',
            method: 'POST',
            data: { action: 'list-delete'},
            dataType: 'JSON',
            success: data => {
                let html = ''
                if (data && data.length > 0) {
                    data.forEach((item) => {
                        html += `
                            <li class="order-item">
                                <div class="order-details">
                                    <div class="order-info">
                                        <span class="order-id" data-transaction-id="${item.transactionID}">Order #${item.transactionID}</span> - Huỷ ngày ${item.FormatDate}
                                    </div>
                                    <button class="order-restore-btn">Đặt lại</button>
                                </div>
                                <div class="order-total">Tổng tiền: ${item.total}</div>
                            </li>
                            `
                    });      
                }       
                $('#orders-list').html(html);
            },
        })
    })
}

function renderReOrder(){
    $(document).on('click', '.order-restore-btn', function() {
        var id = $(this).closest('.order-details').find('.order-id').data('transaction-id');
        console.log(id);
        deleteTransaction(1,id);
        location.reload();
        listDelete();
    })
}

function addTransaction(user, total, notes, address, fullname, phone){
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../../../Controllers/TransactionController.php',
            method: 'POST',
            data: { action: "add", user, total, notes, address, fullname, phone },
            // dataType: 'JSON',
            success: res => resolve(res),
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

function handleAddTransaction(){
    $(document).on('click', '.submit-btn', function(event) {
        event.preventDefault();

        var fullName = document.getElementById('fullname').value.trim();
        var phone = document.getElementById('phone').value.trim();
        var address = document.getElementById('address').value.trim();
        var note = document.getElementById('notes').value.trim();
        var user = username;
        console.log(fullName);
        console.log(phone);
        console.log(address);
        console.log(note);
        var total = totalPriceCart;
        console.log(total);
        var cart = cartDetails; 
        cart.forEach(function(item) {
                console.log('Product ID:', item.productID);
                console.log('Quantity:', item.quantity);
                console.log('Price:', item.price);
                console.log('Variant:', item.variantID);
            });
        if (fullName === '' || phone === '' || address === '') {
            alert('Vui lòng nhập đủ thông tin!');
            return;
        }else if (isNaN(phone) || phone.length !== 10 || phone[0] !== '0') {
            alert('Số điện thoại không hợp lệ!');
        } else {
            alert('Đặt hàng thành công!');
            addTransaction(user, total, note, address, fullName, phone);
            cart.forEach(function(item) {
                addOrderTransaction(item.productID, item.variantID, item.price, item.quantity);
                
            });
            window.location.href = "../../../Controllers/index.php";
            
        }
    });
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