function setUpdateAction() {
document.frmUser.action = "formjs/edit_user.php";
document.frmUser.submit();
}
function setDeleteAction() {
if(confirm("Are you sure want to delete these classes?")) {
document.frmUser.action = "formjs/delete_user.php";
document.frmUser.submit();
}
}