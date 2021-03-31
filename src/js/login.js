function validateForm() {
    var username = document.forms["myForm"]["username"].value;
    var password = document.forms["myForm"]["password"].value;
    if (username == '' || password == '') {
        alert("กรุณาใส่ข้อมูลที่กำหนดไว้ทั้งหมด!")
        return false;
    }
}