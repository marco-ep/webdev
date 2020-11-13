"use strict";

    var emptyX = 300;
	var emptyY = 300;
	var PIECE_SIZE = 100;
	var BOARD_SIZE = 4;

	window.onload = function() {
		createPuzzle();
		document.getElementById("shufflebutton").onclick = shuffle;
	};

	//Sets the intial solved game board
	function createPuzzle() {
        var p=document.getElementById("puzzlearea");
		for (var i = 0; i < 15; i++) {
            var piece = document.createElement("div");
			piece.innerHTML = i + 1;
            piece.classList.add("puzzlepiece");
            
			var row = (i - (Math.floor(i / BOARD_SIZE) * BOARD_SIZE)) * PIECE_SIZE; 
			var col = Math.floor(i / BOARD_SIZE) * PIECE_SIZE;
			
			piece.style.backgroundImage = "url('https://i.imgur.com/xZeq6N1.jpg')";
			piece.style.backgroundPosition = -row + "px " + -col +"px";
			piece.style.left = row + "px";
			piece.style.top = col + "px";
			p.appendChild(piece);
			piece.onclick = move; 
			piece.onmouseover = highlight;
		} 
	}
	
	function highlight() {
		this.onmouseout = unhighlight;
		var x = parseInt(this.style.left);
		var y = parseInt(this.style.top);
		//checks if piece is movable
		if (isMovable(x, y)) {
			this.classList.add("highlight");
		}
	}

	function unhighlight() {
		this.classList.remove("highlight");
	}

	//Swaps the clicked piece with the empty spot
	function move() {
		var x = parseInt(this.style.left);
		var y = parseInt(this.style.top); 
		if (isMovable(x, y)) {
			this.style.left = emptyX + "px";
			this.style.top = emptyY + "px";
			emptyX = x;
			emptyY = y;
		}
        
        if (isWin()){
            notification();
        }
        else{
            clearNotification();
        }
	}

    function isWin(){
        var pieces = document.querySelectorAll("#puzzlearea div");
        var flag = true;

        for(var i = 0; i < 15; i++){
            var x = parseInt(pieces[i].style.left);
            var y = parseInt(pieces[i].style.top);

            if (x != (i%4*100) || y != parseInt(i/4)*100){
                flag = false;
                break;
            }
        }
        //console.log(flag);
        return flag;
    }

    function notification(){
        //window.alert("Congratulations! You \n W I N");
        var o = document.getElementById("output");
        o.innerHTML = "Y O U  W I N";
    }

    function clearNotification(){
        var o = document.getElementById("output");
        o.innerHTML = "";
    }

	function shuffle() {
		for (var i = 0; i < 1000; i++) {
            
			var validPieces = findValid();
			var randPiece = validPieces[Math.floor(Math.random() * validPieces.length)];
			randPiece.click();
		}
	}

	//Finds pieces that are movable
	function findValid() {
		var pieces = document.querySelectorAll("#puzzlearea div");
		var validPieces = [];
		for (var i = 0; i < pieces.length; i++) {
			var x = parseInt(pieces[i].style.left);
			var y = parseInt(pieces[i].style.top);
			if (isMovable(x, y)) {
				validPieces.push(pieces[i]);
			}
		}
		return validPieces;
	}

	//Checks loc of empty and if this piece can move there
	function isMovable(x, y) {
		//Checks if given piece is on the left or right of empty
		if ((x == emptyX - PIECE_SIZE || x == emptyX + PIECE_SIZE) && y == emptyY) {
			return true;
		//Checks if given piece is above or below the empty space
		} else if ((y == emptyY - PIECE_SIZE || y == emptyY + PIECE_SIZE) && x == emptyX) {
			return true;
		} 
		return false;
	}