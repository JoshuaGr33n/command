
    function setDeleteAction() {
        if(confirm("Deleting this student also deletes the entire record of the student. Are you sure want to do this?")) {
        document.frmUser.action = "formjs/delete-students.php";
        document.frmUser.submit();
        }
        }