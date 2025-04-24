var currentCell;
var dragState = false;
var NORMALCOLOR = "red";
var HIGHLIGHTCOLOR = "green";
var theTable;
var tds;

var tableAvailability;
var tableAvailabilityCell;

function main() {
    theTable = document.getElementById("dispoTable");
    tds = theTable.getElementsByTagName("td");
    tableAvailability = Array(tds.length-7);
    addEvent(window, 'mouseup', dragStop, false);
    addEvent(window, 'mousedown', dragStart, false);

    for (var x=0; x < tds.length; x++) {
        tableAvailability[x] = 0;
        if (tds[x].className.length < 1) {
            addEvent(tds[x], 'mouseover', extend, false);
        }
    }
}

function main2(availability) {
    theTable = document.getElementById("dispoTable");
    tds = theTable.getElementsByTagName("td");
    tableAvailability=availability.split("");
    
    addEvent(window, 'mouseup', dragStop, false);
    addEvent(window, 'mousedown', dragStart, false);

    for (var x=0; x < tds.length; x++) {
        
        if (tds[x].className.length < 1) {
            if (tableAvailability[x] == '1'){
                tds[x].style.backgroundColor = HIGHLIGHTCOLOR;
            }
            addEvent(tds[x], 'mouseover', extend, false);
        }
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
    document.getElementById('availability').value = tableAvailability.join("");
;
}

function highlight(currentCell) {
    if (dragState) {
        var row = theTable.getElementsByTagName("tr")[dragRow];
        if (row) {
            var cells = row.getElementsByTagName("td");
            if (cells[currentCell].className != 'border2'){
                tableAvailabilityCell=currentCell+((dragRow-1)*49);
                if (tableAvailability[tableAvailabilityCell] == 1){
                    tableAvailability[tableAvailabilityCell] = 0;
                    cells[currentCell].style.backgroundColor = NORMALCOLOR;
                }
                else {                   
                    tableAvailability[tableAvailabilityCell] = 1;
                    cells[currentCell].style.backgroundColor = HIGHLIGHTCOLOR;
                }
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