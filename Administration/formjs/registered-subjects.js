
    function setDeleteAction() {
    if(confirm("Are you sure want to delete these subjects?")) {
    document.frmUser.action = "formjs/registered-subjects-delete.php";
    document.frmUser.submit();
    }
    }