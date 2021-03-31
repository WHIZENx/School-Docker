function insert_course_view() {
    var e2 = document.getElementById("inputGroupSelect02");
    var e3 = document.getElementById("inputGroupSelect03");
    document.getElementById('gradeno').value = e2.options[e2.selectedIndex].value;
    document.getElementById('section').value = e3.options[e3.selectedIndex].value;
}
function search_course() {
    var e = document.getElementById("search_course");
    if (e.value != '') {
        window.location.replace("course.php?searchID="+(e.value))
    } else {
        var gradeno = document.getElementById("gradeno");
        var section = document.getElementById("section");
        if (section.value == '' && gradeno.value == '') {
            return false;
        } else  {
        str = "";
        var j = 0;
        list_val = [gradeno.value, section.value];
        list_str_val = ["GradeNo=", "Section="];
        for (let i = 0; i < list_val.length; i++) {
            if (list_val[i] != "เลือก...") {
            if (j == 0) str += list_str_val[i] + list_val[i];
            else str += "&" + list_str_val[i] + list_val[i];
            j++;
            }
        }
        window.location.replace("course.php?"+str);
        }
    }
}
function clear_course() {
    window.location.replace("course.php")
}

function insert_course() {
    var e2 = document.getElementById("inputGroupSelect02");
    var e3 = document.getElementById("inputGroupSelect03");
    var e4 = document.getElementById("inputGroupSelect04");
    document.getElementById('gradeno').value = e2.options[e2.selectedIndex].text;
    document.getElementById('prono').value = e3.options[e3.selectedIndex].text;
    document.getElementById('tid').value = e4.options[e4.selectedIndex].value;
}

function validateForm() {
    var gradeno = document.getElementById('gradeno').value;
    var prono = document.getElementById('prono').value;
    var tid = document.getElementById('tid');
    var cid = document.forms["myForm"]["cid"].value;
    var cname = document.forms["myForm"]["cname"].value;
    var credit = document.forms["myForm"]["credit"].value;
    if (tid == '' || tid == 'เลือก...' || gradeno == 'เลือก...' || prono == 'เลือก...' || gradeno == '' || prono == '' || cid == '' || cname == '' || credit == '') {
      alert("กรุณาใส่ข้อมูลทั้งหมด!")
      return false;
    }
}

function validateForm_update() {
    var cname = document.forms["myForm"]["cname"].value;
    var credit = document.forms["myForm"]["credit"].value;
    var tid = document.getElementById('tid').value
    if (cname == '' || tid == '' || tid == 'เลือก...' || credit == '') {
      alert("กรุณาใส่ข้อมูลที่กำหนดไว้ทั้งหมด!")
      return false;
    }
}

function insert_course_update() {
    var e4 = document.getElementById("inputGroupSelect04");
    document.getElementById('tid').value = e4.options[e4.selectedIndex].value;
}