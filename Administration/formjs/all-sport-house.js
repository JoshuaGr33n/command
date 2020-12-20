function setUpdateAction() {
    document.frmUser.action = "formjs/all-sport-house-edit.php";
    document.frmUser.submit();
    }
    function setDeleteAction() {
    if(confirm("Are you sure want to delete these rows?")) {
    document.frmUser.action = "formjs/all-sport-house-delete.php";
    document.frmUser.submit();
    }
    }