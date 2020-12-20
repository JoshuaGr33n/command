function setUpdateAction() {
    document.frmUser.action = "formjs/result-suc-edit.php";
    document.frmUser.submit();
    }
    function setDeleteAction() {
    if(confirm("Are you sure want to delete these rows?")) {
    document.frmUser.action = "formjs/results-suc-delete.php";
    document.frmUser.submit();
    }
    }