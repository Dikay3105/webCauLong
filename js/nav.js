countFilter = 0;
var filterArray = [];
var filterImgArray = [];
var fullArray = [];
selectedFilters = {};

window.addEventListener("load", function () {
    uncheckAllInputs();
    if(getBrandIdFromUrl()!=null) {
        disableInputsByGroup("Hãng");
        document.getElementById("filter-th-"+getBrandIdFromUrl()).checked=true;
    }
    if(getSearchFromUrl() != null) {
        loadSearch();
    } else {
        // Lấy id từ đường dẫn URL
        var id = getIdFromUrl();
        // Gọi loadPage và loadNav với id và số 6
        loadNav(8, id, getBrandIdFromUrl());
        loadPage(1, 8, id, getBrandIdFromUrl());
    }
    if (countFilter == 0) {
        document.getElementById("filter-container").classList.add("hide");
    }
    getAllByCatalogAndBrand();
    console.log(filterArray);
});

async function createImageArray(listVariantDetails) {
    var imageArray = [];

    var promises = listVariantDetails.map(async (variant) => {
        var inputString = variant.url;
        var darkNavyRegex = /^[^:]+/;
        var match = inputString.match(darkNavyRegex);
        var linktmp = "images/product/" + variant.productID + "/" + match + "/" + variant.productID + ".1.png";
        
        try {
            var url = await getPromiseUrl(linktmp);
            imageArray.push({ productID: variant.productID, imageUrl: url });
        } catch (error) {
            console.error('Error getting file URL:', error);
        }
    });

    await Promise.all(promises);
    return imageArray;
}



function uncheckAllInputs() {
    // Lấy tất cả các phần tử input trên trang
    var inputs = document.querySelectorAll('input[type="checkbox"]');

    // Lặp qua mỗi phần tử và bỏ chọn (unchecked) nó
    inputs.forEach(function (input) {
        input.checked = false;
    });
}

function disableInputsByGroup(groupName) {
    // Lấy tất cả các phần tử input trên trang
    var inputs = document.querySelectorAll('input[type="checkbox"][data-group="' + groupName + '"]');

    // Lặp qua mỗi phần tử và vô hiệu hóa (disable) nó
    inputs.forEach(function(input) {
        input.disabled = true;
    });
}


function getAllByCatalogAndBrand() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    var listVariantDetails = JSON.parse(this.responseText);
                    filterArray = listVariantDetails;
                    filterImgArray = createImageArray(filterArray);
                    fullArray = listVariantDetails;
                } else {
                    reject(new Error("Yêu cầu thất bại"));
                }
            }
        };
        if (getBrandIdFromUrl() != null)
            xhttp.open("GET", "ProductNavController.php?getAll=true&id=" + getIdFromUrl() + "&brandID=" + getBrandIdFromUrl(), true);
        else
            xhttp.open("GET", "ProductNavController.php?getAll=true&id=" + getIdFromUrl(), true);
        xhttp.send();
}

function loadSearch() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var listVariantDetails = JSON.parse(this.responseText);
                filterArray = listVariantDetails;
                filterImgArray = createImageArray(filterArray);
                loadNavFilter();
                loadPageFilter(1,8);
                document.getElementById("page-config").innerHTML = '<label for="mySelect">Item per page: </label>' +
                            '<select name="mySelect" id="mySelect" onchange="loadPerPageFilter()">' +
                            '<option value="4">4</option>' +
                            '<option value="8" selected>8</option>' +
                            '<option value="12">12</option>' +
                            '<option value="16">16</option>' +
                            '</select>';
            } else {
                reject(new Error("Yêu cầu thất bại"));
            }
        }
    };
    xhttp.open("GET", "ProductNavController.php?getAllProduct=true&search="+getSearchFromUrl(), true);
    xhttp.send();
}

async function loadPage(page, productsPerPage, id, brandID) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = async function () {
        if (this.readyState == 4 && this.status == 200) {
            var listVariantDetails = JSON.parse(this.responseText);

            // Tạo mảng lưu đường dẫn ảnh và productID
            if(filterImgArray && filterImgArray.length>0) {

            } else {
                var filterImgArray = await createImageArray(listVariantDetails);
            }
                
            var htmlContent = '';
            listVariantDetails.forEach((variant) => {
                var productImage = filterImgArray.find(item => item.productID === variant.productID);
                htmlContent += `<div class="col-6 col-md-3">
                    <div class="item_product_main">
                        <div class="product-thumbnail">
                            <a class="product_overlay" href="index.php?control=ProductDetail&productID=` + variant.productID + `" title="` + variant.name + `"></a>
                            <a class="image_thumb" href="index.php?control=ProductDetail&productID=` + variant.productID + `" title="` + variant.name + `">
                                <img width="300" height="300" class="lazyload loaded" src="` + (productImage ? productImage.imageUrl : '') + `" data-src="" alt="Vợt Cầu Lông Victor Brave Sword LTD Pro (Nội Địa Taiwan)" data-was-processed="true">
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name"><a href="index.php?control=ProductDetail&productID=` + variant.productID + `" title="` + variant.name + `">` + variant.name + `</a></h3>
                            <div class="price-box-nav">
                                <span class="price">` + formatPrice(variant.price) + ` ₫</span>
                            </div>
                        </div>
                    </div>
                </div>`;
            });

            document.getElementById("show-product").innerHTML = htmlContent;

            // Xóa class 'active' và 'current-page' khỏi tất cả các thẻ li
            var liElements = document.querySelectorAll('.number-page li');
            liElements.forEach(function (li) {
                li.classList.remove('active', 'current-page');
            });

            // Thêm class 'active' và 'current-page' vào thẻ li được click
            var currentLi = document.querySelector('.number-page li:nth-child(' + page + ')');
            currentLi.classList.add('active', 'current-page');
        }
    };

    var url = "ProductNavController.php?page=" + parseInt(page) + "&productsPerPage=" + parseInt(productsPerPage) + "&id=" + parseInt(id);
    if (brandID != null) {
        url += "&brandID=" + parseInt(brandID);
    }
    xhttp.open("GET", url, true);
    xhttp.send();
}


async function loadPageFilter(page, productsPerPage) {
    var offset = (page - 1) * productsPerPage;
    var productsOnCurrentPage = filterArray.slice(offset, offset + productsPerPage); // Sử dụng mảng filterArray đã được sắp xếp

    if(filterImgArray && filterImgArray.length>0) {

            } else {
                var filterImgArray = await createImageArray(productsOnCurrentPage);
            }

    var htmlContent = '';
    productsOnCurrentPage.forEach((variant) => {
        var productImage = filterImgArray.find(item => item.productID === variant.productID);
        htmlContent += `<div class="col-6 col-md-3">
            <div class="item_product_main">
                <div class="product-thumbnail">
                    <a class="product_overlay" href="index.php?control=ProductDetail&productID=` + variant.productID + `" title="` + variant.name + `"></a>
                    <a class="image_thumb" href="index.php?control=ProductDetail&productID=` + variant.productID + `" title="` + variant.name + `">
                        <img width="300" height="300" class="lazyload loaded" src="` + (productImage ? productImage.imageUrl : '') + `" data-src="" alt="Vợt Cầu Lông Victor Brave Sword LTD Pro (Nội Địa Taiwan)" data-was-processed="true">
                    </a>
                </div>
                <div class="product-info">
                    <h3 class="product-name"><a href="index.php?control=ProductDetail&productID=` + variant.productID + `" title="` + variant.name + `">` + variant.name + `</a></h3>
                    <div class="price-box-nav">
                        <span class="price">` + formatPrice(variant.price) + ` ₫</span>
                    </div>
                </div>
            </div>
        </div>`;
    });

    document.getElementById("show-product").innerHTML = htmlContent;

    // Xóa class 'active' và 'current-page' khỏi tất cả các thẻ li
    var liElements = document.querySelectorAll('.number-page li');
    liElements.forEach(function (li) {
        li.classList.remove('active', 'current-page');
    });

    // Thêm class 'active' và 'current-page' vào thẻ li được click
    var currentLi = document.querySelector('.number-page li:nth-child(' + page + ')');
    currentLi.classList.add('active', 'current-page');
}



function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function loadNavFilter() {
    var totalPages = Math.ceil(filterArray.length / getProductPerPage());
    //console.log(filterArray.length);
    var htmlContent = '';

    for (var i = 1; i <= totalPages; i++) {
        if (i == 1) {
            htmlContent += '<li onclick="loadPageFilter(' + i + ', ' + getProductPerPage() + ')" class="current-page active" data-page="' + i + '" data-products-per-page="' + getProductPerPage() + '">';
            htmlContent += '<a>' + i + '</a>';
            htmlContent += '</li>';
        } else {
            htmlContent += '<li onclick="loadPageFilter(' + i + ', ' + getProductPerPage() + ')" data-page="' + i + '" data-products-per-page="' + getProductPerPage() + '">';
            htmlContent += '<a>' + i + '</a>';
            htmlContent += '</li>';
        }
    }

    document.getElementById("number-page").innerHTML = htmlContent;
}


function loadNav(productsPerPage, id, brandID) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var totalPages = parseInt(this.responseText.trim()); // Trim whitespace before parsing
            var htmlContent = '';

            for (var i = 1; i <= totalPages; i++) {
                if (i == 1) {
                    htmlContent += '<li onclick="loadPage(' + i + ', ' + productsPerPage + ', ' + id + ', ' + brandID + ')" class="current-page active" data-page="' + i + '" data-products-per-page="' + productsPerPage + '">';
                    htmlContent += '<a>' + i + '</a>';
                    htmlContent += '</li>';
                } else {
                    htmlContent += '<li onclick="loadPage(' + i + ', ' + productsPerPage + ', ' + id + ', ' + brandID + ')" data-page="' + i + '" data-products-per-page="' + productsPerPage + '">';
                    htmlContent += '<a>' + i + '</a>';
                    htmlContent += '</li>';
                }
            }

            document.getElementById("number-page").innerHTML = htmlContent;
        }
    };

    if (brandID == null)
        xhttp.open("GET", "ProductNavController.php?id=" + id + "&productsPerPage=" + productsPerPage, true);
    else
        xhttp.open("GET", "ProductNavController.php?id=" + id + "&productsPerPage=" + productsPerPage + "&brandID=" + brandID, true);
    xhttp.send();
}



function loadPerPage() {
    var id = getIdFromUrl();

    loadPage(1, getProductPerPage(), id, getBrandIdFromUrl());
    loadNav(getProductPerPage(), id, getBrandIdFromUrl());
}

function loadPerPageFilter() {
    loadPageFilter(1, getProductPerPage());
    loadNavFilter();
}

function getProductPerPage() {
    var productsPerPage = document.getElementById("mySelect").value;
    return productsPerPage;
}



function getBrandIdFromUrl() {
    // Lấy đường dẫn URL hiện tại
    var url = window.location.href;

    // Phân tích đường dẫn URL để lấy tham số id
    var urlParams = new URLSearchParams(new URL(url).search);
    var id = urlParams.get('brandID');

    return id;
}

function getIdFromUrl() {
    // Lấy đường dẫn URL hiện tại
    var url = window.location.href;

    // Phân tích đường dẫn URL để lấy tham số id
    var urlParams = new URLSearchParams(new URL(url).search);
    var id = urlParams.get('id');

    return id;
}

function getSearchFromUrl() {
    // Lấy đường dẫn URL hiện tại
    var url = window.location.href;

    // Phân tích đường dẫn URL để lấy tham số id
    var urlParams = new URLSearchParams(new URL(url).search);
    var id = urlParams.get('search');

    return id;
}


function toggleFilter(checkbox) {
    var filterId = checkbox.id;
    var filterItem = document.getElementById("filter-item-" + filterId);

    if (checkbox.checked) {
        countFilter += 1;
        var dataText = checkbox.dataset.text;

        // Tạo một phần tử mới nếu nó chưa tồn tại
        if (!filterItem) {
            filterItem = document.createElement("li");
            filterItem.id = "filter-item-" + filterId;
            filterItem.classList.add("filter-container__selected-filter-item");
            filterItem.innerHTML = `
                <a href="javascript:void(0)" onclick="removeFilteredItem('${filterId}')">
                    <i class="fa fa-close"></i>
                    ${dataText}
                </a>
            `;
            document.getElementById("filter").appendChild(filterItem);
        }

        document.getElementById("filter-container").classList.remove("hide");

    } else {
        if (filterItem) {
            countFilter -= 1;
            document.getElementById("filter").removeChild(filterItem);
        }

        if (countFilter == 0) {
            document.getElementById("filter-container").classList.add("hide");
        }
    }
}

function removeFilteredItem(id) {
    console.log(selectedFilters.thuong_hieu);

    var filterItem = document.getElementById("filter-item-" + id);
    var filterItem2 = document.getElementById(id);

    // Nếu phần tử tồn tại, loại bỏ nó
    if (filterItem) {
        filterItem.parentNode.removeChild(filterItem);
        filterItem2.checked = false;
        countFilter -= 1;
        var event = new Event('change');
        filterItem2.dispatchEvent(event);

        // Cập nhật trạng thái của filter-container
        if (countFilter == 0) {
            document.getElementById("filter-container").classList.add("hide");
        } else {
            document.getElementById("filter-container").classList.remove("hide");
        }

    }
}

function clearAllFiltered() {
    var filterContainer = document.getElementById("filter");
    filterContainer.innerHTML = "";

    var checkboxes = document.querySelectorAll("input[type='checkbox']");
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = false;
    });

    var filterContainerElement = document.getElementById("filter-container");
    filterContainerElement.classList.add("hide");

    var keysort = document.getElementById('keysort').innerText;
    filterArray = fullArray;
    if (keysort != "Mặc định") {
        //filterArray = fullArray;
        if (keysort == "A → Z")
            sortby('alpha-asc');
        else if (keysort == "Z → A")
            sortby('alpha-desc');
        else if (keysort == "Giá tăng dần")
            sortby('price-asc');
        else if (keysort == "Giá giảm dần")
            sortby('price-desc');
        else if (keysort == "Hàng mới nhất")
            sortby('created-asc');
        else if (keysort == "Hàng cũ nhất")
            sortby('created-desc');
    } else {
        if(getSearchFromUrl()!=null) {
            loadNavFilter();
            loadPageFilter(1,getProductPerPage());
        } else {
            loadNav(getProductPerPage(), getIdFromUrl());
            loadPage(1, getProductPerPage(), getIdFromUrl(), getBrandIdFromUrl());
        }
        
    }
    
}

function formatTime(timeString) {
    const parts = timeString.split(' ');
    const dateParts = parts[0].split('-');
    const timeParts = parts[1].split(':');
    return `${dateParts[0]}/${dateParts[1]}/${dateParts[2]} ${timeParts[0]}:${timeParts[1]}:${timeParts[2]}`;
}


function sapXep(arr, key) {
    if (key === 'alpha-asc') {
        return arr.sort(function (a, b) {
            return a.name.localeCompare(b.name);
        });
    } else if (key === 'alpha-desc') {
        return arr.sort(function (a, b) {
            return b.name.localeCompare(a.name);
        });
    } else if (key === 'price-asc') {
        return arr.sort(function (a, b) {
            return a.price - b.price;
        });
    } else if (key === 'price-desc') {
        return arr.sort(function (a, b) {
            return b.price - a.price;
        });
    } else if (key === 'created-desc') {
        return arr.sort(function (a, b) {
            return new Date(formatTime(b.timeCreated)) - new Date(formatTime(a.timeCreated));
        });
    } else if (key === 'created-asc') {
        return arr.sort(function (a, b) {
            return new Date(formatTime(a.timeCreated)) - new Date(formatTime(b.timeCreated));
        });
    }
    return arr;
}



function sortby(key) {
    if (filterArray.length <= 0) {
        getAllByCatalogAndBrand();
    }
    filterArray = sapXep(filterArray, key); // Cập nhật filterArray với mảng đã sắp xếp

    loadNavFilter();
    loadPageFilter(1, getProductPerPage()); // Gọi hàm loadPageFilter với mảng đã sắp xếp

    var desiredValue = getProductPerPage();

    document.getElementById("page-config").innerHTML = '<label for="mySelect">Item per page: </label>' +
        '<select name="mySelect" id="mySelect" onchange="loadPerPageFilter()">' +
        '<option value="4">4</option>' +
        '<option value="8" selected>8</option>' +
        '<option value="12">12</option>' +
        '<option value="16">16</option>' +
        '</select>';
    var selectElement = document.getElementById("mySelect");
    var options = selectElement.options;

    for (var i = 0; i < options.length; i++) {
        if (options[i].value == desiredValue) {
            options[i].selected = true;
            break;
        }
    }
    if (key == 'alpha-asc') {
        document.getElementById('keysort').innerHTML = 'A → Z';
    } else if (key == 'alpha-desc') {
        document.getElementById('keysort').innerHTML = 'Z → A';
    } else if (key == 'price-asc') {
        document.getElementById('keysort').innerHTML = 'Giá tăng dần';
    } else if (key == 'price-desc') {
        document.getElementById('keysort').innerHTML = 'Giá giảm dần';
    } else if (key == 'created-desc') {
        document.getElementById('keysort').innerHTML = 'Hàng mới nhất';
    } else if (key == 'created-asc') {
        document.getElementById('keysort').innerHTML = 'Hàng cũ nhất';
    }
}




$(document).ready(function () {
    // Khởi tạo một object để lưu trữ các giá trị của các nhóm filter


    // Xử lý sự kiện khi các input checkbox thay đổi trạng thái
    $("input[type='checkbox']").change(function () {
        // Lấy data-group của checkbox được chọn
        var checkedCount = 0;
        var group = $(this).data('field');
        // Lấy giá trị của checkbox
        var value = $(this).val();

        $("input[type='checkbox']").each(function () {
            if ($(this).prop("checked")) {
                checkedCount++;
            }
        });
        // Kiểm tra nếu group đã tồn tại trong selectedFilters
        if (selectedFilters[group] === undefined) {
            // Nếu chưa tồn tại, tạo một mảng mới
            selectedFilters[group] = [];
        }
        // Nếu checkbox được chọn, thêm giá trị vào mảng của group tương ứng
        if ($(this).prop("checked")) {
            selectedFilters[group].push(value);
        } else {
            // Nếu checkbox được bỏ chọn, loại bỏ giá trị khỏi mảng của group tương ứng
            var index = selectedFilters[group].indexOf(value);
            if (index !== -1) {
                selectedFilters[group].splice(index, 1);
            }
        }

        

        if(getBrandIdFromUrl()!=null) checkedCount-=1;
        console.log(selectedFilters);
        if (checkedCount > 0) {
            if (getBrandIdFromUrl() != null) {
                var requestData = {
                    selectedFilters,
                    filter: true,
                    productsPerPage: getProductPerPage(),
                    id: getIdFromUrl(),
                    brandID: getBrandIdFromUrl()
                };
            } else {
                var requestData = {
                    selectedFilters,
                    filter: true,
                    productsPerPage: getProductPerPage(),
                    id: getIdFromUrl()
                };
            }

            // Gửi yêu cầu lọc đến máy chủ bằng AJAX
            $.ajax({
                url: "ProductNavController.php", // Đường dẫn tới file xử lý yêu cầu lọc trên máy chủ
                type: "GET",
                data: requestData, // Truyền object chứa thông tin các bộ lọc đã chọn
                success: function (response) {
                    var keysort = document.getElementById('keysort').innerText;
                    filterArray = JSON.parse(response);
                    if (keysort != "Mặc định") {
                        if (keysort == "A → Z")
                            sortby('alpha-asc');
                        else if (keysort == "Z → A")
                            sortby('alpha-desc');
                        else if (keysort == "Giá tăng dần")
                            sortby('price-asc');
                        else if (keysort == "Giá giảm dần")
                            sortby('price-desc');
                        else if (keysort == "Hàng mới nhất")
                            sortby('created-asc');
                        else if (keysort == "Hàng cũ nhất")
                            sortby('created-desc');

                    } else {
                        var totalPages = Math.ceil(filterArray.length / getProductPerPage());
                        var htmlContent = '';

                        for (var i = 1; i <= totalPages; i++) {
                            if (i == 1) {
                                htmlContent += '<li onclick="loadPageFilter(' + i + ', ' + getProductPerPage() + ')" class="current-page active" data-page="' + i + '" data-products-per-page="' + getProductPerPage() + '">';
                                htmlContent += '<a>' + i + '</a>';
                                htmlContent += '</li>';
                            } else {
                                htmlContent += '<li onclick="loadPageFilter(' + i + ', ' + getProductPerPage() + ')" data-page="' + i + '" data-products-per-page="' + getProductPerPage() + '">';
                                htmlContent += '<a>' + i + '</a>';
                                htmlContent += '</li>';
                            }
                        }

                        document.getElementById("number-page").innerHTML = htmlContent;

                        //--------------------------//
                        loadPageFilter(1, getProductPerPage());

                        //--------------------------//
                        var desiredValue = getProductPerPage();
                        document.getElementById("page-config").innerHTML = '<label for="mySelect">Item per page: </label>' +
                            '<select name="mySelect" id="mySelect" onchange="loadPerPageFilter()">' +
                            '<option value="4">4</option>' +
                            '<option value="8">8</option>' +
                            '<option value="12">12</option>' +
                            '<option value="16">16</option>' +
                            '</select>';

                        
                        var selectElement = document.getElementById("mySelect");
                        var options = selectElement.options;

                        for (var i = 0; i < options.length; i++) {
                            if (options[i].value == desiredValue) {
                                options[i].selected = true;
                                break;
                            }
                        }
                    }
                }
            });
        } else {
            var keysort = document.getElementById('keysort').innerText;
            filterArray = fullArray;

            if (keysort != "Mặc định") {
                if (keysort == "A → Z")
                    sortby('alpha-asc');
                else if (keysort == "Z → A")
                    sortby('alpha-desc');
                else if (keysort == "Giá tăng dần")
                    sortby('price-asc');
                else if (keysort == "Giá giảm dần")
                    sortby('price-desc');
                else if (keysort == "Hàng mới nhất")
                    sortby('created-asc');
                else if (keysort == "Hàng cũ nhất")
                    sortby('created-desc');
            } else {
                // Lấy id từ đường dẫn URL
                var id = getIdFromUrl();
                // Gọi loadPage và loadNav với id và số 6
                loadNav(8, id, getBrandIdFromUrl());
                loadPage(1, 8, id, getBrandIdFromUrl());
                document.getElementById("page-config").innerHTML = '<label for="mySelect">Item per page: </label>' +
                    '<select name="mySelect" id="mySelect" onchange="loadPerPage()">' +
                    '<option value="4">4</option>' +
                    '<option value="8" selected>8</option>' +
                    '<option value="12">12</option>' +
                    '<option value="16">16</option>' +
                    '</select>';
            }

            if (countFilter == 0) {
                document.getElementById("filter-container").classList.add("hide");
            }
        }
    });
});



