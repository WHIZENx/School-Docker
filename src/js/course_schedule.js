$(function(){
    var d = new Date();
    var n = d.getFullYear();
    $("input[type='number']").prop('min',n);
    var file = window.location.href.split("/")[3]
    if (file == "class_schedule_add.php") {
        if (window.location.href.split("?")[1] != undefined) {
            document.getElementById("schedule").style.display = "block";
        }
    } else if (file.split('?')[0] == "class_schedule_update.php") {
      var e = document.getElementById("inputGroupSelect04");
      if (e.options[e.selectedIndex].value != "เลือก...") {
        var value = e.options[e.selectedIndex].value.split("_");
        document.getElementById('semesterid').value = value[0];
        document.getElementById('termid').value = value[1];
        document.getElementById('gradeno').value = value[2];
        document.getElementById('roomno').value = value[3];
      }
        if (window.location.href.split("?")[1] != undefined) {
            document.getElementById("schedule-update").style.display = "block";
            document.getElementById("update").style.display = "inline-block";
            var v_y = window.location.href.split("?")[1].split("Year=")[1].split("&Term=")[0];
            var v_t = window.location.href.split("?")[1].split("Year=")[1].split("&Term=")[1].split("&Gradeno=")[0];
            var v_g = window.location.href.split("?")[1].split("Year=")[1].split("&Term=")[1].split("&Gradeno=")[1].split("&Roomno=")[0];
            var v_r = window.location.href.split("?")[1].split("Year=")[1].split("&Term=")[1].split("&Gradeno=")[1].split("&Roomno=")[1];
            document.getElementById('gradeno').value = v_g;
            document.getElementById('roomno').value = v_r;
            document.getElementById('semesterid').value = v_y;
            document.getElementById('termid').value = v_t;
        }
    }
});

a = {"1_1": [], "1_2": [], "1_3": [], "1_4": [], "1_5": [], "2_1": [], "2_2": [], "2_3": [], "2_4": [], "2_5": [], "3_1": [], "3_2": [], "3_3": [], "3_4": [], "3_5": [], "4_1": [], "4_2": [], "4_3": [], "4_4": [], "4_5": [], "5_1": [], "5_2": [], "5_3": [], "5_4": [], "5_5": [], "6_1": [], "6_2": [], "6_3": [], "6_4": [], "6_5": []}
var time_list = ["08.30-09.30", "09.30-10.30", "10.30-11.30", "13.00-14.00", "14.00-15.00", "15.00-16.00"];
var day_list = ["วันจันทร์", "วันอังคาร", "วันพุธ", "วันพฤหัสบดี", "วันศุกร์"];

function search_schedule() {
    var e = document.getElementById("inputGroupSelect04");
    console.log(e.options[e.selectedIndex].value)
    if (e.options[e.selectedIndex].value != "เลือก...") {
      let value = e.options[e.selectedIndex].value.split("_");
      window.location.replace("class_schedule.php?"+"Year="+value[0]+"&Term="+value[1]+"&GradeNo="+value[2]+"&RoomNo="+value[3]);
    } else {
      document.getElementById("schedule").style.display = "none";
    }
}

function clear_schedule() {
    window.location.replace("class_schedule.php")
}

function showpopup(time, day) {
    document.getElementById('time').value = time;
    document.getElementById('day').value = day;
    var e = document.getElementById("inputGroupSelectc");
    document.getElementById('exampleModalLongTitle').textContent = "เลือกวิชาของ" + day_list[parseInt(day)-1] + " เวลา " + time_list[parseInt(time)-1];
    e.selectedIndex = 0;
}

function addcourse() {
    var e = document.getElementById("inputGroupSelectc");
    var value = e.options[e.selectedIndex].value.split(":");
    var time = document.getElementById('time').value;
    var day = document.getElementById('day').value;
    if (value[0] == 'เลือก...') {
        if (a[time+"_"+day].length == 1) {
        a[time+"_"+day].pop();
        }
        document.getElementById('id'+time+'_'+day).textContent = 'เพิ่ม';
    document.getElementById('n'+time+'_'+day).textContent = '';
    } else {
        if (a[time+"_"+day].length == 1) {
        a[time+"_"+day].pop();
        a[time+"_"+day].push(value[0]);
        } else {
        a[time+"_"+day].push(value[0]);
        }
        document.getElementById('id'+time+'_'+day).textContent = value[0];
        document.getElementById('n'+time+'_'+day).textContent = value[1];
        document.getElementById('int'+time+'_'+day).value = time;
        document.getElementById('ind'+time+'_'+day).value = day;
        document.getElementById('cid'+time+'_'+day).value = value[0];
    }
}

function insert_classes() {
    var e = document.getElementById("inputGroupSelect04");
    var e3 = document.getElementById("inputGroupSelect02");
    var e4 = document.getElementById("inputGroupSelect03");
    if (e.options[e.selectedIndex].value != "เลือก..." && e3.options[e3.selectedIndex].value != "เลือก..." && e4.options[e4.selectedIndex].value != "เลือก...") {
      document.getElementById("schedule-add").style.display = "block";
      document.getElementById("confirm").style.display = "inline-block";
      document.getElementById('gradeno').value = e3.options[e3.selectedIndex].value;
      document.getElementById('roomno').value = e4.options[e4.selectedIndex].value;
      document.getElementById('semesterid').value = e.options[e.selectedIndex].value.split("_")[0];
      document.getElementById('termid').value = e.options[e.selectedIndex].value.split("_")[1];
    } else {
      document.getElementById("schedule-add").style.display = "none";
      document.getElementById("confirm").style.display = "none";
      a = {"1_1": [], "1_2": [], "1_3": [], "1_4": [], "1_5": [], "2_1": [], "2_2": [], "2_3": [], "2_4": [], "2_5": [], "3_1": [], "3_2": [], "3_3": [], "3_4": [], "3_5": [], "4_1": [], "4_2": [], "4_3": [], "4_4": [], "4_5": [], "5_1": [], "5_2": [], "5_3": [], "5_4": [], "5_5": [], "6_1": [], "6_2": [], "6_3": [], "6_4": [], "6_5": []}
      for (var i = 1; i <= 6; i++) {
        for (var j = 1; j <= 5; j++) {
          document.getElementById('id'+i+'_'+j).textContent = "เพิ่ม";
          document.getElementById('n'+i+'_'+j).textContent = "";
        }
      }
    }
}

function validateForm() {
    var e = document.getElementById("inputGroupSelect04");
    var e3 = document.getElementById("inputGroupSelect02");
    var e4 = document.getElementById("inputGroupSelect03");
    if (e.options[e.selectedIndex].value == "เลือก..." || e3.options[e3.selectedIndex].value == "เลือก..." || e4.options[e4.selectedIndex].value == "เลือก...") {
      return false;
    }
    for (var i = 1; i <= 6; i++) {
      for (var j = 1; j <= 5; j++) {
        if (a[i+"_"+j].length  == 0) {
          return false;
        }
      }
    }
}

function insert_classes_update() {
    var e = document.getElementById("inputGroupSelect04");
    if (e.options[e.selectedIndex].value != "เลือก...") {
      document.getElementById("schedule-update").style.display = "block";
      document.getElementById("update").style.display = "inline-block";
      var value = e.options[e.selectedIndex].value.split("_");
      document.getElementById('semesterid').value = value[0];
      document.getElementById('termid').value = value[1];
      window.location.replace("class_schedule_update.php?"+"Year="+value[0]+"&Term="+value[1]+"&Gradeno="+value[2]+"&Roomno="+value[3]);
    } else {
      document.getElementById("schedule-update").style.display = "none";
      document.getElementById("update").style.display = "none";
      a = {"1_1": [], "1_2": [], "1_3": [], "1_4": [], "1_5": [], "2_1": [], "2_2": [], "2_3": [], "2_4": [], "2_5": [], "3_1": [], "3_2": [], "3_3": [], "3_4": [], "3_5": [], "4_1": [], "4_2": [], "4_3": [], "4_4": [], "4_5": [], "5_1": [], "5_2": [], "5_3": [], "5_4": [], "5_5": [], "6_1": [], "6_2": [], "6_3": [], "6_4": [], "6_5": []}
      window.location.replace("class_schedule_update.php")
    }
}

function validateForm_update() {
    for (var i = 1; i <= 6; i++) {
      for (var j = 1; j <= 5; j++) {

        if (document.getElementById('id'+i+'_'+j).textContent == 'เพิ่ม') {
          return false;
        }
      }
    }
}