$(document).ready(function() {
    $('#saveRoleChangesBtn').click(function(event) {
        event.preventDefault(); // Ngăn form gửi dữ liệu theo cách truyền thống

        // Lấy giá trị từ các trường input
        var roleID = $('#roleID').val();
        var roleName = $('#roleName').val();
        console.log(roleID);
        if (roleName.trim() === '') {
            alert("Vui lòng nhập tên vai trò");
        } else {
            // Gửi dữ liệu qua AJAX
            $.ajax({
                url: '../../web_BadmintonStore/Controllers/EditroleController.php',
                method: 'POST',
                data: {
                    roleID: roleID,
                    roleName: roleName,
                },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        if (data === false) {
                            alert("Cập nhật thất bại.");
                           
                        } else {
                            alert("Cập nhật thành công!");
                            window.location.reload();
                            showContent('phanquyen-content');

                        }
                    } catch (e) {
                        console.error('Error parsing JSON:', e); // Xử lý lỗi khi không thể chuyển đổi thành JSON
                    }
                },
                error: function(xhr, status, error) {
                    alert('Đã xảy ra lỗi: ' + error);
                }
            });
        }
    });
});
$(document).ready(function() {
    $('#saveRoleAddBtn').click(function(event) {
        event.preventDefault(); // Ngăn form gửi dữ liệu theo cách truyền thống

        // Lấy giá trị từ các trường input
        var roleName = $('#addRoleName').val();
        if (roleName.trim() === '') {
            alert("Vui lòng nhập tên vai trò");
        } else {
            // Gửi dữ liệu qua AJAX
            $.ajax({
                url: '../../web_BadmintonStore/Controllers/AddroleController.php',
                method: 'POST',
                data: {
                    roleName: roleName,
                },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        if (data === false) {
                            alert("Thêm mới thất bại.");
                        } else {
                            alert("Thêm mới thành công!");
                            window.location.reload(); // Tải lại trang sau khi thêm mới thành công
                        }
                    } catch (e) {
                        console.error('Error parsing JSON:', e); // Xử lý lỗi khi không thể chuyển đổi thành JSON
                    }
                },
                error: function(xhr, status, error) {
                    alert('Đã xảy ra lỗi: ' + error);
                }
            });
        }
    });
});