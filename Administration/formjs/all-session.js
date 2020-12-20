function setUpdateAction() {
    document.frmUser.action = "formjs/all-session-edit.php";
    document.frmUser.submit();
    }
    function setDeleteAction() {
    if(confirm("Are you sure want to delete these rows?")) {
    document.frmUser.action = "formjs/all-session-delete.php";
    document.frmUser.submit();
    }
    }