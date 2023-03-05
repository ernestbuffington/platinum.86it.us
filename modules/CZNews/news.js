if (document.layers) {
    document.captureEvents(Event.MOUSEMOVE);
    document.onmousemove = captureMousePosition;
} else if (document.all) document.onmousemove = captureMousePosition;
else if (document.getElementById)  document.onmousemove = captureMousePosition;
xMousePos = 0;
yMousePos = 0;
xMousePosMax = 0;
yMousePosMax = 0;
function captureMousePosition(e) {
    if (document.layers) {
        xMousePos = e.pageX;
        yMousePos = e.pageY;
        xMousePosMax = window.innerWidth+window.pageXOffset;
        yMousePosMax = window.innerHeight+window.pageYOffset;
    } else if (document.all) {
        xMousePos = window.event.x+document.body.scrollLeft;
        yMousePos = window.event.y+document.body.scrollTop;
        xMousePosMax = document.body.clientWidth+document.body.scrollLeft;
        yMousePosMax = document.body.clientHeight+document.body.scrollTop;
    } else if (document.getElementById) {
        xMousePos = e.pageX;
        yMousePos = e.pageY;
        xMousePosMax = window.innerWidth+window.pageXOffset;
        yMousePosMax = window.innerHeight+window.pageYOffset;
    }
}

function showNewsTip(action,tString){
    if (action == 'show') {
		x = xMousePos;
		y = yMousePos;
        document.getElementById('outsidelinks_two').style.left = x;
        document.getElementById('outsidelinks_two').style.top = y;
        document.getElementById('insidelinks_two').innerHTML = tString;
        document.getElementById('outsidelinks_two').style.display = 'inline';
        document.getElementById('insidelinks_two').style.display = 'inline';
    }
    if (action == 'hide') {
		document.getElementById('outsidelinks_two').style.display = 'none';
        document.getElementById('insidelinks_two').style.display = 'none';
    }
}

function followNewsTip() {
	x = xMousePos;
	y = yMousePos;
	document.getElementById('outsidelinks_two').style.left = x + 20;
	document.getElementById('outsidelinks_two').style.top = y;
}
