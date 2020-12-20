function setUpdateAction() {
    document.frmUser.action = "formjs/view-all-results-edit.php";
    document.frmUser.submit();
    }
    function setDeleteAction() {
    if(confirm("Are you sure want to delete these rows?")) {
    document.frmUser.action = "formjs/view-all-results-delete.php";
    document.frmUser.submit();
    }
    }