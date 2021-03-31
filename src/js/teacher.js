function insert_staff() {
  var e = document.getElementById("inputGroupSelect01");
  var e2 = document.getElementById("inputGroupSelect02");
  document.getElementById('typeno').value = e.options[e.selectedIndex].text;
  document.getElementById('ntitle').value = e2.options[e2.selectedIndex].text;
}

function update_teacher() {
  var e = document.getElementById("inputGroupSelect01");
  document.getElementById('ntitle').value = e.options[e.selectedIndex].value;
}

function insert_teacher() {
  var e = document.getElementById("inputGroupSelect03");
  document.getElementById('section').value = e.options[e.selectedIndex].text;
}

function search_teacherid() {
  var e = document.getElementById("search_teaid");
  if (e.value != '') {
    window.location.replace("teacher.php?searchID="+e.value)
  } else {
    var tfname = document.getElementById("search_tf");
    var tlname = document.getElementById("search_tl");
    var section = document.getElementById("section");
    if (section.value == ''&& tfname.value == ''&& tlname.value == '') {
      return false;
    } else  { 
      str = "";
      var j = 0;
      list_val = [section.value, tfname.value, tlname.value];
      list_str_val = ["Section=", "Firstname=", "Lastname="];
      for (let i = 0; i < list_val.length; i++) {
        if (list_val[i] != '' && list_val[i] != "เลือก...") {
          if (j == 0) str += list_str_val[i] + list_val[i];
          else str += "&" + list_str_val[i] + list_val[i];
          j++;
        }
      }
      window.location.replace("teacher.php?"+str);
    }
  }
}

function clear_teacherid() {
  window.location.replace("teacher.php")
}

// Add teacher
function insert_staff() {
  var e = document.getElementById("inputGroupSelect01");
  var e2 = document.getElementById("inputGroupSelect02");
  document.getElementById('typeno').value = e.options[e.selectedIndex].text;
  document.getElementById('ntitle').value = e2.options[e2.selectedIndex].text;
}
function validateForm() {
  var str = new Date().getFullYear()+"-";
  if (new Date().getMonth()+1 < 10) {
    str += "0";
  }
  str += (new Date().getMonth()+1)+"-";
  if (new Date().getDate() < 10) {
    str += "0";
  }
  str += new Date().getDate();
  document.getElementById('startwork').value = str;
  var typeno = document.getElementById('typeno').value;
  var ntitle = document.getElementById('ntitle');
  var email = document.getElementById('email');
  var tid = document.forms["myForm"]["tid"].value;
  var fn = document.forms["myForm"]["firstname"].value;
  var ln = document.forms["myForm"]["lastname"].value;
  var a = document.forms["myForm"]["address"].value;
  var b = document.forms["myForm"]["bdate"].value;
  var phone = document.forms["myForm"]["phone"].value;
  if (typeno == '' || typeno == 'เลือก...' || ntitle == 'เลือก...' || email == '' || ntitle == '' || tid == '' || fn == '' || ln == '' || a == '' || b == '' || phone == '') {
    alert("กรุณาใส่ข้อมูลทั้งหมด!")
    return false;
  }
}
$(function(){
  $('[type="date"]').prop('max', function(){
      return new Date().toJSON().split('T')[0];
  });
});

function update_student() {
  var e = document.getElementById("inputGroupSelect01");
  var e2 = document.getElementById("inputGroupSelect02");
  document.getElementById('ntitle').value = e.options[e.selectedIndex].text;
  document.getElementById('typeno').value = e2.options[e2.selectedIndex].text;
}
function validateForm_update() {
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