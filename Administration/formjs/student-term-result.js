function setUpdateAction() {
    document.frmUser.action = "formjs/student-term-result-edit.php";
    document.frmUser.submit();
    }
    function setDeleteAction() {
    if(confirm("Are you sure want to delete these results?")) {
    document.frmUser.action = "formjs/student-term-result-delete.php";
    document.frmUser.submit();
    }
    }