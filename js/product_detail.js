const initSlider = () => {
    const imageList = document.querySelector(".slider-wrapper .image-list");
    const slideButtons = document.querySelectorAll(".slider-wrapper .slide-button");
    const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;
    const imageWidth = imageList.children[0].clientWidth; // Assuming all images have the same width
    const bigImageContainer = document.querySelector('.big-img');

    // Function to slide images
    const slideImages = (direction) => {
        const scrollAmount = imageList.clientWidth * direction;
        imageList.scrollBy({ left: scrollAmount, behavior: "smooth" });
    };

    // Slide images according to the slide button clicks
    slideButtons.forEach(button => {
        button.addEventListener("click", () => {
            const direction = button.id === "prev-slide" ? -1 : 1;
            slideImages(direction);
        });
    });

    // Show or hide slide buttons based on scroll position
    const handleSlideButtons = () => {
        slideButtons[0].style.display = imageList.scrollLeft <= 0 ? "none" : "flex";
        slideButtons[1].style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "flex";
    };

    // Call handleSlideButtons function initially
    handleSlideButtons();

    // Call handleSlideButtons function when image list scrolls
    imageList.addEventListener("scroll", handleSlideButtons);

    // Function to display the clicked image in the big-img container
    const displayBigImage = (src) => {
        const bigImage = document.createElement('img');
        bigImage.src = src;
        bigImage.id = "big-image";
        bigImage.style.maxWidth = '100%';
        bigImage.style.maxHeight = '100%';
        bigImage.style.objectFit = 'cover';
        // Clear previous big image
        bigImageContainer.innerHTML = '';
        // Append new big image
        bigImageContainer.appendChild(bigImage);
    };

    const handleClickOnImage = (event) => {
        // Remove class .img-chosen-border from all images in the slider
        imageList.querySelectorAll('.image-item').forEach(image => {
            image.classList.remove('img-chosen-border');
        });

        // Add class .img-chosen-border to the clicked image
        event.target.classList.add('img-chosen-border');

        const clickedImageSrc = event.target.src;
        displayBigImage(clickedImageSrc);
    };

    // Add event listener to images in the slider
    imageList.querySelectorAll('.image-item').forEach(image => {
        image.addEventListener('click', handleClickOnImage);
    });


    // Select the first image in the slider
    const firstImage = imageList.querySelector('.image-item');

    // Add class .img-chosen-border to the first image
    firstImage.classList.add('img-chosen-border');
};

// Call initSlider function on window resize and page load
window.addEventListener("resize", initSlider);

window.addEventListener("load", function () {
    const imageList = document.querySelector(".slider-wrapper .image-list");
    initSlider();
    document.getElementById("tab1").click();
    document.getElementById("tab1").style.display = 'block';
    // Kiểm tra nếu trình duyệt hỗ trợ GeoLocation API
    /*
    if ("geolocation" in navigator) {
        // Sử dụng GeoLocation API để lấy thông tin vị trí
        navigator.geolocation.getCurrentPosition(function (position) {
            // Lấy địa chỉ IP từ thông tin vị trí
            var ip = position.coords.latitude + ", " + position.coords.longitude;
            console.log("Địa chỉ IP của thiết bị: " + ip);
        });
    } else {
        console.log("Trình duyệt của bạn không hỗ trợ GeoLocation API.");
    } */

    var productDataElement = document.getElementById('product-data-get');
    var product = JSON.parse(productDataElement.dataset.product);
    document.getElementById("product-title").innerHTML = product.name;

});

function addCart() {
    var loginDataDiv = document.getElementById("login-data-get");
    document.getElementById('product-cart-img').src=document.getElementById('big-image').src;
    var productDataElement = document.getElementById('product-data-get');
    var product = JSON.parse(productDataElement.dataset.product);
    var quantity = document.getElementById('qtym').value;
    if (loginDataDiv) {
        var loginData = loginDataDiv.getAttribute("data-login");
        var loginObject = JSON.parse(loginData);
        if (loginObject === true) {
            var loginUserDiv = document.getElementById("product-data-user");
            var loginUser = loginUserDiv.getAttribute("data-user");

            var loginUserObject = JSON.parse(loginUser);
            var selectedVariant = null;
            var selectedColor = null;
            var ratios = document.getElementsByName("version");
            var colors = document.getElementsByName("color");

            for (var i = 0; i < ratios.length; i++) {
                if (ratios[i].checked) {
                    selectedVariant = ratios[i].value;
                    break;
                }
            }

            for (var i = 0; i < colors.length; i++) {
                if (colors[i].checked) {
                    selectedColor = colors[i].value;
                    break;
                }
            }

            if (selectedVariant == null) {
                alert("Vui lòng chọn phiên bản cần mua");
            } else {

                var xhttp = new XMLHttpRequest();

                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var totalcartproduct = document.querySelector('.count_item_pr');
                        totalcartproduct.innerHTML = JSON.parse(this.responseText);
                        var tmp = document.querySelector('.total-price');
                        var totalprice = parseInt(tmp.innerHTML.replace(/\./g, '').replace(/₫/g, ''));
                        totalprice += product.price * quantity;
                        tmp.innerHTML = formatPrice(totalprice) + "₫";
                        var catalogData = product.catalogID;
                        var inputElement = document.querySelector('input[value="' + selectedVariant + '"]');
                        if (inputElement) {
                            // Lấy id của input
                            var inputId = inputElement.id;

                            // Tạo attribute for của label tương ứng với id của input
                            var labelFor = inputId;

                            // Lấy label bằng cách sử dụng attribute for
                            var labelElement = document.querySelector('label[for="' + labelFor + '"]');

                            // Kiểm tra xem label có tồn tại không
                            if (labelElement) {
                                // Lấy nội dung của label
                                var labelText = labelElement.innerText.trim();

                            } else {
                                console.log("Không tìm thấy label tương ứng với input có giá trị là 2.");
                            }
                        } else {
                            console.log("Không tìm thấy input có giá trị là 2.");
                        }
                        if (catalogData == 1) {
                            document.getElementById("product-new-price").innerHTML = "<b>" + formatPrice(product.price) + "₫</b><span>Màu: " + selectedColor + ", Bản: " + labelText + "</span>";
                        } else if (catalogData == 4) {
                            document.getElementById("product-new-price").innerHTML = "<b>" + formatPrice(product.price) + "₫</b><span>Màu: " + selectedColor + ", Size: " + labelText + "</span>";
                        } else if (catalogData == 3) {
                            document.getElementById("product-new-price").innerHTML = "<b>" + formatPrice(product.price) + "₫</b><span>Tốc độ: " + labelText + "</span>";
                        } else if (catalogData == 2) {
                            document.getElementById("product-new-price").innerHTML = "<b>" + formatPrice(product.price) + "₫</b><span>Màu: " + labelText + "</span>";
                        }
                        document.getElementById('popup-cart-mobile').classList.add('active');
                        document.getElementById('full-cover').style.opacity = "0.5";
                        document.getElementById('full-cover').style.pointerEvents = "none";
                        generateCart();
                    }
                };

                // Gửi yêu cầu AJAX đến tệp PHP để xử lý
                xhttp.open("GET", "addCart.php?productID=" + product.productID + "&variantID=" + selectedVariant + "&quantity=" + quantity + "&username=" + loginUserObject + "&price=" + product.price * quantity, true);
                xhttp.send();
            }
        } else {
            alert("Cần đăng nhập để thêm vào giỏ hàng");
        }
    }
}

function removeActiveTab() {
    var tab = document.getElementById("popup-cart-mobile");

    if (tab) {
        tab.classList.remove("active");
        document.getElementById('full-cover').style.pointerEvents = "auto";
        document.getElementById('full-cover').style.opacity = "1";

    }
    location.reload();
}

function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Function to load version by color using AJAX
function loadVersion(productID, color) {
    var xhttp = new XMLHttpRequest();
    var imagePaths = JSON.parse(document.getElementById("image-list-data").dataset.array);
    var productDataElement = document.getElementById('product-data-get');
    var product = JSON.parse(productDataElement.dataset.product);
    const imageList = document.querySelector(".slider-wrapper .image-list");
    imagePaths = imagePaths[color.toLowerCase()];

    const bigImageContainer = document.querySelector('.big-img');
    const bigImage = document.createElement('img');
    linktmp = "images/product/" + productID + "/" + color + "/" + productID + ".1.png";
    getPromiseUrl(linktmp).then(url => {
        displayBigImage(url);
    }).catch(error => {
        return error;
    });
   
    const container = document.getElementById("image-list");
    container.innerHTML = '';

    const displayBigImage = (src) => {
        const bigImage = document.createElement('img');
        bigImage.src = src;
        bigImage.id = "big-image";
        bigImage.style.maxWidth = '100%';
        bigImage.style.maxHeight = '100%';
        bigImage.style.objectFit = 'cover';
        // Clear previous big image
        bigImageContainer.innerHTML = '';
        // Append new big image
        bigImageContainer.appendChild(bigImage);
    };

    // Lặp qua mỗi đường dẫn hình ảnh và chèn chúng vào danh sách
    for (var i = 0; i < imagePaths.length; i++) {
        // Tạo một thẻ img và đặt thuộc tính src và alt
        const image = document.createElement('img');
        var link = "images/product/" + productID + "/" + color.trim() + "/" + productID + "." + imagePaths[i] + ".png";
        getPromiseUrl(link).then(url => {
            image.src = url;
        }).catch(error => {
            return error;
        });
        image.alt = `Image ` + i + 1; // Tùy chỉnh alt nếu cần
        image.classList.add('image-item');
        // Kiểm tra xem danh sách có tồn tại không trước khi chèn hình vào
        if (container) {
            container.appendChild(image);
        } else {
            console.error(`UL with id 'image-list' not found.`);
        }
    }
    imageList.scrollLeft = 0;

    const handleClickOnImage = (event) => {
        // Remove class .img-chosen-border from all images in the slider
        imageList.querySelectorAll('.image-item').forEach(image => {
            image.classList.remove('img-chosen-border');
        });

        // Add class .img-chosen-border to the clicked image
        event.target.classList.add('img-chosen-border');

        const clickedImageSrc = event.target.src;
        displayBigImage(clickedImageSrc);
    };

    // Add event listener to images in the slider
    imageList.querySelectorAll('.image-item').forEach(image => {
        image.addEventListener('click', handleClickOnImage);
    });


    // Select the first image in the slider
    const firstImage = imageList.querySelector('.image-item');

    // Add class .img-chosen-border to the first image
    firstImage.classList.add('img-chosen-border');


    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var listVariantDetails = JSON.parse(this.responseText);
            var existingVersion = document.getElementById('version');
            if (existingVersion !== null) {
                existingVersion.parentNode.removeChild(existingVersion);
            }
            var htmlContent = '<div class="select-swatch"><div class="swatch clearfix"><div class="header">Chọn phiên bản: </div>';
            for (var i = 0; i < listVariantDetails.length; i++) {
                if (listVariantDetails[i].color == color) {
                    if (listVariantDetails[i].quantity >= 1) {
                        // Thêm mã HTML cho phần tử mới vào chuỗi htmlContent
                        htmlContent += '<div class="swatch-element version-' + listVariantDetails[i].weight + listVariantDetails[i].grip + '" data-value="1" data-value_2="1">' +
                            '<input id="version-' + listVariantDetails[i].weight + listVariantDetails[i].grip + '" type="radio" name="version" value="' + listVariantDetails[i].variantID + '">' +
                            '<label for="version-' + listVariantDetails[i].weight + listVariantDetails[i].grip + '">' +
                            listVariantDetails[i].weight + listVariantDetails[i].grip +
                            '<img class="crossed-out" src="https://cdn.shopvnb.com/themes/images/soldout.png" alt="' + listVariantDetails[i].weight + listVariantDetails[i].grip + '">' +
                            '</label>' +
                            '</div>';
                    } else if (listVariantDetails[i].quantity <= 0) {
                        htmlContent += '<div class="swatch-element soldout version-' + listVariantDetails[i].weight + listVariantDetails[i].grip + '" data-value="1" data-value_2="1">' +
                            '<input disabled id="version-' + listVariantDetails[i].weight + listVariantDetails[i].grip + '" type="radio" name="version" value="' + listVariantDetails[i].variantID + '">' +
                            '<label for="version-' + listVariantDetails[i].weight + listVariantDetails[i].grip + '">' +
                            listVariantDetails[i].weight + listVariantDetails[i].grip +
                            '<img class="crossed-out" src="https://cdn.shopvnb.com/themes/images/soldout.png" alt="' + listVariantDetails[i].weight + listVariantDetails[i].grip + '">' +
                            '</label>' +
                            '</div>';
                    }
                }
            }
            htmlContent += '</div></div>';
            // Thêm chuỗi HTML vào phần tử có id là "hidden"
            document.getElementById("hidden").innerHTML = htmlContent;
        }
    };

    // Gửi yêu cầu AJAX đến tệp PHP để xử lý
    xhttp.open("GET", "ProductDetailController.php?productID=" + productID + "&color=" + color + "&type=racket", true);
    xhttp.send();
}

function loadSize(productID, color) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var listVariantDetails = JSON.parse(this.responseText);
            var existingVersion = document.getElementById('version');
            if (existingVersion !== null) {
                // Nếu phần tử đã tồn tại, có thể xóa nếu cần
                existingVersion.parentNode.removeChild(existingVersion);
            }
            var htmlContent = '<div class="select-swatch"><div class="swatch clearfix"><div class="header">Chọn size: </div>';
            //console.log(listVariantDetails);
            for (var i = 0; i < listVariantDetails.length; i++) {
                if (listVariantDetails[i].color == color) {
                    if (listVariantDetails[i].quantity >= 1) {
                        // Thêm mã HTML cho phần tử mới vào chuỗi htmlContent
                        htmlContent += '<div class="swatch-element version-' + listVariantDetails[i].size + '" data-value="1" data-value_2="1">' +
                            '<input id="version-' + listVariantDetails[i].size + '" type="radio" name="version" value="' + listVariantDetails[i].variantID + '">' +
                            '<label for="version-' + listVariantDetails[i].size + '">' +
                            listVariantDetails[i].size +
                            '<img class="crossed-out" src="https://cdn.shopvnb.com/themes/images/soldout.png" alt="' + listVariantDetails[i].size + '">' +
                            '</label>' +
                            '</div>';
                    } else if (listVariantDetails[i].quantity <= 0) {
                        htmlContent += '<div class="swatch-element soldout version-' + listVariantDetails[i].size + '" data-value="1" data-value_2="1">' +
                            '<input disabled id="version-' + listVariantDetails[i].size + '" type="radio" name="version" value="' + listVariantDetails[i].variantID + '">' +
                            '<label for="version-' + listVariantDetails[i].size + '">' +
                            listVariantDetails[i].size +
                            '<img class="crossed-out" src="https://cdn.shopvnb.com/themes/images/soldout.png" alt="' + listVariantDetails[i].size + '">' +
                            '</label>' +
                            '</div>';
                    }
                }
            }
            htmlContent += '</div></div>';
            // Thêm chuỗi HTML vào phần tử có id là "hidden"
            document.getElementById("hidden").innerHTML = htmlContent;
        }
    };

    // Gửi yêu cầu AJAX đến tệp PHP để xử lý
    xhttp.open("GET", "ProductDetailController.php?productID=" + productID + "&color=" + color + "&type=shoes", true);
    xhttp.send();
}




// Lấy tất cả các nút tab
const tabButtons = document.querySelectorAll('.tab-button');

// Lặp qua từng nút tab và thêm sự kiện click
tabButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Lấy id của tab được nhấn
        const tabId = button.getAttribute('data-tab');

        // Lấy tất cả các nội dung tab
        const tabContents = document.querySelectorAll('.tab-content');

        // Ẩn tất cả các tab content và loại bỏ class "active" khỏi các nút tab
        tabContents.forEach(content => {
            content.style.display = 'none';
        });
        tabButtons.forEach(tabButton => {
            tabButton.classList.remove('active');
        });

        // Hiển thị tab content tương ứng với tab được nhấn và thêm class "active" cho nút tab đó
        const selectedTabContent = document.getElementById(tabId);
        if (selectedTabContent) {
            selectedTabContent.style.display = 'block';
            button.classList.add('active');
        }
    });
});


