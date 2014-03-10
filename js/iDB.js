var db, fn, tmp, uTime;
const DB_NAME = "todoDB";

function init() {
 window.indexedDB = window.indexedDB || window.webkitIndexedDB || window.mozIndexedDB;
  if (!window.indexedDB) {
    window.alert("Your browser doesn't support a stable version of IndexedDB.");
  } else {
    initIndexedDB();
  }
};

function initIndexedDB() {
  var request = window.indexedDB.open(DB_NAME);

  request.onerror = function onError_Init(event) {
    alert("Error Opening/Creating Database");
  }

  request.onsuccess = function onSuccess_Init(event) {
    db = request.result;
    displayToDoList();
  }

  request.onupgradeneeded = function onUpgradeNeeded(event) {
    db = event.target.result;
    var objectStore = db.createObjectStore("todo", {
      keyPath: "uid"
    });
  }
};

function saveToDo(uid, subject, tag) {
  var trans = db.transaction(["todo"], "readwrite");
  var store = trans.objectStore("todo");
  timeStamp = Date.now();
  
    var data = {
    "uid": uid,
    "subject": subject,
	"tag": tag,
    "timeStamp": timeStamp,
	"done" : 0,
  };
  var request = store.put(data);
  request.onsuccess = function onSuccess_Save(e) {
    alert("Tag Saved Successfully");
  };
  request.onerror = function onError_Save(e) {
    alert("An Error Occured while Saving Tag!");
  };

};

function doneToDo(uid) {
  var trans = db.transaction(["todo"], "readwrite");
  var store = trans.objectStore("todo");
  var request = store.delete(uid);
  request.onsuccess = function onSuccess_Del(e) {
    //displayToDoList();
	alert("Deleted Tag Successfully");
	window.location = "todo.php";
  };

  request.onerror = function onError_Del(e) {
    alert("Delete Request Error !");
  };
};

function displayToDoList() {
 

  var trans = db.transaction(["todo"], "readwrite");
  var store = trans.objectStore("todo");

  var cursorRequest = store.openCursor();
  cursorRequest.onsuccess = function onSuccess_Cursor(e) {
    var result = e.target.result;
    var row = result.value;
    renderToDoList(result.value);
    result.continue ();
  };

  cursorRequest.onerror = function onError_Cursor(e) {
    alert("Cursor Request Error !");
  }
};

function renderToDoList(row) {
  var todayElement = document.getElementById("today");
  var tomorrowElement = document.getElementById("tomorrow");
  var oneWeekElement = document.getElementById("oneweek");
  var li = document.createElement("li");
  var a = document.createElement("a");
  var aDel = document.createElement("a");
  a.setAttribute('href',"#");
  a.addEventListener("click", function () {
   	 uid= row.uid;
   	window.location = "viewmail.php?mailbox=INBOX&&mail_id="+uid;
  }, false);
  
  aDel.addEventListener("click", function () {
    doneToDo(row.uid);
  }, false);

  aDel.textContent = " [Done]";
  aDel.setAttribute("style","float:right;cursor:pointer;");
  a.setAttribute("style","text-decoration:none;color:black;");
  a.textContent = "["+row.subject+"]";
  li.setAttribute("class","ui-li ui-li-static ui-btn-up-c ui-corner-bottom ui-li-last");
  li.appendChild(a);
  li.appendChild(aDel);
  if(row.tag=="Today")
  todayElement.appendChild(li);
  else if(row.tag=="Tomorrow")
  tomorrowElement.appendChild(li);
  else
  oneWeekElement.appendChild(li);
};