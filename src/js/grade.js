function insert_grade() {
    var e2 = document.getElementById("inputGroupSelect02");
    var e3 = document.getElementById("inputGroupSelect03");
    var e4 = document.getElementById("inputGroupSelect04");
    var e5 = document.getElementById("inputGroupSelectc");
    document.getElementById('gradeno').value = e2.options[e2.selectedIndex].value;
    document.getElementById('roomno').value = e3.options[e3.selectedIndex].value;
    document.getElementById('semesterid').value = e4.options[e4.selectedIndex].value;
    document.getElementById('courseid').value = "'"+e5.options[e5.selectedIndex].value.split(":")[0]+"'";
}

function search_grade() {
    var gradeno = document.getElementById("gradeno");
    var roomno = document.getElementById("roomno");
    var courseid = document.getElementById("courseid");
    var semid = document.getElementById("semesterid");
    var sem = semid.value.split("_");
    if (sem[0] == '' || sem[1] == '' || courseid.value == '' || gradeno.value == '' || roomno.value == '') {
      return false;
    } else  {
      str = "";
      var j = 0;
      list_val = [sem[0], sem[1], courseid.value, gradeno.value, roomno.value];
      list_str_val = ["Year=", "SemesterNo=", "CourseID=", "GradeNo=", "RoomNo="];
      for (let i = 0; i < list_val.length; i++) {
        if (list_val[i] != "เลือก...") {
          if (j == 0) str += list_str_val[i] + list_val[i];
          else str += "&" + list_str_val[i] + list_val[i];
          j++;
        }
      }
      window.location.replace("grade.php?"+str);
    }
}

function clear_grade() {
    window.location.replace("grade.php")
}