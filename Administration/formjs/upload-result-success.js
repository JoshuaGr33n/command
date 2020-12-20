function setUpdateAction() {
    document.frmUser.action = "formjs/upload-result-success-edit.php";
    document.frmUser.submit();
    }
    function setDeleteAction() {
    if(confirm("Are you sure want to delete these rows?")) {
    document.frmUser.action = "formjs/upload-result-success-delete.php";
    document.frmUser.submit();
    }
    }