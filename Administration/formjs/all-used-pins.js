


    function setDeleteUsedPinsAction() {
        if(confirm("Are you sure want to delete these pins?")) {
        document.frmUser.action = "formjs/all-used-pins-delete.php";
        document.frmUser.submit();
        }
        }