<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm mã đơn hàng</title>
    <script> var username = "<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'unknown'; ?>"; </script>
    <style>
      .combobox__right {
        background-color: #fff;
      }

      .order__container {
        background-color: white;
        padding-right: 15px;
      }

      .order-filter {
        background-color: #fff;
        border-top-left-radius: 2px;
        border-top-right-radius: 2px;
        display: flex;
        margin-bottom: 12px;
        overflow: hidden;
      }

      .order-filter__item {
        align-items: center;
        background: #fff;
        border-bottom: 2px solid rgba(0, 0, 0, .09);
        color: rgba(0, 0, 0, .8);
        cursor: pointer;
        display: flex;
        flex: 1;
        font-size: 16px;
        justify-content: center;
        line-height: 19px;
        overflow: hidden;
        padding: 16px 0;
        text-align: center;
        transition: color .2s;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      .order-filter__item.active {
        border-color: var(--primary-color);
        color: var(--primary-color);
      }

      .order-filter__item span {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }

      .order-container1 { 
        width: 1200px;
        max-width: 1500px; 
        margin: 20px auto; 
        background: white; 
        border-radius: 8px; 
        box-shadow: 0 4px 6px rgba(0,0,0,0.1); 
        padding: 20px; 
        background: linear-gradient(to right, #ff7e5f, #feb47b);
      }

      .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); 
        z-index: 9998; 
      }
    
    .header { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 20px; 
        padding-bottom: 10px;
        border-bottom: 1px solid black;
    }

    .close-button { 
        background: none; 
        border: none; 
        font-size: 24px; 
        cursor: pointer; 
    } 

    .order-details {
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
    } 

    .product-info { 
        display: flex;
        align-items: center; 
    } 

    .product-info img { 
        margin-right: 15px; 
    } 

    .price-info { 
        width: 200px;
        font-size: 18px;
        font-weight: bold; 
    } 

    .price-info .info-3 { 
        margin-left: 40px; 
    } 

    .total-amount { 
        padding-left: 80%;
        text-align: left; 
        margin-top: 10px; 
        margin-bottom: 25px; 
    }

    .order-form {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        display: none;
    }

    .svg-inline{
        width: 25px;
        height: 25px;
        margin-top: -5px;
        margin-right: 2px;
    }

    .svg-inline2{
        width: 35px;
        height: 35px;
        margin-top: -5px;
        margin-right: 2px;
    }

    .order-item{
      text-align: center;
    }

    .order-detail_address{
      padding-left: 20px;
      padding-top: 20px;
      border-top: 1px solid black;
    }

    .order-detail__address-info{
      font-size: 20px;
    }

    .order-detail__address-info-item{
      color: #00008b;
    }

    </style>
</head>
<body>
<section class="layout-info-find">
    <div class="container">
        <main>
        <div class="col-xs-12">
            <h1>Kiểm tra trạng thái đơn hàng</h1>
            <a class="logout" href="index.php?control=DetailOrder">
                <span class="fa fa-sign-out"></span>
                "Đã huỷ"
            </a>
        </div>
        <form>
            <label class="custom1" for="tra-cuu">Mã đơn hàng/Số điện thoại*</label><br>
            <input type="text" class="tra-cuu" name="tra-cuu" placeholder="Nhập vào đây"><br>
            <button class="btn-search" type="button">Tra cứu đơn hàng</button>
        </form>
        <div id="combobox__right"></div>
        <div class="col-md-8 col-xs-12">
            <div class="userbox">
                <table class="table table-striped table-hover">
                <thead>
                    <tr style="background-color: orange;">
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái thanh toán</th>
                    <th>Trạng thái vận chuyển</th>
                    <th>Tổng tiền</th>
                    
                    </tr>
                </thead>
                <tbody id="showlist">
                    
                </tbody>
            </table>

            </div>
         </div>
        </main>
    </div>
</section>

<div class="overlay" id="overlay"></div>
<form class="order-form" id="orderForm">
<div class="order-container1">
    <div class="header">
        <h1>Đặt hàng thành công</h1>
        <div class="close-button"><img class="svg-inline2" src="../View/images/x-button.png" data-src="../View/images/x-button.png"></div>
    </div>
    <div id="order-detail-modal"></div>
    <div id="order-detail-receive"></div>
</div>
</form>

</body>
</html>

<script>
</script>
