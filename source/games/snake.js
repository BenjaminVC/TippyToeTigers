class Snake {
  constructor(blockSize, totalRow, totalCol) {
    this.blockSize = blockSize;
    this.totalRow = totalRow;
    this.totalCol = totalCol;
    this.board = null;
    this.context = null;
    this.snakeX = blockSize * 5;
    this.snakeY = blockSize * 5;
    this.speedX = 0;
    this.speedY = 0;
    this.snakeBody = [];
    this.foodX = null;
    this.foodY = null;
    this.gameOver = false;
    this.score = 1;
    this.round_id = null;
    this.game_id = 2;
    this.category_id = 2;
    this.username = "JohnDoe";
  }

  start() {
    this.round_id = new Date().getTime();
    this.board = document.getElementById("board");
    this.board.height = this.totalRow * this.blockSize;
    this.board.width = this.totalCol * this.blockSize;
    this.context = this.board.getContext("2d");
    this.placeFood();
    document.addEventListener("keyup", this.changeDirection.bind(this));
    setInterval(this.update.bind(this), 1000 / 10);
  }

  update() {
    
    document.getElementById('score').innerHTML = "Score: " + this.score;
      console.log(this.score);
    if (this.gameOver) {
      return;
    }

    this.context.fillStyle = "white";
    this.context.fillRect(0, 0, this.board.width, this.board.height);

    this.context.fillStyle = "#f70a8d";
    this.context.fillRect(this.foodX, this.foodY, this.blockSize, this.blockSize);

    if (this.snakeX == this.foodX && this.snakeY == this.foodY) {
      this.snakeBody.push([this.foodX, this.foodY]);
      this.score += 1;
      this.placeFood();
    }

    for (let i = this.snakeBody.length - 1; i > 0; i--) {
      this.snakeBody[i] = this.snakeBody[i - 1];
    }

    if (this.snakeBody.length) {
      this.snakeBody[0] = [this.snakeX, this.snakeY];
    }

    this.context.fillStyle = "#ffb02e";
    this.snakeX += this.speedX * this.blockSize;
    this.snakeY += this.speedY * this.blockSize;
    this.context.fillRect(this.snakeX, this.snakeY, this.blockSize, this.blockSize);

    for (let i = 0; i < this.snakeBody.length; i++) {
      this.context.fillRect(this.snakeBody[i][0], this.snakeBody[i][1], this.blockSize, this.blockSize);
    }

    if (this.snakeX < 0
        || this.snakeX > this.totalCol * this.blockSize
        || this.snakeY < 0
        || this.snakeY > this.totalRow * this.blockSize) {
      this.gameOver = true;
      document.getElementById('logo').innerHTML = "TIPPYTOETIGERS STATUS = 😿";
      this.context.font = "18px Verdana";
      this.context.strokeText("YOU ARE A LOSER!\nPress 'R' key to restart NOW", 10, 200, 500);
      this.sendScoreToAjax();
    }

    for (let i = 0; i < this.snakeBody.length; i++) {
      if (this.snakeX == this.snakeBody[i][0] && this.snakeY == this.snakeBody[i][1]) {
        this.gameOver = true;
        document.getElementById('logo').innerHTML = "TIPPYTOETIGERS STATUS = 😿";
        this.context.font = "12px Verdana";
        this.context.strokeText("YOU ATE YOURSELF AND YOU ARE A LOSER!\nPress 'R' key to restart NOW", 0, 200, 500);
        this.sendScoreToAjax();
      }
    }
  }

  changeDirection(e) {
    if (e.code == "ArrowUp" && this.speedY != 1) {
      this.speedX = 0;
      this.speedY = -1;
    }
    else if (e.code == "ArrowDown" && this.speedY != -1) {
      this.speedX = 0;
      this.speedY = 1;
    }
    else if (e.code == "ArrowLeft" && this.speedX != 1) {
      this.speedX = -1;
      this.speedY = 0;
  }
  else if (e.code == "ArrowRight" && this.speedX != -1) {
      this.speedX = 1;
      this.speedY = 0;
  }
  else if(e.code == "KeyR") {
    location.reload();
  }
  }

  placeFood() {
      this.foodX = Math.floor(Math.random() * this.totalCol) * this.blockSize;
      this.foodY = Math.floor(Math.random() * this.totalRow) * this.blockSize;
  }

  sendScoreToAjax() {
    // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();

    // Open a new HTTP POST request
    xhr.open("POST", "snake.php", true);

    // Set the Content-Type header to indicate that the data is in JSON format
    // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Define the callback function that will be called when the request is complete
    xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      console.log("Round saved successfully.");
    } 
    else {
      console.error("Error saving round:", xhr.statusText);
    }
  };
    const round_id = this.round_id;
    const username = this.username;
    const game_id = this.game_id;
    const category_id = this.category_id;
    const score = this.score;
  // Encode the data as URL-encoded form data
    const formData = new FormData();
    formData.append('round_id', round_id);
    formData.append('username', username);
    formData.append('game_id', game_id);
    formData.append('category_id', category_id);
    formData.append('score', score);
    // Send the data as a JSON string in the request body
    xhr.send(formData);
  }
}