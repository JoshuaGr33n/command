function setUpdateAction() {
    document.frmUser.action = "formjs/all-pins-edit.php";
    document.frmUser.submit();
    }
    function setDeleteAction() {
    if(confirm("Are you sure want to delete these pins?")) {
    document.frmUser.action = "formjs/all-pins-delete.php";
    document.frmUser.submit();
    }
    }


    