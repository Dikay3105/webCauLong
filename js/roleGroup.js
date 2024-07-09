function getAllSwitchValues() {
    // Lấy tất cả các nút switch có class "roleSwitch"
    var switches = document.querySelectorAll('.roleSwitch');

    // Mảng để chứa giá trị của nút switch
    var switchValues = [];

    switches.forEach(function(switchElement) {
        var switchName = switchElement.id;
        var switchValue = switchElement.checked; // Lấy giá trị của nút switch

        // Thêm vào mảng nếu giá trị là true
        if (switchValue) {
            // Lấy permissionName từ switchName
            var permissionName = '';
            if (switchName.includes('add')) {
                permissionName = 'add';
            } else if (switchName.includes('update')) {
                permissionName = 'update';
            } else if (switchName.includes('show')) {
                permissionName = 'show';
            } else if (switchName.includes('delete')) {
                permissionName = 'delete';
            }

            // Lấy functionID từ switchName
            var functionID = '';
            if (switchName.includes('Role')) {
                functionID = '1'; // Role: functionID là 1
            } else if (switchName.includes('Account')) {
                functionID = '2'; // Account: functionID là 2
            } else if (switchName.includes('Product')) {
                functionID = '3'; // Product: functionID là 3
            } else if (switchName.includes('Category')) {
                functionID = '4'; // Category: functionID là 4
            } else if (switchName.includes('Invoice')) {
                functionID = '5'; // Invoice: functionID là 5
            } else if (switchName.includes('Revenue')) {
                functionID = '6'; // Revenue: functionID là 6
            }

            switchValues.push({ functionID: functionID, permissionName: permissionName });
        }
    });
    console.log(switchValues);
    return switchValues;
}

$(document).ready(function() {
    $('#saveRoleGroupChangesBtn').click(function(event) {
        event.preventDefault(); // Ngăn form gửi dữ liệu theo cách truyền thống

        // Lấy giá trị roleID từ combobox
        var roleID = $('select[name="selectedRole"]').val();
        console.log("Selected roleID: " + roleID);

        // Lấy danh sách switchValues
        var switchValues = getAllSwitchValues();
        console.log("Switch values: ", switchValues);

        // Kiểm tra nếu không có roleID hoặc switchValues
        if (!roleID) {
            alert("Vui lòng chọn vai trò");
            return;
        }

        // Gửi dữ liệu qua AJAX
        $.ajax({
            url: '../Controllers/AddRoleGroupControler.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                roleID: roleID,
                switchValues: switchValues
            }),
            success: function(response) {
                try {
                    var data = JSON.parse(response);
                    if (data === false) {
                        alert("Cập nhật thất bại.");
                    } else {
                        alert("Cập nhật thành công!");
                        window.location.reload();
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e); // Xử lý lỗi khi không thể chuyển đổi thành JSON
                }
            },
            error: function(xhr, status, error) {
                alert('Đã xảy ra lỗi: ' + error);
            }
        });
    });
});

$(document).ready(function() {
    $('#saveEditRoleGroupChangesBtn').click(function(event) {
        event.preventDefault(); // Ngăn form gửi dữ liệu theo cách truyền thống

        // Lấy giá trị roleID từ input
        var roleID = $('#showRoleid').val();
        console.log("Role ID: ", roleID);

        // Lấy danh sách switchValues
        var switchValues = getAllSwitchValues();
        console.log("Switch values: ", switchValues);

        // Kiểm tra nếu không có roleID hoặc switchValues
        if (!roleID) {
            alert("Vui lòng chọn vai trò");
            return;
        }

        // Gửi dữ liệu qua AJAX
        $.ajax({
            url: '../Controllers/EditRoleGroupControler.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                roleID: roleID,
                switchValues: switchValues
            }),
            success: function(response) {
                try {
                    var data = JSON.parse(response);
                    if (data === false) {
                        alert("Cập nhật thất bại.");
                    } else {
                        alert("Cập nhật thành công!");
                        window.location.reload();
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e); // Xử lý lỗi khi không thể chuyển đổi thành JSON
                }
            },
            error: function(xhr, status, error) {
                alert('Đã xảy ra lỗi: ' + error);
            }
        });
    });
});
