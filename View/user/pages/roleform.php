<?php
    $roleID = isset($_GET['roleID']) ? $_GET['roleID'] : null;
    require_once __DIR__ . '../../Model/ModelPermission.php';
    $modelPermission = new ModelPermission();
    for ($i = 1; $i <= 6; $i++) {
        $listpermission = $modelPermission->getPermissionByroleIDandfunctionID($roleID, $i);

        // Kiểm tra và xử lý kết quả
            foreach ($listpermission as $permission) {
                if ($i == 1) {
                    switch ($permission->getPermissionName()) {
                        case "show":
                            echo '<script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    setDefaultCheckedStatus("showAccountSwitch");
                                });
                            </script>';
                            break;
                        case "add":
                            echo '<script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    setDefaultCheckedStatus("addAccountSwitch");
                                });
                            </script>';
                            break;
                        case "update":
                            echo '<script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    setDefaultCheckedStatus("updateAccountSwitch");
                                });
                            </script>';
                            break;
                        case "delete":
                            echo '<script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    setDefaultCheckedStatus("deleteAccountSwitch");
                                });
                            </script>';
                            break;
                        default:
                            break;
                    }
                } elseif ($i == 2) {
                    switch ($permission->getPermissionName()) {
                        case "show":
                            echo '<script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    setDefaultCheckedStatus("showProductSwitch");
                                });
                            </script>';
                            break;
                        case "add":
                            echo '<script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    setDefaultCheckedStatus("addProductSwitch");
                                });
                            </script>';
                            break;
                        case "update":
                            echo '<script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    setDefaultCheckedStatus("updateProductSwitch");
                                });
                            </script>';
                            break;
                        case "delete":
                            echo '<script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    setDefaultCheckedStatus("deleteProductSwitch");
                                });
                            </script>';
                            break;
                        default:
                            break;
                    }
                }
            }
        
    }
    ?>