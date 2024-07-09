<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Style for the modal form */
        #FormRole_add {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            max-width: 600px; /* Đặt kích thước tối đa */
            height: auto;
            z-index: 10010; /* Đảm bảo form nằm trên tất cả */
            background-color: #fff;
            border-radius: 10px;
            padding: 2.5rem; 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Background overlay */
        #Role-add-background {
            display: flex;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(87, 84, 84, .4);
            z-index: 10005;
            align-items: center;
            justify-content: center;
        }

        /* Close button */
        .closeformrole-add {
            cursor: pointer;
            position: absolute;
            right: 16px;
            top: 16px;
            width: 48px;
            height: 48px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            font-weight: 500;
        }
  /* Style for the modal form */
#FormRole_edit {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    max-width: 600px; /* Đặt kích thước tối đa */
    height: auto;
    z-index: 10010; /* Đảm bảo form nằm trên tất cả */
    background-color: #fff;
    border-radius: 10px;
    padding: 2.5rem; 
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    text-align: center;
}

/* Background overlay */
#Role-background {
    display: flex;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(87, 84, 84, .4);
    z-index: 10005;
    align-items: center;
    justify-content: center;
}

/* Close button */
.closeformrole {
    cursor: pointer;
    position: absolute;
    right: 16px;
    top: 16px;
    width: 48px;
    height: 48px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
    font-weight: 500;
}

/* Form elements */
.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    text-align: left;
    font-weight: bold;
    margin-bottom: 5px;
}

.form-control {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

/* Button */
#saveRoleChangesBtn {
    margin-top: 20px;
}

#EditFormRole {
    display: none; /* Ẩn form ban đầu */
}

#fixRow {
    margin-top: -20px;
}

    </style>
</head>
<body>
<div>
        <div class="col-md-4">
            <label style="margin-right: 10px;">Danh sách quyền</label>
            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#addModal" style="width: 100px; margin-bottom: 10px; cursor: pointer;" onclick="showAddFormRole()">
                Thêm mới
            </button>
        </div>

        <div class="table-responsive" style="margin-top: 20px;">
            <table class="table table-striped" id="quanlyPQTable" style="text-align: center;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">Mã vai trò</th>
                        <th scope="col" class="text-center">Tên vai trò</th>
                        <th scope="col" class="text-center">Số lượng người dùng</th>
                        <th scope="col" class="text-center">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once __DIR__ . '../../../../Model/ModelRole.php';
                    require_once __DIR__ . '../../../../Model/ModelUser.php';

                    $modelRole = new ModelRole();
                    $modelUser = new ModelUser();

                    $roles = $modelRole->getAllRoles();

                    if ($roles) {
                        foreach ($roles as $role) {
                            echo '<tr style="height: 50px;">';
                            echo "<td class=\"text-center\">" . $role['roleID'] . "</td>";
                            echo "<td class=\"text-center\">" . $role['roleName'] . "</td>";
                    
                            // Lấy số lượng người dùng cho từng nhóm quyền
                            $userCount = $modelUser->getUserCountByRoleID($role['roleID']);
                            echo "<td class=\"text-center\">" . $userCount . "</td>";
                    
                            echo '<td class="d-flex justify-content-evenly">';
                            echo '<i class="fas fa-wrench" style="font-size: 25px; color: orange; cursor: pointer" onclick="showEditFormRole(' . $role['roleID'] . ', \'' . $role['roleName'] . '\')"></i>';
                            echo '</td>';

                    
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Không có dữ liệu</td></tr>";
                    }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>

<div id="AddFormRole" style="display: none;">
    <div id="Role-add-background">
        <div id="FormRole_add">
            <div class="closeformrole-add" onclick="closeAddFormRole()">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <h3 class="mb-4">Thêm Nhóm quyền</h3>
            <form id="AddRoleForm" action="../../../../web_BadmintonStore/Controllers/AddroleController.php" method="post">
                <div class="mb-3 row" style="margin-left: 50px;">
                    <div class="mb-3 row">
                        <label for="addRoleName" class="col-sm-3 col-form-label" style="margin-right: 30px; margin-top: 5px;">Tên vai trò:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" style="margin-left: 30px; margin-top: 10px;" name="roleNametxt" id="addRoleName">
                        </div>
                    </div>
                </div>
                <!-- Nút Lưu -->
                <button id="saveRoleAddBtn" type="submit" class="btn btn-primary mt-4">Lưu</button>
            </form>
        </div>
    </div>
</div>













<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<script>
    function showAddFormRole() {
        document.getElementById("AddFormRole").style.display = "block";
    }

    function closeAddFormRole() {
        document.getElementById("AddFormRole").style.display = "none";
    }


</script>


    <div id="EditFormRole" style="display: none;">
        <div id="Role-background">
            <div id="FormRole_edit">
                <div class="closeformrole" onclick="closeEditFormRole()">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <h3 class="mb-4">Nhóm quyền</h3>
                <form id="Roleform" action="../../../../web_BadmintonStore/Controllers/EditroleController.php" method="post">
                <div class="mb-3 row" style="margin-left: 50px;">
                        <div class="mb-3 row">
                            <label for="roleID" class="col-sm-3 col-form-label" style="margin-right: 30px; margin-top: 5px;">Mã vai trò:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  style="margin-top: 10px;" name="roleIDtxt" id="roleID" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="roleName" class="col-sm-3 col-form-label" style="margin-right: 30px; margin-top: 5px;">Tên vai trò:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" style="margin-left: 30px; margin-top: 10px;" name="roleNametxt" id="roleName">
                            </div>
                        </div>
                        </div>
                    <!-- Nút Lưu -->
                    <button id="saveRoleChangesBtn" type="submit" class="btn btn-primary mt-4">Lưu</button>
                </form>
            </div>
        </div>
    </div>

<!-- Include jQuery, Popper.js, and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Include additional JavaScript files -->
<script type="text/javascript" src="../js/jquery.validate.min.js" defer></script>
<script type="text/javascript" src="../../../../web_BadmintonStore/js/role.js" defer></script>

<script>
    function showEditFormRole(roleID, roleName) {
        if(roleID==1){
            alert("Quyền admin không được sửa");
        }else if(roleID==4){
            alert("Quyền user không được sửa");
        } else{
            // Đảm bảo dữ liệu được truyền đúng
            console.log("Role ID:", roleID);
            console.log("Role Name:", roleName);

            // Điền dữ liệu vào các trường của form
            document.getElementById('roleID').value = roleID;
            document.getElementById('roleName').value = roleName;

            // Hiển thị form chỉnh sửa
            document.getElementById('EditFormRole').style.display = 'block';
        }
    }


    function closeEditFormRole() {
        var EditFormRole = document.getElementById("EditFormRole");
        EditFormRole.style.display = "none";
    }
    </script>

</body>
</html>
