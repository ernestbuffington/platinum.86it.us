/**********************************************************
 Very minorly modified from the example by Tim Taylor
 http://tool-man.org/examples/sorting.html
 
 Added Coordinate.prototype.inside( northwest, southeast );
 
 **********************************************************/
function DDShow(x,DURL) {
  var today = new Date();               
  var expiry = new Date(today.getTime() + 28 * 24 * 60 * 60 * 1000);
  document.cookie = "standalone=" + x + "; expires=" + expiry.toGMTString();
  location.href=DURL;
}

var Coordinates = {
	ORIGIN : new Coordinate(0, 0),

	northwestPosition : function(element) {
		var x = parseInt(element.style.left);
		var y = parseInt(element.style.top);

		return new Coordinate(isNaN(x) ? 0 : x, isNaN(y) ? 0 : y);
	},

	southeastPosition : function(element) {
		return Coordinates.northwestPosition(element).plus(
				new Coordinate(element.offsetWidth, element.offsetHeight));
	},

	northwestOffset : function(element, isRecursive) {
		var offset = new Coordinate(element.offsetLeft, element.offsetTop);

		if (!isRecursive) return offset;

		var parent = element.offsetParent;
		while (parent) {
			offset = offset.plus(
					new Coordinate(parent.offsetLeft, parent.offsetTop));
			parent = parent.offsetParent;
		}
		return offset;
	},

	southeastOffset : function(element, isRecursive) {
		return Coordinates.northwestOffset(element, isRecursive).plus(
				new Coordinate(element.offsetWidth, element.offsetHeight));
	},

	fixEvent : function(event) {
		event.windowCoordinate = new Coordinate(event.clientX, event.clientY);
	}
};

function Coordinate(x, y) {
	this.x = x;
	this.y = y;
}

Coordinate.prototype.toString = function() {
	return "(" + this.x + "," + this.y + ")";
}

Coordinate.prototype.plus = function(that) {
	return new Coordinate(this.x + that.x, this.y + that.y);
}

Coordinate.prototype.minus = function(that) {
	return new Coordinate(this.x - that.x, this.y - that.y);
}

Coordinate.prototype.distance = function(that) {
	var deltaX = this.x - that.x;
	var deltaY = this.y - that.y;

	return Math.sqrt(Math.pow(deltaX, 2) + Math.pow(deltaY, 2));
}

Coordinate.prototype.max = function(that) {
	var x = Math.max(this.x, that.x);
	var y = Math.max(this.y, that.y);
	return new Coordinate(x, y);
}

Coordinate.prototype.constrain = function(min, max) {
	if (min.x > max.x || min.y > max.y) return this;

	var x = this.x;
	var y = this.y;

	if (min.x != null) x = Math.max(x, min.x);
	if (max.x != null) x = Math.min(x, max.x);
	if (min.y != null) y = Math.max(y, min.y);
	if (max.y != null) y = Math.min(y, max.y);

	return new Coordinate(x, y);
}

Coordinate.prototype.reposition = function(element) {
	element.style["top"] = this.y + "px";
	element.style["left"] = this.x + "px";
}

Coordinate.prototype.equals = function(that) {
	if (this == that) return true;
	if (!that || that == null) return false;

	return this.x == that.x && this.y == that.y;
}

// returns true of this point is inside specified box
Coordinate.prototype.inside = function(northwest, southeast) {
	if ((this.x >= northwest.x) && (this.x <= southeast.x) &&
		(this.y >= northwest.y) && (this.y <= southeast.y)) {
		
		return true;
	}
	return false;
}

       function confirm(z)
       {
          window.status = 'Sajax version updated'; 
       }

        function onDrop() {
          var data = DragDrop.serData('g2'); 
          x_sajax_update(data, confirm);
       }

 window.onload = function() {
        
  var list = document.getElementById("l");
  DragDrop.makeListContainer( list, 'g1' );
  list.onDragOver = function() { this.style["background"] = "#EEF"; }; 
  list.onDragOut = function() {this.style["background"] = "none"; };

                list = document.getElementById("edit");
  DragDrop.makeListContainer( list, 'g1' );
                list.onDragOver = function() { this.style["background"] = "#EEF"; }; 
  list.onDragOut = function() {this.style["background"] = "none"; };

  list = document.getElementById("c");
  DragDrop.makeListContainer( list, 'g1' );
                list.onDragOver = function() { this.style["background"] = "#EEF"; };
  list.onDragOut = function() {this.style["background"] = "none"; };
                
                list = document.getElementById("r");
  DragDrop.makeListContainer( list, 'g1' );
                list.onDragOver = function() { this.style["background"] = "#EEF"; };
  list.onDragOut = function() {this.style["background"] = "none"; };

                list = document.getElementById("t");
  DragDrop.makeListContainer( list, 'g1' );
                list.onDragOver = function() { this.style["background"] = "#EEF"; }; 
  list.onDragOut = function() {this.style["background"] = "none"; };

                dlist = document.getElementById("d");
  DragDrop.makeListContainer( dlist, 'g1' );
                dlist.onDragOver = function() { this.style["background"] = "#EEF"; }; 
  dlist.onDragOut = function() {this.style["background"] = "none"; };


 };
        
        function getSort(np)
        {
          order = document.getElementById("order");
          order.value = DragDrop.serData('g1', null);
          document.sd.mod.value=np;
          document.sd.submit();
        }
        
        function showValue() 
        {
          order = document.getElementById("order");
          alert(order.value);
        }
        
        function chgop(DURL)
        {
          location.href=DURL;
        }