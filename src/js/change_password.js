function validateForm() {
    var current_pasword = document.forms["myForm"]["current_password"].value;
    var new_pasword = document.forms["myForm"]["new_password"].value;
    var check_pasword = document.forms["myForm"]["check_password"].value;
    if (current_pasword == '' || new_pasword == '' || check_pasword == '') {
        alert("กรุณาใส่ข้อมูลที่กำหนดไว้ทั้งหมด!");
        return false;
    }
    if (new_pasword != check_pasword) {
        alert("รหัสผ่านยืนยันไม่ตรงกัน!");
        return false;
    }
}