function setUpdateAction() {
    document.frmUser.action = "formjs/student-result-view-edit.php";
    document.frmUser.submit();
    }
    function setDeleteAction() {
    if(confirm("Are you sure want to delete these rows?")) {
    document.frmUser.action = "formjs/student-result-view-delete.php";
    document.frmUser.submit();
    }
    }