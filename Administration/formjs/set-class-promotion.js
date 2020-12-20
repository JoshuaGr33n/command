function setUpdateAction() {
    document.frmUser.action = "formjs/set-class-promotion-edit.php";
    document.frmUser.submit();
    }
    function setDeleteAction() {
    if(confirm("Are you sure want to delete these rows?")) {
    document.frmUser.action = "formjs/set-class-promotion-delete.php";
    document.frmUser.submit();
    }
    }