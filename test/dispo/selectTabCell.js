var currentCell;
var dragState = false;
var NORMALCOLOR = "red";
var HIGHLIGHTCOLOR = "green";
var theTable = document.getElementById("dispoTable");
var tds = theTable.getElementsByTagName("td");

var table=new Array(tds.length-7);

addEvent(window, 'mouseup', dragStop, false);
addEvent(window, 'mousedown', dragStart, false);

for (var x=0; x < tds.length; x++) {
    table[x] = 0;
    if (tds[x].className.length < 1) {        
        addEvent(tds[x], 'mouseover', extend, false);        
    }
}
function dragStart(e) {
  if (e.target.localName == "td") {
        var curElement = getEventTarget(e);
        dragState = true;
        currentCell = curElement.cellIndex;
        dragRow = curElement.parentNode.rowIndex;
        highlight(currentCell);        
    }
}
function extend(e) {
    if (dragState == true) {
        var curElement = getEventTarget(e);    
        currentCell = curElement.cellIndex;
        dragRow = curElement.parentNode.rowIndex;
        highlight(currentCell);
    }
}
function dragStop() {
    dragState = false;
}

function highlight(currentCell) {
    if (dragState) {
        var row = theTable.getElementsByTagName("tr")[dragRow];
        if (row) {			
            var cells = row.getElementsByTagName("td");		
			
            if (table[currentCell*dragRow] == 1){
                table[currentCell*dragRow] = 0;
                cells[currentCell].style.backgroundColor = NORMALCOLOR;                                    
            }
            else {
                table[currentCell*dragRow] = 1;
                cells[currentCell].style.backgroundColor = HIGHLIGHTCOLOR;
            }				
			
        }
    }
}

//cross-browser event handling for IE 5+, NS6+, Mozilla/Gecko
function addEvent(elm, evType, fn, useCapture) {
    if (elm.addEventListener) {
        elm.addEventListener(evType, fn, useCapture);
        return true;
    }
    else if (elm.attachEvent) {
        var r = elm.attachEvent('on' + evType, fn);
        return r;
    }
    else {
        elm['on' + evType] = fn;
        return true;
    }
}

//returns the object that received the event in a browser neutral manner
function getEventTarget(e) {
    if (window.event && window.event.srcElement) {
        return window.event.srcElement;
    }
    if (e && e.target) {
        return e.target;
    }
    return null
}