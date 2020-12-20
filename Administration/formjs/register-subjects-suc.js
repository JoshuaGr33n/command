function setUpdateAction() {
    document.frmUser.action = "formjs/register-subjects-suc-edit.php";
    document.frmUser.submit();
    }
    function setDeleteAction() {
    if(confirm("Are you sure want to delete these subjects?")) {
    document.frmUser.action = "formjs/register-subjects-suc-delete.php";
    document.frmUser.submit();
    }
    }