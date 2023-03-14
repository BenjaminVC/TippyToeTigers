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
     
    }
  
    start() {
      this.board = document.getElementById("board");
      this.board.height = this.totalRow * this.blockSize;
      this.board.width = this.totalCol * this.blockSize;
      this.context = this.board.getContext("2d");
      this.placeFood();
      document.addEventListener("keyup", this.changeDirection.bind(this));
      setInterval(this.update.bind(this), 1000 / 10);
    }
  
    update() {
        console.log("hi");
      if (this.gameOver) {
        return;
      }
  
      this.context.fillStyle = "white";
      this.context.fillRect(0, 0, this.board.width, this.board.height);
  
      this.context.fillStyle = "#f70a8d";
      this.context.fillRect(this.foodX, this.foodY, this.blockSize, this.blockSize);
  
      if (this.snakeX == this.foodX && this.snakeY == this.foodY) {
        this.snakeBody.push([this.foodX, this.foodY]);
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
        alert("YOU ARE A LOSER!");
      }
  
      for (let i = 0; i < this.snakeBody.length; i++) {
        if (this.snakeX == this.snakeBody[i][0] && this.snakeY == this.snakeBody[i][1]) {
          this.gameOver = true;
          alert("YOU ARE A CANNIBAL, AND A LOSER!");
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
    }

    placeFood() {
        this.foodX = Math.floor(Math.random() * this.totalCol) * this.blockSize;
        this.foodY = Math.floor(Math.random() * this.totalRow) * this.blockSize;
    }
}