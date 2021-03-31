function insert_student() {
  var e1 = document.getElementById("inputGroupSelect01");
  var e2 = document.getElementById("inputGroupSelect02");
  document.getElementById('gradeno').value = e1.options[e1.selectedIndex].value;
  document.getElementById('roomno').value = e2.options[e2.selectedIndex].value;
}

function search_stdid() {
  var e = document.getElementById("search_stdid");
  if (e.value != '') {
    window.location.replace("student.php?searchID="+e.value)
  } else {
    var gradeno = document.getElementById("gradeno");
    var roomno = document.getElementById("roomno");
    var stfname = document.getElementById("search_stdf");
    var stlname = document.getElementById("search_stdl");
    if (gradeno.value == '' && roomno.value == ''&& stfname.value == ''&& stlname.value == '') {
      return false;
    } else  { 
      str = "";
      var j = 0;
      list_val = [gradeno.value, roomno.value, stfname.value, stlname.value];
      list_str_val = ["GradeNo=", "RoomNo=", "Firstname=", "Lastname="];
      for (let i = 0; i < list_val.length; i++) {
        if (list_val[i] != '' && list_val[i] != "เลือก...") {
          if (j == 0) str += list_str_val[i] + list_val[i];
          else str += "&" + list_str_val[i] + list_val[i];
          j++;
        }
      }
      window.location.replace("student.php?"+str);
    }
  }
}

function clear_stdid() {
  window.location.replace("student.php")
}

// Student Add
function insert_student_add() {
  var e2 = document.getElementById("inputGroupSelect02");
  var e3 = document.getElementById("inputGroupSelect02");
  var e4 = document.getElementById("inputGroupSelect04");
  document.getElementById('gradeno').value = e2.options[e2.selectedIndex].text;
  document.getElementById('roomno').value = e3.options[e3.selectedIndex].text;
  document.getElementById('ntitle').value = e4.options[e4.selectedIndex].text;
}

function validateForm() {
  var gradeno = document.getElementById('gradeno').value;
  var roomno = document.getElementById('roomno').value;
  var ntitle = document.getElementById('ntitle').value;
  var stuid = document.forms["myForm"]["stdid"].value;
  var fn = document.forms["myForm"]["firstname"].value;
  var ln = document.forms["myForm"]["lastname"].value;
  var a = document.forms["myForm"]["address"].value;
  var b = document.forms["myForm"]["bdate"].value;
  var phone = document.forms["myForm"]["phone"].value;
  var pname = document.forms["myForm"]["pname"].value;
  var pphone = document.forms["myForm"]["pphone"].value;
  if (gradeno == 'เลือก...' || roomno == 'เลือก...' || ntitle == 'เลือก...' || gradeno == '' || roomno == '' || ntitle == '' || stuid == '' || fn == '' || ln == '' || a == '' || b == '' || phone == '' || pname == '' || pphone == '') {
    alert("กรุณาใส่ข้อมูลทั้งหมด!")
    return false;
  }
}

$(function(){
  $('[type="date"]').prop('max', function(){
      return new Date().toJSON().split('T')[0];
  });
  $('#styear').prop('min', function(){
      return new Date().toJSON().split('T')[0];
  });
});

// Student Update
function update_student() {
  var e = document.getElementById("inputGroupSelect01");
  var e2 = document.getElementById("inputGroupSelect02");
  var e3 = document.getElementById("inputGroupSelect03");
  document.getElementById('gradeno').value = e.options[e.selectedIndex].text;
  document.getElementById('roomno').value = e2.options[e2.selectedIndex].text;
  document.getElementById('ntitle').value = e3.options[e3.selectedIndex].value;
}

function validateForm() {
  var fn = document.forms["myForm"]["firstname"].value;
  var ln = document.forms["myForm"]["lastname"].value;
  var a = document.forms["myForm"]["address"].value;
  var phone = document.forms["myForm"]["phone"].value;
  var pname = document.forms["myForm"]["pname"].value;
  var pphone = document.forms["myForm"]["pphone"].value;
  if (fn == '' || ln == '' || a == '' || phone == '' || pname == '' || pphone == '') {
    alert("กรุณาใส่ข้อมูลที่กำหนดไว้ทั้งหมด!")
    return false;
  }
}