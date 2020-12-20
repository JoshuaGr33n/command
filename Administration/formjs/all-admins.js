
    function setDeleteAction() {
    if(confirm("Are you sure want to execute this?")) {
    document.frmUser.action = "formjs/all-admins-delete.php";
    document.frmUser.submit();
    }
    }